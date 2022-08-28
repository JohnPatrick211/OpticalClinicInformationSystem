@include('modals.patientinformation_modals')
@extends('layouts.secretary')

@section('content')


                    <!-- Page Heading -->
                     <h1 class="h3 mb-2 text-gray-800">Patient Information</h1>
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
                                <table class="table table-bordered" id="datatable-patientinformation" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="min-width: 50px">User ID</th>
                                            <th style="min-width: 250px">Name</th>
                                            <th style="min-width: 100px">Email</th>
                                            <th style="min-width: 400px">Address</th>
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

