@extends('layouts.admin')

@section('content')

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Audit Trail</h1>
                    <!-- DataTales Example -->
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



                    </div>

                        <div class="row mb-2">



                            <div class="col-sm-2 mb-3">
                              <input data-column="9" type="date" class="form-control" id="audit-date_from" value="{{ date('Y-m-d') }}">
                              </div>

                              <div class="mt-2">
                                -
                                </div>

                              <div class="col-sm-2 mb-3">
                                <input data-column="9" type="date" class="form-control" id="audit-date_to" value="{{ date('Y-m-d') }}">
                                </div>


                             </div>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="audit-table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Module</th>
                                            <th>Action</th>
                                            <th>Date time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach($users3 as $LoggedUserInfo)
                                        <tr>
                                            <td>{{$LoggedUserInfo -> id}}</td>
                                            <td>{{$LoggedUserInfo -> name}}</td>
                                            <td>{{$LoggedUserInfo-> role}}</td>
                                            <td>{{$LoggedUserInfo -> contactNo}}</td>

                                        </tr>
                                        @endforeach --}}
                                        {{-- <tr>
                                            <td>{{$LoggedUserInfo -> id}}</td>
                                            <td>{{$LoggedUserInfo -> fullname}}</td>
                                            <td>{{$LoggedUserInfo -> email}}</td>
                                            <td>{{$LoggedUserInfo -> phonenumber}}</td>

                                        </tr> --}}
                                        {{-- <tr>
                                            <td>Garrett Winters</td>
                                            <td>Accountant</td>
                                            <td>Tokyo</td>
                                            <td>63</td>
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
