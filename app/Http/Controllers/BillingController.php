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

class BillingController extends Controller
{
    function billing()
    {
            $product = new Product;
            $service = new Service;
            $staff = Login:: where('id','=', session('LoggedUser'))->first();
            $product = $product->readAllProduct();
            $service = $service->readAllService();
            $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
            //   $CountPendingEmployer = DB::table('users')->where('role','=', 'employer')->where('status','=', 'Pending')->count();
            //   $CountApprovedEmployer = DB::table('users')->where('role','=', 'employer')->where('status','=', 'Approved')->count();
            //    $CountPendingJob = DB::table('job_posts')->where('jobstatus','=', 'Pending')->count();
            //    $CountApprovedJob = DB::table('job_posts')->where('jobstatus','=', 'Approved')->count();
            $data = [
                'LoggedUserInfo' => $staff,
                // 'CountPendingEmployer' => $CountPendingEmployer,
                // 'CountApprovedEmployer' => $CountApprovedEmployer,
                // 'CountPendingJob' => $CountPendingJob,
                // 'CountApprovedJob' => $CountApprovedJob
            ];
            return view('billing', $data,compact('product','service'))->with('users4',$users4);
    }

    function doctorbilling()
    {
            $product = new Product;
            $service = new Service;
            $staff = Login:: where('id','=', session('LoggedUser'))->first();
            $product = $product->readAllProduct();
            $service = $service->readAllService();
            $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
            $users6 = DB::table('tbl_user')
            ->select('tbl_user.*','tbl_branch.branchname')
            ->leftJoin('tbl_branch', 'tbl_user.branch_id', '=', 'tbl_branch.id')
            ->where('tbl_user.id','=', session('LoggedUser'))
            ->first();
            //   $CountPendingEmployer = DB::table('users')->where('role','=', 'employer')->where('status','=', 'Pending')->count();
            //   $CountApprovedEmployer = DB::table('users')->where('role','=', 'employer')->where('status','=', 'Approved')->count();
            //    $CountPendingJob = DB::table('job_posts')->where('jobstatus','=', 'Pending')->count();
            //    $CountApprovedJob = DB::table('job_posts')->where('jobstatus','=', 'Approved')->count();
            $data = [
                'LoggedUserInfo' => $staff,
                'users6' =>  $users6,
                // 'CountPendingEmployer' => $CountPendingEmployer,
                // 'CountApprovedEmployer' => $CountApprovedEmployer,
                // 'CountPendingJob' => $CountPendingJob,
                // 'CountApprovedJob' => $CountApprovedJob
            ];
            return view('doctor-billing', $data,compact('product','service'))->with('users4',$users4);
    }

    function secretarybilling()
    {
            $product = new Product;
            $service = new Service;
            $staff = Login:: where('id','=', session('LoggedUser'))->first();
            $product = $product->readAllProduct();
            $service = $service->readAllService();
            $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
            $users6 = DB::table('tbl_user')
            ->select('tbl_user.*','tbl_branch.branchname')
            ->leftJoin('tbl_branch', 'tbl_user.branch_id', '=', 'tbl_branch.id')
            ->where('tbl_user.id','=', session('LoggedUser'))
            ->first();
            //   $CountPendingEmployer = DB::table('users')->where('role','=', 'employer')->where('status','=', 'Pending')->count();
            //   $CountApprovedEmployer = DB::table('users')->where('role','=', 'employer')->where('status','=', 'Approved')->count();
            //    $CountPendingJob = DB::table('job_posts')->where('jobstatus','=', 'Pending')->count();
            //    $CountApprovedJob = DB::table('job_posts')->where('jobstatus','=', 'Approved')->count();
            $data = [
                'LoggedUserInfo' => $staff,
                'users6' =>  $users6,
                // 'CountPendingEmployer' => $CountPendingEmployer,
                // 'CountApprovedEmployer' => $CountApprovedEmployer,
                // 'CountPendingJob' => $CountPendingJob,
                // 'CountApprovedJob' => $CountApprovedJob
            ];
            return view('secretary-billing', $data,compact('product','service'))->with('users4',$users4);
    }

    public function readAllProduct($type,$billingbranch)
    {
        if($type == 'Product')
        {
            $product = new Product;
            return DB::table('tbl_product as P')
            ->select("P.*", 'P.id as product_code',
                    'productname',
                    'reorder', 
                    'orig_price', 
                    'selling_price', 
                    'qty', 
                    'C.name as category',
                    'B.branchname'
                    )
            ->leftJoin('tbl_category as C', 'C.id', '=', 'P.category_id')
            ->leftJoin('tbl_branch as B', 'B.id', '=', 'P.branch_id')
            ->where('P.status', 1)
            ->where('P.branch_id', $billingbranch)
            ->get();
        }
        else{
            $service = new Service;
            return DB::table('tbl_service as P')
            ->select("P.*", 'P.id as service_code',
                    'servicename',
                    'orig_price', 
                    'selling_price',
                    'B.branchname' 
                    )
            ->leftJoin('tbl_branch as B', 'B.id', '=', 'P.branch_id')
            ->where('P.status', 1)
            ->where('P.branch_id', $billingbranch)
            ->get();
        }

    }

    public function searchProduct(Request $request)
    {
        $data = $request->all();
        $key = $data['search_key'];
        $key2 = $data['billingbranch'];
        $key3 = $data['type'];
        if($key3 == 'Product')
        {
            return DB::table('tbl_product')
            ->select("tbl_product.*")
            ->where('tbl_product.status', 1)
            ->where('tbl_product.productname', 'LIKE', '%'.$key.'%')
            ->where('tbl_product.branch_id', $key2)
            ->get();
        }
        if($key3 == 'Service')
        {
            return DB::table('tbl_service')
            ->select("tbl_service.*")
            ->where('tbl_service.status', 1)
            ->where('tbl_service.servicename', 'LIKE', '%'.$key.'%')
            ->where('tbl_service.branch_id', $key2)
            ->get();
        }
    }

    public function addToTray(Request $request)
    {
            $product_code = $request->input('product_code');
            $qty = $request->input('qty');
            $amount = $request->input('amount');
           
            if($this->isProductExists($product_code)){
                DB::table('tbl_billingtray')
                ->where('product_id', $product_code)
                ->update(array(
                    'amount' => DB::raw('amount + '. $amount),
                    'qty' => DB::raw('qty + '. $qty)));
            }
            else{
                $c = new Billing;
                $c->product_id = $product_code;
                $c->user_id = session('LoggedUser');
                $c->qty = $qty;
                $c->amount = $amount;
                $c->save();
            }
    }

    public function checkProductQty($product_code, $qty_order)
    {
        $inventory_qty = DB::table('tblexpiration')
            ->where('tbl_billingtray', $product_code)
            ->sum('qty');
            
        
        return $inventory_qty >= $qty_order ? '1' : '0';

    }

    public function isProductExists($product_code){
        $p = DB::table('tbl_billingtray')->where('product_id', $product_code)->where('user_id', session('LoggedUser'));
        if($p->count() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function readTray(){
        $cashiering = new Billing;
        return $cashiering->readCashieringTray();
    }

    public function void(Request $request, $id)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        
        $data = DB::table('tbl_user')
            ->where('username', $username)
            ->where('user_role', 'System Admin')
            ->orWhere('user_role', 'Doctor')
            ->first();
            
        if ($data) {
            // if password is correct, void the item. 
            if ($password == $data->password) {      
                DB::table('tbl_billingtray')->where('id', $id)->delete();
                return 'success';
            }
            else {
                return 'failed';
            }
        }
        else {
            return 'failed';
        }
       
    }

    public function recordSale(Request $request)
    {
        $input =$request->all();
        $cashiering = new Billing;
        $data = $cashiering->readCashieringTray();
        $invoice_no = $input['invoice_no'];

        if (!$this->isInvoiceExists($invoice_no)) {
            foreach ($data as $items) {
                $sales = new Sales;
                $sales->invoice_no = $invoice_no;
                $sales->product_id = $items->product_id;
                $sales->productname = $items->productname;
                if($items->productname == null)
                {
                    $sales->productname = $items->servicename;
                }
                $sales->qty = $items->qty_order;
                $sales->amount = $items->amount;
                $sales->payment_method = $input['payment_method'];
                $sales->user_id = $input['id'];
                $sales->branch_id = $input['billingbranch2'];
                $sales->wholesale_discount_amount = $input['wholesale_discount_amount2'];
                $sales->senior_pwd_discount_amount = $input['senior_pwd_discount_amount2'];
                $sales->order_from = 'walk-in';
                $sales->status = 1;
                $sales->save();
    
                $this->updateInventory($items->product_id, $items->qty_order);
            }

            return 'success';
        }
        else {
            return 'invoice_exists';
        }
    }

    public function isInvoiceExists($invoice_no){
        $row = DB::table('tbl_sales')->where('invoice_no', $invoice_no)->get();
        return count($row) > 0 ? true : false;
    }

    public function updateInventory($product_id, $qty){
        
        DB::table('tbl_product')
            ->where('id', $product_id)
            ->update([
                'qty' => DB::raw('qty - '. $qty .'')
            ]);

            $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'Billing', 'Billing Success');
    }

    public function readOneQty($product_code){
        return DB::table('tbl_billingtray')
            ->where('product_id', $product_code)
            ->first('qty');
    }

    

    public function previewInvoice($wholesale_discount_amount, $senior_pwd_discount_amount, $billingbranch, $patientname){

        // $selectedbranch = DB::table('tbl_branch')
        // ->select('tbl_branch.branchname')
        // ->where('id', $billingbranch)
        // ->get();

        $selectedbranch =  ClinicBranch::find($billingbranch);
       
        
        $cashiering = new Billing;
        $data = $cashiering->readCashieringTray();
        $output = $this->generateSalesInvoice($data, $wholesale_discount_amount, $senior_pwd_discount_amount, $selectedbranch, $patientname);

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

    public function generateSalesInvoice($product, $wholesale_discount_amount, $senior_pwd_discount_amount, $selectedbranch, $patientname){

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
        <p class="p-details address" style="text-align:left;">Patient Name: '.$patientname .'</p>
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
        // $cashiering = new Billing;
        // $cashiering->truncate();
        DB::table('tbl_billingtray')->where('user_id', session('LoggedUser'))->delete();
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
