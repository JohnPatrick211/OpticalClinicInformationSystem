<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\ClinicBranch;
use App\Helpers\base;

class BranchMaintenanceController extends Controller
{
      // Branch
      public function BranchMaintenance(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
            //  $users3 = Category::all();
            //   $users4 = Category::all();
            //   $users5 = Region::orderBy('region', 'ASC')->get();
            //  $users6 = Employer::orderBy('name', 'ASC')->get();
             return view('maintenance-branch', $data);
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
    public function storebranch(Request $request)
    {
        $branch = new ClinicBranch();
        $validatebranch =  ClinicBranch::where('branchname','=', $request->input('branchname'))->first();
        if($validatebranch)
        {
            return back()->with('danger', 'Clinic Branch Already Exist');
        }
        else
        {
        $branch->branchname = $request->input('branchname');
        $branch->address = $request->input('address');
        $branch->save();
        $getname = Session::get('Name');
        $getusertype = Session::get('User-Type');
        base::recordAction( $getname, $getusertype,'Branch Maintenance', 'Add Branch Successfully');
        // return redirect('maintenance-category')->with('success', 'Category Saved');
         return back()->with('success', 'Clinic Branch Saved');
        }
    }

    public function updateBranch(Request $request, $id, $branchname, $address)
    {
        
        $users = DB::table('tbl_branch')
        ->Join('tbl_user', 'tbl_branch.id', '=', 'tbl_user.branch_id')
        ->whereColumn([
                    ['tbl_branch.id', '=', 'tbl_user.branch_id'],
                    ])
                    ->where('tbl_branch.id', $id)
                    ->where('tbl_user.archive_status', 'no')
                    ->get();
        if($users->isEmpty())
        {
              DB::table('tbl_branch')
            ->where('id', $id)
            ->update([
                'branchname' => $branchname,
                'address' => $address
            ]);
            $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'Branch Maintenance', 'Update Branch Sucessfully');
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

    public function deleteBranch(Request $request, $id)
    {
        $users = DB::table('tbl_branch')
        ->Join('tbl_user', 'tbl_branch.id', '=', 'tbl_user.branch_id')
        ->whereColumn([
                    ['tbl_branch.id', '=', 'tbl_user.branch_id'],
                    ])
                    ->where('tbl_branch.id', $id)
                    ->where('tbl_user.archive_status', 'no')
                    ->get();
        
        if($users->isEmpty())
        {
            DB::table('tbl_branch')
            ->where('id', $id)
            ->delete();
             $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'Branch Maintenance', 'Deleted Successfully Branch id'.$id);
            return response()->json(['status'=>0,'success'=>$users]);
        }
        else
        {
        return response()->json(['status'=>1,'success'=>$users]);
        }
    }

    public function BranchData()
    {
        $getEm = $this->getBranch();
         if(request()->ajax())
             {
                return datatables()->of($getEm)
                ->addColumn('action', function($getEm){
                $button = '<a class="btn btn-sm btn-success m-1" id="btn-edit-category" employer-id='. $getEm->id .' data-toggle="modal" data-target="#EditCategoryModal">
                    <i class="fa fa-edit"></i></a>';
                    $button .= '<a class="btn btn-sm btn-danger m-1" id="btn-delete-category" employer-id='. $getEm->id .' data-toggle="modal" data-target="#proconfirmModal">
                    <i class="fa fa-archive"></i></a>';


                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }
    }

    public function getBranch()
    {
        $getbranch = DB::table('tbl_branch')
        ->select('tbl_branch.*')
        ->get();

        return $getbranch;
    }

    public function getBranchData($id)
    {
        $get_branch = ClinicBranch::where('id',$id)->get();
        return  $get_branch;
    }
}
