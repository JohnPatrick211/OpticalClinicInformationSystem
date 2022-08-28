
  <!-- Add Service -->
  <!--Confirm Modal-->
  <div class="modal fade" id="scheduleproconfirmModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
             <input type="hidden" id="cust-id-hidden">
            <label class="col-form-label">Are you sure you want to delete?</label>
          <p class="delete-message"></p>
        </div>
        <div class="delete-success" style="display: none;">
          <span style="margin-left:180px;" class="text-success">Delete Successfully!</span>
          </div>
          <div class="existservice-success" style="display: none;">
          <span style="margin-left:180px;" class="text-danger">Schedule Already Used</span>
          </div>
        <div class="modal-footer">
          <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
          <button class="btn btn-sm btn-outline-dark" type="button" name="ok_button" id="btn_service_delete">Yes</button>
        <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>

        </div>
      </div>
    </div>
  </div>
  <!-- Edit Modal -->
  @yield('secretaryschedulemodal')
<div class="modal fade" id="SecretaryScheduleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Add Doctor Schedule</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <form action="storedoctorschedule" autocomplete="off" method="POST" enctype="multipart/form-data">

              <div class="row">
                {{ csrf_field() }}

                <input type="hidden" id="discount_hidden">

                <div class="col-12">
                            <label class="col-form-label">Branch</label>
                            <!-- <select class="form-control" name="schedulebranch" id="schedulebranch">
                            @foreach($users4 as $item)
                                <option value="{{$item->id}}">{{$item->branchname}}</option>
                            @endforeach
                  </select> -->
                  <input class="form-control form-control-navbar" name="schedulebranch" id="schedulebranch" type="hidden" value="{{$LoggedUserInfo -> branch_id}}" aria-label="Search" >
                  <input class="form-control form-control-navbar" name="displayschedulebranch" id="displayschedulebranch" type="text" value="{{$users6->branchname}}" aria-label="Search" disabled>
                  </div>

                  <div class="col-12">
                            <label class="col-form-label">Doctor name</label>
                            <select class="form-control" name="scheduledoctorname" id="scheduledoctorname">
                            @foreach($users5 as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                  </select>
                  <!-- <input class="form-control form-control-navbar" name="scheduledoctorname" id="scheduledoctorname" type="hidden" value="{{$LoggedUserInfo -> id}}" aria-label="Search">
                  <input class="form-control form-control-navbar" name="displayscheduledoctorname" id="displayscheduledoctorname" type="text" value="{{$LoggedUserInfo -> name}}" aria-label="Search" disabled> -->
                  </div>
                  <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                        <label class="col-form-label">Schedule Date</label>    
                            <input type="text" name="doctor_schedule_date" id="doctor_schedule_date" class="form-control" required/>
                    </div>

                  <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label class="col-form-label">Start Time</label>
                     <input type="text" step=".01" class="form-control" name="doctor_schedule_start_time" id="doctor_schedule_start_time">
                  </div>
        
                  <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label class="col-form-label">End Time</label>
                      <input type="text" step=".01" class="form-control" name="doctor_schedule_end_time" id="doctor_schedule_end_time" min="0">
                  </div>
          </div>
          <br><br>
          <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-sm btn-primary" id="btn-add-job">Add</button>
          </div>
        </form>
        </div>
      </div>
  </div>
</div>

<div class="modal fade" id="SecretaryEditScheduleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Edit Doctor Schedule</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">



              <div class="row">


                <input type="hidden" id="cust-id-hidden">

                <div class="col-12">
                            <label class="col-form-label">Branch</label>
                            <!-- <select class="form-control" name="editschedulebranch" id="editschedulebranch">
                            @foreach($users4 as $item)
                                <option value="{{$item->id}}">{{$item->branchname}}</option>
                            @endforeach
                  </select> -->
                  <input class="form-control form-control-navbar" name="editschedulebranch" id="editschedulebranch" type="hidden" value="{{$LoggedUserInfo -> branch_id}}" aria-label="Search" >
                  <input class="form-control form-control-navbar" name="displayeditschedulebranch" id="displayeditschedulebranch" type="text" value="{{$users6->branchname}}" aria-label="Search" disabled>
                  </div>

                  <div class="col-12">
                            <label class="col-form-label">Doctor name</label>
                            <select class="form-control" name="editscheduledoctorname" id="editscheduledoctorname">
                            @foreach($users5 as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                  </select>
                  <!-- <input class="form-control form-control-navbar" name="editscheduledoctorname" id="editscheduledoctorname" type="hidden" value="{{$LoggedUserInfo -> id}}" aria-label="Search" disabled>
                  <input class="form-control form-control-navbar" name="displayeditscheduledoctorname" id="displayeditscheduledoctorname" type="text" value="{{$LoggedUserInfo -> name}}" aria-label="Search" disabled> -->
                  </div>
                  <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                        <label class="col-form-label">Schedule Date</label>    
                            <input type="text" autocomplete="off" name="editdoctor_schedule_date" id="editdoctor_schedule_date" class="form-control" required/>
                    </div>

                  <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label class="col-form-label">Start Time</label>
                     <input type="text" step=".01" class="form-control" name="editdoctor_schedule_start_time" id="editdoctor_schedule_start_time">
                  </div>
        
                  <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label class="col-form-label">End Time</label>
                      <input type="text" step=".01" class="form-control" name="editdoctor_schedule_end_time" id="editdoctor_schedule_end_time" min="0">
                  </div>

                  <div class="col-2">
                  <label class="col-form-label">Status</label>
                  <select class="form-control" name="editstatus" id="editstatus">
                      <option value="Active">Active</option>
                      <option value="Inactive">Inactive</option>
                  </select>
                </div>
          </div>
          <br><br>
          <div class="modal-footer">
            <div class="update-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">Edit Successfully</label>
               </div>
                <div class="existservice-success" style="display: none;">
          <span style="margin-left:180px;" class="text-danger">Schedule Already Used</span>
          </div>
               <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-sm btn-primary" id="btn-edit-save-schedule">Edit</button>
          </div>
        </form>
        </div>
      </div>
  </div>
</div>

