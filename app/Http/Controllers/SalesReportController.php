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

class SalesReportController extends Controller
{
    public function SalesReportView(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
            $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
            $users5 = Login::orderBy('id', 'ASC')->where('user_role','=','Doctor')->get();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             //$users3 = User::where('role','employer')->get();
             return view('sales-report', $data)->with('users4',$users4)->with('users5',$users5);


         }
    }

    public function DoctorSalesReportView(){
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
             return view('doctor-sales-report', $data)->with('users4',$users4)->with('users5',$users5);


         }
    }

    public function SecretarySalesReportView(){
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
             return view('secretary-sales-report', $data)->with('users4',$users4)->with('users5',$users5);


         }
    }

    public function StaffSalesReportView(){
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
             return view('staff-sales-report', $data)->with('users4',$users4)->with('users5',$users5);


         }
    }

    public function SalesReportData(Request $request)
    {
        $getEm = $this->getSalesReport($request->date_from, $request->date_to, $request-> salesreportbranch);
         if(request()->ajax())
             {  
                return datatables()->of($getEm)
            ->make(true);
             }
    }

    public function getSalesReport($date_from, $date_to, $salesreportbranch)
    {

        if($salesreportbranch == 'All Branches')
        {
             return DB::table('tbl_sales AS BR')
                ->select('BR.*','tbl_branch.branchname')
                ->selectRaw('ROUND(BR.amount / BR.qty, 2) AS selling_price')
                ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
                ->leftJoin('tbl_product', 'BR.product_id', '=', 'tbl_product.id')
                ->where('BR.product_id', 'LIKE', '1%')
                ->whereBetween('BR.created_at', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
                ->get();
        }
        else
        {
            return DB::table('tbl_sales AS BR')
                ->select('BR.*','tbl_branch.branchname')
                ->selectRaw('ROUND(BR.amount / BR.qty, 2) AS selling_price')
                ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
                ->leftJoin('tbl_product', 'BR.product_id', '=', 'tbl_product.id')
                ->where('BR.product_id', 'LIKE', '1%')
                ->whereBetween('BR.created_at', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
                ->where('BR.branch_id',$salesreportbranch)
                ->get();
        }
    }
    public function previewSalesReport($date_from, $date_to, $salesreportbranch){

        // $selectedbranch =  ClinicBranch::select('branchname')->where('id',$appointmentreportbranch)->get();
         $selectedbranch =  ClinicBranch::find($salesreportbranch);
 
         $data= $this->getSalesReports($date_from, $date_to, $salesreportbranch);
         $output = $this->generateSalesReport($data, $date_from, $date_to, $salesreportbranch, $selectedbranch);
 
 
         $pdf = \App::make('dompdf.wrapper');
         $pdf->loadHTML($output);
         $pdf->setPaper('A4', 'landscape');
     
         return $pdf->stream();
     }
 
     public function getSalesReports($date_from, $date_to, $salesreportbranch)
     {
        if($salesreportbranch == 'All Branches')
        {
             return DB::table('tbl_sales AS BR')
                ->select('BR.*','tbl_branch.branchname')
                ->selectRaw('ROUND(BR.amount / BR.qty, 2) AS selling_price')
                ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
                ->leftJoin('tbl_product', 'BR.product_id', '=', 'tbl_product.id')
                ->where('BR.product_id', 'LIKE', '1%')
                ->whereBetween('BR.created_at', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
                ->get();
        }
        else
        {
            return DB::table('tbl_sales AS BR')
                ->select('BR.*','tbl_branch.branchname')
                ->selectRaw('ROUND(BR.amount / BR.qty, 2) AS selling_price')
                ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
                ->leftJoin('tbl_product', 'BR.product_id', '=', 'tbl_product.id')
                ->where('BR.product_id', 'LIKE', '1%')
                ->whereBetween('BR.created_at', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
                ->where('BR.branch_id',$salesreportbranch)
                ->get();
        }
     }
     public function generateSalesReport($data, $date_from, $date_to, $salesreportbranch, $selectedbranch)
     {
        $sales = new Sales;
        $total_sales = $sales->computeTotalSales($date_from, $date_to, $salesreportbranch);
         $add = '';
         $add2 = '';
         $add3 = '';
         if($salesreportbranch == 'All Branches')
         {
             $add = 'Optical Clinic';
         }
         else
         {
             $add = $selectedbranch->branchname;
             $add3 = $selectedbranch->address;
         }
         $output = '
         <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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

         .peso{
            font-family: DejaVu Sans, sans-serif;
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
         <h2 style="text-align:center;">Sales Report</h2>
         <h2 style="text-align:center;">For the Month of '.date("F", strtotime($date_from)).' '.date("Y", strtotime($date_from)).'</h2>
         <p style="text-align:right;">Date: '. date("M/d/Y", strtotime($date_from)) .' - '. date("M/d/Y", strtotime($date_to)).'</p>
         <p style="text-align:left;">Total sales: <span class = "peso">&#8369;</span> <b>'. number_format($total_sales,2,'.',',') .'</b></p>
        '.$add2.'
         <br/>
 
      
     
         <table width="100%" style="border-collapse:collapse">                
             <thead>
                 <tr>
                    <th>Invoice No.</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Branch Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Amount</th>
                    <th>Date Time</th>
                 <tr>      
             </thead>
         <tbody>
             ';
             if($data){
                 foreach ($data as $datas) {
                    if($datas->product_id[0] ==1)
                    {
                        $p = 'P-';
                    }
                    else
                    {
                        $p = 'S-';
                    }
                     
                                 $output .='
                         <tr class="align-text">                             
                             <td>INV-'. $datas->invoice_no .'</td>  
                             <td>'. $p . $datas->product_id .'</td>
                             <td>'. $datas->productname .'</td>   
                             <td>'. $datas->branchname .'</td>
                             <td><span class = "peso">&#8369;</span>'. $datas->selling_price .'</td>
                             <td>'. $datas->qty .'</td>   
                             <td><span class = "peso">&#8369;</span>'. $datas->amount .'</td>
                             <td>'. $datas->created_at .'</td>      
                         </tr>
                         ';        
                 } 
             }
             else{
                 echo "No data found";
             }
         
         return $output;
     }
     public function computeSales(Request $request) {

        $input = $request->all();
        $date_from = $input['date_from'];
        $date_to = $input['date_to'];
        $salesreportbranch = $input['salesreportbranch'];

        $data = new Sales;
        return $data->computeTotalSales($date_from, $date_to, $salesreportbranch);
    }

}
