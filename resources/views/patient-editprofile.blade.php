
@extends('layouts.patient')

@section('content')
                 <!-- Page Heading -->
                 <h1 class="h3 mb-2 text-gray-800">Edit Information</h1>
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
          <a href="patient-dashboard"><i class="fa fa-arrow-left"></i></a>
          <br/>
            <div class="card">
                <div class="card-body">
                        <form action="saveeditprofile" method="POST" enctype="multipart/form-data">
                        <div class="row">
                        {{ csrf_field() }}
 
                        <input type="hidden" name= "editid" id="editid" value="{{$LoggedUserInfo -> id}}">

                        <div class="col-md-3 mb-3">
                            <label class="label-small">First Name</label>
                            <input type="text" class="form-control" name= "editfirstname" id="editfirstname" placeholder="First Name" value="{{$LoggedUserInfo -> firstname}}">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label-small">Middle Name</label>
                            <input type="text" class="form-control" name= "editmiddlename" id="editmiddlename" placeholder="Middle Name" value="{{$LoggedUserInfo -> middlename}}">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label-small">Last Name</label>
                            <input type="text" class="form-control" name= "editlastname" id="editlastname" placeholder="Last Name" value="{{$LoggedUserInfo -> lastname}}">
                        </div>
                        
                        <div class="col-md-3 mb-6">
                            <label class="label-small">Username</label>
                            <input type="text" class="form-control" name= "editusername" id="editusername" placeholder=" " value="{{$LoggedUserInfo -> username}}">
                        </div> 

                        <div class="col-md-4 mb-3">
                            <label class="label-small">Email</label>
                            <input type="text" class="form-control" name="editemail" id="editemail" placeholder="Email Address" value="{{$LoggedUserInfo -> email}}">
                        </div>
                        
                        <div class="col-md-2 mb-3">
                            <label class="label-small">Age</label>
                            <input type="text" class="form-control" name="editage" id="editage" placeholder="Age" value="{{$LoggedUserInfo -> age}}">
                        </div> 

                        <div class="col-md-3 mb-3">
                            <label class="label-small">Gender</label>
                            <select class="form-control" name="editgender" id="editgender">
                            <option value="Male"  {{ ( $LoggedUserInfo -> gender == "Male") ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ ( $LoggedUserInfo -> gender == "Female") ? 'selected' : '' }}>Female</option>
                             </select>
                        </div>


                        <div class="col-md-3 mb-3">
                            <label class="label-small">Civil Status</label>
                            <select class="form-control" name="editcivilstatus" id="editcivilstatus" value="{{$LoggedUserInfo -> civilstatus}}">
                            <option value="Single" {{ ( $LoggedUserInfo -> civilstatus == "Single") ? 'selected' : '' }}>Single</option>
                            <option value="Married" {{ ( $LoggedUserInfo -> civilstatus == "Married") ? 'selected' : '' }}>Married</option>
                            <option value="Widowed" {{ ( $LoggedUserInfo -> civilstatus == "Widowed") ? 'selected' : '' }}>Widowed</option>
                            <option value="Separated" {{ ( $LoggedUserInfo -> civilstatus == "Separated") ? 'selected' : '' }}>Separated</option>
                            <option value="Divorced" {{ ( $LoggedUserInfo -> civilstatus == "Divorced") ? 'selected' : '' }}>Divorced</option>
                             </select>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="label-small">House No.</label>
                            <input type="text" class="form-control" name="edithouseno" id="edithouseno" placeholder="House No." value="{{$LoggedUserInfo -> houseno}}">
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="label-small">Street</label>
                            <input type="text" class="form-control" name="editstreet" id="editstreet" placeholder="Street" value="{{$LoggedUserInfo -> street}}">
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="label-small">Barangay</label>
                            <input type="text" class="form-control" name="editbarangay" id="editbarangay" placeholder="Barangay" value="{{$LoggedUserInfo -> barangay}}">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label-small">City/Municipality</label>
                            <input type="text" class="form-control" name="editcity" id="editcity" placeholder="City/Municipality" value="{{$LoggedUserInfo -> city}}">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="label-small">Province</label>
                            <input type="text" class="form-control" name="editprovince" id="editprovince" placeholder="Province" value="{{$LoggedUserInfo -> province}}">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="label-small">Birth Date</label>
                            <input type="date" class="form-control" name="editbirthdate" id="editbirthdate" placeholder="birthdate" value="{{$LoggedUserInfo -> birthdate}}">
                        </div>
            
                        <div class="col-md-6">
                            <label class="label-small">Phone Number</label>
                            <input type="text" maxlength="11" class="form-control" name="editphone_no" id="editphone_no" value="{{$LoggedUserInfo -> contactno}}">
                        </div> 

                        <div class="col-md-6 mb-3">
                            <label class="label-small">Password</label>
                            <input type="password" onkeyup='check();' class="form-control" name="editpassword" id="editpassword" placeholder="Minimum of 8 characters">
                        </div> 
                        
                        <div class="col-md-6">
                            <label class="label-small">Confirm Password</label>
                            <input type="password" onkeyup='check();' class="form-control" name="editconfirm_password" id="editconfirm_password">
                            <div class="editprofile-fail" style="display: none;">
                            <span class="text-danger">Password Does Not Match</span>
                            </div>
                            <div class="editprofile-success" style="display: none;">
                            <span class="text-success">Password Match</span>
                            </div>
                        </div>
    
                              <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-sm btn-primary mr-2" id="btn-edit-user">Save changes</button>
                              </div>
                              
                
                        </div>
                        <form>
                </div>
            </div>
        </div>
   @endsection
