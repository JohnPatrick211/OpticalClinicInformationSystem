<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ClinicBranch;
use App\Helpers\base;

class ProductMaintenanceController extends Controller
{
    // Product
    public function ProductMaintenance(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             $users3 = Category::orderBy('name', 'ASC')->get();
             $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
            //   $users4 = Category::all();
            //   $users5 = Region::orderBy('region', 'ASC')->get();
            //  $users6 = Employer::orderBy('name', 'ASC')->get();
             return view('maintenance-product', $data)->with('users3',$users3)->with('users4',$users4);
         }
    }

    public function DoctorProductMaintenance(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $users3 = Category::orderBy('name', 'ASC')->get();
             $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
            $users6 = DB::table('tbl_user')
            ->select('tbl_user.*','tbl_branch.branchname')
            ->leftJoin('tbl_branch', 'tbl_user.branch_id', '=', 'tbl_branch.id')
            ->where('tbl_user.id','=', session('LoggedUser'))
            ->first();
             $data = [
                 'LoggedUserInfo' => $users2,
                 'users6' =>  $users6,
             ];
             return view('doctor-maintenance-product', $data)->with('users3',$users3)->with('users4',$users4);
         }
    }

    public function SecretaryProductMaintenance(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $users3 = Category::orderBy('name', 'ASC')->get();
             $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
            $users6 = DB::table('tbl_user')
            ->select('tbl_user.*','tbl_branch.branchname')
            ->leftJoin('tbl_branch', 'tbl_user.branch_id', '=', 'tbl_branch.id')
            ->where('tbl_user.id','=', session('LoggedUser'))
            ->first();
             $data = [
                 'LoggedUserInfo' => $users2,
                 'users6' =>  $users6,
             ];
             return view('secretary-maintenance-product', $data)->with('users3',$users3)->with('users4',$users4);
         }
    }
    
    // public function pesostaffCategoryMaintenance(){
    //     if(Session::has('LoggedUser')){
    //         $users2 = DB::table('staff')->where('id','=', session('LoggedUser'))->first();
    //          $data = [
    //              'LoggedUserInfo' => $users2
    //          ];
    //          $users3 = Category::all();
    //          $users4 = Category::all();
    //          $users5 = Region::orderBy('region', 'ASC')->get();
    //          $users6 = Employer::orderBy('name', 'ASC')->get();
    //          return view('pesostaff-maintenance-category', $data)->with('users3',$users3)->with('users4',$users4)->with('users5',$users5)->with('users6',$users6);
    //      }
    // }
    public function storeproduct(Request $request)
    {
        $product = new Product();
        $validateproduct =  Product::where('productname','=', $request->input('productname'))->where('branch_id','=', $request->input('branch_id'))->first();
        if($validateproduct)
        {
            return back()->with('danger', 'Product Already Exist');
        }
        else
        {
        $product->productname = $request->input('productname');
        $product->branch_id = $request->input('productbranch');
        $product->category_id = $request->input('category_id');
        $product->reorder = $request->input('reorder');
        $product->qty = $request->input('qty');
        $product->orig_price = $request->input('originalprice');
        $product->selling_price = $request->input('sellingprice');
        $product->markup = $request->input('markup');
        $product->status = '1';
        $getname = Session::get('Name');
        $getusertype = Session::get('User-Type');
        base::recordAction( $getname, $getusertype,'Product Maintenance', 'Add Product Successfully');
        // return redirect('maintenance-category')->with('success', 'Category Saved');

        if ($request->hasFile('productimage')) {
            $productimage = time().'.jpg';
            $product->image = request()->file('productimage')->storeAs('',   $productimage, 'my_upload');
        }

        $product->save();
        return back()->with('success', 'Product Saved');
        }
    }

    public function updateProduct(Request $request)
    {
        $id = $request->input('id');
        
        // $users = DB::table('tbl_branch')
        // ->Join('tbl_user', 'tbl_branch.id', '=', 'tbl_user.branch_id')
        // ->whereColumn([
        //             ['tbl_branch.id', '=', 'tbl_user.branch_id'],
        //             ])
        //             ->where('tbl_branch.id', $id)
        //             ->get();
        // if($users->isEmpty())
        // {
            if($request->hasFile('file'))
            {
                $productimage = time().'.jpg';
                $request->image = request()->file('file')->storeAs('',   $productimage, 'my_upload');

                DB::table('tbl_product')
                ->where('id', $id)
                ->update([
                    'productname' => $request->input('productname'),
                    'branch_id' => $request->input('branchname'),
                    'category_id' => $request->input('category'),
                    'reorder' => $request->input('reorder'),
                    'qty' => $request->input('qty'),
                    'orig_price' => $request->input('originalprice'),
                    'selling_price' => $request->input('sellingprice'),
                    'markup' => $request->input('markup'),
                    'image' =>  $productimage,
                    
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
                base::recordAction( $getname, $getusertype,'Product Maintenance', 'Update Product Sucessfully');
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
            else
            {
                DB::table('tbl_product')
                ->where('id', $id)
                ->update([
                    'productname' => $request->input('productname'),
                    'branch_id' => $request->input('branchname'),
                    'category_id' => $request->input('category'),
                    'reorder' => $request->input('reorder'),
                    'qty' => $request->input('qty'),
                    'orig_price' => $request->input('originalprice'),
                    'selling_price' => $request->input('sellingprice'),
                    'markup' => $request->input('markup'),
                    //'image' =>  $productimage,
                    
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
                base::recordAction( $getname, $getusertype,'Product Maintenance', 'Update Product Sucessfully');
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

    public function deleteProduct(Request $request, $id)
    {
        // $users = DB::table('tbl_branch')
        // ->Join('tbl_user', 'tbl_branch.id', '=', 'tbl_user.branch_id')
        // ->whereColumn([
        //             ['tbl_branch.id', '=', 'tbl_user.branch_id'],
        //             ])
        //             ->where('tbl_branch.id', $id)
        //             ->get();
        
        // if($users->isEmpty())
        // {
            DB::table('tbl_product')
            ->where('id', $id)
            ->update([
                'status' => '0'     
            ]);
             $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'Product Maintenance', 'Deleted Successfully Product id'.$id);
             return response()->json(['status'=>0,'success'=>'success']);
        // }
        // else
        // {
        // return response()->json(['status'=>1,'success'=>'success']);
        // }
    }

    public function ProductData(Request $request)
    {
        $getEm = $this->getProduct($request->mainproductbranch);
         if(request()->ajax())
             {
                return datatables()->of($getEm)
                ->addColumn('action', function($getEm){
                $button = '<a class="btn btn-sm btn-success m-1" id="btn-edit-product" employer-id='. $getEm->id .' data-toggle="modal" data-target="#EditProductModal">
                    <i class="fa fa-edit"></i></a>';
                    $button .= '<a class="btn btn-sm btn-danger m-1" id="btn-delete-product" employer-id='. $getEm->id .' data-toggle="modal" data-target="#proconfirmModal">
                    <i class="fa fa-archive"></i></a>';


                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }
    }

    public function DoctorProductData(Request $request)
    {
        $getEm = $this->getProduct($request->mainproductbranch);
         if(request()->ajax())
             {
                return datatables()->of($getEm)
                ->addColumn('action', function($getEm){
                $button = '<a class="btn btn-sm btn-success m-1" id="btn-edit-product" employer-id='. $getEm->id .' data-toggle="modal" data-target="#DoctorEditProductModal">
                    <i class="fa fa-edit"></i></a>';
                    $button .= '<a class="btn btn-sm btn-danger m-1" id="btn-delete-product" employer-id='. $getEm->id .' data-toggle="modal" data-target="#proconfirmModal">
                    <i class="fa fa-archive"></i></a>';


                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }
    }

    public function SecretaryProductData(Request $request)
    {
        $getEm = $this->getProduct($request->mainproductbranch);
         if(request()->ajax())
             {
                return datatables()->of($getEm)
                ->addColumn('action', function($getEm){
                $button = '<a class="btn btn-sm btn-success m-1" id="btn-edit-product" employer-id='. $getEm->id .' data-toggle="modal" data-target="#SecretaryEditProductModal">
                    <i class="fa fa-edit"></i></a>';
                    $button .= '<a class="btn btn-sm btn-danger m-1" id="btn-delete-product" employer-id='. $getEm->id .' data-toggle="modal" data-target="#proconfirmModal">
                    <i class="fa fa-archive"></i></a>';


                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }
    }

    public function getProduct($mainproductbranch)
    {
        if($mainproductbranch == 'All Branches')
        {
        $getproduct = DB::table('tbl_product')
        ->select('tbl_product.*','tbl_category.name','tbl_branch.branchname')
        ->leftJoin('tbl_category', 'tbl_product.category_id', '=', 'tbl_category.id')
        ->leftJoin('tbl_branch', 'tbl_product.branch_id', '=', 'tbl_branch.id')
        ->where('tbl_product.status', '1')
        ->get();

        return $getproduct;
        }
        else
        {
            $getproduct = DB::table('tbl_product')
            ->select('tbl_product.*','tbl_category.name','tbl_branch.branchname')
            ->leftJoin('tbl_category', 'tbl_product.category_id', '=', 'tbl_category.id')
            ->leftJoin('tbl_branch', 'tbl_product.branch_id', '=', 'tbl_branch.id')
            ->where('tbl_product.status', '1')
            ->where('tbl_product.branch_id',$mainproductbranch)
            ->get();

            return $getproduct;
        }

            // return DB::table('tbl_user AS BR')
    //             ->select('BR.*', 'tbl_branch.branchname')
    //             ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
    //             ->where('BR.user_role','=','Staff')
    //             ->where('BR.archive_status','=','no')
    //             ->get();
    }

    public function getProductData($id)
    {
        $get_product = Product::where('id',$id)->get();
        return  $get_product;
    }

    // public function imageUpload($request, $type) 
    // {
    //     $folder_to_save = 'productimage';

    //     if ($type == 'product_only') {
    //         $image_name = uniqid() . "." . $request->image->extension();
    //         $request->image->move(public_path('images/' . $folder_to_save), $image_name);
    //         return $folder_to_save . "/" . $image_name;
    //     }
    // }
}
