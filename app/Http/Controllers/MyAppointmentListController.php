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
use App\Models\MailMessageAppointment;
use App\Models\MailCancelAppointment;
use App\Helpers\base;
use Mail; 

class MyAppointmentListController extends Controller
{
    public function MyAppointmentListView(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
            $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             //$users3 = User::where('role','employer')->get();
             return view('patient-my-appointment', $data)->with('users4',$users4);


         }
    }

    public function MyAppointmentListData(Request $request)
    {
        $getEm = $this->getMyAppointment($request->myappointmentbranch);
         if(request()->ajax())
             {
                return datatables()->of($getEm)
                ->addColumn('action', function($getEm){
                    $button = '<button type="button" id="btn-view-appointmentpending" name="btn-view-appointmentpending" class="btn btn-primary btn-sm get_appointment" employer-id='. $getEm->I.' patient-id='. session('LoggedUser').' data-toggle="modal" data-target="#ViewAppointmentModal"">View</button>';
                    $button .= ' <button type="button" id="btn-cancel-appointment" name="btn-cancel-appointment" class="btn btn-danger btn-sm get_appointment" employer-ids='. $getEm->I.' patient-id='. session('LoggedUser').' data-toggle="modal" data-target="#cancelconfirmModal"">Cancel</button>';


                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }
    }

    public function MyAppointmentCompleteListData(Request $request)
    {
        $getEm = $this->getMyAppointmentComplete($request->myappointmentbranch);
         if(request()->ajax())
             {
                return datatables()->of($getEm)
                ->addColumn('action', function($getEm){
                    $button = '<button type="button" id="btn-view-appointment" name="btn-view-appointment" class="btn btn-primary btn-sm get_appointment" employer-id='. $getEm->I.' patient-id='. session('LoggedUser').' data-toggle="modal" data-target="#ViewAppointmentModal"">View</button>';


                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }
    }

    public function getMyAppointment($myappointmentbranch)
    {

        if($myappointmentbranch == "All Branches")
        {
            $getmyappointment = DB::table('tbl_appointment')
            ->select('tbl_appointment.*','tbl_appointment.id AS I','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
            'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
            'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_user.name','tbl_user.id','tbl_doctor.specialty')
            ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
            ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_appointment.doctor_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'tbl_appointment.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->where('tbl_appointment.patient_id', session('LoggedUser'))
            ->where('tbl_appointment.status', '!=', 'Completed')
            ->get();

            return  $getmyappointment;
        }
        else
        {
            $getmyappointment = DB::table('tbl_appointment')
            ->select('tbl_appointment.*','tbl_appointment.id AS I','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
            'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
            'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_user.name','tbl_user.id','tbl_doctor.specialty')
            ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
            ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_appointment.doctor_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'tbl_appointment.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->where('tbl_appointment.patient_id', session('LoggedUser'))
            ->where('tbl_doctorschedule.branch_id',$myappointmentbranch)
            ->where('tbl_appointment.status', '!=', 'Completed')
            ->get();

            return  $getmyappointment;
        }
    }

    public function getMyAppointmentComplete($myappointmentbranch)
    {
        //need to rechange in tbl_appointmentreport

        if($myappointmentbranch == "All Branches")
        {
            // $getmyappointment = DB::table('tbl_appointment')
            // ->select('tbl_appointment.*','tbl_appointment.id AS I','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
            // 'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
            // 'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_user.name','tbl_user.id')
            // ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
            // ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            // ->leftJoin('tbl_user', 'tbl_appointment.doctor_id', '=', 'tbl_user.id')
            // ->where('tbl_doctorschedule.status','Active')
            // ->where('tbl_appointment.patient_id', session('LoggedUser'))
            // ->where('tbl_appointment.status','Completed')
            // ->get();

            $getmyappointment = DB::table('tbl_appointmentreport')
            ->select('tbl_appointmentreport.*','tbl_appointmentreport.id AS I','tbl_branch.branchname','tbl_user.name','tbl_user.id','tbl_doctor.specialty')
            ->leftJoin('tbl_doctor', 'tbl_appointmentreport.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->leftJoin('tbl_branch', 'tbl_appointmentreport.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_appointmentreport.doctor_id', '=', 'tbl_user.id')
            ->where('tbl_appointmentreport.patient_id', session('LoggedUser'))
            ->where('tbl_appointmentreport.status','Completed')
            ->get();

            return  $getmyappointment;
        }
        else
        {
            // $getmyappointment = DB::table('tbl_appointment')
            // ->select('tbl_appointment.*','tbl_appointment.id AS I','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
            // 'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
            // 'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_user.name','tbl_user.id')
            // ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
            // ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            // ->leftJoin('tbl_user', 'tbl_appointment.doctor_id', '=', 'tbl_user.id')
            // ->where('tbl_doctorschedule.status','Active')
            // ->where('tbl_appointment.patient_id', session('LoggedUser'))
            // ->where('tbl_doctorschedule.branch_id',$myappointmentbranch)
            // ->where('tbl_appointment.status','Completed')
            // ->get();

            // return  $getmyappointment;

            $getmyappointment = DB::table('tbl_appointmentreport')
            ->select('tbl_appointmentreport.*','tbl_appointmentreport.id AS I','tbl_branch.branchname','tbl_user.name','tbl_user.id','tbl_doctor.specialty')
            ->leftJoin('tbl_doctor', 'tbl_appointmentreport.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->leftJoin('tbl_branch', 'tbl_appointmentreport.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_appointmentreport.doctor_id', '=', 'tbl_user.id')
            ->where('tbl_appointmentreport.patient_id', session('LoggedUser'))
            ->where('tbl_appointmentreport.branch_id',$myappointmentbranch)
            ->where('tbl_appointmentreport.status','Completed')
            ->get();

            return  $getmyappointment;
        }
    }

    public function getMyAppointmentData($id, $patient_id)
    {
        $getmyappointment1 = DB::table('tbl_user')
            ->select('tbl_user.*')
            ->where('tbl_user.id',$patient_id)
            ->get();

            // $getmyappointment2 = DB::table('tbl_appointment')
            // ->select('tbl_appointment.*','tbl_appointment.id AS I','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
            // 'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
            // 'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_user.name','tbl_user.id')
            // ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
            // ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            // ->leftJoin('tbl_user', 'tbl_appointment.doctor_id', '=', 'tbl_user.id')
            // ->where('tbl_appointment.id', $id)
            // ->get();

            $getmyappointment2 = DB::table('tbl_appointmentreport')
            ->select('tbl_appointmentreport.*','tbl_appointmentreport.id AS I','tbl_branch.branchname','tbl_user.name','tbl_user.id','tbl_doctor.specialty')
            ->leftJoin('tbl_doctor', 'tbl_appointmentreport.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->leftJoin('tbl_branch', 'tbl_appointmentreport.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_appointmentreport.doctor_id', '=', 'tbl_user.id')
            ->where('tbl_appointmentreport.id', $id)
            ->get();

            return  [$getmyappointment1,  $getmyappointment2];
    }

    public function getMyAppointmentPendingData($id, $patient_id)
    {
        $getmyappointment1 = DB::table('tbl_user')
            ->select('tbl_user.*')
            ->where('tbl_user.id',$patient_id)
            ->get();

            $getmyappointment2 = DB::table('tbl_appointment')
            ->select('tbl_appointment.*','tbl_appointment.id AS I','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
            'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
            'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_user.name','tbl_user.id','tbl_doctor.specialty')
            ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
            ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_appointment.doctor_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'tbl_appointment.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->where('tbl_appointment.id', $id)
            ->get();

            // $getmyappointment2 = DB::table('tbl_appointmentreport')
            // ->select('tbl_appointmentreport.*','tbl_appointmentreport.id AS I','tbl_branch.branchname','tbl_user.name','tbl_user.id')
            // ->leftJoin('tbl_doctor', 'tbl_appointmentreport.doctor_id', '=', 'tbl_doctor.doctor_id')
            // ->leftJoin('tbl_branch', 'tbl_appointmentreport.branch_id', '=', 'tbl_branch.id')
            // ->leftJoin('tbl_user', 'tbl_appointmentreport.doctor_id', '=', 'tbl_user.id')
            // ->where('tbl_appointmentreport.id', $id)
            // ->get();

            return  [$getmyappointment1,  $getmyappointment2];
    }

    public function CancelMyAppointment($id)
    {
        $exists = DB::table('tbl_appointment')->where('id',$id)
        ->where('status','In Process')
        ->first();

        $status = DB::table('tbl_appointment')->where('id',$id)->where('status','Approved');
        
        if($exists == null)
        {
            if($status->count() == 1){

                $getSecretaryBranch = DB::table('tbl_appointment')
                ->select('tbl_branch.id')
                ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
                ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
                ->where('tbl_appointment.id', $id)
                ->get();

                
                $sec_id = str_replace(['{','}',':','"','id'],'',json_encode($getSecretaryBranch[0]));
                $message =  "Good Day!<br><br>"."<p>One of the Approved Appointments is canceled by the patient<p>";
    
                $email = DB::table('tbl_user')->select('tbl_user.email')->where('branch_id', $sec_id)->where('user_role','Secretary')->get();
                foreach ($email as $mail)
                {
                    Mail::to($email)->send(new MailCancelAppointment($message));
                };

                DB::table('tbl_appointment')
                ->where('id', $id)
                ->delete();
    
                $getname = Session::get('Name');
                $getusertype = Session::get('User-Type');
                base::recordAction( $getname, $getusertype,'Patient Appointment List', 'Cancel Approved Appointment');
                return response()->json(['status'=>0,'success'=>$exists]);
            }
            else{
                DB::table('tbl_appointment')
                ->where('id', $id)
                ->delete();
                $getname = Session::get('Name');
                $getusertype = Session::get('User-Type');
                base::recordAction( $getname, $getusertype,'Patient Appointment List', 'Cancel Appointment');
                return response()->json(['status'=>0,'success'=>$exists]);
            }

        }
        else
        {
        return response()->json(['status'=>1,'success'=>$exists]);
        }
    }
}
