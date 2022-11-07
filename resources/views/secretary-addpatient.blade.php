
@extends('layouts.secretary')
@include('sweetalert::alert')
@section('content')
                 <!-- Page Heading -->
                 <h1 class="h3 mb-2 text-gray-800">Patient Registration</h1>
                     @if(count($errors)>0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)

                            <li>{{$error}}</li>

                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(\Session::has('success'))
                    <div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-check"></i> </h5>
                      {{ \Session::get('success') }}
                    </div>
                    @endif

                    @if(\Session::has('danger'))
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-exclamation-triangle"></i> </h5>
                      {{ \Session::get('danger') }}
                    </div>
                    @endif
                    <div class="row">
          <div class="col-sm-12 col-md-12">
          <a href="secretary-patient-information"><i class="fa fa-arrow-left"></i></a>
          <br/>
            <div class="card">
                <div class="card-body">
                        <form action="registerpatient" method="POST" enctype="multipart/form-data">
                        <div class="row">
                        {{ csrf_field() }}
                        <div class="col-md-3 mb-3">
                            <label class="label-small">First Name</label>
                            <input type="text" class="form-control" name= "registerfirstname" id="registerfirstname" placeholder="First Name" value="" required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label-small">Middle Name</label>
                            <input type="text" class="form-control" name= "registermiddlename" id="registermiddlename" placeholder="Middle Name" value="" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="label-small">Last Name</label>
                            <input type="text" class="form-control" name= "registerlastname" id="registerlastname" placeholder="Last Name" value="" required>
                        </div>                      
                        <div class="col-md-3 mb-6">
                            <label class="label-small">Username</label>
                            <input type="text" class="form-control" name= "registerusername" id="registerusername" placeholder=" " value="" required>
                        </div> 

                        <div class="col-md-4 mb-3">
                            <label class="label-small">Email</label>
                            <input type="text" class="form-control" name="registeremail" id="registeremail" placeholder="Email Address" value="" required>
                        </div>
                        
                        <div class="col-md-2 mb-3">
                            <label class="label-small">Age</label>
                            <input type="text" class="form-control" name="registerage" id="registerage" placeholder="Age" value="" required>
                        </div> 

                        <div class="col-md-3 mb-3">
                            <label class="label-small">Gender</label>
                            <select class="form-control" name="registergender" id="registergender" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                             </select>
                        </div>


                        <div class="col-md-3 mb-3">
                            <label class="label-small">Civil Status</label>
                            <select class="form-control" name="registercivilstatus" id="registercivilstatus" value="" required>
                            <option value="Single">Single</option>
                            <option value="Married" >Married</option>
                            <option value="Widowed">Widowed</option>
                            <option value="Separated">Separated</option>
                            <option value="Divorced">Divorced</option>
                             </select>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="label-small">House No.</label>
                            <input type="text" class="form-control" name="registerhouseno" id="registerhouseno" placeholder="House No." value="" required>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="label-small">Street</label>
                            <input type="text" class="form-control" name="registerstreet" id="registerstreet" placeholder="Street" value="" required>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="label-small">Barangay</label>
                            <input type="text" class="form-control" name="registerbarangay" id="registerbarangay" placeholder="Barangay" value="" required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label-small">City/Municipality</label>
                            <input type="text" class="form-control" name="registercity" id="registercity" placeholder="City/Municipality" value="" required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label-small">Province</label>
                            <input type="text" class="form-control" name="registerprovince" id="registerprovince" placeholder="Province" value="" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="label-small">Birth Date</label>
                            <input type="date" class="form-control" name="registerbirthdate" id="registerbirthdate" placeholder="birthdate" value="" required>
                        </div>
            
                        <div class="col-md-6">
                            <label class="label-small">Phone Number</label>
                            <input type="text" maxlength="11" class="form-control" name="registerphone_no" id="registerphone_no" value="" required>
                        </div> 

                        <div class="col-md-6 mb-3">
                            <label class="label-small">Password</label>
                            <input type="password" onkeyup='check2();' class="form-control" name="registerpassword" id="registerpassword" placeholder="Minimum of 8 characters" required>
                        </div> 
                        
                        <div class="col-md-6">
                            <label class="label-small">Confirm Password</label>
                            <input type="password" onkeyup='check2();' class="form-control" name="registerconfirm_password" id="registerconfirm_password" required>
                            <div class="registerprofile-fail" style="display: none;">
                            <span class="text-danger">Password Does Not Match</span>
                            </div>
                            <div class="registerprofile-success" style="display: none;">
                            <span class="text-success">Password Match</span>
                            </div>
                        </div>
    
                              <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-sm btn-primary mr-2" id="btn-register-user" name="btn-register-user">Register Patient</button>
                              </div>
                              
                
                        </div>
                        <form>
                </div>
            </div>
        </div>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
   @endsection
