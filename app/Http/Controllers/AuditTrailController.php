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
use Mail; 

class AuditTrailController extends Controller
{
    public function audit_trail(Request $request){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
             $b = $this->getAuditTrail($request->date_from, $request->date_to);
             if(request()->ajax())
             {
                 return datatables()->of($this->getAuditTrail($request->date_from, $request->date_to))
                 ->addColumn('user_type', function($b){
                     if($b->user_type == 'System Admin'){
                         $z = '<span>Administrator</p>';
                         return $z;
                     }
                     else if($b->user_type == 'Doctor'){
                        $z = '<span>Doctor</p>';
                        return $z;
                    }
                    else if($b->user_type == 'Secretary'){
                        $z = '<span>Secretary</p>';
                        return $z;
                    }
                    else if($b->user_type == 'Staff'){
                        $z = '<span>Staff</p>';
                        return $z;
                    }
                     else if($b->user_type == 'Patient'){
                         $z = '<span>Patient</p>';
                         return $z;
                     }
                 })
                 ->rawColumns(['user_type'])
                 ->make(true);
             }
             return view('audit-trail', $data);
         }
    }
    public function getAuditTrail($date_from, $date_to)
    {
        return DB::table('tbl_audit_trail AS A')
        ->select('A.*', DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d %h:%i:%s %p") as formatteddate'))
        ->whereBetween('A.created_at', [$date_to, date('Y-m-d', strtotime($date_from . " + 1 day"))])
        ->get();
    }
}
