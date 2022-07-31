<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Billing;
use App\Models\Product;
use App\Models\Service;
use App\Models\Sales;
use App\Models\ClinicBranch;
use App\Models\BookAppointment;
use App\Models\AppointmentReport;
use App\Models\MailVerify;
use Mail;
use App\Helpers\base; 

class BackupAndRestoreController extends Controller
{
    public function backupandrestore()
    {
        $staff = Login:: where('id','=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $staff
            ];
            return view('backup-and-restore', $data);
    }
      public function download(){

        // Artisan::call('backup:run');
        // // dd(Artisan::output());
        // $path = storage_path('app/Laravel/*');
        // $latest_ctime = 0;
        // $latest_filename = '';
        // $files = glob($path);
        // foreach($files as $file)
        // {
        //         if (is_file($file) && filectime($file) > $latest_ctime)
        //         {
        //                 $latest_ctime = filectime($file);
        //                 $latest_filename = $file;
        //         }
        // }
        // return response()->download($latest_filename);
    //      $mysqlHostName      = env('DB_HOST');
    //   $mysqlUserName      = env('DB_USERNAME');
    //   $mysqlPassword      = env('DB_PASSWORD');
    //   $DbName             = env('DB_DATABASE');
    //   $file_name = 'DB_Backup-' . date('y-m-d') . '.sql';


    //   $queryTables = \DB::select(\DB::raw('SHOW TABLES'));
    //     foreach ( $queryTables as $table )
    //     {
    //         foreach ( $table as $tName)
    //         {
    //             $tables[]= $tName ;
    //         }
    //     }
    //   $tables  = array("users","applicants","employers","job_posts","saved_job_posts","apply_jobs"
    //   ,"work_experiences","educational_backgrounds","regions","categories","staff","applicantreports",
    //   "audit_trails"); //here your tables...

    //   $connect = new \PDO("mysql:host=$mysqlHostName;dbname=$DbName;charset=utf8", "$mysqlUserName", "$mysqlPassword",array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    //   $get_all_table_query = "SHOW TABLES";
    //   $statement = $connect->prepare($get_all_table_query);
    //   $statement->execute();
    //   $result = $statement->fetchAll();
    //   $output = '';
    //   foreach($tables as $table)
    //   {
    //       $show_table_query = "SHOW CREATE TABLE " . $table . "";
    //       $statement = $connect->prepare($show_table_query);
    //       $statement->execute();
    //       $show_table_result = $statement->fetchAll();

    //       foreach($show_table_result as $show_table_row)
    //       {
    //           $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
    //       }
    //       $select_query = "SELECT * FROM " . $table . "";
    //       $statement = $connect->prepare($select_query);
    //       $statement->execute();
    //       $total_row = $statement->rowCount();

    //       for($count=0; $count<$total_row; $count++)
    //       {
    //           $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
    //           $table_column_array = array_keys($single_result);
    //           $table_value_array = array_values($single_result);
    //           $output .= "\nINSERT INTO $table (";
    //           $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
    //           $output .= "'" . implode("','", $table_value_array) . "');\n";
    //       }
    //   }

    //   $file_handle = fopen($file_name, 'w+');
    //   fwrite($file_handle, $output);
    //   fclose($file_handle);
    //   header('Content-Description: File Transfer');
    //   header('Content-Type: application/octet-stream');
    //   header('Content-Disposition: attachment; filename=' . basename($file_name));
    //   header('Content-Transfer-Encoding: binary');
    //   header('Expires: 0');
    //   header('Cache-Control: must-revalidate');
    //   header('Pragma: public');
    //   header('Content-Length: ' . filesize($file_name));
    //   ob_clean();
    //   flush();
    //   readfile($file_name);
    //   unlink($file_name);
    // //   dd($file_name);
    //   return response()->download($file_name);
     $get_all_table_query = "SHOW TABLES";
    $result = DB::select(DB::raw($get_all_table_query));

    $tables = [
        'tbl_appointment','tbl_audit_trail','tbl_appointmentreport','tbl_billingtray','tbl_branch','tbl_category'
        ,'tbl_certification','tbl_discount','tbl_doctor','tbl_doctorschedule','tbl_prescription','tbl_product',
        'tbl_sales','tbl_service','tbl_user'
    ];
    //  $tables = [
    //     'users','applicants','employers','job_posts',
    //   'regions','categories','staff','reports',
    //   'audit_trails'
    // ];

    $structure = '';
    $data = '';
    foreach ($tables as $table) {
        $show_table_query = "SHOW CREATE TABLE " . $table . "";

        $show_table_result = DB::select(DB::raw($show_table_query));

        foreach ($show_table_result as $show_table_row) {
            $show_table_row = (array)$show_table_row;
            $structure .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
        }
        $select_query = "SELECT * FROM " . $table;
        $records = DB::select(DB::raw($select_query));

        foreach ($records as $record) {
            $record = (array)$record;
            $table_column_array = array_keys($record);
            foreach ($table_column_array as $key => $name) {
                $table_column_array[$key] = '`' . $table_column_array[$key] . '`';
            }

            $table_value_array = array_values($record);
            $data .= "\nINSERT INTO $table (";

            $data .= "" . implode(", ", $table_column_array) . ") VALUES \n";

            foreach($table_value_array as $key => $record_column)
                $table_value_array[$key] = addslashes($record_column);

            $data .= "('" . implode("','", $table_value_array) . "');\n";
        }
    }
    $file_name = 'DB_Backup_' .date('M-d-Y') . '.sql';
    $file_handle = fopen($file_name, 'w + ');

    $output = $structure . $data;
    fwrite($file_handle, $output);
    fclose($file_handle);
    $getname = Session::get('Name');
        $getusertype = Session::get('User-Type');
        base::recordAction( $getname, $getusertype,'Backup and Restore', 'backup');
    return response()->download($file_name);
    
     
    
    
          }
}
