<?php

namespace App\Http\Controllers;
use App\Models\Login;
use App\Models\ClinicBranch;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Helpers\base;

class LoginController extends Controller
{
    function login()
    {
        return view('login');
    }

    function register()
    {
        return view('signup');
    }

    function check(Request $request)
    {
        $request->validate([
            'username'=>'required',
            'password'=>'required|min:8|max:12'
        ],
         [
        'username.required' => 'Please type your username',
        'password.required' => 'Please type your password',
        'password.min' => 'Password must have minimum of 8 characters',
        'password.max' => 'Password must have maximum of 12 characters'
        
    ]);

        $staff = Login:: where('username','=', $request-> username)
        ->where('password','=', $request-> password)->first();

        if($staff)
        {
            if($staff->archive_status == 'yes')
            {
                return back()->with('fail','Your account is Archived, please contact your system administrator');
            }
            else
            {
                if($staff->user_role == 'System Admin')
                {
                    $request->session()->put('LoggedUser',$staff->id);
                    Session::put('LoggedUser',$staff->id);
                    Session::put('Branch',$staff->branch_id);
                    Session::put('Name',$staff->name);
                    Session::put('User-Type',$staff->user_role);
                    $getname = Session::get('Name');
                    $getusertype = Session::get('User-Type');
                    base::recordAction( $getname, $getusertype,'Login', 'login');
                    return redirect('admin-dashboard');
                }
                else if($staff->user_role == 'Doctor')
                {
                   
                    $branch = ClinicBranch::where('id','=',$staff->branch_id)->first();
                    $request->session()->put('LoggedUser',$staff->id);
                    Session::put('LoggedUser',$staff->id);
                    Session::put('Branch',$staff->branch_id);
                    Session::put('BranchName',$branch->branchname);
                    Session::put('Name',$staff->name);
                    Session::put('User-Type',$staff->user_role);
                        $getname = Session::get('Name');
                        $getusertype = Session::get('User-Type');
                    base::recordAction( $getname, $getusertype,'Login', 'login');
                    return redirect('doctor-dashboard');
                }
                else if($staff->user_role == 'Secretary')
                {
                    $branch = ClinicBranch::where('id','=',$staff->branch_id)->first();
                    $request->session()->put('LoggedUser',$staff->id);
                    Session::put('LoggedUser',$staff->id);
                    Session::put('Branch',$staff->branch_id);
                    Session::put('BranchName',$branch->branchname);
                    Session::put('Name',$staff->name);
                    Session::put('User-Type',$staff->user_role);
                        $getname = Session::get('Name');
                        $getusertype = Session::get('User-Type');
                        base::recordAction( $getname, $getusertype,'Login', 'login');
                    return redirect('secretary-dashboard');
                }
                else if($staff->user_role == 'Staff')
                {
                    $branch = ClinicBranch::where('id','=',$staff->branch_id)->first();
                    $request->session()->put('LoggedUser',$staff->id);
                    Session::put('LoggedUser',$staff->id);
                    Session::put('Branch',$staff->branch_id);
                    Session::put('BranchName',$branch->branchname);
                    Session::put('Name',$staff->name);
                    Session::put('User-Type',$staff->user_role);
                        $getname = Session::get('Name');
                        $getusertype = Session::get('User-Type');
                        base::recordAction( $getname, $getusertype,'Login', 'login');
                    return redirect('staff-dashboard');
                }
                else if($staff->user_role == 'Patient' && $staff->status == 'Approved')
                {
                    $request->session()->put('LoggedUser',$staff->id);
                    Session::put('LoggedUser',$staff->id);
                    Session::put('Name',$staff->name);
                    Session::put('User-Type',$staff->user_role);
                        $getname = Session::get('Name');
                        $getusertype = Session::get('User-Type');
                        base::recordAction( $getname, $getusertype,'Login', 'login');
                    return redirect('patient-dashboard');
                }
                else if($staff->user_role == 'Patient' && $staff->status == 'Pending')
                {
                    return back()->with('fail','Your Account is Pending in the Approval List, Please wait for the confirmation to your email');
                }
                else
                {
                    return back()->with('fail','Invalid Username and Password');
                }
            }
         }
         else
         {
              return back()->with('fail','Invalid Username and Password');
         }
        
    }

    function admin()
    {
            $staff = Login:: where('id','=', session('LoggedUser'))->first();
              $AppointmentForToday = DB::table('tbl_appointment')
              ->select('tbl_appointment.*','tbl_appointment.id AS P','tbl_doctor.name AS D','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
              'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
              'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_branch.id AS B','tbl_user.name AS N','tbl_user.id')
              ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
              ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
              ->leftJoin('tbl_user', 'tbl_appointment.patient_id', '=', 'tbl_user.id')
              ->leftJoin('tbl_doctor', 'tbl_appointment.doctor_id', '=', 'tbl_doctor.doctor_id')
              ->where('tbl_doctorschedule.doctor_schedule_date', \Carbon\Carbon::now()->format('Y-m-d'))
              ->where('tbl_doctorschedule.status','Active')
              ->whereIn('tbl_appointment.status',['Approved','In Process'])
              ->count();
              $pendingappointmentapproval = $getmyappointment = DB::table('tbl_appointment')
              ->select('tbl_appointment.*','tbl_appointment.id AS P','tbl_doctor.name AS D','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
              'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
              'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_user.name AS N','tbl_user.id','tbl_doctor.specialty')
              ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
              ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
              ->leftJoin('tbl_user', 'tbl_appointment.patient_id', '=', 'tbl_user.id')
              ->leftJoin('tbl_doctor', 'tbl_appointment.doctor_id', '=', 'tbl_doctor.doctor_id')
              ->whereBetween('tbl_doctorschedule.doctor_schedule_date', [\Carbon\Carbon::now()->format('Y-m-d'), \Carbon\Carbon::now()->addWeek()->format('Y-m-d')])
              ->where('tbl_appointment.status', 'Pending')
              ->count();
              $completeappointment = DB::table('tbl_appointmentreport AS BR')
              ->select('BR.*','tbl_branch.branchname','tbl_user.name AS U','tbl_doctor.name AS D')
              ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
              ->leftJoin('tbl_user', 'BR.patient_id', '=', 'tbl_user.id')
              ->leftJoin('tbl_doctor', 'BR.doctor_id', '=', 'tbl_doctor.doctor_id')
              ->count();
              $pendingpatient = DB::table('tbl_user')
              ->select('tbl_user.*')
              ->where('user_role','Patient')
              ->where('status','Pending')
              ->count();

              $approvedpatient = DB::table('tbl_user')
              ->select('tbl_user.*')
              ->where('user_role','Patient')
              ->where('status','Approved')
               ->count();

               $sales = DB::table('tbl_sales')
               ->where('status', 1)
               ->where('tbl_sales.product_id', 'LIKE', '1%')
               ->where(DB::raw('DATE(created_at)'), \Carbon\Carbon::now()->format('Y-m-d'))
               ->sum('amount');

              $date = \Carbon\Carbon::now()->format('Y-m-d');
              $dateadvance = \Carbon\Carbon::now()->addWeek()->format('Y-m-d');
            $data = [
                'LoggedUserInfo' => $staff,
                'AppointmentForToday' =>  $AppointmentForToday,
                'pendingappointmentapproval' =>  $pendingappointmentapproval,
                'completeappointment' =>  $completeappointment,
                'pendingpatient' => $pendingpatient,
                'approvedpatient' => $approvedpatient,
                'date' => $date,
                'sales' => $sales,
                'dateadvance' => $dateadvance,
                // 'CountApprovedEmployer' => $CountApprovedEmployer,
                // 'CountPendingJob' => $CountPendingJob,
                // 'CountApprovedJob' => $CountApprovedJob
            ];
            return view('admin-dashboard', $data);
    }
    //Doctor Dashboard
    function doctor()
    {
            $staff = Login:: where('id','=', session('LoggedUser'))->first();
            $AppointmentForToday = DB::table('tbl_appointment')
            ->select('tbl_appointment.*','tbl_appointment.id AS P','tbl_doctor.name AS D','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
            'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
            'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_branch.id AS B','tbl_user.name AS N','tbl_user.id')
            ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
            ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_appointment.patient_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'tbl_appointment.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->where('tbl_doctorschedule.doctor_schedule_date', \Carbon\Carbon::now()->format('Y-m-d'))
            ->where('tbl_doctorschedule.status','Active')
            ->whereIn('tbl_appointment.status',['Approved','In Process'])
            ->where('tbl_doctor.doctor_id','=', session('LoggedUser'))
            ->where('tbl_branch.id','=', session('Branch'))
            ->count();
            $pendingappointmentapproval = $getmyappointment = DB::table('tbl_appointment')
            ->select('tbl_appointment.*','tbl_appointment.id AS P','tbl_doctor.name AS D','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
            'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
            'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_user.name AS N','tbl_user.id','tbl_doctor.specialty')
            ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
            ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'tbl_appointment.patient_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'tbl_appointment.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->whereBetween('tbl_doctorschedule.doctor_schedule_date', [\Carbon\Carbon::now()->format('Y-m-d'), \Carbon\Carbon::now()->addWeek()->format('Y-m-d')])
            ->where('tbl_appointment.status', 'Pending')
            ->where('tbl_doctor.doctor_id','=', session('LoggedUser'))
            ->where('tbl_branch.id','=', session('Branch'))
            ->count();
            $completeappointment = DB::table('tbl_appointmentreport AS BR')
            ->select('BR.*','tbl_branch.branchname','tbl_user.name AS U','tbl_doctor.name AS D')
            ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
            ->leftJoin('tbl_user', 'BR.patient_id', '=', 'tbl_user.id')
            ->leftJoin('tbl_doctor', 'BR.doctor_id', '=', 'tbl_doctor.doctor_id')
            ->where('tbl_doctor.doctor_id','=', session('LoggedUser'))
            ->where('tbl_branch.id','=', session('Branch'))
            ->count();
            $pendingpatient = DB::table('tbl_user')
            ->select('tbl_user.*')
            ->where('user_role','Patient')
            ->where('status','Pending')
            ->count();

            $approvedpatient = DB::table('tbl_user')
            ->select('tbl_user.*')
            ->where('user_role','Patient')
            ->where('status','Approved')
             ->count();

             $sales = DB::table('tbl_sales')
             ->select('tbl_sales.*','tbl_branch.*')
             ->leftJoin('tbl_branch', 'tbl_sales.branch_id', '=', 'tbl_branch.id')
             ->where('status', 1)
             ->where('tbl_sales.product_id', 'LIKE', '1%')
             ->where(DB::raw('DATE(tbl_sales.created_at)'), \Carbon\Carbon::now()->format('Y-m-d'))
             ->where('tbl_branch.id','=', session('Branch'))
             ->sum('amount');

            $date = \Carbon\Carbon::now()->format('Y-m-d');
            $dateadvance = \Carbon\Carbon::now()->addWeek()->format('Y-m-d');
          $data = [
              'LoggedUserInfo' => $staff,
              'AppointmentForToday' =>  $AppointmentForToday,
              'pendingappointmentapproval' =>  $pendingappointmentapproval,
              'completeappointment' =>  $completeappointment,
              'pendingpatient' => $pendingpatient,
              'approvedpatient' => $approvedpatient,
              'date' => $date,
              'sales' => $sales,
              'dateadvance' => $dateadvance,
              // 'CountApprovedEmployer' => $CountApprovedEmployer,
              // 'CountPendingJob' => $CountPendingJob,
              // 'CountApprovedJob' => $CountApprovedJob
          ];
            return view('doctor-dashboard', $data);
    }
    //Secretary Dashboard
    function secretary()
    {
        $staff = Login:: where('id','=', session('LoggedUser'))->first();
        $AppointmentForToday = DB::table('tbl_appointment')
        ->select('tbl_appointment.*','tbl_appointment.id AS P','tbl_doctor.name AS D','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
        'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
        'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_branch.id AS B','tbl_user.name AS N','tbl_user.id')
        ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
        ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
        ->leftJoin('tbl_user', 'tbl_appointment.patient_id', '=', 'tbl_user.id')
        ->leftJoin('tbl_doctor', 'tbl_appointment.doctor_id', '=', 'tbl_doctor.doctor_id')
        ->where('tbl_doctorschedule.doctor_schedule_date', \Carbon\Carbon::now()->format('Y-m-d'))
        ->where('tbl_doctorschedule.status','Active')
        ->whereIn('tbl_appointment.status',['Approved','In Process'])
        ->where('tbl_branch.id','=', session('Branch'))
        ->count();
        $pendingappointmentapproval = $getmyappointment = DB::table('tbl_appointment')
        ->select('tbl_appointment.*','tbl_appointment.id AS P','tbl_doctor.name AS D','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
        'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
        'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_user.name AS N','tbl_user.id','tbl_doctor.specialty')
        ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
        ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
        ->leftJoin('tbl_user', 'tbl_appointment.patient_id', '=', 'tbl_user.id')
        ->leftJoin('tbl_doctor', 'tbl_appointment.doctor_id', '=', 'tbl_doctor.doctor_id')
        ->whereBetween('tbl_doctorschedule.doctor_schedule_date', [\Carbon\Carbon::now()->format('Y-m-d'), \Carbon\Carbon::now()->addWeek()->format('Y-m-d')])
        ->where('tbl_appointment.status', 'Pending')
        ->where('tbl_branch.id','=', session('Branch'))
        ->count();
        $completeappointment = DB::table('tbl_appointmentreport AS BR')
        ->select('BR.*','tbl_branch.branchname','tbl_user.name AS U','tbl_doctor.name AS D')
        ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
        ->leftJoin('tbl_user', 'BR.patient_id', '=', 'tbl_user.id')
        ->leftJoin('tbl_doctor', 'BR.doctor_id', '=', 'tbl_doctor.doctor_id')
        ->where('tbl_branch.id','=', session('Branch'))
        ->count();
        $pendingpatient = DB::table('tbl_user')
        ->select('tbl_user.*')
        ->where('user_role','Patient')
        ->where('status','Pending')
        ->count();

        $approvedpatient = DB::table('tbl_user')
        ->select('tbl_user.*')
        ->where('user_role','Patient')
        ->where('status','Approved')
         ->count();

         $sales = DB::table('tbl_sales')
         ->select('tbl_sales.*','tbl_branch.*')
         ->leftJoin('tbl_branch', 'tbl_sales.branch_id', '=', 'tbl_branch.id')
         ->where('status', 1)
         ->where('tbl_sales.product_id', 'LIKE', '1%')
         ->where(DB::raw('DATE(tbl_sales.created_at)'), \Carbon\Carbon::now()->format('Y-m-d'))
         ->where('tbl_branch.id','=', session('Branch'))
         ->sum('amount');

        $date = \Carbon\Carbon::now()->format('Y-m-d');
        $dateadvance = \Carbon\Carbon::now()->addWeek()->format('Y-m-d');
      $data = [
          'LoggedUserInfo' => $staff,
          'AppointmentForToday' =>  $AppointmentForToday,
          'pendingappointmentapproval' =>  $pendingappointmentapproval,
          'completeappointment' =>  $completeappointment,
          'pendingpatient' => $pendingpatient,
          'approvedpatient' => $approvedpatient,
          'date' => $date,
          'sales' => $sales,
          'dateadvance' => $dateadvance,
          // 'CountApprovedEmployer' => $CountApprovedEmployer,
          // 'CountPendingJob' => $CountPendingJob,
          // 'CountApprovedJob' => $CountApprovedJob
      ];
            return view('secretary-dashboard', $data);
    }
    //Staff Dashboard
    function staff()
    {
        $staff = Login:: where('id','=', session('LoggedUser'))->first();
        $AppointmentForToday = DB::table('tbl_appointment')
        ->select('tbl_appointment.*','tbl_appointment.id AS P','tbl_doctor.name AS D','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
        'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
        'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_branch.id AS B','tbl_user.name AS N','tbl_user.id')
        ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
        ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
        ->leftJoin('tbl_user', 'tbl_appointment.patient_id', '=', 'tbl_user.id')
        ->leftJoin('tbl_doctor', 'tbl_appointment.doctor_id', '=', 'tbl_doctor.doctor_id')
        ->where('tbl_doctorschedule.doctor_schedule_date', \Carbon\Carbon::now()->format('Y-m-d'))
        ->where('tbl_doctorschedule.status','Active')
        ->whereIn('tbl_appointment.status',['Approved','In Process'])
        ->where('tbl_branch.id','=', session('Branch'))
        ->count();
        $pendingappointmentapproval = $getmyappointment = DB::table('tbl_appointment')
        ->select('tbl_appointment.*','tbl_appointment.id AS P','tbl_doctor.name AS D','tbl_doctorschedule.id', 'tbl_doctorschedule.doctor_schedule_date',
        'tbl_doctorschedule.doctor_schedule_day', 'tbl_doctorschedule.doctor_schedule_start_time', 
        'tbl_doctorschedule.doctor_schedule_end_time','tbl_branch.branchname','tbl_user.name AS N','tbl_user.id','tbl_doctor.specialty')
        ->leftJoin('tbl_doctorschedule', 'tbl_appointment.doctor_schedule_id', '=', 'tbl_doctorschedule.id')
        ->leftJoin('tbl_branch', 'tbl_doctorschedule.branch_id', '=', 'tbl_branch.id')
        ->leftJoin('tbl_user', 'tbl_appointment.patient_id', '=', 'tbl_user.id')
        ->leftJoin('tbl_doctor', 'tbl_appointment.doctor_id', '=', 'tbl_doctor.doctor_id')
        ->whereBetween('tbl_doctorschedule.doctor_schedule_date', [\Carbon\Carbon::now()->format('Y-m-d'), \Carbon\Carbon::now()->addWeek()->format('Y-m-d')])
        ->where('tbl_appointment.status', 'Pending')
        ->where('tbl_branch.id','=', session('Branch'))
        ->count();
        $completeappointment = DB::table('tbl_appointmentreport AS BR')
        ->select('BR.*','tbl_branch.branchname','tbl_user.name AS U','tbl_doctor.name AS D')
        ->leftJoin('tbl_branch', 'BR.branch_id', '=', 'tbl_branch.id')
        ->leftJoin('tbl_user', 'BR.patient_id', '=', 'tbl_user.id')
        ->leftJoin('tbl_doctor', 'BR.doctor_id', '=', 'tbl_doctor.doctor_id')
        ->where('tbl_branch.id','=', session('Branch'))
        ->count();
        $pendingpatient = DB::table('tbl_user')
        ->select('tbl_user.*')
        ->where('user_role','Patient')
        ->where('status','Pending')
        ->count();

        $approvedpatient = DB::table('tbl_user')
        ->select('tbl_user.*')
        ->where('user_role','Patient')
        ->where('status','Approved')
         ->count();

         $sales = DB::table('tbl_sales')
         ->select('tbl_sales.*','tbl_branch.*')
         ->leftJoin('tbl_branch', 'tbl_sales.branch_id', '=', 'tbl_branch.id')
         ->where('status', 1)
         ->where('tbl_sales.product_id', 'LIKE', '1%')
         ->where(DB::raw('DATE(tbl_sales.created_at)'), \Carbon\Carbon::now()->format('Y-m-d'))
         ->where('tbl_branch.id','=', session('Branch'))
         ->sum('amount');

        $date = \Carbon\Carbon::now()->format('Y-m-d');
        $dateadvance = \Carbon\Carbon::now()->addWeek()->format('Y-m-d');
      $data = [
          'LoggedUserInfo' => $staff,
          'AppointmentForToday' =>  $AppointmentForToday,
          'pendingappointmentapproval' =>  $pendingappointmentapproval,
          'completeappointment' =>  $completeappointment,
          'pendingpatient' => $pendingpatient,
          'approvedpatient' => $approvedpatient,
          'date' => $date,
          'sales' => $sales,
          'dateadvance' => $dateadvance,
          // 'CountApprovedEmployer' => $CountApprovedEmployer,
          // 'CountPendingJob' => $CountPendingJob,
          // 'CountApprovedJob' => $CountApprovedJob
      ];
            return view('staff-dashboard', $data);
    }
    //Patient Dashboard
    function patient()
    {
            $staff = Login:: where('id','=', session('LoggedUser'))->first();
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
            return view('patient-dashboard', $data);
    }

    function logout(){
        if(Session::has('LoggedUser')){
              $getname = Session::get('Name');
                     $getusertype = Session::get('User-Type');
                    base::recordAction( $getname, $getusertype,'Logout', 'logout');
            Session::pull('LoggedUser');
            return redirect('login');
        }
    }
}
