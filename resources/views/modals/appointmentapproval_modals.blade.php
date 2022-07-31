
<div class="modal fade" id="ViewAppointmentApprovalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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


                  <input type="hidden" id="viewapprovalcust-id-hidden">
                  <input type="hidden" id="viewapprovalcust-patient-id-hidden">
                  <input type="hidden" id="viewapprovalcust-doctor-id-hidden">
                  <div class="col-md-12">
                  <h4 class="text-left">Patient Details</h4>
                  <hr/>
                  </div>

                <div class="col-md-4">
                    <label class="col-form-label">Patient Name</label>
                    <input type="text" class="form-control" name="viewapprovalpatientname" id="viewapprovalpatientname"  readonly>
                  </div>

                  <div class="col-md-4">
                    <label class="col-form-label">Email Address</label>
                    <input type="text" class="form-control" name="viewapprovalemail" id="viewapprovalemail"  readonly>
                  </div>

                  <div class="col-md-4">    
                    <label class="col-form-label">Contact No.</label>
                    <input type="text" class="form-control" name=viewapprovalcontactno" id="viewapprovalcontactno"  readonly>
                  </div>

                  <div class="col-md-3">    
                    <label class="col-form-label">Age</label>
                    <input type="text" class="form-control" name="viewapprovalage" id="viewapprovalage"  readonly>
                  </div>

                  <div class="col-md-3">    
                    <label class="col-form-label">Gender</label>
                    <input type="text" class="form-control" name="viewapprovalgender" id="viewapprovalgender"  readonly>
                  </div>

                  <div class="col-md-3">    
                    <label class="col-form-label">Civil Status</label>
                    <input type="text" class="form-control" name="viewapprovalcivilstatus" id="viewapprovalcivilstatus"  readonly>
                  </div>

                  <div class="col-md-3">    
                    <label class="col-form-label">Birth Date</label>
                    <input type="text" class="form-control" name="viewapprovalbirthdate" id="viewapprovalbirthdate"  readonly>
                  </div>

                 <br/><br/><br/><br/>

                  <div class="col-md-12">
                  <h4 class="text-left">Appointment Details</h4>
                  <hr/>
                  </div>

                  <div class="col-md-6">
                    <label class="col-form-label">Doctor Name</label>
                    <input type="text" class="form-control" name="viewapprovaldoctorname" id="viewapprovaldoctorname"  readonly>
                  </div>

                  <div class="col-md-6">
                    <label class="col-form-label">Specialization</label>
                    <input type="text" class="form-control" name="viewapprovalspecialization" id="viewapprovalspecialization"  readonly>
                  </div>

                  <div class="col-md-6">
                    <label class="col-form-label">Branch</label>
                    <input type="text" class="form-control" name="viewapprovalbranch" id="viewapprovalbranch"  readonly>
                  </div>

                  <div class="col-md-4">
                    <label class="col-form-label">Appointment Date</label>
                    <input type="text" class="form-control" name="viewapprovalappointmentdate" id="viewapprovalappointmentdate"  readonly>
                  </div>

                  <div class="col-md-4">
                    <label class="col-form-label">Appointment Day</label>
                    <input type="text" class="form-control" name="viewapprovalappointmentday" id="viewapprovalappointmentday"  readonly>
                  </div>

                  <div class="col-md-4">
                    <label class="col-form-label">Appointment Time</label>
                    <input type="text" class="form-control" name="viewapprovalappointmenttime" id="viewapprovalappointmenttime"  readonly>
                  </div>

                  <div class="col-md-12">
                  <label class="col-form-label">Reason For Appointment</label>
                  <textarea name="viewapprovalreasonforappointment" id="viewapprovalreasonforappointment" class="form-control" required rows="2" readonly></textarea>
                  </div>
                  
          </div>
          <br><br>
          <div class="modal-footer">
            <div class="update-success-validation mr-auto ml-3" style="display: none">
             <label class="label text-success">Appointment is Successfully Approved</label>
            </div>
                <div class="reject-validation mr-auto ml-3" style="display: none">
                 <label class="label text-success">Appointment is Successfully Rejected</label>
                </div>
          <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
            <button id="btn-appointmentapprovaldecline" class="btn btn-sm btn-danger">Reject</button>
            <button id="btn-appointmentapprovalapprove" class="btn btn-sm btn-success">Approve</button>
          </div>
        </form>
        </div>
      </div>
  </div>
</div>

     <!--Approve Modal-->
     <div class="modal fade" id="confirmationappointmentapproveModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to approve this Appointment?</p>
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
            <button class="btn btn-sm btn-outline-dark"  id="btn_confirmpappointmentapprove">Yes</button>
            <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>
          </form>
          </div>
        </div>
      </div>
    </div>
    
     <!--Reject Modal-->
    <div class="modal fade" id="confirmationappointmentrejectModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to reject this Appointment?</p>
          </div>
          <input type="hidden" id="id_reject" name="id_reject">
          <div class="modal-footer">
            <div class="dupdate-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">User is Successfully Archived</label>
               </div>
                   <div class="dreject-validation mr-auto ml-3" style="display: none">
                    <label class="label text-success">Employer Job is Successfully Rejected</label>
                   </div>
                   <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
            <button class="btn btn-sm btn-outline-dark"  id="btn_confirmappointmentreject">Yes</button>
            <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>
          </form>
          </div>
        </div>
      </div>
    </div>
