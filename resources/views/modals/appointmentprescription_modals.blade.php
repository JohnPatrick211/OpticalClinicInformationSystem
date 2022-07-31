
<div class="modal fade" id="AppointmentPrescriptionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Patient Appointment</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="row">


                  <input type="hidden" id="appointmentprescriptioncust-id-hidden">
                  <input type="hidden" id="appointmentprescriptioncust-patient-id-hidden">
                  <input type="hidden" id="appointmentprescriptioncust-doctor-id-hidden">
                  <input type="hidden" id="appointmentprescriptioncust-branch-id-hidden">
                  <div class="col-md-12">
                  <h4 class="text-left">Patient Details</h4>
                  <hr/>
                  </div>

                <div class="col-md-4">
                    <label class="col-form-label">Patient Name</label>
                    <input type="text" class="form-control" name="appointmentprescriptionpatientname" id="appointmentprescriptionpatientname"  readonly>
                  </div>

                  <div class="col-md-4">
                    <label class="col-form-label">Email Address</label>
                    <input type="text" class="form-control" name="appointmentprescriptionemail" id="appointmentprescriptionemail"  readonly>
                  </div>

                  <div class="col-md-4">    
                    <label class="col-form-label">Contact No.</label>
                    <input type="text" class="form-control" name="appointmentprescriptioncontactno" id="appointmentprescriptioncontactno"  readonly>
                  </div>

                  <div class="col-md-3">    
                    <label class="col-form-label">Age</label>
                    <input type="text" class="form-control" name="appointmentprescriptionage" id="appointmentprescriptionage"  readonly>
                  </div>

                  <div class="col-md-3">    
                    <label class="col-form-label">Gender</label>
                    <input type="text" class="form-control" name="appointmentprescriptiongender" id="appointmentprescriptiongender"  readonly>
                  </div>

                  <div class="col-md-3">    
                    <label class="col-form-label">Civil Status</label>
                    <input type="text" class="form-control" name="appointmentprescriptioncivilstatus" id="appointmentprescriptioncivilstatus"  readonly>
                  </div>

                  <div class="col-md-3">    
                    <label class="col-form-label">Birth Date</label>
                    <input type="text" class="form-control" name="appointmentprescriptionbirthdate" id="appointmentprescriptionbirthdate"  readonly>
                  </div>

                  <div class="col-md-12">
                  <label class="col-form-label">Reason For Appointment</label>
                  <textarea name="appointmentprescriptionreasonforappointment" id="appointmentprescriptionreasonforappointment" class="form-control" required rows="2" readonly></textarea>
                  </div>

                 <br/><br/><br/><br/><br/>

                  <div class="col-md-12">
                  <h4 class="text-left">Patient Prescription</h4>
                  </div>
                  <div class="col-md-12">
                  <textarea name="appointmentprescriptiontext" id="appointmentprescriptiontext" class="form-control" required rows="5"></textarea>
                  </div>
                  <!-- hidden doctor schedule -->
                    <input type="hidden" class="form-control" name="appointmentprescriptiondoctorname" id="appointmentprescriptiondoctorname"  readonly>
                    <input type="hidden" class="form-control" name="appointmentprescriptionbranch" id="appointmentprescriptionbranch"  readonly>
                    <input type="hidden" class="form-control" name="appointmentprescriptiondate" id="appointmentprescriptiondate"  readonly>
                    <input type="hidden" class="form-control" name="appointmentprescriptionday" id="appointmentprescriptionday"  readonly>
                    <input type="hidden" class="form-control" name="appointmentprescriptiontime" id="appointmentprescriptiontime"  readonly>

                  
                  
          </div>
          <br><br>
          <div class="modal-footer">
            <div class="update-success-validation mr-auto ml-3" style="display: none">
             <label class="label text-success">Appointment is Successfully Complete</label>
            </div>
                <div class="reject-validation mr-auto ml-3" style="display: none">
                 <label class="label text-success">Appointment is Successfully Rejected</label>
                </div>
          <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
            <button id="btn-appointmentprescriptionsave" class="btn btn-sm btn-success">Save</button>
          </div>
        </form>
        </div>
      </div>
  </div>
</div>

     <!--Save Modal-->
     <div class="modal fade" id="confirmationappointmentprescriptionModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to complete this Appointment?</p>
          </div>
          <input type="hidden" id="id_approve" name="id_approve">
          <div class="modal-footer">
            <div class="dupdate-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">User is Successfully Archived</label>
               </div>
                   <div class="dreject-validation mr-auto ml-3" style="display: none">
                    <label class="label text-success">Employer Job is Successfully Rejected</label>
                   </div>
                   <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
            <button class="btn btn-sm btn-outline-dark"  id="btn_confirmappointmentprescription">Yes</button>
            <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>
          </form>
          </div>
        </div>
      </div>
    </div>
