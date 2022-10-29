@include('modals.patient_approval_modal')
@extends('layouts.admin')

@section('content')


                    <!-- Page Heading -->
                     <h1 class="h3 mb-2 text-gray-800">Patient History</h1>
                    {{-- <div class="update-success-validation mr-auto ml-3" style="display: none">
                        <label class="label text-success">Employer is successfully Approved</label>
                      </div>
                      <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none"> --}}
                <!-- Debug Table Content -->
                <div class="row">
                <div class="col-sm-2 mb-3">
                            <select class="form-control" style="width:auto;" name="patienthistorybranch" id="patienthistorybranch">
                                                <option value="All Branches">All Branches</option>
                                                @foreach($users4 as $item)
                                                    <option value="{{$item->id}}">{{$item->branchname}}</option>
                                                @endforeach
                                                </select>
                              </div>
                </div>


                <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable-adminpatienthistory" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Invoice No.</th>
                                            <th>Branch Name</th>
                                            <th>Payment Method</th>
                                            <th>Receipt Date</th>
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

