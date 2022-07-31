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
use App\Models\Category;
use App\Helpers\base;

class InventoryController extends Controller
{
    public function Inventory(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
            $users3 = Category::orderBy('name', 'ASC')->get();
            $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             //$users3 = User::where('role','employer')->get();
             return view('inventory', $data)->with('users3',$users3)->with('users4',$users4);


         }
    }

    public function InventoryDisplay(Request $request)
    {
        $getEm = $this->getProduct($request->inventorybranch);
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

    public function ReorderDisplay(Request $request)
    {
        $getEm = $this->getReorder($request->inventorybranch);
         if(request()->ajax())
             {
                return datatables()->of($getEm)
                ->addColumn('action', function($getEm){
                $button = '<a class="btn btn-sm" id="btn-inventory-product" employer-id='. $getEm->id .' data-toggle="modal" data-target="#EditReorderProductModal">
                    <i class="fas fa-eye"></i></a>';

                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }
    }

    public function getProduct($inventorybranch)
    {
        if($inventorybranch == 'All Branches')
        {
            $getproduct = DB::table('tbl_product')
            ->select('tbl_product.*','tbl_category.name','tbl_branch.branchname')
            ->leftJoin('tbl_category', 'tbl_product.category_id', '=', 'tbl_category.id')
            ->leftJoin('tbl_branch', 'tbl_product.branch_id', '=', 'tbl_branch.id')
            ->where('tbl_product.status', '1')
            ->get();

            return $getproduct; 
        }
        else{
            $getproduct = DB::table('tbl_product')
            ->select('tbl_product.*','tbl_category.name','tbl_branch.branchname')
            ->leftJoin('tbl_category', 'tbl_product.category_id', '=', 'tbl_category.id')
            ->leftJoin('tbl_branch', 'tbl_product.branch_id', '=', 'tbl_branch.id')
            ->where('tbl_product.status', '1')
            ->where('tbl_product.branch_id',$inventorybranch)
            ->get();

            return $getproduct; 
        }   
    }

    public function getReorder($inventorybranch)
    {
        if($inventorybranch == 'All Branches')
        {
            $getproduct = DB::table('tbl_product')
            ->select('tbl_product.*','tbl_category.name','tbl_branch.branchname')
            ->leftJoin('tbl_category', 'tbl_product.category_id', '=', 'tbl_category.id')
            ->leftJoin('tbl_branch', 'tbl_product.branch_id', '=', 'tbl_branch.id')
            ->where('tbl_product.status', '1')
            ->whereColumn('tbl_product.reorder','>=', 'tbl_product.qty')
            ->get();

            return $getproduct; 
        }
        else{
            $getproduct = DB::table('tbl_product')
            ->select('tbl_product.*','tbl_category.name','tbl_branch.branchname')
            ->leftJoin('tbl_category', 'tbl_product.category_id', '=', 'tbl_category.id')
            ->leftJoin('tbl_branch', 'tbl_product.branch_id', '=', 'tbl_branch.id')
            ->where('tbl_product.status', '1')
            ->where('tbl_product.branch_id',$inventorybranch)
            ->whereColumn('tbl_product.reorder','>=', 'tbl_product.qty')
            ->get();

            return $getproduct; 
        }     
    }

    public function getInventoryData($id)
    {
        $get_product = DB::table('tbl_product')
        ->select('tbl_product.*','tbl_category.name','tbl_branch.branchname')
        ->leftJoin('tbl_category', 'tbl_product.category_id', '=', 'tbl_category.id')
        ->leftJoin('tbl_branch', 'tbl_product.branch_id', '=', 'tbl_branch.id')
        ->where('tbl_product.status', '1')
        ->where('tbl_product.id', $id)
        ->get();
        return  $get_product;
    }

    public function updateQuantityProduct(Request $request)
    {
        $id = $request->input('id');   
        DB::table('tbl_product')
        ->where('id', $id)
                ->update([
                    'qty' => DB::raw('qty + '.$request->input('qty')),
                ]);
            //     $product->productname = $request->input('productname');
            // $product->category_id = $request->input('category_id');
            // $product->reorder = $request->input('reorder');
            // $product->qty = $request->input('qty');
            // $product->orig_price = $request->input('originalprice');
            // $product->selling_price = $request->input('sellingprice');
            // $product->markup = $request->input('markup');
            // $product->status = '1';
                $getname = Session::get('Name');
                $getusertype = Session::get('User-Type');
                base::recordAction( $getname, $getusertype,'Inventory', 'Update Quantity Sucessfully');
                 return response()->json(['status'=>0,'success'=>'success']);
            // }
            // else
            // {
                return response()->json(['status'=>1,'success'=>'success']);
            // }
            // $category = $request->input('editcategory');
            // base::recordAction(Auth::id(), 'Book Maintenance', 'update');
            //return redirect('/book-maintenance')->with('success', 'Data updated successfully');
            
    }
}
