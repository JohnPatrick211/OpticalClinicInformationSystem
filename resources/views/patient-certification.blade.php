@include('modals.patient_approval_modal')
@extends('layouts.patient')

@section('content')


                    <!-- Page Heading -->
                     <h1 class="h3 mb-2 text-gray-800">Patient Certificate</h1>
                    {{-- <div class="update-success-validation mr-auto ml-3" style="display: none">
                        <label class="label text-success">Employer is successfully Approved</label>
                      </div>
                      <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none"> --}}
                <!-- Debug Table Content -->
                <div class="row">

                </div>


                <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable-patientcertificate" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Doctor Name</th>
                                            <th>Branch Name</th>
                                            <th>Date Created</th>
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
            </div>  --}}
            <!-- End of Main Content -->

            @endsection
