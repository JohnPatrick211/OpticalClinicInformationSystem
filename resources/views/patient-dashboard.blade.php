
@extends('layouts.patient')

@section('content')
                 <!-- Page Heading -->
                 <h1 class="h3 mb-2 text-gray-800">My Profile Information</h1>
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
            <div class="card">
                <div class="card-body">
                        <div class="row">

                        <div class="col-md-4 mb-3">
                            <label class="label-small font-weight-bold">Patient ID</label>
                            <br/>
                            <label class="label-small" id="displayid">P-{{$LoggedUserInfo -> id}}</label>
                        </div>
    
                        <div class="col-md-4 mb-3">
                            <label class="label-small font-weight-bold">Fullname</label>
                            <br/>
                            <label class="label-small" id="displayfullname">{{$LoggedUserInfo -> name}}</label>
                        </div>
                        
                        <div class="col-md-4 mb-6">
                            <label class="label-small font-weight-bold">Username</label>
                            <br/>
                            <label class="label-small" id="displayusername">{{$LoggedUserInfo -> username}}</label>
                        </div> 

                        <div class="col-md-4 mb-3">
                            <label class="label-small font-weight-bold">Email</label>
                            <br/>
                            <label class="label-small" id="displayemail">{{$LoggedUserInfo -> email}}</label>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label class="label-small font-weight-bold">Age</label>
                            <br/>
                            <label class="label-small" id="displayage">{{$LoggedUserInfo -> age}}</label>
                        </div> 

                        <div class="col-md-4 mb-3">
                            <label class="label-small font-weight-bold">Gender</label>
                            <br/>
                            <label class="label-small" id="displaygender">{{$LoggedUserInfo -> gender}}</label>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="label-small font-weight-bold">Civil Status</label>
                            <br/>
                            <label class="label-small" id="displaycivilstatus">{{$LoggedUserInfo -> civilstatus}}</label>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="label-small font-weight-bold">Birth Date</label>
                            <br/>
                            <label class="label-small" id="displaybirthdate">{{$LoggedUserInfo -> birthdate}}</label>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="label-small font-weight-bold">Phone Number</label>
                            <br/>
                            <label class="label-small" id="displayphone_no">{{$LoggedUserInfo -> contactno}}</label>
                        </div> 

                        <div class="col-md-12 mb-3">
                            <label class="label-small font-weight-bold">Address</label>
                            <br/>
                            <label class="label-small" id="displayaddress">{{$LoggedUserInfo -> address}}</label>
                        </div>

                     
                        
                    
    
                              <div class="col-12 mt-2">
                              <a href="editprofile" class="btn btn-sm btn-primary">Edit</a>
                              </div>
                              
                
                        </div>
                </div>
            </div>
        </div>
   @endsection
