@include('modals.staff_certification_modals')
@extends('layouts.staff')

@section('content')

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Certification Report</h1>
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

                        <div class="row mb-2">

                        <!-- <div class="col-sm-2 mb-3">
                          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#StaffCertificationModal" id="btn-add-certification"><span class='fa fa-plus'></span> Add Medical Certificate</button>

                          </div> -->


                                <!-- <div class="col-sm-4 mb-3"> -->
                                <!-- <h6 class="h6 mt-2 text-gray-800">{{$users6->branchname}}</h6> -->
                              <input type="hidden" name="certificationreportbranch" id="certificationreportbranch" value="{{$LoggedUserInfo -> branch_id}}">
                              <!-- <input type="hidden" name="certificationreportdoctorname" id="certificationreportdoctorname" value="{{$LoggedUserInfo -> id}}"> -->
                              <!-- </div> -->

                              <!-- <div class="mt-2">
                              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                </div>
                                 -->
                        

                                <div class="col-sm-2 mb-3">
                              <select class="form-control" name="certificationreportdoctorname" id="certificationreportdoctorname">
                              @foreach($users5 as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                              @endforeach
                              </select>
                              </div>                 

                              </div>
                        
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable-certification" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Patient Name</th>
                                            <th>Doctor Name</th>
                                            <th>Branch</th>
                                            <th>Date</th>
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
