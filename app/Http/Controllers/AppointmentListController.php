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

class AppointmentListController extends Controller
{
    public function AppointmentListView(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
            $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
            $users5 = Login::orderBy('id', 'ASC')->where('user_role','=','Doctor')->get();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             //$users3 = User::where('role','employer')->get();
             return view('appointment-list', $data)->with('users4',$users4)->with('users5',$users5);


         }
    }
    public function AppointmentList(Request $request)
    {
        $getEm = $this->getAppointmentList($request->date_today,$request->appointmentlistbranch,$request->appointmentlistdoctorname);
         if(request()->ajax())
             {
                return datatables()->of($getEm)
                ->addColumn('action', function($getEm){
                    $button = '<button type="button" id="btn-view-appointmentprescription" name="btn-view-appointmentprescription" class="btn btn-primary btn-sm get_appointment" employer-id='. $getEm->P.' branch-id='. $getEm->B.' patient-id='.  $getEm->id.' data-toggle="modal" data-target="#AppointmentPrescriptionModal"">View</button>';


                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }
    }
    public function getAppointmentList($date_today,$appointmentlistbranch,$appointmentlistdoctorname)
    {

        if($appointmentlistbranch == "All Branches" && $appointmentlistdoctorname == "All Doctors")
        {

            $getmyappointment = DB::table('tbl_appointment')
            ->select('tbl_appointment.*','tbl_appointment.id AS P','tbl_doctor.name AS D','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
            'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
            'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_branch.id AS B','tbl_user.name AS N','tbl_user.id')
            ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
            ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_appointment.patient_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'tbl_appointment.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->where('tbl_doctorschedule.doctor_schedule_date', $date_today)
            ->where('tbl_doctorschedule.status','Active')
            ->whereIn('tbl_appointment.status',['Approved','In Process'])
            ->get();



            return  $getmyappointment;
        }
        if($appointmentlistbranch == "All Branches")
        {

            $getmyappointment = DB::table('tbl_appointment')
            ->select('tbl_appointment.*','tbl_appointment.id AS P','tbl_doctor.name AS D','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
            'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
            'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_branch.id AS B','tbl_user.name AS N','tbl_user.id')
            ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
            ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_appointment.patient_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'tbl_appointment.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->where('tbl_doctorschedule.doctor_schedule_date', $date_today)
            ->where('tbl_doctorschedule.status','Active')
            ->whereIn('tbl_appointment.status',['Approved','In Process'])
            ->where('tbl_doctor.doctor_id',$appointmentlistdoctorname)
            ->get();

            return  $getmyappointment;
        }
        if($appointmentlistdoctorname == "All Doctors")
        {

            $getmyappointment = DB::table('tbl_appointment')
            ->select('tbl_appointment.*','tbl_appointment.id AS P','tbl_doctor.name AS D','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
            'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
            'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_branch.id AS B','tbl_user.name AS N','tbl_user.id')
            ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
            ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_appointment.patient_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'tbl_appointment.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->where('tbl_doctorschedule.doctor_schedule_date', $date_today)
            ->where('tbl_doctorschedule.status','Active')
            ->whereIn('tbl_appointment.status',['Approved','In Process'])
            ->where('tbl_doctorschedule.branch_id',$appointmentlistbranch)
            ->get();

            return  $getmyappointment;
        }
        else
        {

            $getmyappointment = DB::table('tbl_appointment')
            ->select('tbl_appointment.*','tbl_appointment.id AS P','tbl_doctor.name AS D','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
            'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
            'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_branch.id AS B','tbl_user.name AS N','tbl_user.id')
            ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
            ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_appointment.patient_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'tbl_appointment.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->where('tbl_doctorschedule.doctor_schedule_date', $date_today)
            ->where('tbl_doctorschedule.status','Active')
            ->whereIn('tbl_appointment.status',['Approved','In Process'])
            ->where('tbl_doctorschedule.branch_id',$appointmentlistbranch)
            ->where('tbl_doctor.doctor_id',$appointmentlistdoctorname)
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
            'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_user.name','tbl_user.id')
            ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
            ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_appointment.doctor_id', '=', 'tbl_user.id')
            ->where('tbl_doctorschedule.status','Active')
            ->where('tbl_appointment.id', $id)
            ->get();

            return  [$getmyappointment1,  $getmyappointment2];
    }

    public function SavePrescription($id,$patient_id,$prescription,$doctorname,$branch_id,$date,$time,$doctor_id,$day,$branchname,$reason){
        DB::table('tbl_appointment')
        ->where('tbl_appointment.id', $id)
        ->update([
            'status' => 'Completed',
        ]);

        // DB::table('tbl_user')
        //     ->select('tbl_user.email')
        //     ->where('tbl_user.id',$patient_id)
        //     ->get();

        DB::table('tbl_prescription')->insert([
            'patient_id' => $patient_id,
            'prescription' => $prescription,
            'doctor_name' => $doctorname,
            'branchname' => $branchname,
            'date' => $date,
            'time' => $time,
        ]);

        DB::table('tbl_appointmentreport')->insert([
            'patient_id' => $patient_id,
            'doctor_id' => $doctor_id,
            'branch_id' => $branch_id,
            'reason' => $reason,
            'day' => $day,
            'status' => 'Completed',
            'date' => $date,
            'time' => $time,
        ]);

        $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'Appointment Schedule', 'Appointment Completed');
    }
}
