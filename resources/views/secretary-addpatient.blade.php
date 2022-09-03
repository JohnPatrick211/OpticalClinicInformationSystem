
@extends('layouts.secretary')

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

                        <div class="col-md-6 mb-3">
                            <label class="label-small">Fullname</label>
                            <input type="text" class="form-control" name= "registerfullname" id="registerfullname" placeholder="First Last" value="">
                        </div>
                        
                        <div class="col-md-6 mb-6">
                            <label class="label-small">Username</label>
                            <input type="text" class="form-control" name= "registerusername" id="registerusername" placeholder=" " value="">
                        </div> 

                        <div class="col-md-6 mb-3">
                            <label class="label-small">Email</label>
                            <input type="text" class="form-control" name="registeremail" id="registeremail" placeholder="Email Address" value="">
                        </div>
                        
                        <div class="col-md-3 mb-3">
                            <label class="label-small">Age</label>
                            <input type="text" class="form-control" name="registerage" id="registerage" placeholder="Age" value="">
                        </div> 

                        <div class="col-md-3 mb-3">
                            <label class="label-small">Gender</label>
                            <select class="form-control" name="registergender" id="registergender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                             </select>
                        </div>


                        <div class="col-md-3 mb-3">
                            <label class="label-small">Civil Status</label>
                            <select class="form-control" name="registercivilstatus" id="registercivilstatus" value="">
                            <option value="Single">Single</option>
                            <option value="Married" >Married</option>
                             </select>
                        </div>

                        <div class="col-md-9 mb-3">
                            <label class="label-small">Address</label>
                            <input type="text" class="form-control" name="registeraddress" id="registeraddress" placeholder="Address" value="">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="label-small">Birth Date</label>
                            <input type="date" class="form-control" name="registerbirthdate" id="registerbirthdate" placeholder="birthdate" value="">
                        </div>
            
                        <div class="col-md-6">
                            <label class="label-small">Phone Number</label>
                            <input type="text" maxlength="11" class="form-control" name="registerphone_no" id="registerphone_no" value="">
                        </div> 

                        <div class="col-md-6 mb-3">
                            <label class="label-small">Password</label>
                            <input type="password" onkeyup='check2();' class="form-control" name="registerpassword" id="registerpassword" placeholder="Minimum of 8 characters">
                        </div> 
                        
                        <div class="col-md-6">
                            <label class="label-small">Confirm Password</label>
                            <input type="password" onkeyup='check2();' class="form-control" name="registerconfirm_password" id="registerconfirm_password">
                            <div class="registerprofile-fail" style="display: none;">
                            <span class="text-danger">Password Does Not Match</span>
                            </div>
                            <div class="registerprofile-success" style="display: none;">
                            <span class="text-success">Password Match</span>
                            </div>
                        </div>
    
                              <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-sm btn-primary mr-2" id="btn-register-user">Register Patient</button>
                              </div>
                              
                
                        </div>
                        <form>
                </div>
            </div>
        </div>
   @endsection
