@include('modals.appointmentprescription_modals')
@extends('layouts.staff')

@section('content')



                    <!-- Page Heading -->
                     <h1 class="h3 mb-2 text-gray-800">Appointment List For Today</h1>
                    {{-- <div class="update-success-validation mr-auto ml-3" style="display: none">
                        <label class="label text-success">Employer is successfully Approved</label>
                      </div>
                      <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none"> --}}
                <!-- Debug Table Content -->
                <div class="row">

                </div>

                
                <div class="row mb-2">

                <div class="col-sm-2 mb-3">
                              <input data-column="9" type="date" class="form-control" id="appointmentlisttoday" value="{{ date('Y-m-d') }}" readonly>
                              </div>
                                <div class="col-sm-4 ">
                                <!-- <h6 class="h6 mt-2 text-gray-800" style="min-width: 350px;">{{$users6->branchname}}</h6> -->
                              <input type="hidden" name="appointmentlistbranch" id="appointmentlistbranch" value="{{$LoggedUserInfo -> branch_id}}">
                              <!-- <input type="hidden"name="appointmentlistdoctorname" id="appointmentlistdoctorname" value="{{$LoggedUserInfo -> id}}"> -->
                    </div>
                    <div class="col-sm-2 mb-3">
                              <select class="form-control" name="appointmentlistdoctorname" id="appointmentlistdoctorname">
                              @foreach($users5 as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                              @endforeach
                              </select>
                              </div>

                            <!-- <div class="col-sm-2 mb-3">
                            <select class="form-control" style="width:auto;" name="appointmentlistbranch" id="appointmentlistbranch">
                                                <option value="All Branches">All Branches</option>
                                                @foreach($users4 as $item)
                                                    <option value="{{$item->id}}">{{$item->branchname}}</option>
                                                @endforeach
                                                </select>
                              </div> -->

                              </div>
                <div class="card shadow mb-4">
                    <div class="card-body">
                              <table class="table responsive table-bordered table-hover" id="appointment-list-table" width="100%" cellspacing="0">
                                <thead>
                                  <tr>
                                            <th>Patient Name</th>
                                            <th>Doctor Name</th>
                                            <th>Branch</th>
                                            <th>Appointment Date</th>
                                            <th>Appointment Day</th>
                                            <th>Available Time</th>
                                            <th>End Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                  </tr>
                              </thead>

                              </table>
                             <!-- <img src="('assets/arrow_ltr.png')}}" alt="">
                              <button class="btn btn-sm btn-success mt-3" id="btn-bulk-verified">Mark as verified</button>
                              <div class="update-success-validation mr-auto ml-3" style="display: none">
                                <label class="label text-success">Customer is successfully added validate</label>
                              </div>
                              <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">-->
                <!-- Debug Table Content -->
                {{-- <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Employer Approval</h1> --}}
                    {{-- <ul class="nav nav-tabs" id="myTab" role="tablist">

                        <li class="nav-item">
                          <a class="nav-link  active" id="employer-validation-tab" data-toggle="tab" href="#employervalidation-tab" role="tab" aria-controls="contact" aria-selected="true">For Validation

                          </a>
                         </li>
                          <li class="nav-item">
                              <a class="nav-link" id="employer-verified-tab" data-toggle="tab" href="#employerverified-tab" role="tab" aria-controls="home" aria-selected="false">Verified

                              </a>
                          </li>

                      </ul>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="tab-pane fade active show" id="employervalidation-tab" role="tabpanel" aria-labelledby="employer-validation-tab">
                                <table class="table table-bordered " id="employer-approval-table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>address</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="employerverified-tab" role="tabpanel" aria-labelledby="employer-verified-tab">
                                <table class="table table-bordered" id="employer-approval-table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>address</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                        </div>
                        </div>

                </div>
                <!-- /.container-fluid -->
            </div>  --}}
            <!-- End of Main Content -->

            @endsection

