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
use App\Helpers\base;
use Mail; 

class AppointmentReportController extends Controller
{
    public function AppointmentReportView(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
            $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
            $users5 = Login::orderBy('id', 'ASC')->where('user_role','=','Doctor')->get();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             //$users3 = User::where('role','employer')->get();
             return view('appointment-report', $data)->with('users4',$users4)->with('users5',$users5);


         }
    }

    public function DoctorAppointmentReportView(){
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
             return view('doctor-appointment-report', $data)->with('users4',$users4)->with('users5',$users5);


         }
    }

    public function SecretaryAppointmentReportView(){
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
             return view('secretary-appointment-report', $data)->with('users4',$users4)->with('users5',$users5);


         }
    }

    public function StaffAppointmentReportView(){
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
             return view('staff-appointment-report', $data)->with('users4',$users4)->with('users5',$users5);


         }
    }

    public function AppointmentReportData(Request $request)
    {
        $getEm = $this->getAppointmentReport($request->date_from, $request->date_to, $request->appointmentreportbranch, $request->appointmentreportdoctorname);
         if(request()->ajax())
             {  
                return datatables()->of($getEm)
            ->make(true);
             }
    }

    public function getAppointmentReport($date_from, $date_to, $appointmentreportbranch, $appointmentreportdoctorname)
    {

        if($appointmentreportbranch == 'All Branches' && $appointmentreportdoctorname == 'All Doctors')
        {
             return DB::table('tbl_appointmentreport AS BR')
                ->select('BR.*','tbl_branch.branchname','tbl_user.name AS U','tbl_doctor.name AS D')
                ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
                ->leftJoin('tbl_user', 'BR.patient_id', '=', 'tbl_user.id')
                ->leftJoin('tbl_doctor', 'BR.doctor_id', '=', 'tbl_doctor.doctor_id')
                ->whereBetween('BR.date', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
                ->get();
        }
        if($appointmentreportbranch == 'All Branches')
        {
            return DB::table('tbl_appointmentreport AS BR')
            ->select('BR.*','tbl_branch.branchname','tbl_user.name AS U','tbl_doctor.name AS D')
            ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'BR.patient_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'BR.doctor_id', '=', 'tbl_doctor.doctor_id')
                ->whereBetween('BR.date', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
                ->where('BR.doctor_id',$appointmentreportdoctorname)
                ->get();
        }
        if($appointmentreportdoctorname == 'All Doctors')
        {
            return DB::table('tbl_appointmentreport AS BR')
            ->select('BR.*','tbl_branch.branchname','tbl_user.name AS U','tbl_doctor.name AS D')
            ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'BR.patient_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'BR.doctor_id', '=', 'tbl_doctor.doctor_id')
                ->whereBetween('BR.date', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
                ->where('BR.branch_id',$appointmentreportbranch)
                ->get();
        }
        else
        {
            return DB::table('tbl_appointmentreport AS BR')
            ->select('BR.*','tbl_branch.branchname','tbl_user.name AS U','tbl_doctor.name AS D')
            ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'BR.patient_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'BR.doctor_id', '=', 'tbl_doctor.doctor_id')
                ->whereBetween('BR.date', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
                ->where('BR.doctor_id',$appointmentreportdoctorname)
                ->where('BR.branch_id',$appointmentreportbranch)
                ->get();
        }
    }

    public function previewAppointmentReport($date_from, $date_to, $appointmentreportbranch, $appointmentreportdoctorname){

       // $selectedbranch =  ClinicBranch::select('branchname')->where('id',$appointmentreportbranch)->get();
        $selectedbranch =  ClinicBranch::find($appointmentreportbranch);
        $selecteddoctor =  Login::find($appointmentreportdoctorname);

        $data= $this->getAppointmentReports($date_from, $date_to, $appointmentreportbranch, $appointmentreportdoctorname);
        $output = $this->generateAppointmentReport($data, $date_from, $date_to, $appointmentreportbranch, $appointmentreportdoctorname, $selectedbranch, $selecteddoctor);


        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($output);
        $pdf->setPaper('A4', 'landscape');
    
        return $pdf->stream();
    }

    public function getAppointmentReports($date_from, $date_to, $appointmentreportbranch, $appointmentreportdoctorname)
    {
        if($appointmentreportbranch == 'All Branches' && $appointmentreportdoctorname == 'All Doctors')
        {
            return DB::table('tbl_appointmentreport AS BR')
            ->select('BR.*','tbl_branch.branchname','tbl_user.name AS U','tbl_doctor.name AS D')
            ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'BR.patient_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'BR.doctor_id', '=', 'tbl_doctor.doctor_id')
                ->whereBetween('BR.date', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
                ->get();
        }
        // if($appointmentreportbranch == 'All Branches')
        // {
        //     return DB::table('tbl_appointmentreport AS BR')
        //     ->select('BR.*','tbl_branch.branchname','tbl_user.name AS U','tbl_doctor.name AS D')
        //     ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
        //     ->leftJoin('tbl_user', 'BR.patient_id', '=', 'tbl_user.id')
        //     ->leftJoin('tbl_doctor', 'BR.doctor_id', '=', 'tbl_doctor.doctor_id')
        //         ->whereBetween('BR.date', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
        //         ->where('BR.doctor_id',$appointmentreportdoctorname)
        //         ->get();
        // }
        if($appointmentreportdoctorname == 'All Doctors')
        {
            return DB::table('tbl_appointmentreport AS BR')
            ->select('BR.*','tbl_branch.branchname','tbl_user.name AS U','tbl_doctor.name AS D')
            ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'BR.patient_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'BR.doctor_id', '=', 'tbl_doctor.doctor_id')
                ->whereBetween('BR.date', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
                ->where('BR.branch_id',$appointmentreportbranch)
                ->get();
        }
        else
        {
            return DB::table('tbl_appointmentreport AS BR')
            ->select('BR.*','tbl_branch.branchname','tbl_user.name AS U','tbl_doctor.name AS D')
            ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'BR.patient_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'BR.doctor_id', '=', 'tbl_doctor.doctor_id')
                ->whereBetween('BR.date', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
                ->where('BR.doctor_id',$appointmentreportdoctorname)
                ->where('BR.branch_id',$appointmentreportbranch)
                ->get();
        }
    }
    public function generateAppointmentReport($data, $date_from, $date_to, $appointmentreportbranch, $appointmentreportdoctorname, $selectedbranch, $selecteddoctor)
    {
        $add = '';
        $add2 = '';
        $add3 = '';
        if($appointmentreportbranch == 'All Branches' && $appointmentreportdoctorname == 'All Doctors')
        {
            $add = 'All Optical Clinic and Doctors';
        }
        if($appointmentreportdoctorname == 'All Doctors' && $appointmentreportbranch != 'All Branches')
        {
            $add = $selectedbranch->branchname;
            $add3 = $selectedbranch->address;
        }
        if($appointmentreportbranch != 'All Branches' && $appointmentreportdoctorname != 'All Doctors'){
            $add = $selectedbranch->branchname;
            $add2 = ' <p class="p-details address" style="text-align:left;">Doctor Name: '.$selecteddoctor->name .'</p>';
            $add3 = $selectedbranch->address;
        }
        $output = '
        <style>
        @page { margin: 10px; }
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

        .address{
            text-align:center;
            margin-top:0px;
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
        
        <h2 class="p-name">'.$add.'</h2>
        <p class="p-details address">'. $add3 .'</p>
        <h2 style="text-align:center;">Appointment Report</h2>
        <h2 style="text-align:center;">For the Month of '.date("F", strtotime($date_from)).' '.date("Y", strtotime($date_from)).'</h2>
        <p style="text-align:right;">Date: '. date("M/d/Y", strtotime($date_from)) .' - '. date("M/d/Y", strtotime($date_to)).'</p>
       '.$add2.'
        <br/>

     
    
        <table width="100%" style="border-collapse:collapse">                
            <thead>
                <tr>
                    <th>Patient Name</th>    
                    <th>Doctor Name</th>   
                    <th>Clinic Branch</th>   
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                <tr>      
            </thead>
        <tbody>
            ';
            if($data){
                foreach ($data as $datas) {
                    
                                $output .='
                        <tr class="align-text">                             
                            <td>'. $datas->U .'</td>  
                            <td>'. $datas->D .'</td>
                            <td>'. $datas->branchname .'</td>   
                            <td>'. $datas->date .'</td>
                            <td>'. $datas->time .'</td>    
                        </tr>
                        ';        
                } 
            }
            else{
                echo "No data found";
            }
        
        return $output;
    }
       
    
}
