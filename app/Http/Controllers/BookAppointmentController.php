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
use App\Helpers\base;
use Mail; 

class BookAppointmentController extends Controller
{
    public function BookAppointmentView(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
            $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             //$users3 = User::where('role','employer')->get();
             return view('patient-book-appointment', $data)->with('users4',$users4);


         }
    }
    public function BookAppointmentData(Request $request)
    {
        $getEm = $this->getBookAppointment($request->bookappointmentbranch);
         if(request()->ajax())
             {
                return datatables()->of($getEm)
                ->addColumn('action', function($getEm){
                    $button = '<button type="button" id="btn-make-appointment" name="btn-make-appointment" class="btn btn-primary btn-sm get_appointment" employer-id='. $getEm->id.' patient-id='. session('LoggedUser').' data-toggle="modal" data-target="#MakeAppointmentModal"">Get Appointment</button>';


                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }
    }

    public function getBookAppointment($bookappointmentbranch)
    {

        if($bookappointmentbranch == "All Branches")
        {
            $getbookappointment = DB::table('tbl_doctorschedule')
            ->select('tbl_doctorschedule.*','tbl_branch.branchname','tbl_user.name','tbl_doctor.specialty')
            ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_doctorschedule.doctor_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'tbl_doctorschedule.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->where('tbl_doctorschedule.status','Active')
            ->get();

            return  $getbookappointment;
        }
        else
        {
            $getbookappointment = DB::table('tbl_doctorschedule')
            ->select('tbl_doctorschedule.*','tbl_branch.branchname','tbl_user.name','tbl_doctor.specialty')
            ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_doctorschedule.doctor_id', '=', 'tbl_user.id')
            ->where('tbl_doctorschedule.branch_id',$bookappointmentbranch)
            ->where('tbl_doctorschedule.status','Active')
            ->leftJoin('tbl_doctor', 'tbl_doctorschedule.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->get();

            return  $getbookappointment;
        }
    }

    public function getBookAppointmentData($id, $patient_id)
    {
        $getbookappointment1 = DB::table('tbl_user')
            ->select('tbl_user.*')
            ->where('tbl_user.id',$patient_id)
            ->get();

            $getbookappointment2 = DB::table('tbl_doctorschedule')
            ->select('tbl_doctorschedule.*','tbl_branch.branchname','tbl_user.name','tbl_doctor.specialty')
            ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_doctorschedule.doctor_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'tbl_doctorschedule.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->where('tbl_doctorschedule.id',$id)
            ->get();

            return  [$getbookappointment1,  $getbookappointment2];
    }
    public function makeAppointment(Request $request)
    {
        $prefix = 1000;
        $schedule_id = $request->input('schedule_id');
        $patient_id = $request->input('patient_id');
        $doctor_id = $request->input('doctor_id');
        $reason_for_appointment = $request->input('reason_for_appointment');
        $appointmenttime = $request->input('appointmenttime');

        $exists = DB::table('tbl_appointment')->where('doctor_schedule_id',$schedule_id)
                    ->where('patient_id',$patient_id)
                    ->where('doctor_id',$doctor_id)
                    ->whereIn('status',['Pending','Approved','In Process'])
                    // ->orwhere('status','Approved')
                    // ->orwhere('status','In Process')
                    ->first();

        if($exists == null)
        {
            DB::table('tbl_appointment')
            ->insert([
                'doctor_schedule_id' =>  $schedule_id,
                'doctor_id' =>   $doctor_id,
                'patient_id' =>   $patient_id,
                'appointment_number' =>  $prefix + $patient_id,
                'reason_for_appointment' =>  $reason_for_appointment,
                'appointment_time' =>  $appointmenttime,
                'status' =>  'Pending',
            ]);

            $users = Login::where('id', '=',  $patient_id)->first();

            $email = DB::table('tbl_user')
            ->select('tbl_user.email')
            ->where('tbl_user.id', $patient_id)
            ->get();


            $message =  "<p> Good Day " . $users->name  . ", Your Appointment has been add on the Pending List. Please wait for the Approval Result on your email or You can check your status in your account and please check your schedule according to your time, We serve a best service you are looking for and meet your expectations.</p>";

                    Mail::to($email)->send(new MailMessageAppointment($message));

             return response()->json(['status'=>0,'success'=>'success']);

             $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'Book Appointment', 'Book');
        }
        else{
             return response()->json(['status'=>1,'success'=>'success']);
        }

    }
}
