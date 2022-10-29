


  <!-- Edit Modal -->
  @yield('staffcertificationmodal')
<div class="modal fade" id="StaffCertificationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Add Medical Certificate</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="row">
                {{ csrf_field() }}

                <input type="hidden" id="discount_hidden">

                <div class="col-md-6">
                <label class="col-form-label">Patient ID</label>
                  <div class="input-group input-group-s">
                  <input class="form-control form-control-navbar" id="cinput-search-userid" type="number" placeholder="Patient ID" aria-label="Search">
                      <div class="input-group-append">
                        <button class="btn btn-dark cbtn-search-userid">
                            <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                </div>

                  <div class="col-md-6">    
                  <label class="col-form-label">Patient Name</label>
                  <input class="form-control form-control-navbar" id="cinput-patientname" type="text" placeholder="Name" aria-label="Search" disabled>
                  </div>

                  <div class="col-12">
                            <label class="col-form-label">Branch</label>
                            <!-- <select class="form-control" name="certificationbranch" id="certificationbranch">
                            @foreach($users4 as $item)
                                <option value="{{$item->id}}">{{$item->branchname}}</option>
                            @endforeach
                  </select> -->
                  <input class="form-control form-control-navbar" name="certificationbranch" id="certificationbranch" type="hidden" value="{{$LoggedUserInfo -> branch_id}}" aria-label="Search" disabled>
                  <input class="form-control form-control-navbar" name="displaycertificationbranch" id="displaycertificationbranch" type="text" value="{{$users6->branchname}}" aria-label="Search" disabled>
                  </div>

                  <div class="col-12">
                            <label class="col-form-label">Doctor name</label>
                            <select class="form-control" name="certificationdoctorname" id="certificationdoctorname">
                            @foreach($users5 as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                  </select>
                  <!-- <input class="form-control form-control-navbar" name="certificationdoctorname" id="certificationdoctorname" type="hidden" value="{{$LoggedUserInfo -> id}}" aria-label="Search" disabled>
                  <input class="form-control form-control-navbar" name="displaycertificationdoctorname" id="displaycertificationdoctorname" type="text" value="{{$LoggedUserInfo -> name}}" aria-label="Search" disabled> -->
                  </div>

                  <div class="col-md-12">
                  <label class="col-form-label">Impressions</label>
                  <textarea name="viewreasonforappointment" id="certificationimpression" class="form-control" required rows="2"></textarea>
                  </div>
        
                  <div class="col-md-12">
                  <label class="col-form-label">Diagnosis</label>
                  <textarea name="viewreasonforappointment" id="certificationdiagnosis" class="form-control" required rows="2"></textarea>
                  </div>
        
                  <div class="col-md-12">
                  <label class="col-form-label">Remarks</label>
                  <textarea name="viewreasonforappointment" id="certificationremarks" class="form-control" required rows="2"></textarea>
                  </div>


          </div>
          <div class="modal-footer">
            <div class="update-success-validation mr-auto ml-3" style="display: none">
             <label class="label text-success">Medical Certificate is Successfully Created</label>
            </div>
                <div class="reject-validation mr-auto ml-3" style="display: none">
                 <label class="label text-success">Patient Account is Successfully Rejected</label>
                </div>
          <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-sm btn-primary" id="btn-add-certificate">Add</button>
          </div>
        </form>
        </div>
      </div>
  </div>
</div>

