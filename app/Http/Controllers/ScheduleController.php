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
use App\Models\DoctorSchedule;
use App\Helpers\base;

class ScheduleController extends Controller
{
    function schedule(Request $request)
    {
            $staff = Login:: where('id','=', session('LoggedUser'))->first();
            $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
            $users5 = Login::orderBy('id', 'ASC')->where('branch_id',2)->get();
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
            return view('maintenance-schedule', $data)->with('users4',$users4)->with('users5',$users5);;
    }

    function Doctorschedule(Request $request)
    {
            $staff = Login:: where('id','=', session('LoggedUser'))->first();
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
            $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
            $users5 = Login::orderBy('id', 'ASC')->where('branch_id',2)->get();
            //   $CountPendingEmployer = DB::table('users')->where('role','=', 'employer')->where('status','=', 'Pending')->count();
            //   $CountApprovedEmployer = DB::table('users')->where('role','=', 'employer')->where('status','=', 'Approved')->count();
            //    $CountPendingJob = DB::table('job_posts')->where('jobstatus','=', 'Pending')->count();
            //    $CountApprovedJob = DB::table('job_posts')->where('jobstatus','=', 'Approved')->count();
            $users6 = DB::table('tbl_user')
            ->select('tbl_user.*','tbl_branch.branchname')
            ->leftJoin('tbl_branch', 'tbl_user.branch_id', '=', 'tbl_branch.id')
            ->where('tbl_user.id','=', session('LoggedUser'))
            ->first();
             $data = [
                 'LoggedUserInfo' => $users2,
                 'users6' =>  $users6,
             ];
            return view('doctor-maintenance-schedule', $data)->with('users4',$users4)->with('users5',$users5);;
    }

    function Secretaryschedule(Request $request)
    {
            $staff = Login:: where('id','=', session('LoggedUser'))->first();
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
            $users4 = ClinicBranch::orderBy('id', 'ASC')->get();
            $users5 = Login::orderBy('id', 'ASC')->where('branch_id',2)->get();
            //   $CountPendingEmployer = DB::table('users')->where('role','=', 'employer')->where('status','=', 'Pending')->count();
            //   $CountApprovedEmployer = DB::table('users')->where('role','=', 'employer')->where('status','=', 'Approved')->count();
            //    $CountPendingJob = DB::table('job_posts')->where('jobstatus','=', 'Pending')->count();
            //    $CountApprovedJob = DB::table('job_posts')->where('jobstatus','=', 'Approved')->count();
            $users6 = DB::table('tbl_user')
            ->select('tbl_user.*','tbl_branch.branchname')
            ->leftJoin('tbl_branch', 'tbl_user.branch_id', '=', 'tbl_branch.id')
            ->where('tbl_user.id','=', session('LoggedUser'))
            ->first();
             $data = [
                 'LoggedUserInfo' => $users2,
                 'users6' =>  $users6,
             ];
            return view('secretary-maintenance-schedule', $data)->with('users4',$users4)->with('users5',$users5);;
    }

    public function storedoctorschedule(Request $request)
    {
        $scheduledoctor = new DoctorSchedule();
        $validatescheduledoctor  =  DoctorSchedule::where('doctor_schedule_start_time','=', $request->input('doctor_schedule_start_time'))
        ->where('doctor_schedule_end_time','=', $request->input('doctor_schedule_end_time'))->first();
        if($validatescheduledoctor)
        {
            return back()->with('danger', 'Schedule Already Exist');
        }
        else
        {
        $scheduledoctor->doctor_id = $request->input('scheduledoctorname');
        $scheduledoctor->branch_id = $request->input('schedulebranch');
        $scheduledoctor->doctor_schedule_date = $request->input('doctor_schedule_date');
        $scheduledoctor->doctor_schedule_day = date('l', strtotime($request->input('doctor_schedule_date')));
        $scheduledoctor->doctor_schedule_start_time = $request->input('doctor_schedule_start_time');
        $scheduledoctor->doctor_schedule_end_time = $request->input('doctor_schedule_end_time');
        $scheduledoctor->status = "Active";
        $scheduledoctor->save();
        $getname = Session::get('Name');
        $getusertype = Session::get('User-Type');
        base::recordAction( $getname, $getusertype,'Schedule Maintenance', 'Add Schedule Successfully');
        // return redirect('maintenance-category')->with('success', 'Category Saved');
         return back()->with('success', 'Schedule Saved');
        }
    }

    public function updateSchedule(Request $request, $id, $doctorname, $date, $doctor_schedule_end_time, $doctor_schedule_start_time, $branchname, $status)
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
              DB::table('tbl_doctorschedule')
            ->where('id', $id)
            ->update([
                'doctor_id' => $doctorname,
                'branch_id' => $branchname,
                'doctor_schedule_date' => $date,
                'doctor_schedule_day'  => date('l', strtotime($date)),
                'doctor_schedule_start_time' => $doctor_schedule_start_time,
                'doctor_schedule_end_time' => $doctor_schedule_end_time,
                'status' => $status,
                
            ]);
            $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'Schedule Maintenance', 'Update Schedule Sucessfully');
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

    public function deleteSchedule(Request $request, $id)
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
            DB::table('tbl_doctorschedule')
            ->where('id', $id)
            ->delete();
             $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'Schedule Maintenance', 'Deleted Successfully Schedule id'.$id);
             return response()->json(['status'=>0,'success'=>'success']);
        // }
        // else
        // {
        // return response()->json(['status'=>1,'success'=>'success']);
        // }
    }

    public function ScheduleData(Request $request)
    {
        $getEm = $this->getSchedule($request->mainschedulebranch);
         if(request()->ajax())
             {
                return datatables()->of($getEm)
                ->addColumn('action', function($getEm){
                $button = '<a class="btn btn-sm btn-success m-1" id="btn-edit-schedule" employer-id='. $getEm->id .' data-toggle="modal" data-target="#EditScheduleModal">
                    <i class="fa fa-edit"></i></a>';
                    $button .= '<a class="btn btn-sm btn-danger m-1" id="btn-delete-service" employer-id='. $getEm->id .' data-toggle="modal" data-target="#scheduleproconfirmModal">
                    <i class="fa fa-archive"></i></a>';


                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }
    }

    public function DoctorScheduleData(Request $request)
    {
        $getEm = $this->getDoctorSchedule($request->mainschedulebranch);
         if(request()->ajax())
             {
                return datatables()->of($getEm)
                ->addColumn('action', function($getEm){
                $button = '<a class="btn btn-sm btn-success m-1" id="btn-edit-schedule" employer-id='. $getEm->id .' data-toggle="modal" data-target="#DoctorEditScheduleModal">
                    <i class="fa fa-edit"></i></a>';
                    $button .= '<a class="btn btn-sm btn-danger m-1" id="btn-delete-service" employer-id='. $getEm->id .' data-toggle="modal" data-target="#scheduleproconfirmModal">
                    <i class="fa fa-archive"></i></a>';


                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }
    }

    public function SecretaryScheduleData(Request $request)
    {
        $getEm = $this->getSchedule($request->mainschedulebranch);
         if(request()->ajax())
             {
                return datatables()->of($getEm)
                ->addColumn('action', function($getEm){
                $button = '<a class="btn btn-sm btn-success m-1" id="btn-edit-schedule" employer-id='. $getEm->id .' data-toggle="modal" data-target="#SecretaryEditScheduleModal">
                    <i class="fa fa-edit"></i></a>';
                    $button .= '<a class="btn btn-sm btn-danger m-1" id="btn-delete-service" employer-id='. $getEm->id .' data-toggle="modal" data-target="#scheduleproconfirmModal">
                    <i class="fa fa-archive"></i></a>';


                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
             }
    }


    public function getSchedule($mainschedulebranch)
    {
        if($mainschedulebranch == 'All Branches')
        {
            $getschedule = DB::table('tbl_doctorschedule')
            ->select('tbl_doctorschedule.*','tbl_branch.branchname','tbl_user.name','tbl_doctor.specialty')
            ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_doctorschedule.doctor_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'tbl_doctorschedule.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->where('tbl_doctorschedule.doctor_id', session('LoggedUser'))
            ->get();

            return $getschedule;
        }
        else
        {
            $getschedule = DB::table('tbl_doctorschedule')
            ->select('tbl_doctorschedule.*','tbl_branch.branchname','tbl_user.name','tbl_doctor.specialty')
            ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_doctorschedule.doctor_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'tbl_doctorschedule.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->where('tbl_doctorschedule.branch_id',$mainschedulebranch)
            ->get();

            return $getschedule;
        }
    }

    public function getDoctorSchedule($mainschedulebranch)
    {
        if($mainschedulebranch == 'All Branches')
        {
            $getschedule = DB::table('tbl_doctorschedule')
            ->select('tbl_doctorschedule.*','tbl_branch.branchname','tbl_user.name','tbl_doctor.specialty')
            ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_doctorschedule.doctor_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'tbl_doctorschedule.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->where('tbl_doctorschedule.doctor_id', session('LoggedUser'))
            ->get();

            return $getschedule;
        }
        else
        {
            $getschedule = DB::table('tbl_doctorschedule')
            ->select('tbl_doctorschedule.*','tbl_branch.branchname','tbl_user.name','tbl_doctor.specialty')
            ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_doctorschedule.doctor_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'tbl_doctorschedule.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->where('tbl_doctorschedule.branch_id',$mainschedulebranch)
            ->where('tbl_doctorschedule.doctor_id', session('LoggedUser'))
            ->get();

            return $getschedule;
        }
    }

    public function getScheduleData($id)
    {
        $get_schedule = DoctorSchedule::where('id',$id)->get();
        return  $get_schedule;
    }
    public function getDoctorData($schedulebranch)
    {
        $get_doctor = Login::where('branch_id',$schedulebranch)
        ->where('user_role','Doctor')
        ->where('archive_status','no')->get();
        return  $get_doctor;
    }
}
