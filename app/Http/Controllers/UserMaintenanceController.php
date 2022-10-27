<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ClinicBranch;
use App\Helpers\base;

class UserMaintenanceController extends Controller
{
    public function usermaintenance(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             $users3 = Login::all();
             $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
             $getEm = $this->getAdmin();
            if(request()->ajax())
                {
                return datatables()->of($getEm)
                ->addColumn('action', function($getEm){
                $button = '<a class="btn btn-sm btn-success m-1" id="btn-edit-user" employer-id="'. $getEm->id .'" user-type="'. $getEm->user_role .'"data-toggle="modal" data-target="#editUserModal">
                    <i class="fa fa-edit"></i></a>';
                    // $button .= '<a class="btn btn-sm btn-danger m-1" id="btn-archive-user" employer-id='. $getEm->id .' data-toggle="modal" data-target="#archiveModal">
                    // <i class="fa fa-archive"></i></a>';


                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }
             return view('user-maintenance', $data)->with('users3',$users3)->with('users4',$users4);
         }
    }
    public function getAdmin()
    {
       return DB::table('tbl_user AS BR')
                ->select('BR.*')
                ->where('BR.user_role','=','System Admin')
                ->where('BR.archive_status','=','no')
                ->get();
    }

    public function getDoctor()
    {
       return DB::table('tbl_user AS BR')
                ->select('BR.*', 'tbl_branch.branchname','tbl_doctor.specialty')
                ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
                ->leftJoin('tbl_doctor', 'BR.id', '=', 'tbl_doctor.doctor_id')
                ->where('BR.user_role','=','Doctor')
                ->where('BR.archive_status','=','no')
                ->get();
    }
    public function getSecretary()
    {
       return DB::table('tbl_user AS BR')
                ->select('BR.*', 'tbl_branch.branchname')
                ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
                ->where('BR.user_role','=','Secretary')
                ->where('BR.archive_status','=','no')
                ->get();
    }

    public function getStaff()
    {
       return DB::table('tbl_user AS BR')
                ->select('BR.*', 'tbl_branch.branchname')
                ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
                ->where('BR.user_role','=','Staff')
                ->where('BR.archive_status','=','no')
                ->get();
    }

    public function usermaintenance_doctor()
    {
        $getEm = $this->getDoctor();
        if(request()->ajax())
        {
        return datatables()->of($getEm)
        ->addColumn('action', function($getEm){
        $button = '<a class="btn btn-sm btn-success m-1" id="btn-edit-user" employer-id="'. $getEm->id .'" user-type="'. $getEm->user_role .'"data-toggle="modal" data-target="#editUserModal">
            <i class="fa fa-edit"></i></a>';
            $button .= '<a class="btn btn-sm btn-danger m-1" id="btn-archive-user" employer-id='. $getEm->id .' data-toggle="modal" data-target="#archiveModal">
            <i class="fa fa-archive"></i></a>';


        return $button;
    })
    ->rawColumns(['action'])
    ->make(true);
     }
    }
    public function usermaintenance_secretary()
    {
        $getEm = $this->getSecretary();
        if(request()->ajax())
        {
        return datatables()->of($getEm)
        ->addColumn('action', function($getEm){
        $button = '<a class="btn btn-sm btn-success m-1" id="btn-edit-user" employer-id="'. $getEm->id .'" user-type="'. $getEm->user_role .'"data-toggle="modal" data-target="#editUserModal">
            <i class="fa fa-edit"></i></a>';
            $button .= '<a class="btn btn-sm btn-danger m-1" id="btn-archive-user" employer-id='. $getEm->id .' data-toggle="modal" data-target="#archiveModal">
            <i class="fa fa-archive"></i></a>';


        return $button;
    })
    ->rawColumns(['action'])
    ->make(true);
     }
    }
    public function usermaintenance_staff()
    {
        $getEm = $this->getStaff();
        if(request()->ajax())
        {
        return datatables()->of($getEm)
        ->addColumn('action', function($getEm){
        $button = '<a class="btn btn-sm btn-success m-1" id="btn-edit-user" employer-id="'. $getEm->id .'" user-type="'. $getEm->user_role .'"data-toggle="modal" data-target="#editUserModal">
            <i class="fa fa-edit"></i></a>';
            $button .= '<a class="btn btn-sm btn-danger m-1" id="btn-archive-user" employer-id='. $getEm->id .' data-toggle="modal" data-target="#archiveModal">
            <i class="fa fa-archive"></i></a>';


        return $button;
    })
    ->rawColumns(['action'])
    ->make(true);
     }
    }
    public function getUserDetails($id)
    {
         return DB::table('tbl_user AS BR')
        ->select('BR.*','tbl_doctor.specialty')
        ->leftJoin('tbl_doctor', 'BR.id', '=', 'tbl_doctor.doctor_id')
        ->where('BR.id',$id)
        ->get();
    }
    public function isAdminExist($user_role)
    {
        $row=DB::table('tbl_user')->where('user_role', $user_role);

        return $row->count() > 0 ? true : false;
    }
    public function isUserExist($name)
    {
        $row = DB::table('tbl_user')->where('name', $name);

        if($row->count() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function insertUser(Request $request)
    {

        $doctor = new Login();

        // DB::table('tbl_user')
        // ->insert([
        //     'user_role' => $user_role,
        //     'name' => $name,
        //     'email' => $email,
        //     'address' => $address,
        //     'contactNo' => $contact_no,
        //     'username' => $username,
        //     'password' => $password,
        //     'archive_status' => 'no',
        //     'branch_id' => $branch,
        //     'age' => $age,
        //     'birthdate' => $birthdate,
        //     'gender' => $gender,
        //     'civilstatus' => $civilstatus,
        //     'created_at' => \Carbon\Carbon::now(),
        //     'updated_at' => \Carbon\Carbon::now(),
        // ]);
        if($request->input('specialization') && $request->input('user_type') != 'Doctor')
        {
            $doctor->user_role =  $request->input('user_type');
            $doctor->name =  $request->input('name');
            $doctor->email =  $request->input('email');
            $doctor->address =  $request->input('address');
            $doctor->contactNo =  $request->input('contact_no');
            $doctor->username =  $request->input('username');
            $doctor->password =  $request->input('password');
            $doctor->archive_status =  'no';
            $doctor->branch_id =  $request->input('branch');
            $doctor->age=  $request->input('age');
            $doctor->gender =  $request->input('gender');
            $doctor->birthdate =  $request->input('birthdate');
            $doctor->password =  $request->input('password');
            $doctor->civilstatus =  $request->input('civilstatus');
            $doctor->save();
        }
        else{
            $doctor->user_role =  $request->input('user_type');
            $doctor->name =  $request->input('name');
            $doctor->email =  $request->input('email');
            $doctor->address =  $request->input('address');
            $doctor->contactNo =  $request->input('contact_no');
            $doctor->username =  $request->input('username');
            $doctor->password =  $request->input('password');
            $doctor->archive_status =  'no';
            $doctor->branch_id =  $request->input('branch');
            $doctor->age=  $request->input('age');
            $doctor->gender =  $request->input('gender');
            $doctor->birthdate =  $request->input('birthdate');
            $doctor->password =  $request->input('password');
            $doctor->civilstatus =  $request->input('civilstatus');
            $doctor->save();
            $id = $doctor->id;
            
            DB::table('tbl_doctor')
            ->insert([
            'doctor_id' => $id,
            'name' => $request->input('name'),
            'specialty' => $request->input('specialization'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

        return redirect('user-maintenance')->with('success', 'User Saved');
  


        
        
        $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'User Maintenance', 'Add');
    }

    // public function AddUser(Request $request,$user_role, $name, $email, $contact_no, $address, $username,$password,$age,$birthdate,$gender,$civilstatus,$branch,$specialization)
    // {
        public function AddUser(Request $request)
        {

            if($request->input('user_type') == 'System Admin'){
                if($this->isAdminExist($request->input('user_type')))
                {
                    return back()->with('danger', 'Admin already exist');
                }
                else{
                    return $this->insertUser($request);
                }
            }
            else{
                if($this->isUserExist($request->input('name')))
                {
                    return back()->with('danger', 'User already exist');
                }
                else{

                    return $this->insertUser($request);
                    // return response()->json(['status'=>1,'success'=>'success']);
                }
            }

    }
    public function updateUser(Request $request,$id,$user_role,$name,$email,$contact_no,$address,$username,$password,$age,$birthdate,$gender,$civilstatus,$branch,$specialization)
    {
        if($user_role == 'System Admin')
        {
            DB::table('tbl_user')
            ->where('id', $id)
            ->update([
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'contactNo' => $contact_no,
                'username' => $username,
                'password' => $password,
                'archive_status' => 'no',
                'age' => $age,
                'birthdate' => $birthdate,
                'gender' => $gender,
                'civilstatus' => $civilstatus,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
            
            $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'User Maintenance', 'update');
        }
        else if($user_role == 'Doctor')
        {
            DB::table('tbl_user')
            ->where('id', $id)
            ->update([
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'contactNo' => $contact_no,
                'username' => $username,
                'password' => $password,
                'archive_status' => 'no',
                'branch_id' => $branch,
                'age' => $age,
                'birthdate' => $birthdate,
                'gender' => $gender,
                'civilstatus' => $civilstatus,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            DB::table('tbl_doctor')
            ->where('doctor_id', $id)
            ->update([
            'name' => $name,
            'specialty' => $specialization,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            ]);

            DB::table('tbl_doctorschedule')
                ->where('doctor_id', $id)
                ->update([
                'branch_id' => $branch,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            DB::table('tbl_certification')
                ->where('doctor_id', $id)
                ->update([
                'branch_id' => $branch,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
            
             $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'User Maintenance', 'update');
        }
        else if($user_role == 'Secretary')
        {
            DB::table('tbl_user')
            ->where('id', $id)
            ->update([
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'contactNo' => $contact_no,
                'username' => $username,
                'password' => $password,
                'archive_status' => 'no',
                'branch_id' => $branch,
                'age' => $age,
                'birthdate' => $birthdate,
                'gender' => $gender,
                'civilstatus' => $civilstatus,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
            
             $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'User Maintenance', 'update');
        }
        else if($user_role == 'Staff')
        {
            DB::table('tbl_user')
            ->where('id', $id)
            ->update([
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'contactNo' => $contact_no,
                'username' => $username,
                'password' => $password,
                'archive_status' => 'no',
                'branch_id' => $branch,
                'age' => $age,
                'birthdate' => $birthdate,
                'gender' => $gender,
                'civilstatus' => $civilstatus,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
            
             $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'User Maintenance', 'update');
        }
    }
    public function updateUserWithoutPassword(Request $request,$id,$user_role,$name,$email,$contact_no,$address,$username,$age,$birthdate,$gender,$civilstatus,$branch,$specialization)
    {
        if($user_role == 'System Admin')
        {
            DB::table('tbl_user')
            ->where('id', $id)
            ->update([
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'contactNo' => $contact_no,
                'username' => $username,
                'archive_status' => 'no',
                'age' => $age,
                'birthdate' => $birthdate,
                'gender' => $gender,
                'civilstatus' => $civilstatus,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
            
            $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'User Maintenance', 'update');
        }
        else if($user_role == 'Doctor')
        {
                    DB::table('tbl_user')
                    ->where('id', $id)
                    ->update([
                        'name' => $name,
                        'email' => $email,
                        'address' => $address,
                        'contactNo' => $contact_no,
                        'username' => $username,
                        'archive_status' => 'no',
                        'branch_id' => $branch,
                        'age' => $age,
                        'birthdate' => $birthdate,
                        'gender' => $gender,
                        'civilstatus' => $civilstatus,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);

                    DB::table('tbl_doctor')
                    ->where('doctor_id', $id)
                    ->update([
                    'name' => $name,
                    'specialty' => $specialization,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);

                DB::table('tbl_doctorschedule')
                ->where('doctor_id', $id)
                ->update([
                'branch_id' => $branch,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            DB::table('tbl_certification')
            ->where('doctor_id', $id)
            ->update([
            'branch_id' => $branch,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            ]);
            
             $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'User Maintenance', 'update');
        }
        else if($user_role == 'Secretary')
        {
            DB::table('tbl_user')
            ->where('id', $id)
            ->update([
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'contactNo' => $contact_no,
                'username' => $username,
                'archive_status' => 'no',
                'branch_id' => $branch,
                'age' => $age,
                'birthdate' => $birthdate,
                'gender' => $gender,
                'civilstatus' => $civilstatus,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
            
             $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'User Maintenance', 'update');
        }
        else if($user_role == 'Staff')
        {
            DB::table('tbl_user')
            ->where('id', $id)
            ->update([
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'contactNo' => $contact_no,
                'username' => $username,
                'archive_status' => 'no',
                'branch_id' => $branch,
                'age' => $age,
                'birthdate' => $birthdate,
                'gender' => $gender,
                'civilstatus' => $civilstatus,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
            
             $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'User Maintenance', 'update');
        }
    }
    public function ArchiveUser($id)
    {
        DB::table('tbl_user')
            ->where('id', $id)
            ->update([
                'archive_status' => 'yes',
                'updated_at' => \Carbon\Carbon::now()
                
            ]);
            
            $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'User Maintenance', 'Archive');
    }

    // function import(Request $request)
    // {
    //     $file = $request->file('file');

    //     base::CSVImporter($file);
    //     $no_of_duplicates = Session::get('NO_OF_DUPLICATES');
    //     $getname = Session::get('Name');
    //         $getusertype = Session::get('User-Type');
    //         base::recordAction( $getname, $getusertype,'User Maintenance', 'import');

    //    if($no_of_duplicates>0)
    //    {
    //     return redirect('user-maintenance')
    //     ->with('success', 'PESO Staff information imported successfully! There are '.$no_of_duplicates.' user are not imported because the user is already exists.');
    //    }
    //    else
    //    {
    //     return redirect('user-maintenance')
    //     ->with('success', 'PESO Staff information imported successfully!');
    //    }
    // }

    // public function export(Request $request)
    // {

    //       base::CSVExporter($this->getPESOData());
    //       $getname = Session::get('Name');
    //         $getusertype = Session::get('User-Type');
    //         base::recordAction( $getname, $getusertype,'User Maintenance', 'export');
    // }

    // public function getPESOData()
    // {
    //     return DB::table('tbl_user as U')
    //             ->select('U.id','U.name','U.email','U.contactNo','U.address','U.username','U.password','U.archive_status','U.created_at','U.user_role','U.updated_at')
    //             ->where('user_role', 'PESO Staff')
    //             ->where('archive_status', 'no')
    //             ->get();
    // }
}
