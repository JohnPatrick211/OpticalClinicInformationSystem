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

class CertificationReportController extends Controller
{
    public function CertificationReportView(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
            $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
            $users5 = Login::orderBy('id', 'ASC')->where('user_role','=','Doctor')->get();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             //$users3 = User::where('role','employer')->get();
             return view('certification-report', $data)->with('users4',$users4)->with('users5',$users5);


         }
    }

    public function DoctorCertificationReportView(){
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
             return view('doctor-certification-report', $data)->with('users4',$users4)->with('users5',$users5);


         }
    }

    public function SecretaryCertificationReportView(){
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
             return view('secretary-certification-report', $data)->with('users4',$users4)->with('users5',$users5);


         }
    }

    public function StaffCertificationReportView(){
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
             return view('staff-certification-report', $data)->with('users4',$users4)->with('users5',$users5);


         }
    }

    public function AddCert($patientid, $branchname, $doctorname, $impressions, $diagnosis, $remarks)
    {
        DB::table('tbl_certification')
        ->insert([
            'patient_id' => $patientid,
            'branch_id' => $branchname,
            'doctor_id' => $doctorname,
            'impressions' => $impressions,
            'diagnosis' => $diagnosis,
            'remarks' => $remarks,
            'date' => \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        return response()->json(['status'=>1,'success'=>'success']);
    }
    public function CertificationReportData(Request $request)
    {
        $getEm = $this->getCertificationReport($request->certificationreportbranch,$request->certificationreportdoctorname);
        if(request()->ajax())
        {
           return datatables()->of($getEm)
           ->addColumn('action', function($getEm){
               $button = '<button type="button" id="btn-certificationreport-print" name="btn-certificationreport-print" class="btn btn-primary btn-sm get_appointment" main-id='. $getEm->id.' patient-id='. $getEm->patient_id.' doctor-id='. $getEm->doctor_id. ' branch-id='. $getEm->branch_id.'">View</button>';


           return $button;
       })
       ->rawColumns(['action'])
       ->make(true);
        }
    }

    public function getCertificationReport($certificationreportbranch, $certificationreportdoctorname)
    {

        if($certificationreportbranch == 'All Branches' && $certificationreportdoctorname == 'All Doctors')
        {
             return DB::table('tbl_certification AS BR')
                ->select('BR.*','tbl_branch.branchname','tbl_user.name AS U','tbl_doctor.name AS D')
                ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
                ->leftJoin('tbl_user', 'BR.patient_id', '=', 'tbl_user.id')
                ->leftJoin('tbl_doctor', 'BR.doctor_id', '=', 'tbl_doctor.doctor_id')
                ->get();
        }
        if($certificationreportbranch == 'All Branches')
        {
            return DB::table('tbl_certification AS BR')
            ->select('BR.*','tbl_branch.branchname','tbl_user.name AS U','tbl_doctor.name AS D')
            ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'BR.patient_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'BR.doctor_id', '=', 'tbl_doctor.doctor_id')
                ->where('BR.doctor_id',$certificationreportdoctorname)
                ->get();
        }
        if($certificationreportdoctorname == 'All Doctors')
        {
            return DB::table('tbl_certification AS BR')
            ->select('BR.*','tbl_branch.branchname','tbl_user.name AS U','tbl_doctor.name AS D')
            ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'BR.patient_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'BR.doctor_id', '=', 'tbl_doctor.doctor_id')
                ->where('BR.branch_id',$certificationreportbranch)
                ->get();
        }
        else
        {
            return DB::table('tbl_certification AS BR')
            ->select('BR.*','tbl_branch.branchname','tbl_user.name AS U','tbl_doctor.name AS D')
            ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'BR.patient_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'BR.doctor_id', '=', 'tbl_doctor.doctor_id')
                ->where('BR.doctor_id',$certificationreportdoctorname)
                ->where('BR.branch_id',$certificationreportbranch)
                ->get();
        }
    }

    public function previewCertificationReport($id, $patient_id, $doctor_id, $branch_id){

        // $selectedbranch =  ClinicBranch::select('branchname')->where('id',$appointmentreportbranch)->get();
         $selectedbranch =  ClinicBranch::find($branch_id);
         $selecteddoctor =  Login::find($doctor_id);
         $selectedpatient =  Login::find($patient_id);
 
         $data= $this->getCertificationReports($id);
         $output = $this->generateCertificationReport($data, $doctor_id, $branch_id, $patient_id, $selectedbranch, $selecteddoctor, $selectedpatient);
 
 
         $pdf = \App::make('dompdf.wrapper');
         $pdf->loadHTML($output);
         $pdf->setPaper('A4', 'portrait');
     
         return $pdf->stream();
     }
 
     public function getCertificationReports($id)
     {
             return DB::table('tbl_certification AS BR')
             ->select('BR.*','tbl_branch.branchname','tbl_user.name AS U','tbl_doctor.specialty AS SPECIAL','tbl_user.age AS A','tbl_doctor.name AS D')
             ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
             ->leftJoin('tbl_user', 'BR.patient_id', '=', 'tbl_user.id')
             ->leftJoin('tbl_doctor', 'BR.doctor_id', '=', 'tbl_doctor.doctor_id')
             ->where('BR.id',$id) 
             ->get();
         
     }
     public function generateCertificationReport($data, $doctor_id, $branch_id, $patient_id, $selectedbranch, $selecteddoctor, $selectedpatient)
     {
        if($data){
            foreach ($data as $datas) {
                $add1 = $datas->date;
                $add2 = $datas->U;
                $add3 = $datas->A;
                $add4 = $datas->impressions;
                $add5 = $datas->D;
                $add6 = $datas->diagnosis;
                $add7 = $datas->remarks;
                $add8 = $datas->SPECIAL;           
            } 
        }
        else{
            echo "No data found";
        }
         
         $output = '
         <style>
         @page { margin: 25px; }
         body{ font-family: sans-serif; }
         th{
             border: 1px solid;
         }
         td{
             font-size: 14px;
             border: 1px solid;
             padding-right: 2px;
             padding-left: 2px;
         }
 
         .p-name{
             text-align:center;
             margin-bottom:5px;
         }

         .p-name2{
            padding-top: 10px;
        }

        .p-justify{
            text-align: justify;
            text-justify: inter-word;
        }
 
         .address{
             text-align:center;
             margin-top:0px;
         }
         .address2{
            text-indent: 30px;
        }
 
         .p-details{
             margin:0px;
         }
 
         .ar{
             text-align:right;
         }
 
         .al{
             text-left:right;
         }
 
         .align-text{
             text-align:center;
         }
 
         .align-text td{
         }
 
         .b-text .line{
             margin-bottom:0px;
         }
 
         .b-text .b-label{
             font-size:12px;
             margin-top:-7px;
             margin-right:12px;
             font-style:italic;
         }
 
         .f-courier{
             font-family: monospace, sans-serif;
             font-size:14px;
         }
 
 
          </style>
         <div style="width:100%">
         
         
         <h2 class="p-name">'.$selectedbranch->branchname.'</h2>
         <p class="p-details address">'. $selectedbranch->address .'</p>
         <h2 style="text-align:center;">OPTICAL CERTIFICATE</h2>
         <p style="text-align:right;">Date: '. date("M/d/Y", strtotime($add1)).'</p>
        

         <p>To Whom it May Concern: 
            <p class=" address2"> This is to certify that '.$add2.', '. $add3.' years old was seen and examined 
            by '.$add5.' with the following impression:</p>
            <p class=" p-justify">'.$add4.'</p>
            <p class="p-name2"> DIAGNOSIS: </p>
            <p class=" p-justify">'.$add6.'</p>
            <p class="p-name2"> REMARKS: </p>
            <p class=" p-justify">'.$add7.'</p>
         <p>
         <p>This is issued upon the request for whatever purpose it may serve.</p>
         <p>Thank you very much and God bless.</p>
         <br/>
         <p class = "ar">'.$add5.'<br/> '.$add8.'</p>
         ';
 
             
         return $output;
     }
}
