@include('modals.appointment_modals')
@extends('layouts.patient')

@section('content')


                    <!-- Page Heading -->
                     <h1 class="h3 mb-2 text-gray-800">Book Appointment</h1>
                     
                    {{-- <div class="update-success-validation mr-auto ml-3" style="display: none">
                        <label class="label text-success">Employer is successfully Approved</label>
                      </div>
                      <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none"> --}}
                <!-- Debug Table Content -->
                <div class="row">

                </div>

                <div class="row mb-2">



                            <div class="col-sm-2 mb-3">
                            <select class="form-control" style="width:auto;" name="bookappointmentbranch" id="bookappointmentbranch">
                                                <option value="All Branches">All Branches</option>
                                                @foreach($users4 as $item)
                                                    <option value="{{$item->id}}">{{$item->branchname}}</option>
                                                @endforeach
                                                </select>
                              </div>

                              <div class="mt-2">
                                -
                                </div>

                              <!-- <div class="col-sm-2 mb-3">
                                <input data-column="9" type="date" class="form-control" id="vacantdate_to" value="{{ date('Y-m-d') }}">
                                </div>
                                    
                                    <div class="mt-2">
                                </div> -->

                             </div>

                
                             <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable-bookappointment" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Doctor Name</th>
                                            <th>Specialization</th>
                                            <th>Branch</th>
                                            <th>Appointment Date</th>
                                            <th>Appointment Day</th>
                                            <th>Available Time</th>
                                            <th>End Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
               
            <!-- End of Main Content -->

            @endsection

