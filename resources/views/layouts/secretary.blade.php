<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Optical Clinic</title>
    <link rel="icon" href="/img/initial_logo.png"/>
    <!-- Custom fonts for this template-->
    <link href="/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style type="text/css">
        .ui-datepicker {
            background: #333;
            border: 1px solid #555;
            color: #EEE;
}
</style>
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                 <!--<div class="sidebar-brand-icon rotate-n-15">-->
                    <!--<i class="fas fa-laugh-wink"></i>-->
                    <img src ="/img/initial_logo.png" width="55px" height="55px">
                <!--</div>-->
                <div class="sidebar-brand-text mx-3">OPTICAL CLINIC</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="secretary-dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span id="content-dashboard">Dashboard</span></a>
            </li>

            <!-- Divider -->
            {{-- <hr class="sidebar-divider"> --}}

            <!-- Heading -->
            {{-- <div class="sidebar-heading">
                Interface
            </div> --}}

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-address-book"></i>
                    <span>Patient Record</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="secretary-patient-information">Patient Information</a>
                        <a class="collapse-item" href="secretary-patient-history">Patient History</a>
                        <a class="collapse-item" href="secretary-patient-prescription">Patient Prescription</a>
                        <a class="collapse-item" href="secretary-patient-approval">Patient Approval</a>
                    </div>
                </div>
            </li>

            {{-- <li class="nav-item active">
                <a class="nav-link" href="employer-approval">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Employer Approval</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="employer-approval">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Job Approval </span></a>
            </li> --}}

            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAppointmentApproval"
                    aria-expanded="true" aria-controls="collapseApproval">
                    <i class="fas fa-fw fa-calendar-check"></i>
                    <span>Appointment</span>
                </a>
                <div id="collapseAppointmentApproval" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="secretary-appointment-approval">Appointment Approval</a>
                        <a class="collapse-item" href="secretary-appointment-list">Appointment List</a>
                    </div>
                </div>
            </li>

            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseApproval"
                    aria-expanded="true" aria-controls="collapseApproval">
                    <i class="fas fa-fw fa-money-bill"></i>
                    <span>Sales</span>
                </a>
                <div id="collapseApproval" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="secretary-billing">Billing</a>
                        <a class="collapse-item" href="secretary-inventory">Inventory</a>
                    </div>
                </div>
            </li>

            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ReportscollapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-chart-pie"></i>
                    <span>Reports</span>
                </a>
                <div id="ReportscollapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="secretary-sales-reports">Sales Reports</a>
                        <a class="collapse-item" href="secretary-services-reports">Service Reports</a>
                        <a class="collapse-item" href="secretary-appointment-reports">Appointment Report</a>
                        <a class="collapse-item" href="secretary-certification-reports">Certification Report</a>
                    </div>
                </div>
            </li>

            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaintenance"
                    aria-expanded="true" aria-controls="collapseMaintenance">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Maintenance</span>
                </a>
                <div id="collapseMaintenance" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="secretary-maintenance-service">Service Maintenance</a>
                        <a class="collapse-item" href="secretary-maintenance-product">Product Maintenance</a>
                        <a class="collapse-item" href="secretary-maintenance-schedule">Schedule Maintenance</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <!--<li class="nav-item active">-->
            <!--    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"-->
            <!--        aria-expanded="true" aria-controls="collapseUtilities">-->
            <!--        <i class="fas fa-fw fa-wrench"></i>-->
            <!--        <span>Utilities</span>-->
            <!--    </a>-->
            <!--    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"-->
            <!--        data-parent="#accordionSidebar">-->
            <!--        <div class="bg-white py-2 collapse-inner rounded">-->
            <!--            <a class="collapse-item" href="user-maintenance">User Maintenance</a>-->
            <!--            <a class="collapse-item" href="audit-trail">Audit Trail</a>-->
            <!--            <a class="collapse-item" href="backup-and-restore">Backup and Restore</a>-->
            <!--            <a class="collapse-item" href="archive">Archive</a>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</li>-->

            <!-- Divider -->
            {{-- <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div> --}}

            <!-- Nav Item - Pages Collapse Menu -->
            {{-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" id="content-tablerecords" href="tablerecords">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li> --}}

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 ">
                        <div class="input-group">
                            <h3 class="mt-3">{{ Session::get('BranchName')}}</h3>
                        </div>
                    </form> 

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <!--<li class="nav-item dropdown no-arrow mx-1">-->
                        <!--    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"-->
                        <!--        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                        <!--        <i class="fas fa-bell fa-fw"></i>-->
                                <!-- Counter - Alerts -->
                        <!--        <span class="badge badge-danger badge-counter">3+</span>-->
                        <!--    </a>-->
                            <!-- Dropdown - Alerts -->
                        <!--    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"-->
                        <!--        aria-labelledby="alertsDropdown">-->
                        <!--        <h6 class="dropdown-header">-->
                        <!--            Notifications-->
                        <!--        </h6>-->
                        <!--        <a class="dropdown-item d-flex align-items-center" href="#">-->
                        <!--            <div class="mr-3">-->
                        <!--                <div class="icon-circle bg-primary">-->
                        <!--                    <i class="fas fa-file-alt text-white"></i>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div>-->
                        <!--                <div class="small text-gray-500">December 12, 2019</div>-->
                        <!--                <span class="font-weight-bold">A new monthly report is ready to download!</span>-->
                        <!--            </div>-->
                        <!--        </a>-->
                        <!--        <a class="dropdown-item d-flex align-items-center" href="#">-->
                        <!--            <div class="mr-3">-->
                        <!--                <div class="icon-circle bg-success">-->
                        <!--                    <i class="fas fa-donate text-white"></i>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div>-->
                        <!--                <div class="small text-gray-500">December 7, 2019</div>-->
                        <!--                $290.29 has been deposited into your account!-->
                        <!--            </div>-->
                        <!--        </a>-->
                        <!--        <a class="dropdown-item d-flex align-items-center" href="#">-->
                        <!--            <div class="mr-3">-->
                        <!--                <div class="icon-circle bg-warning">-->
                        <!--                    <i class="fas fa-exclamation-triangle text-white"></i>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div>-->
                        <!--                <div class="small text-gray-500">December 2, 2019</div>-->
                        <!--                Spending Alert: We've noticed unusually high spending for your account.-->
                        <!--            </div>-->
                        <!--        </a>-->
                        <!--        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>-->
                        <!--    </div>-->
                        <!--</li>-->
                        <!-- Nav Item - Messages -->
                        <!--<div class="topbar-divider d-none d-sm-block"></div>-->

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{$LoggedUserInfo -> name}}</span>
                                {{-- <span class="mr-2 d-none d-lg-inline text-gray-600 small">Wyns Alvez</span> --}}
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <section class="content">
                    <div class="container-fluid">
                        @yield('content')

              </div>
                </section>
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
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to logout your account?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <!-- Bootstrap core JavaScript-->
    <script src="js/jquery.min.js"></script>

    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>

    <script src="js/bootstrap.bundle.min.js"></script>
   

    <!-- Core plugin JavaScript-->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>

   <!-- Page level custom scripts -->
   <script src="js/datatables-demo.js"></script>
    <!-- ajax action edit employer -->
   
    <script src="js/peso-staff--archive.js"></script>
    <script src="js/verify_appointment.js"></script>
    <script src="js/employer.js"></script>
    <script src="js/jobvacancy.js"></script>
    <script src="js/verify_patient.js"></script>
    <script src="js/verify_job.js"></script>
    <script src="js/borrowed.js"></script>
    <script src="js/branch.js"></script>
    <script src="js/service.js"></script>
    <script src="js/product.js"></script>
    <script src="js/category.js"></script>
    <script src="js/cashiering.js"></script>
    <script src="js/vacantreport.js"></script>
    <script src="js/user.js"></script>
    <script src="js/audit-trail.js"></script>
    <script src="js/archive.js"></script>
    <script src="js/region.js"></script>
    <script src="js/inventory.js"></script>
    <script src="js/schedule.js"></script>
    <script src="js/appointmentlist.js"></script>
    <script src="js/appointmentreport.js"></script>
    <script src="js/certificationreport.js"></script>
    <script src="js/salesreport.js"></script>
    <script src="js/servicesreport.js"></script>
    <script src="js/secretarypatienthistory.js"></script>
    <script src="js/secretarypatientprescription.js"></script>
    <script src="js/patientinformation.js"></script>
    <script src="js/login.js"></script>
    <script src="js/require-2.3.5.min.js"></script>
    <script src="js/bootstrap-multiselect.js"></script>
    <script src="js/adminlte.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>
