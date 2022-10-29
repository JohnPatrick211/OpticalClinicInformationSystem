@include('modals.appointmentprescription_modals')
@extends('layouts.secretary')

@section('content')



                    <!-- Page Heading -->
                     <h1 class="h3 mb-2 text-gray-800">Appointment Report</h1>
                    {{-- <div class="update-success-validation mr-auto ml-3" style="display: none">
                        <label class="label text-success">Employer is successfully Approved</label>
                      </div>
                      <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none"> --}}
                <!-- Debug Table Content -->
                <div class="row">

                </div>

                
                <div class="row mb-2">

                <div class="col-sm-2 mb-3">
                              <input data-column="9" type="date" class="form-control" id="appointmentreportdate_from" value="{{ date('Y-m-d') }}">
                              </div>

                              <div class="mt-2">
                                -
                                </div>

                              <div class="col-sm-2 mb-3">
                                <input data-column="9" type="date" class="form-control" id="appointmentreportdate_to" value="{{ date('Y-m-d') }}" readonly>
                                </div>
                                    
                                    <div class="mt-2">
                                </div>

                                <!-- <div class="col-sm-2 mb-3"> -->
                                <!-- <h6 class="h6 mt-2 text-gray-800">{{$users6->branchname}}</h6> -->
                              <input type="hidden" name="appointmentreportbranch" id="appointmentreportbranch" value="{{$LoggedUserInfo -> branch_id}}">
                              <!-- <input type="hidden" name="appointmentreportdoctorname" id="appointmentreportdoctorname" value="{{$LoggedUserInfo -> id}}"> -->
                            <!-- <select class="form-control" style="width:auto;" name="appointmentreportbranch" id="appointmentreportbranch">
                                                <option value="All Branches">All Branches</option>
                                                @foreach($users4 as $item)
                                                    <option value="{{$item->id}}">{{$item->branchname}}</option>
                                                @endforeach
                                                </select> -->
                              <!-- </div> -->

                              <!-- <div class="mt-2">
                              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                </div> -->
                                
                        

                                <div class="col-sm-2 mb-3">
                              <select class="form-control" name="appointmentreportdoctorname" id="appointmentreportdoctorname">
                              @foreach($users5 as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                              @endforeach
                              </select>
                              </div>                 

                              </div>
                              <div class="row mb-2">

                    <div class="col-sm-2 col-md-2 col-lg-10 mb-3">
                        <button class="btn btn-danger btn-sm"id="btn-appointmentreport-print"><span class='fa fa-print'></span> Print</button>
                        </div>

                    </div>
                <div class="card shadow mb-4">
                    <div class="card-body">
                              <table class="table responsive table-bordered table-hover" id="appointment-report-table" width="100%" cellspacing="0">
                                <thead>
                                  <tr>
                                            <th>Patient Name</th>
                                            <th>Doctor Name</th>
                                            <th>Branch</th>
                                            <th>Appointment Date</th>
                                            <th>Appointment Day</th>
                                            <th>Available Time</th>
                                  </tr>
                              </thead>

                              </table>
            @endsection

