<?php

namespace App\Http\Controllers;
use App\Models\Login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Helpers\base;
use App\Models\MailVerify;
use Mail; 

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function signUp(Request $request){

        $fullname =  $request->input('fullname');
        $phone_no =  $request->input('phone_no');
        $password =  $request->input('password');
        $email =  $request->input('email');
        $address =  $request->input('address');
        $username =  $request->input('username');
        $birthdate =  $request->input('birthdate');
        $gender =  $request->input('gender');
        $age =  $request->input('age');
        $civilstatus =  $request->input('civilstatus');
        
        $patient_acc = new Login;
        $patient_acc->name = $fullname;
        $patient_acc->contactno = $phone_no;
        $patient_acc->address = $address;
        $patient_acc->email = $email;
        $patient_acc->age = $age;
        $patient_acc->gender = $gender;
        $patient_acc->birthdate = $birthdate;
        $patient_acc->username = $username;
        $patient_acc->password = $password;
        $patient_acc->civilstatus = $civilstatus;
        $patient_acc->user_role = 'Patient';
        $patient_acc->status = 'Pending';
        $patient_acc->archive_status = 'no';

        if ($request->hasFile('validid')) {
            $patient_acc->validid = $this->imageUpload($request, 'id_only');
        }

        $patient_acc->save();

        Session::forget('otp');

        $message =  "<p>From: " . "Optical Clinic"  . "</p>" .
                    "<p>Patient Name: " .  $fullname  . "</p>" .
                    "<p>Message: " . "Good Day, Your Registration Has been sent to the approval list, Please Wait for the email result for the verification of your credentials" . "</p>";

        Mail::to($email)->send(new MailVerify($message));
        
        return redirect('login')->send();         
      
    }

    public function isPhoneNoExists(Request $request)
    {
        $phone_no = $request->input('phone_no');
        
        $account =  DB::table('tbl_user')
        ->where('contactno', $phone_no)->get();  

        if($account->count() > 0)
        {
            return '1';
        }
        else{
            return $phone_no;
        }
    }


    public function sendOTP(Request $request){
        $phone_no =  $request->input('phone_no');
        $basic  = new \Vonage\Client\Credentials\Basic("9898a37c", "RWnDn3sbvaz1YQ5J");
        //$basic  = new \Vonage\Client\Credentials\Basic("534ad896", "2qI43TOV5XsNSPd4");
        $client = new \Vonage\Client($basic);

        $otp = rand(1000,9999);
      
        $message = $client->message()->send([
            'to' => '63'.$phone_no,
            'from' => 'Optical Clinic',
            'text' => $otp.' is your OTP from Optical Clinic'
        ]);
        Session::put('otp', $otp);

    }

    public function validateOTP($otp){
        if(Session::get('otp') == $otp){
            return '1';
        }
        else{
            return '0';
        }
    }

    public function imageUpload($request, $type) 
    {
        $folder_to_save = 'user-identification';

        if ($type == 'id_only') {
            $image_name = uniqid() . "." . $request->validid->extension();
            $request->validid->move(public_path('images/' . $folder_to_save), $image_name);
            return $folder_to_save . "/" . $image_name;
        }
    }
    // Edit Profile
    public function editprofile()
    {
            $staff = Login:: where('id','=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $staff,
            ];
            return view('patient-editprofile', $data);
    }
    public function addpatient()
    {
            $staff = Login:: where('id','=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo' => $staff,
            ];
            return view('secretary-addpatient', $data);
    }
    public function registerpatient(Request $request)
    {
        $registerpatient = new Login();
        $validatepatient =  Login::where('name','=', $request->input('registerfullname'))->first();
        if($validatepatient)
        {
            return back()->with('danger', 'Patient Already Exist');
        }
        else
        {
        $registerpatient->name = $request->input('registerfullname');
        $registerpatient->username = $request->input('registerusername');
        $registerpatient->password = $request->input('registerpassword');
        $registerpatient->user_role = 'Patient';
        $registerpatient->email = $request->input('registeremail');
        $registerpatient->contactno = $request->input('registerphone_no');
        $registerpatient->address = $request->input('registeraddress');
        $registerpatient->age = $request->input('registerage');
        $registerpatient->birthdate = $request->input('registerbirthdate');
        $registerpatient->gender = $request->input('registergender');
        $registerpatient->civilstatus = $request->input('registercivilstatus');
        $registerpatient->status = 'Approved';
        $registerpatient->archive_status = 'no';
        $registerpatient->save();
        $getname = Session::get('Name');
        $getusertype = Session::get('User-Type');
        base::recordAction( $getname, $getusertype,'Patient Registration', 'Patient Registration Successfully');
        // return redirect('maintenance-category')->with('success', 'Category Saved');
         return back()->with('success', 'Patient Registration is Successfully Saved');
        }
    }
    public function saveeditprofile(Request $request)
    {
        $id =  $request->input('editid');
        $fullname =  $request->input('editfullname');
        $phone_no =  $request->input('editphone_no');
        $password =  $request->input('editpassword');
        $email =  $request->input('editemail');
        $address =  $request->input('editaddress');
        $username =  $request->input('editusername');
        $birthdate =  $request->input('editbirthdate');
        $gender =  $request->input('editgender');
        $age =  $request->input('editage');
        $civilstatus =  $request->input('editcivilstatus');

        if($password == "")
        {
           $asd = DB::table('tbl_user')
            ->where('id', $id)
            ->update([
                'name' =>  $fullname,
                'email' => $email,
                'address' => $address,
                'contactno' => $phone_no,
                'username' => $username,
                'age' => $age,
                'birthdate' => $birthdate,
                'gender' => $gender,
                'civilstatus' => $civilstatus,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            return back()->with('success', 'Your Information is Successfully Saved');
        }
        else{
            DB::table('tbl_user')
            ->where('id', $id)
            ->update([
                'name' =>  $fullname,
                'email' => $email,
                'address' => $address,
                'contactno' => $phone_no,
                'username' => $username,
                'age' => $age,
                'birthdate' => $birthdate,
                'password' =>  $password,
                'gender' => $gender,
                'civilstatus' => $civilstatus,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            return back()->with('success', 'Your Information is Successfully Saved');
        }
    }
}
