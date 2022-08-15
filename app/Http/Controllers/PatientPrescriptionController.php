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
use App\Models\Prescription;
use App\Helpers\base;

class PatientPrescriptionController extends Controller
{
    public function PrescriptionView(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             //$users3 = User::where('role','employer')->get();
             return view('patient-prescription', $data);


         }
    }

    public function PatientPrescriptionData()
    {
        $getEm = $this->getPrescription();
         if(request()->ajax())
             {
                return datatables()->of($getEm)
                ->addColumn('action', function($getEm){
                $button = '<a class="btn btn-sm btn-success m-1" id="btn-preview-prescription" employer-id='. $getEm->id .' data-toggle="modal" data-target="#EditCategoryModal">
                    <i class="fa fa-edit"></i></a>';


                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }
    }

    public function getPrescription()
    {
        $getprescription = DB::table('tbl_prescription')
        ->select('tbl_prescription.*', 'tbl_branch.branchname')
        ->leftJoin('tbl_branch', 'tbl_prescription.branchname', '=', 'tbl_branch.id')
        ->where('patient_id',Session::get('LoggedUser'))
        ->get();

        return $getprescription;
    }

    public function getPatientPrescriptionData($id)
    {
        $get_patientprescription = Prescription::where('id',$id)->get();
        return  $get_patientprescription;
    }

    public function patientprescriptionpreview($doctorname, $branchname, $date, $time, $patient_id, $prescription){

        // $selectedbranch =  ClinicBranch::select('branchname')->where('id',$appointmentreportbranch)->get();
         $selectedbranch =  ClinicBranch::find($branchname);
         $selectedpatient =  Login::find($patient_id);
 
         $output = $this->generatePrescription($doctorname, $selectedbranch, $selectedpatient, $date, $time, $prescription);
 
 
         $pdf = \App::make('dompdf.wrapper');
         $pdf->loadHTML($output);
         $pdf->setPaper('A5', 'portrait');
     
         return $pdf->stream();
     }
     public function generatePrescription($doctorname, $selectedbranch, $selectedpatient, $date, $time, $prescription)
     {   
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
             position:absolute; 
             bottom:0px;
             right:0px;
             
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

         hr.class-1 {
            border-top: 3px solid #000000;
        }

        .right img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            position:absolute;
            left:-28px;
            top:200px;
            }
 
 
          </style>
         <div style="width:100%">
         
         
         <h2 class="p-name">'.$selectedbranch->branchname.'</h2>
         <p class="p-details address">'. $selectedbranch->address .'</p>
         <h2 style="text-align:center;">Prescription</h2>
         <hr class="class-1" />
         <hr />

         <p>Patient Name: '.$selectedpatient->name.'<br>
            Age: '.$selectedpatient->age.' &nbsp;  Sex: '.$selectedpatient->gender.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.date("M/d/Y", strtotime($date)).' <br>
           
         </p>
         <div class ="right">
         <img src="img/rx.png" style="width:20%; align:middle;" >
         </div>
         <br><br><br>
         <p align="justify">'.$prescription.'</p>
         <p class = "ar">'.$doctorname.', MD</p>
        

         ';
 
             
         return $output;
     }
}
