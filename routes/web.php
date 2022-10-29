<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AlreadyloggedIn;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//READ AND SEARCH PRODUCT
Route::get('/customer/product/{type}/{billingbranch}',[App\Http\Controllers\BillingController::class, 'readAllProduct']);
Route::get('/customer/product/search',[App\Http\Controllers\BillingController::class, 'searchProduct']);

Route::get('/login',[App\Http\Controllers\LoginController::class, 'login'])->middleware('AlreadyLoggedIn');
Route::get('register',[App\Http\Controllers\LoginController::class, 'register']);
Route::post('check',[App\Http\Controllers\LoginController::class, 'check']) ->name('check');
Route::get('admin-dashboard', [App\Http\Controllers\LoginController::class, 'admin'])->middleware('Islogged');
Route::get('logout', [App\Http\Controllers\LoginController::class, 'logout']);
//signup
Route::post('/signup/signup', [App\Http\Controllers\RegisterController::class, 'signup']);
Route::get('/signup/isexists', [App\Http\Controllers\RegisterController::class, 'isPhoneNoExists']);
Route::get('/signup/send-OTP', [App\Http\Controllers\RegisterController::class, 'sendOTP']);
Route::get('/signup/validate-otp/{otp}', [App\Http\Controllers\RegisterController::class, 'validateOTP']);
//Patient Information
Route::get('patient-information',[App\Http\Controllers\PatientInformationController::class, 'PatientInformationView'])->middleware('Islogged');
Route::get('patientinformation-data',[App\Http\Controllers\PatientInformationController::class, 'PatientInformation'])->middleware('Islogged');
Route::get('/patientinformation/getpatientinfo/{id}', [App\Http\Controllers\PatientInformationController::class, 'getPatientInfo']);
//Patient Approval
Route::get('patient-approval-data',[App\Http\Controllers\PatientApprovalController::class, 'PatientApproval'])->middleware('Islogged');
Route::get('patient-approval-data-approved',[App\Http\Controllers\PatientApprovalController::class, 'PatientApproved'])->middleware('Islogged');
Route::get('patient-approval',[App\Http\Controllers\PatientApprovalController::class, 'PatientApprovalView'])->middleware('Islogged');
Route::get('verifypatient/getverificationinfo/{id}', [App\Http\Controllers\PatientApprovalController::class, 'getVerificationInfo']);
Route::post('verifypatient/approve/{id}', [App\Http\Controllers\PatientApprovalController::class, 'approve']);
Route::post('verifypatient/reject/{id}', [App\Http\Controllers\PatientApprovalController::class, 'reject']);
//Appointment Approval
Route::get('admin-appointment-approval',[App\Http\Controllers\AppointmentApprovalController::class, 'AppointmentApprovalView'])->middleware('Islogged');
Route::get('appointment-approval-data',[App\Http\Controllers\AppointmentApprovalController::class, 'AppointmentApproval'])->middleware('Islogged');
Route::get('appointment-approved-data',[App\Http\Controllers\AppointmentApprovalController::class, 'AppointmentApproved'])->middleware('Islogged');
Route::get('/verifyappointment/getappointmentinfo/{id}/{patient_id}', [App\Http\Controllers\AppointmentApprovalController::class, 'getVerificationInfo']);
Route::post('/verifyappointmentapproval/approve/{id}/{patient_id}', [App\Http\Controllers\AppointmentApprovalController::class, 'approve']);
Route::post('/verifyappointmentapproval/reject/{id}/{patient_id}', [App\Http\Controllers\AppointmentApprovalController::class, 'reject']);
//Appointment List
Route::get('admin-appointment-list',[App\Http\Controllers\AppointmentListController::class, 'AppointmentListView'])->middleware('Islogged');
Route::get('appointment-list-data',[App\Http\Controllers\AppointmentListController::class, 'AppointmentList'])->middleware('Islogged');
Route::get('/verifyprescription/getprescriptioninfo/{id}/{patient_id}', [App\Http\Controllers\AppointmentListController::class, 'getVerificationInfo']);
Route::post('/verifyprescription/save/{id}/{patient_id}/{prescription}/{doctorname}/{branch_id}/{date}/{time}/{doctor_id}/{day}/{branchname}/{reason}', [App\Http\Controllers\AppointmentListController::class, 'SavePrescription']);
//MAINTENANCE
//Service maintenance
Route::get('maintenance-service',[App\Http\Controllers\ServiceMaintenanceController::class, 'ServiceMaintenance'])->middleware('Islogged');
Route::post('storeservice', [App\Http\Controllers\ServiceMaintenanceController::class, 'storeservice']);
Route::get('service-data',[App\Http\Controllers\ServiceMaintenanceController::class, 'ServiceData'])->middleware('Islogged');
Route::get('/service/getserviceinfo/{id}', [App\Http\Controllers\ServiceMaintenanceController::class, 'getServiceData']);
Route::post('/service/editservice/{id}/{servicename}/{originalprice}/{sellingprice}/{markup}/{branchname}', [App\Http\Controllers\ServiceMaintenanceController::class, 'updateService']);
Route::post('/service/deleteservice/{id}', [App\Http\Controllers\ServiceMaintenanceController::class, 'deleteService']);
//Schedule Maintenance
Route::get('maintenance-schedule',[App\Http\Controllers\ScheduleController::class, 'schedule'])->middleware('Islogged');
Route::post('storedoctorschedule', [App\Http\Controllers\ScheduleController::class, 'storedoctorschedule']);
Route::get('schedule-data',[App\Http\Controllers\ScheduleController::class, 'ScheduleData'])->middleware('Islogged');
Route::get('/schedule/getdoctorname/{schedulebranch}', [App\Http\Controllers\ScheduleController::class, 'getDoctorData']);
Route::get('/schedule/getdoctorinfo/{id}', [App\Http\Controllers\ScheduleController::class, 'getScheduleData']);
Route::post('/schedule/editschedule/{id}/{doctorname}/{date}/{doctor_schedule_end_time}/{doctor_schedule_start_time}/{branchname}/{status}', [App\Http\Controllers\ScheduleController::class, 'updateSchedule']);
Route::post('/schedule/deleteschedule/{id}', [App\Http\Controllers\ScheduleController::class, 'deleteSchedule']);
//Product
Route::get('maintenance-product',[App\Http\Controllers\ProductMaintenanceController::class, 'ProductMaintenance'])->middleware('Islogged');
Route::post('storeproduct', [App\Http\Controllers\ProductMaintenanceController::class, 'storeproduct']);
Route::get('product-data',[App\Http\Controllers\ProductMaintenanceController::class, 'ProductData'])->middleware('Islogged');
Route::get('/product/getproductinfo/{id}', [App\Http\Controllers\ProductMaintenanceController::class, 'getProductData']);
Route::post('/product/editproduct/', [App\Http\Controllers\ProductMaintenanceController::class, 'updateProduct']);
Route::post('/product/deleteproduct/{id}', [App\Http\Controllers\ProductMaintenanceController::class, 'deleteProduct']);
//Product Category
Route::get('maintenance-categoryproduct',[App\Http\Controllers\CategoryMaintenanceController::class, 'CategoryProductMaintenance'])->middleware('Islogged');
Route::post('storecategoryproduct', [App\Http\Controllers\CategoryMaintenanceController::class, 'storecategoryproduct']);
Route::get('categoryproduct-data',[App\Http\Controllers\CategoryMaintenanceController::class, 'CategoryProductData'])->middleware('Islogged');
Route::get('/categoryproduct/getcategoryproductinfo/{id}', [App\Http\Controllers\CategoryMaintenanceController::class, 'getCategoryProductData']);
Route::post('/categoryproduct/editcategoryproduct/{id}/{categoryproduct}', [App\Http\Controllers\CategoryMaintenanceController::class, 'updateCategoryProduct']);
Route::post('/categoryproduct/deletecategoryproduct/{id}', [App\Http\Controllers\CategoryMaintenanceController::class, 'deleteCategoryProduct']);
//Discount maintenance
Route::get('maintenance-discount',[App\Http\Controllers\DiscountMaintenanceController::class, 'DiscountMaintenance'])->middleware('Islogged');
Route::resource('discount',App\Http\Controllers\DiscountMaintenanceController::class);
Route::get('/read-discount',[App\Http\Controllers\DiscountMaintenanceController::class, 'readDiscount']);

//REPORTS
//Appointment Reports
Route::get('appointment-reports',[App\Http\Controllers\AppointmentReportController::class, 'AppointmentReportView'])->middleware('Islogged');
Route::get('appointment-report/print/{date_from}/{date_to}/{appointmentreportbranch}/{appointmentreportdoctorname}', [App\Http\Controllers\AppointmentReportController::class, 'previewAppointmentReport'])->middleware('Islogged');
Route::get('appointment-report-data',[App\Http\Controllers\AppointmentReportController::class, 'AppointmentReportData'])->middleware('Islogged');
//Certification Reports
Route::get('certification-reports',[App\Http\Controllers\CertificationReportController::class, 'CertificationReportView'])->middleware('Islogged');
Route::get('certification-data',[App\Http\Controllers\CertificationReportController::class, 'CertificationReportData'])->middleware('Islogged');
Route::post('addcert/{patientid}/{branchname}/{doctorname}/{impressions}/{diagnosis}/{remarks}', [App\Http\Controllers\CertificationReportController::class, 'AddCert'])->middleware('Islogged');
Route::get('certification-report/print/{id}/{patient_id}/{doctor_id}/{branch_id}', [App\Http\Controllers\CertificationReportController::class, 'previewCertificationReport'])->middleware('Islogged');
//Sales Reports 
Route::get('sales-reports',[App\Http\Controllers\SalesReportController::class, 'SalesReportView'])->middleware('Islogged');
Route::get('sales-report-data',[App\Http\Controllers\SalesReportController::class, 'SalesReportData'])->middleware('Islogged');
Route::get('sales-report/print/{date_from}/{date_to}/{salesreportbranch}', [App\Http\Controllers\SalesReportController::class, 'previewSalesReport'])->middleware('Islogged');
Route::get('/compute-total-sales', [App\Http\Controllers\SalesReportController::class, 'computeSales']);
//Services Reports
Route::get('services-reports',[App\Http\Controllers\ServicesReportController::class, 'ServicesReportView'])->middleware('Islogged');
Route::get('services-report-data',[App\Http\Controllers\ServicesReportController::class, 'ServicesReportData'])->middleware('Islogged');
Route::get('services-report/print/{date_from}/{date_to}/{servicessreportbranch}', [App\Http\Controllers\ServicesReportController::class, 'previewServicesReport'])->middleware('Islogged');
Route::get('/compute-total-services', [App\Http\Controllers\ServicesReportController::class, 'computeServices']);
//UTILITIES
//User Maintenance
Route::get('user-maintenance',[App\Http\Controllers\UserMaintenanceController::class, 'usermaintenance'])->middleware('Islogged');
Route::get('user-maintenance/admin',[App\Http\Controllers\UserMaintenanceController::class, 'usermaintenance'])->middleware('Islogged');
Route::get('user-maintenance/doctor',[App\Http\Controllers\UserMaintenanceController::class, 'usermaintenance_doctor'])->middleware('Islogged');
Route::get('user-maintenance/secretary',[App\Http\Controllers\UserMaintenanceController::class, 'usermaintenance_secretary'])->middleware('Islogged');
Route::get('user-maintenance/staff',[App\Http\Controllers\UserMaintenanceController::class, 'usermaintenance_staff'])->middleware('Islogged');
Route::get('user-maintenance-details/{id}',[App\Http\Controllers\UserMaintenanceController::class, 'getUserDetails'])->middleware('Islogged');
Route::post('usermaintenance/edituser/{id}/{user_type}/{name}/{email}/{contact_no}/{address}/{username}/{password}/{age}/{birthdate}/{gender}/{civilstatus}/{branch}/{specialization}', [App\Http\Controllers\UserMaintenanceController::class, 'updateUser'])->middleware('Islogged');
Route::post('usermaintenance/edituserwithoutpassword/{id}/{user_type}/{name}/{email}/{contact_no}/{address}/{username}/{age}/{birthdate}/{gender}/{civilstatus}/{branch}/{specialization}', [App\Http\Controllers\UserMaintenanceController::class, 'updateUserWithoutPassword'])->middleware('Islogged');
Route::post('usermaintenance/archiveuser/{id}', [App\Http\Controllers\UserMaintenanceController::class, 'ArchiveUser']);
// Route::post('usermaintenance/adduser/{user_type}/{name}/{email}/{contact_no}/{address}/{username}/{password}/{age}/{birthdate}/{gender}/{civilstatus}/{branch}/{specialization}', [App\Http\Controllers\UserMaintenanceController::class, 'AddUser'])->middleware('Islogged');
Route::post('AddUser', [App\Http\Controllers\UserMaintenanceController::class, 'AddUser']);
//Branch maintenance
Route::get('maintenance-branch',[App\Http\Controllers\BranchMaintenanceController::class, 'BranchMaintenance'])->middleware('Islogged');
Route::post('storebranch', [App\Http\Controllers\BranchMaintenanceController::class, 'storebranch']);
Route::get('branch-data',[App\Http\Controllers\BranchMaintenanceController::class, 'BranchData'])->middleware('Islogged');
Route::get('/branch/getbranchinfo/{id}', [App\Http\Controllers\BranchMaintenanceController::class, 'getBranchData']);
Route::post('/branch/editbranch/{id}/{branchname}/{address}', [App\Http\Controllers\BranchMaintenanceController::class, 'updateBranch']);
Route::post('/branch/deletebranch/{id}', [App\Http\Controllers\BranchMaintenanceController::class, 'deleteBranch']);
//Audit Trail
Route::get('audit-trail',[App\Http\Controllers\AuditTrailController::class, 'audit_trail'])->middleware('Islogged');
//Backup and Restore
Route::get('backup-and-restore',[App\Http\Controllers\BackupAndRestoreController::class, 'backupandrestore'])->middleware('Islogged');
Route::get('download',[App\Http\Controllers\BackupAndRestoreController::class, 'download'])->middleware('Islogged');
//ARCHIVE
//Archive Patient
Route::get('archive',[App\Http\Controllers\ArchiveController::class, 'archivepatient'])->middleware('Islogged');
Route::post('archivepatient/retrieve/{id}',[App\Http\Controllers\ArchiveController::class, 'archivepatient_retrieve'])->middleware('Islogged');
//Archive Product
Route::get('productarchive',[App\Http\Controllers\ArchiveController::class, 'archiveproduct'])->middleware('Islogged');
Route::post('archiveproduct/retrieve/{id}',[App\Http\Controllers\ArchiveController::class, 'archiveproduct_retrieve'])->middleware('Islogged');
//Archive Service
Route::get('servicearchive',[App\Http\Controllers\ArchiveController::class, 'archiveservice'])->middleware('Islogged');
Route::post('archiveservice/retrieve/{id}',[App\Http\Controllers\ArchiveController::class, 'archiveservice_retrieve'])->middleware('Islogged');
//Archive Doctor
Route::get('doctorarchive',[App\Http\Controllers\ArchiveController::class, 'archivedoctor'])->middleware('Islogged');
Route::post('archivedoctor/retrieve/{id}',[App\Http\Controllers\ArchiveController::class, 'archivedoctor_retrieve'])->middleware('Islogged');
//Archive Secretary
Route::get('secretaryarchive',[App\Http\Controllers\ArchiveController::class, 'archivesecretary'])->middleware('Islogged');
Route::post('archivesecretary/retrieve/{id}',[App\Http\Controllers\ArchiveController::class, 'archivesecretary_retrieve'])->middleware('Islogged');
//Archive Staff
Route::get('staffarchive',[App\Http\Controllers\ArchiveController::class, 'archivestaff'])->middleware('Islogged');
Route::post('archivestaff/retrieve/{id}',[App\Http\Controllers\ArchiveController::class, 'archivestaff_retrieve'])->middleware('Islogged');
//BILLING
Route::get('billing', [App\Http\Controllers\BillingController::class, 'billing'])->middleware('Islogged');
Route::post('/record-sale', [App\Http\Controllers\BillingController::class, 'recordSale']);
Route::post('add-to-tray', [App\Http\Controllers\BillingController::class, 'addToTray']);
Route::get('/read-tray', [App\Http\Controllers\BillingController::class, 'readTray']);
Route::get('cashiering/read-one-qty/{product_code}', [App\Http\Controllers\BillingController::class, 'readOneQty']);
Route::post('void/{id}', [App\Http\Controllers\BillingController::class, 'void']);
Route::get('preview-invoice/{wholesale_discount_amount}/{senior_pwd_discount_amount}/{billingbranch}/{patientname}', [App\Http\Controllers\BillingController::class, 'previewInvoice']);
Route::get('getusername/{id}', [App\Http\Controllers\BillingController::class, 'getUsernameData']);

//Inventory
Route::get('inventory',[App\Http\Controllers\InventoryController::class, 'Inventory'])->middleware('Islogged');
Route::get('inventory-data',[App\Http\Controllers\InventoryController::class, 'InventoryDisplay'])->middleware('Islogged');
Route::get('reorder-data',[App\Http\Controllers\InventoryController::class, 'ReorderDisplay'])->middleware('Islogged');
Route::get('/inventory/getproductinfo/{id}', [App\Http\Controllers\InventoryController::class, 'getInventoryData']);
Route::post('/inventory/addquantity/', [App\Http\Controllers\InventoryController::class, 'updateQuantityProduct']);

//DOCTOR INTERFACE
Route::get('doctor-dashboard', [App\Http\Controllers\LoginController::class, 'doctor'])->middleware('Islogged');
//doctor Patient Information
Route::get('doctor-patient-information',[App\Http\Controllers\PatientInformationController::class, 'DoctorPatientInformationView'])->middleware('Islogged');
//doctor Patient Approval
Route::get('doctor-patient-approval',[App\Http\Controllers\PatientApprovalController::class, 'DoctorPatientApprovalView'])->middleware('Islogged');
//doctor Patient History
Route::get('doctor-patient-history',[App\Http\Controllers\DoctorPatientHistoryController::class, 'HistoryView'])->middleware('Islogged');
Route::get('doctorpatienthistory-data',[App\Http\Controllers\DoctorPatientHistoryController::class, 'PatientHistoryData'])->middleware('Islogged');
Route::get('/doctorpatienthistory/getpatienthistoryinfo/{invoice_no}', [App\Http\Controllers\DoctorPatientHistoryController::class, 'getPatientHistoryData']);
Route::get('doctorpatienthistory/preview-invoice/{wholesale_discount_amount}/{senior_pwd_discount_amount}/{billingbranch}/{patientname}/{invoice_no}', [App\Http\Controllers\DoctorPatientHistoryController::class, 'patienthistorypreviewInvoice']);
//doctor PATIENT PRESCRIPTION
Route::get('doctor-patient-prescription', [App\Http\Controllers\PatientPrescriptionController::class, 'doctorPrescriptionView'])->middleware('Islogged');
Route::get('doctorpatientprescription-data',[App\Http\Controllers\PatientPrescriptionController::class, 'doctorPatientPrescriptionData'])->middleware('Islogged');
Route::get('/doctorpatientprescription/getpatientprescriptioninfo/{id}', [App\Http\Controllers\PatientPrescriptionController::class, 'doctorgetPatientPrescriptionData']);
Route::get('doctorpatientprescription/preview-prescription/{doctorname}/{branchname}/{date}/{time}/{patient_id}/{prescription}', [App\Http\Controllers\PatientPrescriptionController::class, 'doctorpatientprescriptionpreview']);
//doctor Appointment Approval
Route::get('doctor-appointment-approval',[App\Http\Controllers\AppointmentApprovalController::class, 'DoctorAppointmentApprovalView'])->middleware('Islogged');
//doctor Appointment List
Route::get('doctor-appointment-list',[App\Http\Controllers\AppointmentListController::class, 'DoctorAppointmentListView'])->middleware('Islogged');
//doctor BILLING
Route::get('doctor-billing', [App\Http\Controllers\BillingController::class, 'doctorbilling'])->middleware('Islogged');
//doctor Inventory
Route::get('doctor-inventory',[App\Http\Controllers\InventoryController::class, 'DoctorInventory'])->middleware('Islogged');
//doctor Sales Reports 
Route::get('doctor-sales-reports',[App\Http\Controllers\SalesReportController::class, 'DoctorSalesReportView'])->middleware('Islogged');
//doctor Services Reports
Route::get('doctor-services-reports',[App\Http\Controllers\ServicesReportController::class, 'DoctorServicesReportView'])->middleware('Islogged');
//doctor Appointment Reports
Route::get('doctor-appointment-reports',[App\Http\Controllers\AppointmentReportController::class, 'DoctorAppointmentReportView'])->middleware('Islogged');
//doctor Certification Reports
Route::get('doctor-certification-reports',[App\Http\Controllers\CertificationReportController::class, 'DoctorCertificationReportView'])->middleware('Islogged');
//doctor Service maintenance
Route::get('doctor-maintenance-service',[App\Http\Controllers\ServiceMaintenanceController::class, 'DoctorServiceMaintenance'])->middleware('Islogged');
Route::get('doctor-service-data',[App\Http\Controllers\ServiceMaintenanceController::class, 'DoctorServiceData'])->middleware('Islogged');
//doctor Product maintenance
Route::get('doctor-maintenance-product',[App\Http\Controllers\ProductMaintenanceController::class, 'DoctorProductMaintenance'])->middleware('Islogged');
Route::get('doctor-product-data',[App\Http\Controllers\ProductMaintenanceController::class, 'DoctorProductData'])->middleware('Islogged');
//doctor Schedule Maintenance
Route::get('doctor-maintenance-schedule',[App\Http\Controllers\ScheduleController::class, 'Doctorschedule'])->middleware('Islogged');
Route::get('doctor-schedule-data',[App\Http\Controllers\ScheduleController::class, 'DoctorScheduleData'])->middleware('Islogged');


//STAFF INTERFACE
Route::get('staff-dashboard', [App\Http\Controllers\LoginController::class, 'staff'])->middleware('Islogged');
//staff Patient Information
Route::get('staff-patient-information',[App\Http\Controllers\PatientInformationController::class, 'StaffPatientInformationView'])->middleware('Islogged');
//staff Patient Approval
// Route::get('staff-patient-approval',[App\Http\Controllers\PatientApprovalController::class, 'StaffPatientApprovalView'])->middleware('Islogged');
//staff Patient History
Route::get('staff-patient-history',[App\Http\Controllers\StaffPatientHistoryController::class, 'HistoryView'])->middleware('Islogged');
Route::get('staffpatienthistory-data',[App\Http\Controllers\StaffPatientHistoryController::class, 'PatientHistoryData'])->middleware('Islogged');
Route::get('/staffpatienthistory/getpatienthistoryinfo/{invoice_no}', [App\Http\Controllers\StaffPatientHistoryController::class, 'getPatientHistoryData']);
Route::get('staffpatienthistory/preview-invoice/{wholesale_discount_amount}/{senior_pwd_discount_amount}/{billingbranch}/{patientname}/{invoice_no}', [App\Http\Controllers\StaffPatientHistoryController::class, 'patienthistorypreviewInvoice']);
//staff PATIENT PRESCRIPTION
Route::get('staff-patient-prescription', [App\Http\Controllers\PatientPrescriptionController::class, 'staffPrescriptionView'])->middleware('Islogged');
Route::get('staffpatientprescription-data',[App\Http\Controllers\PatientPrescriptionController::class, 'staffPatientPrescriptionData'])->middleware('Islogged');
Route::get('/staffpatientprescription/getpatientprescriptioninfo/{id}', [App\Http\Controllers\PatientPrescriptionController::class, 'staffgetPatientPrescriptionData']);
Route::get('staffpatientprescription/preview-prescription/{doctorname}/{branchname}/{date}/{time}/{patient_id}/{prescription}', [App\Http\Controllers\PatientPrescriptionController::class, 'staffpatientprescriptionpreview']);
//staff Appointment Approval
Route::get('staff-appointment-approval',[App\Http\Controllers\AppointmentApprovalController::class, 'StaffAppointmentApprovalView'])->middleware('Islogged');
//staff Appointment List
Route::get('staff-appointment-list',[App\Http\Controllers\AppointmentListController::class, 'StaffAppointmentListView'])->middleware('Islogged');
//doctor Sales Reports 
Route::get('staff-sales-reports',[App\Http\Controllers\SalesReportController::class, 'StaffSalesReportView'])->middleware('Islogged');
//doctor Services Reports
Route::get('staff-services-reports',[App\Http\Controllers\ServicesReportController::class, 'StaffServicesReportView'])->middleware('Islogged');
//doctor Appointment Reports
Route::get('staff-appointment-reports',[App\Http\Controllers\AppointmentReportController::class, 'StaffAppointmentReportView'])->middleware('Islogged');
//doctor Certification Reports
Route::get('staff-certification-reports',[App\Http\Controllers\CertificationReportController::class, 'StaffCertificationReportView'])->middleware('Islogged');

//SECRETARY INTERFACE
Route::get('secretary-dashboard', [App\Http\Controllers\LoginController::class, 'secretary'])->middleware('Islogged');
//secretary Patient Information
Route::get('secretary-patient-information',[App\Http\Controllers\PatientInformationController::class, 'SecretaryPatientInformationView'])->middleware('Islogged');
Route::get('addpatient',[App\Http\Controllers\RegisterController::class, 'addpatient'])->middleware('Islogged');
Route::post('registerpatient',[App\Http\Controllers\RegisterController::class, 'registerpatient'])->middleware('Islogged');
//secretary Patient Approval
Route::get('secretary-patient-approval',[App\Http\Controllers\PatientApprovalController::class, 'SecretaryPatientApprovalView'])->middleware('Islogged');
//secretary Patient History
Route::get('secretary-patient-history',[App\Http\Controllers\SecretaryPatientHistoryController::class, 'HistoryView'])->middleware('Islogged');
Route::get('secretarypatienthistory-data',[App\Http\Controllers\SecretaryPatientHistoryController::class, 'PatientHistoryData'])->middleware('Islogged');
Route::get('/secretarypatienthistory/getpatienthistoryinfo/{invoice_no}', [App\Http\Controllers\SecretaryPatientHistoryController::class, 'getPatientHistoryData']);
Route::get('secretarypatienthistory/preview-invoice/{wholesale_discount_amount}/{senior_pwd_discount_amount}/{billingbranch}/{patientname}/{invoice_no}', [App\Http\Controllers\SecretaryPatientHistoryController::class, 'patienthistorypreviewInvoice']);
//secretary PATIENT PRESCRIPTION
Route::get('secretary-patient-prescription', [App\Http\Controllers\PatientPrescriptionController::class, 'secretaryPrescriptionView'])->middleware('Islogged');
Route::get('secretarypatientprescription-data',[App\Http\Controllers\PatientPrescriptionController::class, 'secretaryPatientPrescriptionData'])->middleware('Islogged');
Route::get('/secretarypatientprescription/getpatientprescriptioninfo/{id}', [App\Http\Controllers\PatientPrescriptionController::class, 'secretarygetPatientPrescriptionData']);
Route::get('secretarypatientprescription/preview-prescription/{doctorname}/{branchname}/{date}/{time}/{patient_id}/{prescription}', [App\Http\Controllers\PatientPrescriptionController::class, 'secretarypatientprescriptionpreview']);
//secretary Appointment Approval
Route::get('secretary-appointment-approval',[App\Http\Controllers\AppointmentApprovalController::class, 'SecretaryAppointmentApprovalView'])->middleware('Islogged');
//secretary Appointment List
Route::get('secretary-appointment-list',[App\Http\Controllers\AppointmentListController::class, 'SecretaryAppointmentListView'])->middleware('Islogged');
//secretary BILLING
Route::get('secretary-billing', [App\Http\Controllers\BillingController::class, 'secretarybilling'])->middleware('Islogged');
//secretary Inventory
Route::get('secretary-inventory',[App\Http\Controllers\InventoryController::class, 'SecretaryInventory'])->middleware('Islogged');
//secretary Sales Reports 
Route::get('secretary-sales-reports',[App\Http\Controllers\SalesReportController::class, 'SecretarySalesReportView'])->middleware('Islogged');
//doctor Services Reports
Route::get('secretary-services-reports',[App\Http\Controllers\ServicesReportController::class, 'SecretaryServicesReportView'])->middleware('Islogged');
//secretary Appointment Reports
Route::get('secretary-appointment-reports',[App\Http\Controllers\AppointmentReportController::class, 'SecretaryAppointmentReportView'])->middleware('Islogged');
//secretary Certification Reports
Route::get('secretary-certification-reports',[App\Http\Controllers\CertificationReportController::class, 'SecretaryCertificationReportView'])->middleware('Islogged');
//secretary Service maintenance
Route::get('secretary-maintenance-service',[App\Http\Controllers\ServiceMaintenanceController::class, 'SecretaryServiceMaintenance'])->middleware('Islogged');
Route::get('secretary-service-data',[App\Http\Controllers\ServiceMaintenanceController::class, 'SecretaryServiceData'])->middleware('Islogged');
//secretary Product maintenance
Route::get('secretary-maintenance-product',[App\Http\Controllers\ProductMaintenanceController::class, 'SecretaryProductMaintenance'])->middleware('Islogged');
Route::get('secretary-product-data',[App\Http\Controllers\ProductMaintenanceController::class, 'SecretaryProductData'])->middleware('Islogged');
//secretary Schedule Maintenance
Route::get('secretary-maintenance-schedule',[App\Http\Controllers\ScheduleController::class, 'Secretaryschedule'])->middleware('Islogged');
Route::get('secretary-schedule-data',[App\Http\Controllers\ScheduleController::class, 'SecretaryScheduleData'])->middleware('Islogged');
Route::get('staff-patient-information',[App\Http\Controllers\PatientInformationController::class, 'StaffPatientInformationView'])->middleware('Islogged');

//PATIENT INTERFACE
Route::get('patient-dashboard', [App\Http\Controllers\LoginController::class, 'patient'])->middleware('Islogged');
Route::get('editprofile',[App\Http\Controllers\RegisterController::class, 'editprofile'])->middleware('Islogged');
Route::post('saveeditprofile',[App\Http\Controllers\RegisterController::class, 'saveeditprofile'])->middleware('Islogged');
//PATIENT PRESCRIPTION
Route::get('patient-prescription', [App\Http\Controllers\PatientPrescriptionController::class, 'PrescriptionView'])->middleware('Islogged');
Route::get('patientprescription-data',[App\Http\Controllers\PatientPrescriptionController::class, 'PatientPrescriptionData'])->middleware('Islogged');
Route::get('/patientprescription/getpatientprescriptioninfo/{id}', [App\Http\Controllers\PatientPrescriptionController::class, 'getPatientPrescriptionData']);
Route::get('patientprescription/preview-prescription/{doctorname}/{branchname}/{date}/{time}/{patient_id}/{prescription}', [App\Http\Controllers\PatientPrescriptionController::class, 'patientprescriptionpreview']);
//PATIENT HISTORY
Route::get('patient-history', [App\Http\Controllers\PatientHistoryController::class, 'HistoryView'])->middleware('Islogged');
Route::get('patienthistory-data',[App\Http\Controllers\PatientHistoryController::class, 'PatientHistoryData'])->middleware('Islogged');
Route::get('/patienthistory/getpatienthistoryinfo/{invoice_no}', [App\Http\Controllers\PatientHistoryController::class, 'getPatientHistoryData']);
Route::get('patienthistory/preview-invoice/{wholesale_discount_amount}/{senior_pwd_discount_amount}/{billingbranch}/{patientname}/{invoice_no}', [App\Http\Controllers\PatientHistoryController::class, 'patienthistorypreviewInvoice']);
//PATIENT CERTIFICATION
Route::get('patient-certification', [App\Http\Controllers\PatientCertificationController::class, 'CertificationView'])->middleware('Islogged');
Route::get('patientcertification-data',[App\Http\Controllers\PatientCertificationController::class, 'PatientCertificationData'])->middleware('Islogged');
Route::get('/patientcertification/getpatientcertificationinfo/{id}', [App\Http\Controllers\PatientCertificationController::class, 'getPatientCertificationData']);
Route::get('previewcertification/print/{id}/{patient_id}/{doctor_id}/{branch_id}', [App\Http\Controllers\PatientCertificationController::class, 'patientcertificationpreview']);
//PATIENT BOOK APPOINTMENT
Route::get('patient-book-appointment', [App\Http\Controllers\BookAppointmentController::class, 'BookAppointmentView'])->middleware('Islogged');
Route::get('bookappointment-data',[App\Http\Controllers\BookAppointmentController::class, 'BookAppointmentData'])->middleware('Islogged');
Route::get('/appointment/getappointmentinfo/{id}/{patient_id}', [App\Http\Controllers\BookAppointmentController::class, 'getBookAppointmentData']);
Route::post('/appointment/makeappointment/', [App\Http\Controllers\BookAppointmentController::class, 'makeAppointment']);
//PATIENT MY APPOINTMENT
Route::get('patient-my-appointment', [App\Http\Controllers\MyAppointmentListController::class, 'MyAppointmentListView'])->middleware('Islogged');
Route::get('myappointment-data',[App\Http\Controllers\MyAppointmentListController::class, 'MyAppointmentListData'])->middleware('Islogged');
Route::get('myappointmentcomplete-data',[App\Http\Controllers\MyAppointmentListController::class, 'MyAppointmentCompleteListData'])->middleware('Islogged');
Route::get('/myappointment/getappointmentinfo/{id}/{patient_id}', [App\Http\Controllers\MyAppointmentListController::class, 'getMyAppointmentData']);
Route::get('/myappointment/getappointmentinfopending/{id}/{patient_id}', [App\Http\Controllers\MyAppointmentListController::class, 'getMyAppointmentPendingData']);
Route::post('/myappointment/cancelappointment/{id}', [App\Http\Controllers\MyAppointmentListController::class, 'CancelMyAppointment']);