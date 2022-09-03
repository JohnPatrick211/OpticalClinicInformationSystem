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
use App\Models\MailVerify;
use App\Helpers\base;
use Mail; 

class AppointmentApprovalController extends Controller
{
    public function AppointmentApprovalView(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
            $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
            $users5 = Login::orderBy('id', 'ASC')->where('user_role','=','Doctor')->get();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             //$users3 = User::where('role','employer')->get();
             return view('appointment-approval', $data)->with('users4',$users4)->with('users5',$users5);


         }
    }
    public function DoctorAppointmentApprovalView(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
            $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
            $users5 = Login::orderBy('id', 'ASC')->where('user_role','=','Doctor')->get();
            $users6 = DB::table('tbl_user')
            ->select('tbl_user.*','tbl_branch.branchname')
            ->leftJoin('tbl_branch', 'tbl_user.branch_id', '=', 'tbl_branch.id')
            ->where('tbl_user.id','=', session('LoggedUser'))
            ->first();
             $data = [
                 'LoggedUserInfo' => $users2,
                 'users6' =>  $users6,
             ];
             //$users3 = User::where('role','employer')->get();
             return view('doctor-appointment-approval', $data)->with('users4',$users4)->with('users5',$users5);


         }
    }
    public function SecretaryAppointmentApprovalView(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
            $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
            $users5 = Login::orderBy('id', 'ASC')->where('user_role','=','Doctor')->where('branch_id','=',session('Branch'))->get();
            $users6 = DB::table('tbl_user')
            ->select('tbl_user.*','tbl_branch.branchname')
            ->leftJoin('tbl_branch', 'tbl_user.branch_id', '=', 'tbl_branch.id')
            ->where('tbl_user.id','=', session('LoggedUser'))
            ->first();
             $data = [
                 'LoggedUserInfo' => $users2,
                 'users6' =>  $users6,
             ];
             //$users3 = User::where('role','employer')->get();
             return view('secretary-appointment-approval', $data)->with('users4',$users4)->with('users5',$users5);


         }
    }
    public function StaffAppointmentApprovalView(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
            $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
            $users5 = Login::orderBy('id', 'ASC')->where('user_role','=','Doctor')->where('branch_id','=',session('Branch'))->get();
            $users6 = DB::table('tbl_user')
            ->select('tbl_user.*','tbl_branch.branchname')
            ->leftJoin('tbl_branch', 'tbl_user.branch_id', '=', 'tbl_branch.id')
            ->where('tbl_user.id','=', session('LoggedUser'))
            ->first();
             $data = [
                 'LoggedUserInfo' => $users2,
                 'users6' =>  $users6,
             ];
             //$users3 = User::where('role','employer')->get();
             return view('staff-appointment-approval', $data)->with('users4',$users4)->with('users5',$users5);


         }
    }
    public function AppointmentApproval(Request $request)
    {
        $getEm = $this->getAppointmentApproval($request->date_from,$request->date_to,$request->approvalappointmentbranch,$request->appointmentapprovaldoctorname);
         if(request()->ajax())
             {
                return datatables()->of($getEm)
                ->addColumn('action', function($getEm){
                    $button = '<button type="button" id="btn-view-appointmentapproval" name="btn-view-appointmentapproval" class="btn btn-primary btn-sm get_appointment" employer-id='. $getEm->P.' patient-id='.  $getEm->id.' data-toggle="modal" data-target="#ViewAppointmentApprovalModal"">View</button>';


                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }
    }

    public function AppointmentApproved(Request $request)
    {
        $getEm = $this->getAppointmentApprovalComplete($request->date_from,$request->date_to,$request->approvalappointmentbranch,$request->appointmentapprovaldoctorname);
         if(request()->ajax())
             {
                return datatables()->of($getEm)
                ->addColumn('action', function($getEm){
                    $button = '<button type="button" id="btn-view-appointmentapproval" name="btn-view-appointmentapproval" class="btn btn-primary btn-sm get_appointment" employer-id='. $getEm->P.' patient-id='.  $getEm->id.' data-toggle="modal" data-target="#ViewAppointmentApprovalModal"">View</button>';


                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }
    }

    public function getAppointmentApproval($date_from,$date_to,$approvalappointmentbranch,$appointmentapprovaldoctorname)
    {

        if($approvalappointmentbranch == "All Branches" && $appointmentapprovaldoctorname == "All Doctors")
        {

            $getmyappointment = DB::table('tbl_appointment')
            ->select('tbl_appointment.*','tbl_appointment.id AS P','tbl_doctor.name AS D','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
            'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
            'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_user.name AS N','tbl_user.id','tbl_doctor.specialty')
            ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
            ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_appointment.patient_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'tbl_appointment.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->whereBetween('tbl_doctorschedule.doctor_schedule_date', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
            ->where('tbl_appointment.status', 'Pending')
            ->get();



            return  $getmyappointment;
        }
        if($approvalappointmentbranch == "All Branches")
        {


            $getmyappointment = DB::table('tbl_appointment')
            ->select('tbl_appointment.*','tbl_appointment.id AS P','tbl_doctor.name AS D','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
            'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
            'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_user.name AS N','tbl_user.id','tbl_doctor.specialty')
            ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
            ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_appointment.patient_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'tbl_appointment.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->whereBetween('tbl_doctorschedule.doctor_schedule_date', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
            ->where('tbl_appointment.status', 'Pending')
            ->where('tbl_doctor.doctor_id',$appointmentapprovaldoctorname)
            ->get();

            return  $getmyappointment;
        }
        if($appointmentapprovaldoctorname == "All Doctors")
        {


            $getmyappointment = DB::table('tbl_appointment')
            ->select('tbl_appointment.*','tbl_appointment.id AS P','tbl_doctor.name AS D','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
            'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
            'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_user.name AS N','tbl_user.id','tbl_doctor.specialty')
            ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
            ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_appointment.patient_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'tbl_appointment.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->whereBetween('tbl_doctorschedule.doctor_schedule_date', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
            ->where('tbl_appointment.status', 'Pending')
            ->where('tbl_doctorschedule.branch_id',$approvalappointmentbranch)
            ->get();

            return  $getmyappointment;
        }
        else
        {


            $getmyappointment = DB::table('tbl_appointment')
            ->select('tbl_appointment.*','tbl_appointment.id AS P','tbl_doctor.name AS D','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
            'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
            'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_user.name AS N','tbl_user.id','tbl_doctor.specialty')
            ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
            ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_appointment.patient_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'tbl_appointment.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->whereBetween('tbl_doctorschedule.doctor_schedule_date', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
            ->where('tbl_appointment.status', 'Pending')
            ->where('tbl_doctorschedule.branch_id',$approvalappointmentbranch)
            ->where('tbl_doctor.doctor_id',$appointmentapprovaldoctorname)
            ->get();

            return  $getmyappointment;
        }
    }

    public function getAppointmentApprovalComplete($date_from,$date_to,$approvalappointmentbranch,$appointmentapprovaldoctorname)
    {
        //need to rechange in tbl_appointmentreport

        if($approvalappointmentbranch == "All Branches" && $appointmentapprovaldoctorname == "All Doctors")
        {

            $getmyappointment = DB::table('tbl_appointment')
            ->select('tbl_appointment.*','tbl_appointment.id AS P','tbl_doctor.name AS D','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
            'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
            'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_user.name AS N','tbl_user.id','tbl_doctor.specialty')
            ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
            ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_appointment.patient_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'tbl_appointment.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->whereBetween('tbl_doctorschedule.doctor_schedule_date', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
            ->where('tbl_appointment.status','Approved')
            ->get();



            return  $getmyappointment;
        }
        if($approvalappointmentbranch == "All Branches")
        {


            $getmyappointment = DB::table('tbl_appointment')
            ->select('tbl_appointment.*','tbl_appointment.id AS P','tbl_doctor.name AS D','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
            'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
            'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_user.name AS N','tbl_user.id','tbl_doctor.specialty')
            ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
            ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_appointment.patient_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'tbl_appointment.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->whereBetween('tbl_doctorschedule.doctor_schedule_date', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
            ->where('tbl_appointment.status','Approved')
            ->where('tbl_doctor.doctor_id',$appointmentapprovaldoctorname)
            ->get();

            return  $getmyappointment;
        }
        if($appointmentapprovaldoctorname == "All Doctors")
        {


            $getmyappointment = DB::table('tbl_appointment')
            ->select('tbl_appointment.*','tbl_appointment.id AS P','tbl_doctor.name AS D','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
            'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
            'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_user.name AS N','tbl_user.id','tbl_doctor.specialty')
            ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
            ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_appointment.patient_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'tbl_appointment.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->whereBetween('tbl_doctorschedule.doctor_schedule_date', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
            ->where('tbl_appointment.status','Approved')
            ->where('tbl_doctorschedule.branch_id',$approvalappointmentbranch)
            ->get();

            return  $getmyappointment;
        }
        else
        {


            $getmyappointment = DB::table('tbl_appointment')
            ->select('tbl_appointment.*','tbl_appointment.id AS P','tbl_doctor.name AS D','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
            'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
            'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_user.name AS N','tbl_user.id','tbl_doctor.specialty')
            ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
            ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_appointment.patient_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'tbl_appointment.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->whereBetween('tbl_doctorschedule.doctor_schedule_date', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
            ->where('tbl_appointment.status','Approved')
            ->where('tbl_doctorschedule.branch_id',$approvalappointmentbranch)
            ->where('tbl_doctor.doctor_id',$appointmentapprovaldoctorname)
            ->get();

            return  $getmyappointment;
        }
    }
    public function getVerificationInfo($id, $patient_id)
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

            return  [$getmyappointment1,  $getmyappointment2];
    }
    public function approve($id,$patient_id){
        DB::table('tbl_appointment')
        ->where('tbl_appointment.id', $id)
        ->update([
            'status' => 'Approved',
        ]);

        $email = DB::table('tbl_user')
            ->select('tbl_user.email')
            ->where('tbl_user.id',$patient_id)
            ->get();


    $message =  "<p>Message: " . "Good day, your appointment has been approved." . "</p>";

    Mail::to($email)->send(new MailVerify($message));
    $getname = Session::get('Name');
        $getusertype = Session::get('User-Type');
        base::recordAction( $getname, $getusertype,'Appointment Approval', 'Appointment Approved');
    }

    public function reject($id, $patient_id){

        DB::table('tbl_appointment')
        ->where('tbl_appointment.id', $id)
        ->delete();

        $email = DB::table('tbl_user')
            ->select('tbl_user.email')
            ->where('tbl_user.id',$patient_id)
            ->get();

              $message =  "Good Day!<br><br>"."<p>Your Appointment is not available to doctor schedule due to full slots in schedule time<p>";

        Mail::to($email)->send(new MailVerify($message));
        $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'Appointment Approval', 'Appointment Rejected, Patient Name'.$name);
    }

}
