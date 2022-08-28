@include('modals.doctor_schedule_modals')
@extends('layouts.doctor')

@section('content')

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Schedule Maintenance</h1>
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

                        <div class="col-sm-2 col-md-2 col-lg-10 mb-3">
                          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#DoctorScheduleModal" id="btn-add-product"><span class='fa fa-plus'></span> Add Doctor Schedule</button>

                          </div>
                        </div>

                        <!-- <div class="row mb-2"> -->



                <div class="col-sm-2">
                <input type="hidden" name="branch" id="mainschedulebranch" value="{{$LoggedUserInfo -> branch_id}}">
                <!-- <select class="form-control" style="width:auto;" name="branch" id="mainschedulebranch">
                                    <option value="All Branches">All Branches</option>
                                    @foreach($users4 as $item)
                                        <option value="{{$item->id}}">{{$item->branchname}}</option>
                                    @endforeach
                                    </select>
                </div>

                <div class="mt-2">
                    -
                    </div> -->

                <!-- <div class="col-sm-2 mb-3">
                    <input data-column="9" type="date" class="form-control" id="vacantdate_to" value="{{ date('Y-m-d') }}">
                    </div>
                        
                        <div class="mt-2">
                    </div> -->

                </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable-doctor-schedule" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Doctor Name</th>
                                            <th>Specialization</th>
                                            <th>Branch Name</th>
                                            <th>Schedule Date</th>
                                            <th>Schedule Day</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach($users3 as $LoggedUserInfo)
                                        <tr>
                                            <td>{{$LoggedUserInfo -> id}}</td>
                                            <td>{{$LoggedUserInfo -> category}}</td>
                                        </tr>
                                        @endforeach --}}
                                        {{-- <tr>
                                            <td>{{$LoggedUserInfo -> id}}</td>
                                            <td>{{$LoggedUserInfo -> fullname}}</td>
                                            <td>{{$LoggedUserInfo -> email}}</td>
                                            <td>{{$LoggedUserInfo -> phonenumber}}</td>

                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            
            <!-- End of Main Content -->
@endsection
