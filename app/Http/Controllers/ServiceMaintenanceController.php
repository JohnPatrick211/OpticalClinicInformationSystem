<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ClinicBranch;
use App\Helpers\base;

class ServiceMaintenanceController extends Controller
{
     // Service
     public function ServiceMaintenance(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
            $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
            //  $users3 = Category::all();
            //   $users4 = Category::all();
            //   $users5 = Region::orderBy('region', 'ASC')->get();
            //  $users6 = Employer::orderBy('name', 'ASC')->get();
             return view('maintenance-service', $data)->with('users4',$users4);
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
    public function storeservice(Request $request)
    {
        $service = new Service();
        $validateservice =  Service::where('servicename','=', $request->input('servicename'))->first();
        if($validateservice)
        {
            return back()->with('danger', 'Service Already Exist');
        }
        else
        {
        $service->servicename = $request->input('servicename');
        $service->branch_id = $request->input('servicebranch');
        $service->orig_price = $request->input('originalprice');
        $service->selling_price = $request->input('sellingprice');
        $service->markup = $request->input('markup');
        $service->status = '1';
        $service->save();
        $getname = Session::get('Name');
        $getusertype = Session::get('User-Type');
        base::recordAction( $getname, $getusertype,'Service Maintenance', 'Add Service Successfully');
        // return redirect('maintenance-category')->with('success', 'Category Saved');
         return back()->with('success', 'Service Saved');
        }
    }

    public function updateService(Request $request, $id, $servicename, $originalprice, $sellingprice, $markup, $branchname)
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
              DB::table('tbl_service')
            ->where('id', $id)
            ->update([
                'servicename' => $servicename,
                'branch_id' => $branchname,
                'orig_price' => $originalprice,
                'selling_price' => $sellingprice,
                'markup' => $markup,
                
            ]);
            $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'Service Maintenance', 'Update Service Sucessfully');
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

    public function deleteService(Request $request, $id)
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
            DB::table('tbl_service')
            ->where('id', $id)
            ->update([
                'status' => '0'     
            ]);
             $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'Service Maintenance', 'Deleted Successfully Service id'.$id);
             return response()->json(['status'=>0,'success'=>'success']);
        // }
        // else
        // {
        // return response()->json(['status'=>1,'success'=>'success']);
        // }
    }

    public function ServiceData()
    {
        $getEm = $this->getService();
         if(request()->ajax())
             {
                return datatables()->of($getEm)
                ->addColumn('action', function($getEm){
                $button = '<a class="btn btn-sm btn-success m-1" id="btn-edit-service" employer-id='. $getEm->id .' data-toggle="modal" data-target="#EditServiceModal">
                    <i class="fa fa-edit"></i></a>';
                    $button .= '<a class="btn btn-sm btn-danger m-1" id="btn-delete-service" employer-id='. $getEm->id .' data-toggle="modal" data-target="#proconfirmModal">
                    <i class="fa fa-archive"></i></a>';


                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }
    }

    public function getService()
    {
        $getservice = DB::table('tbl_service')
        ->select('tbl_service.*','tbl_branch.branchname')
        ->leftJoin('tbl_branch', 'tbl_service.branch_id', '=', 'tbl_branch.id')
        ->where('tbl_service.status', '1')
        ->get();

        return $getservice;
    }

    public function getServiceData($id)
    {
        $get_service = Service::where('id',$id)->get();
        return  $get_service;
    }
}
