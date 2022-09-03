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

class PatientInformationController extends Controller
{
    public function PatientInformationView(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
            $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
            $users5 = Login::orderBy('id', 'ASC')->where('user_role','=','Doctor')->get();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             //$users3 = User::where('role','employer')->get();
             return view('patient-information', $data)->with('users4',$users4)->with('users5',$users5);


         }
    }

    public function DoctorPatientInformationView(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
            $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
            $users5 = Login::orderBy('id', 'ASC')->where('user_role','=','Doctor')->get();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             //$users3 = User::where('role','employer')->get();
             return view('doctor-patient-information', $data)->with('users4',$users4)->with('users5',$users5);


         }
    }

    public function SecretaryPatientInformationView(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
            $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
            $users5 = Login::orderBy('id', 'ASC')->where('user_role','=','Doctor')->get();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             //$users3 = User::where('role','employer')->get();
             return view('secretary-patient-information', $data)->with('users4',$users4)->with('users5',$users5);


         }
    }

    public function StaffPatientInformationView(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
            $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
            $users5 = Login::orderBy('id', 'ASC')->where('user_role','=','Doctor')->get();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             //$users3 = User::where('role','employer')->get();
             return view('staff-patient-information', $data)->with('users4',$users4)->with('users5',$users5);


         }
    }

    public function PatientInformation()
    {
        $getEm = $this->getPatientInformation();
        if(request()->ajax())
            {
               return datatables()->of($getEm)
               ->addColumn('action', function($getEm){
                   $button = '<button type="button" id="btn-view-patientinformation" name="btn-view-patientinformation" class="btn btn-primary btn-sm get_appointment" employer-id='. $getEm->id.' data-toggle="modal" data-target="#ViewPatientInformationModal"">View</button>';
                   $button .= '<a class="btn btn-sm btn-danger m-1" id="btn-archive-patient" employer-id='. $getEm->id .' data-toggle="modal" data-target="#archivePatientModal">
                                <i class="fa fa-archive"></i></a>';


               return $button;
           })
           ->rawColumns(['action'])
           ->make(true);
            }
    }

    public function getPatientInformation()
    {

            $getmyappointment = DB::table('tbl_user')
            ->select('tbl_user.*')
            ->where('tbl_user.user_role', 'Patient')
            ->where('tbl_user.archive_status', 'no')
            ->get();

            return  $getmyappointment;
        }

        public function getPatientInfo($id)
        {
            return DB::table('tbl_user')
            ->select('tbl_user.*')
            ->where('tbl_user.id',$id)
            ->get();
        }
    
}
   
