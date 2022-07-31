<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Discount;
use App\Helpers\base;

class DiscountMaintenanceController extends Controller
{
    public function DiscountMaintenance(){
        if(Session::has('LoggedUser')){
            $users2 = DB::table('tbl_user')->where('id','=', session('LoggedUser'))->first();
             $data = [
                 'LoggedUserInfo' => $users2
             ];
            //  $users3 = Category::all();
            //   $users4 = Category::all();
            //   $users5 = Region::orderBy('region', 'ASC')->get();
            //  $users6 = Employer::orderBy('name', 'ASC')->get();
            $row = Discount::all();
            if (count($row) == 0) {
                Discount::create([
                    'discount_percentage' => 0.20,
                    'minimum_purchase' => 10000
                ]);
                }
             $discount = Discount::first();
             return view('maintenance-discount', $data, compact('discount'));
         }
    }

    public function update(Request $request, $id)
    {
        $data = $request->except(['_token', '_method']);
        Discount::where('id', $id)->update($data);
        $getname = Session::get('Name');
            $getusertype = Session::get('User-Type');
            base::recordAction( $getname, $getusertype,'Discount Maintenance', 'Discount Successfully Updated');
        return back()->with('success', 'Discount was updated successfully.');
    }

    public function readDiscount()
    {
        return Discount::first();
    }
}
