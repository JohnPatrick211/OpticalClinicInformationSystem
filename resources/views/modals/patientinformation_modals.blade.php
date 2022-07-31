
<div class="modal fade" id="ViewPatientInformationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Patient Details</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="row">


                  <div class="col-md-4">
                    <label class="col-form-label">Patient ID</label>
                    <input type="text" class="form-control" name="viewinfopatientid" id="viewinfopatientid"  readonly>
                  </div>

                <div class="col-md-8">
                    <label class="col-form-label">Patient Name</label>
                    <input type="text" class="form-control" name="viewinfopatientname" id="viewinfopatientname"  readonly>
                  </div>

                  <div class="col-md-4">
                    <label class="col-form-label">Email Address</label>
                    <input type="text" class="form-control" name="viewinfopatientemail" id="viewinfopatientemail"  readonly>
                  </div>

                  <div class="col-md-4">    
                    <label class="col-form-label">Contact No.</label>
                    <input type="text" class="form-control" name=viewinfopatientcontactno" id="viewinfopatientcontactno"  readonly>
                  </div>

                  <div class="col-md-4">    
                    <label class="col-form-label">Age</label>
                    <input type="text" class="form-control" name="viewinfopatientage" id="viewinfopatientage"  readonly>
                  </div>

                  <div class="col-md-4">    
                    <label class="col-form-label">Gender</label>
                    <input type="text" class="form-control" name="viewinfopatientgender" id="viewinfopatientgender"  readonly>
                  </div>

                  <div class="col-md-4">    
                    <label class="col-form-label">Civil Status</label>
                    <input type="text" class="form-control" name="viewinfopatientcivilstatus" id="viewinfopatientcivilstatus"  readonly>
                  </div>

                  <div class="col-md-4">    
                    <label class="col-form-label">Birth Date</label>
                    <input type="text" class="form-control" name="viewinfopatientbirthdate" id="viewinfopatientbirthdate"  readonly>
                  </div>

                  <div class="col-md-12">    
                    <label class="col-form-label">Address</label>
                    <input type="text" class="form-control" name="viewinfopatientaddress" id="viewinfopatientaddress"  readonly>
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

<div class="modal fade" id="archivePatientModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Are you sure do you want to archive this Patient?</p>
          </div>
          <input type="hidden" id="id_archive" name="id_archive">
          <div class="modal-footer">
            <div class="dupdate-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">Patient is Successfully Archived</label>
               </div>
                   <div class="dreject-validation mr-auto ml-3" style="display: none">
                    <label class="label text-success">Employer Job is Successfully Rejected</label>
                   </div>
                   <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
            <button class="btn btn-sm btn-outline-dark" type="submit" id="btn_archive_patient">Yes</button>
            <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>
          </form>
          </div>
        </div>
      </div>
    </div>


