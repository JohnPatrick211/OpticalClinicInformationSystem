 <!--Confirm Modal-->
 <div class="modal fade" id="cancelconfirmModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <input type="hidden" id="cancelcust-id-hidden">
        <input type="hidden" id="cancelcust-patient-id-hidden">
        <input type="hidden" id="cancelcust-doctor-id-hidden">
            <label class="col-form-label">Are you sure you want to cancel your appointment?</label>
          <p class="delete-message"></p>
        </div>
        <div class="delete-success" style="display: none;">
          <span style="margin-left:180px;" class="text-success">Canceled Successfully!</span>
          </div>
          <div class="existcategoryproduct-success" style="display: none;">
          <span style="margin-left:30px;" class="text-danger">Can't Cancel Because You're Appointment Already Approved</span>
          </div>
        <div class="modal-footer">
          <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
          <button class="btn btn-sm btn-outline-dark" type="button" name="ok_button" id="btn_cancel_appointment">Yes</button>
        <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>

        </div>
      </div>
    </div>
  </div>



<div class="modal fade" id="ViewAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Your Appointment</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="row">


                  <input type="hidden" id="viewcust-id-hidden">
                  <input type="hidden" id="viewcust-patient-id-hidden">
                  <input type="hidden" id="viewcust-doctor-id-hidden">
                  <div class="col-md-12">
                  <h4 class="text-left">Patient Details</h4>
                  <hr/>
                  </div>

                <div class="col-md-4">
                    <label class="col-form-label">Patient Name</label>
                    <input type="text" class="form-control" name="viewpatientname" id="viewpatientname"  readonly>
                  </div>

                  <div class="col-md-4">
                    <label class="col-form-label">Email Address</label>
                    <input type="text" class="form-control" name="viewemail" id="viewemail"  readonly>
                  </div>

                  <div class="col-md-4">    
                    <label class="col-form-label">Contact No.</label>
                    <input type="text" class="form-control" name=viewcontactno" id="viewcontactno"  readonly>
                  </div>

                  <div class="col-md-3">    
                    <label class="col-form-label">Age</label>
                    <input type="text" class="form-control" name="viewage" id="viewage"  readonly>
                  </div>

                  <div class="col-md-3">    
                    <label class="col-form-label">Gender</label>
                    <input type="text" class="form-control" name="viewgender" id="viewgender"  readonly>
                  </div>

                  <div class="col-md-3">    
                    <label class="col-form-label">Civil Status</label>
                    <input type="text" class="form-control" name="viewcivilstatus" id="viewcivilstatus"  readonly>
                  </div>

                  <div class="col-md-3">    
                    <label class="col-form-label">Birth Date</label>
                    <input type="text" class="form-control" name="viewbirthdate" id="viewbirthdate"  readonly>
                  </div>

                 <br/><br/><br/><br/>

                  <div class="col-md-12">
                  <h4 class="text-left">Appointment Details</h4>
                  <hr/>
                  </div>

                  <div class="col-md-6">
                    <label class="col-form-label">Doctor Name</label>
                    <input type="text" class="form-control" name="viewdoctorname" id="viewdoctorname"  readonly>
                  </div>

                  <div class="col-md-6">
                    <label class="col-form-label">Specialization</label>
                    <input type="text" class="form-control" name="viewspecialization" id="viewspecialization"  readonly>
                  </div>

                  <div class="col-md-6">
                    <label class="col-form-label">Branch</label>
                    <input type="text" class="form-control" name="viewbranch" id="viewbranch"  readonly>
                  </div>

                  <div class="col-md-6">
                    <label class="col-form-label">Appointment Date</label>
                    <input type="text" class="form-control" name="viewappointmentdate" id="viewappointmentdate"  readonly>
                  </div>

                  <div class="col-md-6">
                    <label class="col-form-label">Appointment Day</label>
                    <input type="text" class="form-control" name="viewappointmentday" id="viewappointmentday"  readonly>
                  </div>

                  <div class="col-md-6">
                    <label class="col-form-label">Appointment Time</label>
                    <input type="text" class="form-control" name="viewappointmenttime" id="viewappointmenttime"  readonly>
                  </div>

                  <div class="col-md-12">
                  <label class="col-form-label">Reason For Appointment</label>
                  <textarea name="viewreasonforappointment" id="viewreasonforappointment" class="form-control" required rows="2" readonly></textarea>
                  </div>
                  
          </div>
          <br><br>
          <div class="modal-footer">
          </div>
        </form>
        </div>
      </div>
  </div>
</div>


<div class="modal fade" id="MakeAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Make Appointment</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="row">


                  <input type="hidden" id="cust-id-hidden">
                  <input type="hidden" id="cust-patient-id-hidden">
                  <input type="hidden" id="cust-doctor-id-hidden">
                  <div class="col-md-12">
                  <h4 class="text-left">Patient Details</h4>
                  <hr/>
                  </div>

                <div class="col-md-4">
                    <label class="col-form-label">Patient Name</label>
                    <input type="text" class="form-control" name="bookpatientname" id="bookpatientname"  readonly>
                  </div>

                  <div class="col-md-4">
                    <label class="col-form-label">Email Address</label>
                    <input type="text" class="form-control" name="bookemail" id="bookemail"  readonly>
                  </div>

                  <div class="col-md-4">    
                    <label class="col-form-label">Contact No.</label>
                    <input type="text" class="form-control" name="bookcontactno" id="bookcontactno"  readonly>
                  </div>

                  <div class="col-md-3">    
                    <label class="col-form-label">Age</label>
                    <input type="text" class="form-control" name="bookage" id="bookage"  readonly>
                  </div>

                  <div class="col-md-3">    
                    <label class="col-form-label">Gender</label>
                    <input type="text" class="form-control" name="bookgender" id="bookgender"  readonly>
                  </div>

                  <div class="col-md-3">    
                    <label class="col-form-label">Civil Status</label>
                    <input type="text" class="form-control" name="bookcivilstatus" id="bookcivilstatus"  readonly>
                  </div>

                  <div class="col-md-3">    
                    <label class="col-form-label">Birth Date</label>
                    <input type="text" class="form-control" name="bookbirthdate" id="bookbirthdate"  readonly>
                  </div>

                 <br/><br/><br/><br/>

                  <div class="col-md-12">
                  <h4 class="text-left">Appointment Details</h4>
                  <hr/>
                  </div>

                  <div class="col-md-6">
                    <label class="col-form-label">Doctor Name</label>
                    <input type="text" class="form-control" name="bookdoctorname" id="bookdoctorname"  readonly>
                  </div>

                  <div class="col-md-6">
                    <label class="col-form-label">Specialization</label>
                    <input type="text" class="form-control" name="bookspecialization" id="bookspecialization"  readonly>
                  </div>

                  <div class="col-md-6">
                    <label class="col-form-label">Branch</label>
                    <input type="text" class="form-control" name="bookbranch" id="bookbranch"  readonly>
                  </div>

                  <div class="col-md-6">
                    <label class="col-form-label">Appointment Date</label>
                    <input type="text" class="form-control" name="bookappointmentdate" id="bookappointmentdate"  readonly>
                  </div>

                  <div class="col-md-6">
                    <label class="col-form-label">Appointment Day</label>
                    <input type="text" class="form-control" name="bookappointmentday" id="bookappointmentday"  readonly>
                  </div>

                  <div class="col-md-6">
                    <label class="col-form-label">Appointment Time</label>
                    <input type="text" class="form-control" name="bookappointmenttime" id="bookappointmenttime"  readonly>
                  </div>

                  <div class="col-md-12">
                  <label class="col-form-label">Reason For Appointment</label>
                  <textarea name="bookereasonforappointment" id="bookereasonforappointment" class="form-control" required rows="2"></textarea>
                  </div>
                  
          </div>
          <br><br>
          <div class="modal-footer">
            <div class="update-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">Approval Send Successfully</label>
               </div>
                <div class="existproduct-success" style="display: none;">
          <span style="margin-left:180px;" class="text-danger">You Already Have An Appointment In This Doctor</span>
          </div>
               <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-sm btn-primary" id="btn-add-bookappointment">Book</button>
          </div>
        </form>
        </div>
      </div>
  </div>
</div>

