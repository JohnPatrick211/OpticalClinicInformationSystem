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

class ArchiveController extends Controller
{
    public function archivepatient(Request $request)
    {
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
            if(request()->ajax())
            {
                return datatables()->of($this->getArchivePatient())
                ->addColumn('action', function($b){
                    $button = ' <a class="btn btn-sm btn-primary" id="btn-retrieve-patient" employer-id="'. $b->id .'"
                    data-toggle="modal" data-target="#retrievePatientModal"><i class="fa fa-recycle"></i></a>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
             return view('archive', $data);
         }

    }
    public function getArchivePatient()
    {
        return DB::table('tbl_user AS A')
        ->select('A.*')
        ->where('archive_status','yes')
        ->where('A.user_role','=','Patient')
        ->get();
    }

    public function archivepatient_retrieve($id)
    {
        DB::table('tbl_user')
        ->where('id', $id)
        ->update([
            'archive_status' => 'no'
        ]);
        $getname = Session::get('Name');
        $getusertype = Session::get('User-Type');
        base::recordAction( $getname, $getusertype,'Archive', 'Retrieve Patient Account Successfully ID number: '.$id);
    }
    //Product Archive
    public function archiveproduct(Request $request)
    {
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
            if(request()->ajax())
            {
                return datatables()->of($this->getArchiveProduct())
                ->addColumn('action', function($b){
                    $button = ' <a class="btn btn-sm btn-primary" id="btn-retrieve-product" employer-id="'. $b->id .'"
                    data-toggle="modal" data-target="#retrieveProductModal"><i class="fa fa-recycle"></i></a>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
             return view('archive', $data);
         }

    }
    public function getArchiveProduct()
    {
       return DB::table('tbl_product')
        ->select('tbl_product.*','tbl_category.name','tbl_branch.branchname')
        ->leftJoin('tbl_category', 'tbl_product.category_id', '=', 'tbl_category.id')
        ->leftJoin('tbl_branch', 'tbl_product.branch_id', '=', 'tbl_branch.id')
        ->where('tbl_product.status', '0')
        ->get();
    }

    public function archiveproduct_retrieve($id)
    {
        DB::table('tbl_product')
        ->where('id', $id)
        ->update([
            'status' => '1'
        ]);
        $getname = Session::get('Name');
        $getusertype = Session::get('User-Type');
        base::recordAction( $getname, $getusertype,'Archive', 'Retrieve Product Successfully ID number: '.$id);
    }
    //archive service
    public function archiveservice(Request $request)
    {
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
            if(request()->ajax())
            {
                return datatables()->of($this->getArchiveService())
                ->addColumn('action', function($b){
                    $button = ' <a class="btn btn-sm btn-primary" id="btn-retrieve-service" employer-id="'. $b->id .'"
                    data-toggle="modal" data-target="#retrieveServiceModal"><i class="fa fa-recycle"></i></a>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
             return view('archive', $data);
         }

    }
    public function getArchiveService()
    {
       return DB::table('tbl_service')
       ->select('tbl_service.*','tbl_branch.branchname')
       ->leftJoin('tbl_branch', 'tbl_service.branch_id', '=', 'tbl_branch.id')
       ->where('tbl_service.status', '0')
       ->get();
    }

    public function archiveservice_retrieve($id)
    {
        DB::table('tbl_service')
        ->where('id', $id)
        ->update([
            'status' => '1'
        ]);
        $getname = Session::get('Name');
        $getusertype = Session::get('User-Type');
        base::recordAction( $getname, $getusertype,'Archive', 'Retrieve Service Successfully ID number: '.$id);
    }
    //archive doctor
    public function archivedoctor(Request $request)
    {
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
            if(request()->ajax())
            {
                return datatables()->of($this->getArchiveDoctor())
                ->addColumn('action', function($b){
                    $button = ' <a class="btn btn-sm btn-primary" id="btn-retrieve-doctor" employer-id="'. $b->id .'"
                    data-toggle="modal" data-target="#retrieveDoctorModal"><i class="fa fa-recycle"></i></a>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
             return view('archive', $data);
         }

    }
    public function getArchiveDoctor()
    {
        return DB::table('tbl_user AS BR')
        ->select('BR.*', 'tbl_branch.branchname','tbl_doctor.specialty')
        ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
        ->leftJoin('tbl_doctor', 'BR.id', '=', 'tbl_doctor.doctor_id')
        ->where('BR.user_role','=','Doctor')
        ->where('BR.archive_status','=','yes')
        ->get();
    }

    public function archivedoctor_retrieve($id)
    {
        DB::table('tbl_user')
        ->where('id', $id)
        ->update([
            'archive_status' => 'no'
        ]);
        $getname = Session::get('Name');
        $getusertype = Session::get('User-Type');
        base::recordAction( $getname, $getusertype,'Archive', 'Retrieve Doctor Account Successfully ID number: '.$id);
    }
    //archive secretary
    public function archivesecretary(Request $request)
    {
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
            if(request()->ajax())
            {
                return datatables()->of($this->getArchiveSecretary())
                ->addColumn('action', function($b){
                    $button = ' <a class="btn btn-sm btn-primary" id="btn-retrieve-secretary" employer-id="'. $b->id .'"
                    data-toggle="modal" data-target="#retrieveSecretaryModal"><i class="fa fa-recycle"></i></a>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
             return view('archive', $data);
         }

    }
    public function getArchiveSecretary()
    {
        return DB::table('tbl_user AS BR')
                ->select('BR.*', 'tbl_branch.branchname')
                ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
                ->where('BR.user_role','=','Secretary')
                ->where('BR.archive_status','=','yes')
                ->get();
    }

    public function archivesecretary_retrieve($id)
    {
        DB::table('tbl_user')
        ->where('id', $id)
        ->update([
            'archive_status' => 'no'
        ]);
        $getname = Session::get('Name');
        $getusertype = Session::get('User-Type');
        base::recordAction( $getname, $getusertype,'Archive', 'Retrieve Secretary Account Successfully ID number: '.$id);
    }
    //archive staff
    public function archivestaff(Request $request)
    {
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
            if(request()->ajax())
            {
                return datatables()->of($this->getArchiveStaff())
                ->addColumn('action', function($b){
                    $button = ' <a class="btn btn-sm btn-primary" id="btn-retrieve-staff" employer-id="'. $b->id .'"
                    data-toggle="modal" data-target="#retrieveStaffModal"><i class="fa fa-recycle"></i></a>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
            }
             return view('archive', $data);
         }

    }
    public function getArchiveStaff()
    {
        return DB::table('tbl_user AS BR')
                ->select('BR.*', 'tbl_branch.branchname')
                ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
                ->where('BR.user_role','=','Staff')
                ->where('BR.archive_status','=','yes')
                ->get();
    }

    public function archivestaff_retrieve($id)
    {
        DB::table('tbl_user')
        ->where('id', $id)
        ->update([
            'archive_status' => 'no'
        ]);
        $getname = Session::get('Name');
        $getusertype = Session::get('User-Type');
        base::recordAction( $getname, $getusertype,'Archive', 'Retrieve Staff Account Successfully ID number: '.$id);
    }
    
}
