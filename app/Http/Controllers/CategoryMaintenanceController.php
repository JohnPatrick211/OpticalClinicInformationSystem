<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Helpers\base;

class CategoryMaintenanceController extends Controller
{
     // Category Product
     public function CategoryProductMaintenance(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
            //  $users3 = Category::all();
            //   $users4 = Category::all();
            //   $users5 = Region::orderBy('region', 'ASC')->get();
            //  $users6 = Employer::orderBy('name', 'ASC')->get();
             return view('maintenance-category', $data);
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
    public function storecategoryproduct(Request $request)
    {
        $categoryproduct = new Category();
        $validatecategoryproduct =  Category::where('name','=', $request->input('categoryproduct'))->first();
        if($validatecategoryproduct)
        {
            return back()->with('danger', 'Category Already Exist');
        }
        else
        {
        $categoryproduct->name = $request->input('categoryproduct');
        $categoryproduct->save();
        $getname = Session::get('Name');
        $getusertype = Session::get('User-Type');
        base::recordAction( $getname, $getusertype,'Category Maintenance', 'Add Category Successfully');
        // return redirect('maintenance-category')->with('success', 'Category Saved');
         return back()->with('success', 'Category Saved');
        }
    }

    public function updateCategoryProduct(Request $request, $id, $categoryproduct)
    {
        
        $users = DB::table('tbl_category')
        ->Join('tbl_product', 'tbl_category.id', '=', 'tbl_product.category_id')
        ->whereColumn([
                    ['tbl_category.id', '=', 'tbl_product.category_id'],
                    ])
                    ->where('tbl_category.id', $id)
                    ->get();
        if($users->isEmpty())
        {
              DB::table('tbl_category')
            ->where('id', $id)
            ->update([
                'name' => $categoryproduct,
            ]);
            $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'Category Maintenance', 'Update Category Sucessfully');
            return response()->json(['status'=>0,'success'=>$users]);
        }
        else
        {
            return response()->json(['status'=>1,'success'=>$users]);
        }
        // $category = $request->input('editcategory');
        // base::recordAction(Auth::id(), 'Book Maintenance', 'update');
        //return redirect('/book-maintenance')->with('success', 'Data updated successfully');
    }

    public function deleteCategoryProduct(Request $request, $id)
    {
        $users = DB::table('tbl_category')
        ->Join('tbl_product', 'tbl_category.id', '=', 'tbl_product.category_id')
        ->whereColumn([
                    ['tbl_category.id', '=', 'tbl_product.category_id'],
                    ])
                    ->where('tbl_category.id', $id)
                    ->get();
        
        if($users->isEmpty())
        {
            DB::table('tbl_category')
            ->where('id', $id)
            ->delete();
             $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'Category Maintenance', 'Deleted Successfully Category id'.$id);
            return response()->json(['status'=>0,'success'=>$users]);
        }
        else
        {
        return response()->json(['status'=>1,'success'=>$users]);
        }
    }

    public function CategoryProductData()
    {
        $getEm = $this->getCategoryProduct();
         if(request()->ajax())
             {
                return datatables()->of($getEm)
                ->addColumn('action', function($getEm){
                $button = '<a class="btn btn-sm btn-success m-1" id="btn-edit-categoryproduct" employer-id='. $getEm->id .' data-toggle="modal" data-target="#EditCategoryProductModal">
                    <i class="fa fa-edit"></i></a>';
                    $button .= '<a class="btn btn-sm btn-danger m-1" id="btn-delete-categoryproduct" employer-id='. $getEm->id .' data-toggle="modal" data-target="#proconfirmModal">
                    <i class="fa fa-archive"></i></a>';


                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }
    }

    public function getCategoryProduct()
    {
        $getcategoryproduct = DB::table('tbl_category')
        ->select('tbl_category.*')
        ->get();

        return $getcategoryproduct;
    }

    public function getCategoryProductData($id)
    {
        $get_categoryproduct = Category::where('id',$id)->get();
        return  $get_categoryproduct;
    }
}
