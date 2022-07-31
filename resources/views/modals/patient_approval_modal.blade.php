<!--edit  Modal-->
@yield('patientmodal')
<div class="modal fade" id="patientapprovalModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document" :scrollable="true">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Verify Patient</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" >

          {{-- <form action="editapprove" method="POST"> --}}
            @csrf
            <div class="row">

                <input type="hidden" id="cust-id-hidden">
                <input type="hidden" id="valid-hidden">

                <div class="col-md-4">
                    <label class="label-small font-weight-bold" >Name</label>
                    <p id="name"></p>
                </div>

                <div class="col-md-4">
                    <label class="label-small font-weight-bold" >Email</label>
                    <p id="email"></p>
                </div>

                <div class="col-md-4">
                  <label class="label-small font-weight-bold" >Status</label>
                  <p id="status"></p>
              </div>
               <div class="col-md-12">
                  <label class="label-small font-weight-bold" >Address</label>
                  <p id="address" style="min-width: 800px"></p>
              </div>
              
              <div class="contactvalidation col-md-4  m-auto">
                  <label class="label-small font-weight-bold">Contact Number</label>
                  <p id="contactno"></p>
              </div>
              
              <div class="col-md-4" >
                  <label class="label-small font-weight-bold" >Age</label>
                  <p id="age" class="text-justify text-break">
                  </p>
                  </div>

              <div class="col-md-4 m-auto" >
                  <label class="label-small font-weight-bold" >Gender</label>
                  <p id="gender" class="text-justify text-break">
                  </p>
                  </div>

              <div class="col-md-4" >
                  <label class="label-small font-weight-bold" >Birth Date</label>
                  <p id="birthdate" class="text-justify text-break">
                  </p>
                  </div>

              <div class="col-md-4" >
                  <label class="label-small font-weight-bold" >Civil Status</label>
                  <p id="civilstatus" class="text-justify text-break">
                  </p>
                  </div>

                <div class="col-md-12 m-auto">
                    <img class="responsive" id="image" height="500px" width="750px"
                    style="border-style: dashed; border-color: #9E9E9E; background: #fff;">
                  </div>

            </div>


          </div>
          <div class="modal-footer">
            <div class="update-success-validation mr-auto ml-3" style="display: none">
             <label class="label text-success">Patient Account is Successfully Approved</label>
            </div>
                <div class="reject-validation mr-auto ml-3" style="display: none">
                 <label class="label text-success">Patient Account is Successfully Rejected</label>
                </div>
          <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
            <button id="btn-decline" class="btn btn-sm btn-danger">Reject</button>
            <button id="btn-approve" class="btn btn-sm btn-success">Approve</button>
          </div>
        </form>
        </div>
      </div>
    </div>
    
     <!--Approve Modal-->
    <div class="modal fade" id="confirmationpatientapproveModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to approve this Patient?</p>
          </div>
          <input type="hidden" id="id_archive" name="id_archive">
          <div class="modal-footer">
            <div class="dupdate-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">User is Successfully Archived</label>
               </div>
                   <div class="dreject-validation mr-auto ml-3" style="display: none">
                    <label class="label text-success">Employer Job is Successfully Rejected</label>
                   </div>
                   <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
            <button class="btn btn-sm btn-outline-dark"  id="btn_confirmpatientapprove">Yes</button>
            <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>
          </form>
          </div>
        </div>
      </div>
    </div>
    
     <!--Reject Modal-->
    <div class="modal fade" id="confirmationpatientrejectModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to reject this Patient?</p>
          </div>
          <input type="hidden" id="id_archive" name="id_archive">
          <div class="modal-footer">
            <div class="dupdate-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">User is Successfully Archived</label>
               </div>
                   <div class="dreject-validation mr-auto ml-3" style="display: none">
                    <label class="label text-success">Employer Job is Successfully Rejected</label>
                   </div>
                   <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
            <button class="btn btn-sm btn-outline-dark"  id="btn_confirmpatientreject">Yes</button>
            <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>
          </form>
          </div>
        </div>
      </div>
    </div>

