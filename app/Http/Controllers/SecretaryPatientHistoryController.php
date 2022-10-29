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
use App\Helpers\base;

class SecretaryPatientHistoryController extends Controller
{
    public function HistoryView(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             //$users3 = User::where('role','employer')->get();
             return view('secretary-patient-history', $data);


         }
    }

    public function PatientHistoryData()
    {
        $getEm = $this->getHistory();
         if(request()->ajax())
             {
                return datatables()->of($getEm)
                ->addColumn('action', function($getEm){
                $button = '<a class="btn btn-sm btn-success m-1" id="btn-preview-receipt" employer-id='. $getEm->invoice_no .' data-toggle="modal" data-target="#EditCategoryModal">
                    <i class="fa fa-edit"></i></a>';


                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }
    }

    public function getHistory()
    {
        $gethistory = DB::table('tbl_sales')
        ->select('tbl_sales.*', 'tbl_branch.branchname')
        ->leftJoin('tbl_branch', 'tbl_sales.branch_id', '=', 'tbl_branch.id')
        ->where('branch_id',Session::get('Branch'))
        ->groupBy('tbl_sales.invoice_no')
        ->get();

        return $gethistory;
    }

    public function getPatientHistoryData($invoice_no)
    {
        $get_patienthistory = Sales::where('invoice_no',$invoice_no)->get();
        return  $get_patienthistory;
    }

    public function patienthistorypreviewInvoice($wholesale_discount_amount, $senior_pwd_discount_amount, $billingbranch, $patientname, $invoice_no){

        // $selectedbranch = DB::table('tbl_branch')
        // ->select('tbl_branch.branchname')
        // ->where('id', $billingbranch)
        // ->get();

        $selectedbranch =  ClinicBranch::find($billingbranch);
        $selectedpatientname =  Login::find($patientname);
       
        
        $cashiering = new Billing;
        $data = DB::table('tbl_sales as C')
        ->select("C.*", 'S.*' ,'S.selling_price as selling_price2','P.*','C.qty as qty_order', 'C.id as id')
        ->leftJoin('tbl_product as P', 'C.product_id', '=', 'P.id')
        ->leftJoin('tbl_service as S', 'C.product_id', '=', 'S.id')
        ->where('C.branch_id',Session::get('Branch'))
        ->where('C.invoice_no',$invoice_no)
        ->get();
        $output = $this->generateSalesInvoice($data, $wholesale_discount_amount, $senior_pwd_discount_amount, $selectedbranch,  $selectedpatientname);

        $this->removeAllTrayProducts();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($output);
        $pdf->setPaper('A5', 'portrait');
    
        return $pdf->stream('Invoice-#');
    }
    public function readDiscount()
    {
        return Discount::first();
    }

    public function generateSalesInvoice($product, $wholesale_discount_amount, $senior_pwd_discount_amount, $selectedbranch,  $selectedpatientname){

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
            text-align:right;
        }

        .align-text td{
        }

        .w td{
            width:20px;
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
        
        <h2 class="p-name">'.   $selectedbranch->branchname .'</h2>
        <p class="p-details address">'.   $selectedbranch->address .'</p>
        <h3 style="text-align:center;">OFFICIAL RECEIPT</h3>
        <br/>
        <p class="p-details address" style="text-align:left;">Patient Name: '. $selectedpatientname->name .'</p>
        <br/>

     
    
        <table width="100%" style="border-collapse:collapse; border: 1px solid;">                
            <thead>
                <tr>
                    <th>Qty</th>    
                    <th th colspan="1"">Product/Service Name</th>   
                    <th >Price</th>   
                    <th colspan="2" >Amount</th>
                <tr>      
            </thead>
        <tbody>
            ';
            $total_amount = 0;
            $sub_total = 0;
            if($product){
                foreach ($product as $data) {
                    $total_amount += $data->amount;
                    if($data->productname == null || $data->selling_price == null)
                    {
                                $output .='
                        <tr class="align-text">                             
                            <td class="f-courier">'. $data->qty_order .'</td>  
                            <td class="f-courier">'. $data->servicename .'</td>
                            <td class="f-courier">'. number_format($data->selling_price2,2,'.',',') .'</td>   
                            <td class="f-courier align-text" colspan="2" style="width:210px;">'. number_format($data->amount,2,'.',',') .'</td>  
                        </tr>
                        ';
                    }
                    else{
                        $output .='
                <tr class="align-text">                             
                    <td class="f-courier">'. $data->qty_order .'</td>  
                    <td class="f-courier">'. $data->productname .'</td>
                    <td class="f-courier">'. number_format($data->selling_price,2,'.',',') .'</td>   
                    <td class="f-courier align-text" colspan="2" style="width:210px;">'. number_format($data->amount,2,'.',',') .'</td>  
                </tr>
                ';
                    }              
                } 
            }
            else{
                echo "No data found";
            }
            
        $output .='
            <tr>
                <td style="text-align:right;" colspan="4">Total Sales (VAT Inclusive) </td>
                <td class="align-text f-courier">PhP '. number_format($total_amount,2,'.',',') .'</td>
            </tr>

            <tr>
                <td class="ar" colspan="4">Less: VAT </td>
                <td class="align-text f-courier">PhP '. number_format($this->getVAT($total_amount),2,'.',',') .'</td>
            </tr>

            <tr >
                <td class="ar" colspan="2">VATable Sales </td>
                <td ></td>
                <td class="ar">Amount: Net of VAT</td>
                <td class="align-text f-courier">PhP '. number_format($this->getNetOfVAT($total_amount),2,'.',',') .'</td>
            </tr>';


            $total_amount = $total_amount - $wholesale_discount_amount;
            $total_amount = $total_amount - $senior_pwd_discount_amount;

            $output .='
            
            <tr>
                <td class="ar" colspan="2">VAT-Exempt Sales</td>
                <td ></td>
                <td class="ar">Less:Wholesale Discount</td>
                <td class="align-text f-courier"> PhP '. number_format($wholesale_discount_amount,2,'.',',') .'</td>
            </tr>
            <tr>
                <td class="ar" colspan="2">VAT-Exempt Sales</td>
                <td ></td>
                <td class="ar">Less:Senior/PWD Discount</td>
                <td class="align-text f-courier"> PhP '. number_format($senior_pwd_discount_amount,2,'.',',') .'</td>
            </tr>

            <tr>
                <td class="ar" colspan="2">Zero Rated Sales</td>
                <td ></td>
                <td class="ar">Amount Due</td>
                <td class="align-text f-courier"> PhP '. number_format($this->getAmountDue($total_amount),2,'.',',') .'</td>
            </tr>

            <tr>
                <td class="ar" colspan="2">VAT Amount</td>
                <td ></td>
                <td class="ar">Add: VAT</td>
                <td class="align-text f-courier">PhP '. number_format($this->getVAT($total_amount),2,'.',',') .'</td>
            </tr>

            <tr>
                <td style="text-align:right;" colspan="4">Total Amount Due </td>
                <td class="align-text f-courier">PhP '. number_format(($total_amount),2,'.',',')  .'</td>
            </tr>

            </tbody>
        </table>
    
        <div class="b-text">
            <p class="ar line">----------------------------------------</p>
            <p class="ar b-label">Cashier/Authorized Representative</p>
        </div>
    </div>';

        return $output;
    }

    public function getVAT($total_due){
        return $total_due * 0.12;
    }

    public function getNetOfVAT($total_due){
        return $total_due - ($total_due * 0.12);
    }

    public function getAmountDue($total_due){
        return $total_due - $this->getVAT($total_due);
    }

    public function removeAllTrayProducts() {
        $cashiering = new Billing;
        $cashiering->truncate();
    }

    public function getUsernameData($id)
    {
        $get_username = DB::table('tbl_user')
        ->select('tbl_user.*')
         ->where('id',$id)
         ->get();
         return  $get_username;
    }
}
