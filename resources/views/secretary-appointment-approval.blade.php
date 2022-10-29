@include('modals.appointmentapproval_modals')
@extends('layouts.secretary')


@section('content')


                    <!-- Page Heading -->
                     <h1 class="h3 mb-2 text-gray-800">Appointment Approval</h1>
                    {{-- <div class="update-success-validation mr-auto ml-3" style="display: none">
                        <label class="label text-success">Employer is successfully Approved</label>
                      </div>
                      <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none"> --}}
                <!-- Debug Table Content -->
                <div class="row">

                </div>

                
                <div class="row mb-2">

                <div class="col-sm-2 mb-3">
                              <input data-column="9" type="date" class="form-control" id="appointmentdate_from" value="{{ date('Y-m-d') }}">
                              </div>

                              <div class="mt-2">
                                -
                                </div>

                              <div class="col-sm-2 mb-3">
                                <input data-column="9" type="date" class="form-control" id="appointmentdate_to" value="{{ date('Y-m-d') }}" readonly>
                                </div>
                                    
                                    <div class="mt-2">
                                </div>

                                <!-- <div class="col-sm-2 mb-3"> -->
                              
                              
                              <!-- <h6 class="h6 mt-2 text-gray-800">{{$users6->branchname}}</h6> -->
                              <input type="hidden" name="approvalappointmentbranch" id="approvalappointmentbranch" value="{{$LoggedUserInfo -> branch_id}}">
                              <!-- <input type="hidden" name="appointmentapprovaldoctorname" id="appointmentapprovaldoctorname" value="{{$LoggedUserInfo -> id}}"> -->
                              <!-- <h6 class="h6 mt-2 text-gray-800" name="appointmentapprovaldoctorname" id="appointmentapprovaldoctorname">{{$LoggedUserInfo -> id}}</h6> -->
                              <!-- </div> -->

                            <div class="col-sm-2 mb-3">
                            <select class="form-control" name="appointmentapprovaldoctorname" id="appointmentapprovaldoctorname">
                              @foreach($users5 as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                              @endforeach
                              </select>
                              </div>


                              </div>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">

                          <ul class="nav nav-tabs" id="myTab" role="tablist">

                            <li class="nav-item">
                              <a class="nav-link  active" id="validation-tab" data-toggle="tab" href="#validationtab" role="tab" aria-controls="contact" aria-selected="true">For Approval

                              </a>
                             </li>
                              <li class="nav-item">
                                  <a class="nav-link" id="verified-tab" data-toggle="tab" href="#verifiedtab" role="tab" aria-controls="home" aria-selected="false">Approved

                                  </a>
                              </li>

                          </ul>
                          <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="validationtab" role="tabpanel" aria-labelledby="validation-tab">

                              <table class="table responsive table-bordered table-hover" id="appointment-approval-table" width="100%" cellspacing="0">
                                <thead>
                                  <tr>
                                            <th>Patient Name</th>
                                            <th>Doctor Name</th>
                                            <th>Specialization</th>
                                            <th>Branch</th>
                                            <th>Appointment Date</th>
                                            <th>Appointment Day</th>
                                            <th>Appointment Time</th>
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


                            </div>
                            <div class="tab-pane fade" id="verifiedtab" role="tabpanel" aria-labelledby="verified-tab">

                              <table class="table responsive table-bordered table-hover" id="appointment-approved-table" width="100%">
                                <thead>
                                  <tr>
                                            <th>Patient Name</th>
                                            <th>Doctor Name</th>
                                            <th>Specialization</th>
                                            <th>Branch</th>
                                            <th>Appointment Date</th>
                                            <th>Appointment Day</th>
                                            <th>Appointment Time</th>
                                            <th>End Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                  </tr>
                              </thead>

                              </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
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

