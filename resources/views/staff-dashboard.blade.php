
@extends('layouts.staff')

@section('content')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="row h-auto w-auto"href="doctor-dashboard">
                <div class="col-xl-4 col-md-6 mb-4 h-100">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-primary text-uppercase mb-3">
                                        Appointment For Today</div>
                                    <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $AppointmentForToday}}
                                    <br><br>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800"><a href="staff-appointment-list">Click Here to See More</a></div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-history fa-3x text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-primary text-uppercase mb-3">
                                        Pending Appointment Approval</div>
                                    <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $pendingappointmentapproval}}
                                        <br><br>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800"><a href="staff-appointment-approval">Click Here to See More</a></div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-history fa-3x text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4 h-100">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-primary text-uppercase mb-3">
                                        No. of Appointment Completed</div>
                                    <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $completeappointment }}
                                     <br><br>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800"><a href="staff-appointment-reports">Click Here to See More</a></div></div>
                                    
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-thumbs-up fa-3x text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-danger text-uppercase mb-3">
                                        Total Sales for Today</div>
                                    <div class="h3 mb-0 font-weight-bold text-gray-800"><span style="font-size: 28px;">&#8369;</span> {{number_format($sales, 2, '.',',')}}
                                     <br><br>   
                                    <div class="h6 mb-0 font-weight-bold text-gray-800"><a href="staff-sales-reports">Click Here to See More</a></div></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-money-bill fa-3x text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <!-- <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-success text-uppercase mb-3">
                                        Pending Patient Approval</div>
                                    <div class="h3 mb-0 font-weight-bold text-gray-800">{{$pendingpatient}}
                                     <br><br>   
                                    <div class="h6 mb-0 font-weight-bold text-gray-800"><a href="staff-patient-approval">Click Here to See More</a></div></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-history fa-3x text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4 h-100">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-sm font-weight-bold text-success text-uppercase mb-3">
                                    No. of Patient Approved</div>
                                    <div class="h3 mb-0 font-weight-bold text-gray-800">{{$approvedpatient}}
                                     <br><br>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800"><a href="staff-patient-approval">Click Here to See More</a></div></div>
                                    
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-thumbs-up fa-3x text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                
                

                <!-- Earnings (Monthly) Card Example -->
                <!--<div class="col-xl-3 col-md-6 mb-4">-->
                <!--    <div class="card border-left-info shadow h-100 py-2">-->
                <!--        <div class="card-body">-->
                <!--            <div class="row no-gutters align-items-center">-->
                <!--                <div class="col mr-2">-->
                <!--                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks-->
                <!--                    </div>-->
                <!--                    <div class="row no-gutters align-items-center">-->
                <!--                        <div class="col-auto">-->
                <!--                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>-->
                <!--                        </div>-->
                <!--                        <div class="col">-->
                <!--                            <div class="progress progress-sm mr-2">-->
                <!--                                <div class="progress-bar bg-info" role="progressbar"-->
                <!--                                    style="width: 50%" aria-valuenow="50" aria-valuemin="0"-->
                <!--                                    aria-valuemax="100"></div>-->
                <!--                            </div>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--                <div class="col-auto">-->
                <!--                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                </div>

                <!-- Pending Requests Card Example -->
                <!--<div class="col-xl-3 col-md-6 mb-4">-->
                <!--    <div class="card border-left-warning shadow h-100 py-2">-->
                <!--        <div class="card-body">-->
                <!--            <div class="row no-gutters align-items-center">-->
                <!--                <div class="col mr-2">-->
                <!--                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">-->
                <!--                        Pending Requests</div>-->
                <!--                    <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>-->
                <!--                </div>-->
                <!--                <div class="col-auto">-->
                <!--                    <i class="fas fa-comments fa-2x text-gray-300"></i>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->

            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
   @endsection
