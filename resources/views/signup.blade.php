<!DOCTYPE html>
<html>
<head>
	<title>Optical Clinic</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link href="/css/bootstrap.min.css" rel="stylesheet"> 
     <link href="/css/signup.css" rel="stylesheet">
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700;900&display=swap" rel="stylesheet">
    
	 <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
	<img class="bg" src="../images/header-bg.jpg">
	<div class="container-fluid">

        <div class="row mt-2 p-4">

            <div class="card col-md-9 m-auto">
                
                <div class="card-body">

                    <div class="alert alert-success" role="alert" id="alert-acc-success" style="display: none;">
                    </div> 
                    
                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <h4 style="color: #555555">Create your account</h4>
                        </div> 

                        <div class="col-md-3 mb-3">
                            <label class="label-small">First Name</label>
                            <input type="text" class="form-control" id="firstname" placeholder="firstname">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label-small">Middle Name</label>
                            <input type="text" class="form-control" id="middlename" placeholder="middlename">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label-small">Last Name</label>
                            <input type="text" class="form-control" id="lastname" placeholder="lastname">
                        </div>
                        
                        <div class="col-md-3 mb-6">
                            <label class="label-small">Username</label>
                            <input type="text" class="form-control" id="username" placeholder=" ">
                        </div> 

                        <div class="col-md-4 mb-3">
                            <label class="label-small">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="Email Address">
                        </div>
                        
                        <div class="col-md-2 mb-3">
                            <label class="label-small">Age</label>
                            <input type="text" class="form-control" id="age" placeholder="Age">
                        </div> 

                        <div class="col-md-3 mb-3">
                            <label class="label-small">Gender</label>
                            <select class="form-control" name="gender" id="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                             </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label-small">Civil Status</label>
                            <select class="form-control" name="civilstatus" id="civilstatus">
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                            <option value="Separated">Separated</option>
                            <option value="Divorced">Divorced</option>
                             </select>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="label-small">House No.</label>
                            <input type="text" class="form-control" id="houseno" placeholder="House No.">
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="label-small">Street</label>
                            <input type="text" class="form-control" id="street" placeholder="Street">
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="label-small">Barangay</label>
                            <input type="text" class="form-control" id="barangay" placeholder="Barangay">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label-small">City/Municipality</label>
                            <input type="text" class="form-control" id="city" placeholder="City/Municipality">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label-small">Province</label>
                            <input type="text" class="form-control" id="province" placeholder="Province">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="label-small">Birth Date</label>
                            <input type="date" class="form-control" id="birthdate" placeholder="birthdate">
                        </div>
            
                        <div class="col-md-6">
                            <label class="label-small">Phone Number</label>
                            <input type="text" maxlength="11" class="form-control" id="phone_no">
                            <a id="send-OTP" style="cursor: pointer; color:#32638D;" class="label-small"><u>Send OTP</u></a>
                            <span class="countdown label-small"></span>
                        </div> 
    
                        <div class="col-md-6 mb-3">
                            <label class="label-small">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Minimum of 8 characters">
                        </div> 

                        <div class="col-md-6">
                            <label class="label-small">Enter your OTP</label>
                            <input type="text" class="form-control" id="otp" placeholder="Enter your 4 digit OTP">
                        </div> 

                        <div class="col-md-6">
                            <label class="label-small">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password">
                        </div>
                        
                        <div class="col-md-4">
                        <label class="label-small">Valid ID</label>
                        <input type="file"  name="validid" id="validid" enctype="multipart/form-data">
                        </div>
                       
                        <div class="col-md-12">
                            <input type="button" class="btn" id="btn-signup" value="SIGN UP">
                            <span class="label-small m-0">By clicking "SIGN UP"; I agree to Optical Clinic 
                                <a href="/terms_and_condition" target="_blank">Terms of Use</a> and <a href="/privacy-policy" target="_blank">Privacy Policy</a>
                            </span>	
                        </div>

                        <div class="col-md-12"><hr></div>

                        <div class="col-md-6">
                            <span class="label-small m-0"> Already have an account?
                                <a href="login"> Login </a>  here.
                            </span>	
                        </div>

                       
    
                </div>	
            </div>
    
        </div>

        </div>
        @section('modals')
        @endsection
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
	<!-- <script src="{{asset('js/admin-login.js')}}"></script> -->
    <script src="js/signup.js"></script>

</body>
</html>