<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\MailVerify;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Helpers\base; 

class PatientApprovalController extends Controller
{
    public function PatientApprovalView(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             //$users3 = User::where('role','employer')->get();
             return view('patient-approval', $data);


         }
    }
    public function DoctorPatientApprovalView(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             //$users3 = User::where('role','employer')->get();
             return view('doctor-patient-approval', $data);


         }
    }
    public function SecretaryPatientApprovalView(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             //$users3 = User::where('role','employer')->get();
             return view('secretary-patient-approval', $data);


         }
    }
    public function StaffPatientApprovalView(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             //$users3 = User::where('role','employer')->get();
             return view('staff-patient-approval', $data);


         }
    }
    public function PatientApproval()
    {
        $getEm = $this->getPatient();
         if(request()->ajax())
             {
                return datatables()->of($getEm)
                ->addColumn('action', function($getEm){
                $button = '<a class="btn btn-sm" id="btn-view-upload" employer-id='. $getEm->id .' data-toggle="modal" data-target="#patientapprovalModal">
                    <i class="fas fa-eye"></i></a>';

                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }
    }

    public function PatientApproved()
    {
        $getEm = $this->getPatientApproved();
         if(request()->ajax())
             {
                return datatables()->of($getEm)
                ->addColumn('action', function($getEm){
                $button = '<a class="btn btn-sm" id="btn-view-upload" employer-id='. $getEm->id .' data-toggle="modal" data-target="#patientapprovalModal">
                    <i class="fas fa-eye"></i></a>';

                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }
    }

    public function countValidationEmployer(){

        $getEm = $this->getEmployer();

        return $getEm->count();
    }

    public function getPatient()
    {
        $getpatient = DB::table('tbl_user')
        ->select('tbl_user.*')
        ->where('user_role','Patient')
        ->where('status','Pending')
        ->get();

        return $getpatient;
    }

    public function getPatientApproved()
    {
        $getpatientapproved = DB::table('tbl_user')
        ->select('tbl_user.*')
        ->where('user_role','Patient')
        ->where('status','Approved')
         ->get();

        return $getpatientapproved;       
    }
    public function getVerificationInfo($id){
        $verification_info = DB::table('tbl_user')
        ->select('tbl_user.*')
        ->where('tbl_user.id',$id)
        ->get();
         return  $verification_info;
    }
    
    public function approve($id){
            DB::table('tbl_user')
            ->where('tbl_user.id', $id)
            ->update([
                'status' => 'Approved',
                'archive_status' => 'no'
            ]);

            $name = DB::table('tbl_user')
            ->select('tbl_user.name')
            ->where('tbl_user.id',$id)
            ->get();

            $users = Login::where('id', '=', $id)->first();

            $email = DB::table('tbl_user')
            ->select('tbl_user.email')
            ->where('tbl_user.id',$id)
            ->get();

            $message =  "<p>" . "Good day " . $users->name  . "your account has been verified according to your submitted information. You may proceed using our system and also you can change your profile anytime as you requested. Have a Nice Day!
            Have a Nice Day!" . "</p>";

        Mail::to($email)->send(new MailVerify($message));
        $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'Patient Approval', 'Patient Approved, Patient Name'.$users->name);


    }
    public function reject(Request $request,$id){

        DB::table('tbl_user')
        ->where('tbl_user.id', $id)
        ->delete();

        $name = DB::table('tbl_user')
        ->select('tbl_user.name')
        ->where('tbl_user.id',$id)
        ->get();

        $users = Login::where('id', '=', $id)->first();

        $email = $request->input('email');
              $message =  "Good Day" . $users->name  . "<br><br>"."<p>We really appreciate the effort you put into this. Unfortunately, We are unable to approve your account at this time. We received and have reviewed the content of your information. At this moment, we would encourage you to check and re-arrange the details herein. You may sign up again in our website. <br><br>Have a Nice Day!<p>";

        Mail::to($email)->send(new MailVerify($message));
        $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'Patient Approval', 'Patient Rejected');
    }
}
