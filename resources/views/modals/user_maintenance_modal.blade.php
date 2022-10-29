@yield('modals')
<!--Add  Modal-->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Add user</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
        <form action="AddUser" method="POST" enctype="multipart/form-data">
            <div class="row">
            {{ csrf_field() }}
              <div class="col-4">
                  <label class="col-form-label">User type</label>
                  <select class="form-control" name="user_type" id="user_type">
                      <option value="Doctor">Doctor</option>
                      <option value="Secretary">Secretary</option>
                      <option value="Staff">Staff</option>
                      <option value="System Admin">System Admin</option>
                  </select>
                </div>

              <div class="col-8 mb-2">
                  <label class="col-form-label">Name</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Last Name, First Name, Middle Name" required>
                  <div class="empty-reject-name mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Please input the name</label>
                   </div>
                </div>

                <div class="hide-specialization col-12 mb-2" style="display: none">
                  <label class="col-form-label">Specialization</label>
                  <input type="text" class="form-control" name="specialization" id="specialization" required>
                  <div class="empty-reject-specialization mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Please input the specialization</label>
                   </div>
                </div>

                <div class="col-5">
                    <label class="col-form-label">Email</label>
                    <input type="text" class="form-control" name="email" id="email"  required>
                    <div class="empty-reject-email mr-auto ml-3" style="display: none">
                        <label class="label text-danger">Please input the email</label>
                       </div>
                  </div>

                  <div class="col-2">
                    <label class="col-form-label">Age</label>
                    <input type="text" class="form-control" name="age" id="age"  required>
                    <div class="empty-reject-age mr-auto ml-3" style="display: none">
                        <label class="label text-danger">Please input the Age</label>
                       </div>
                  </div>

                  <div class="col-2">
                  <label class="col-form-label">Gender</label>
                  <select class="form-control" name="gender" id="gender" required>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                  </select>
                </div>

                <div class="col-3">
                  <label class="col-form-label">Civil Status</label>
                  <select class="form-control" name="civilstatus" id="civilstatus" required>
                      <option value="Single">Single</option>
                      <option value="Married">Married</option>
                      <option value="Widowed">Widowed</option>
                      <option value="Separated">Separated</option>
                      <option value="Divorced">Divorced</option>
                  </select>
                </div>

                <div class="col-6">
                  <label class="col-form-label">Birthday</label>
                  <input type="date" class="form-control" id="birthdate" placeholder="birthdate" required>
                </div>

                <div class="col-6">
                  <label class="col-form-label">Contact Number</label>
                  <input type="text" class="form-control" name="contact_no" id="contact_no" required>
                  <div class="empty-reject-contact_no mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Please input the contact number</label>
                   </div>
                   <div class="reject-contact_no mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Contact Number must be 11 digits</label>
                   </div>
                </div>

                <div class="col-12">
                  <label class="col-form-label">Address</label>
                  <input type="text" class="form-control" name="address" id="address" placeholder="House Number, Street, Barangay, City, Province" required>
                  <div class="empty-reject-address mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Please input the address</label>
                   </div>
                </div>

                <div class="col-12">
                  <label class="col-form-label">Branch</label>
                  <select class="form-control" name="branch" id="branch">
                  @foreach($users4 as $item)
                      <option value="{{$item->id}}">{{$item->branchname}}</option>
                  @endforeach
                  </select>
                  <div class="empty-reject-branch mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Please select the branch</label>
                   </div>
                </div>


                <div class="col-6 mb-2">
                    <label class="col-form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                    <div class="empty-reject-username mr-auto ml-3" style="display: none">
                        <label class="label text-danger">Please input the username</label>
                       </div>
                  </div>

                <div class="col-6 mb-2">
                  <label class="col-form-label">Password</label>
                  <input type="password" class="form-control" name="password" id="password" required>
                  <div class="reject-password mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Password must be 8 characters</label>
                   </div>
                   <div class="empty-reject-password mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Please input the password</label>
                   </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <div class="update-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">User is Successfully Created</label>
               </div>
                   <div class="reject-validation mr-auto ml-3" style="display: none">
                    <label class="label text-danger">User Already Exist</label>
                   </div>
                   <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
                <button type="button" class="btn btn-sm btn-secondary" id="btn-close" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-sm btn-primary" id="btn-save-user" >Save</button>
        </div>
      </form>
      </div>
    </div>
  </div>


  <!--edit  Modal-->
  <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Edit user</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <div class="row">

              <input type="hidden" name="user_id_hidden" id="euser_id_hidden">

              <div class="col-4">
                <label class="col-form-label">User type</label>
                <p id="euser_type"></p>
              </div>

            <div class="col-8 mb-2">
                <label class="col-form-label">Name</label>
                <input type="text" class="form-control" name="name" id="ename" placeholder="First, Middle, Last Name" required>
              </div>

              <div class="ehide-specialization col-12 mb-2" style="display: none">
                  <label class="col-form-label">Specialization</label>
                  <input type="text" class="form-control" name="specialization" id="especialization" required>
                  <div class="empty-reject-specialization mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Please input the specialization</label>
                   </div>
                </div>

              <div class="col-5">
                  <label class="col-form-label">Email</label>
                  <input type="text" class="form-control" name="email" id="eemail" required>
                </div>

                <div class="col-2">
                    <label class="col-form-label">Age</label>
                    <input type="text" class="form-control" name="age" id="eage"  required>
                    <div class="empty-reject-age mr-auto ml-3" style="display: none">
                        <label class="label text-danger">Please input the Age</label>
                       </div>
                  </div>

                  <div class="col-2">
                  <label class="col-form-label">Gender</label>
                  <select class="form-control" name="gender" id="egender">
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                  </select>
                </div>

                <div class="col-3">
                  <label class="col-form-label">Civil Status</label>
                  <select class="form-control" name="civilstatus" id="ecivilstatus">
                      <option value="Single">Single</option>
                      <option value="Married">Married</option>
                      <option value="Widowed">Widowed</option>
                      <option value="Separated">Separated</option>
                      <option value="Divorced">Divorced</option>
                  </select>
                </div>

                <div class="col-6">
                  <label class="col-form-label">Birthday</label>
                  <input type="date" class="form-control" id="ebirthdate" placeholder="ebirthdate" required>
                </div>

              <div class="col-6">
                <label class="col-form-label">Contact Number</label>
                <input type="text" class="form-control" name="contact_no" id="econtact_no" required>
              </div>

              <div class="col-12">
                <label class="col-form-label">Address</label>
                <input type="text" class="form-control" name="address" id="eaddress" placeholder="House Number, Street, Barangay, City, Province" required>
              </div>

              <div class="col-12">
                  <label class="col-form-label">Branch</label>
                  <select class="form-control" name="branch" id="ebranch">
                  @foreach($users4 as $item)
                      <option value="{{$item->id}}">{{$item->branchname}}</option>
                  @endforeach
                  </select>
                  <div class="empty-reject-branch mr-auto ml-3" style="display: none">
                    <label class="label text-danger">Please select the branch</label>
                   </div>
                </div>
              

              <div class="col-6 mb-2">
                  <label class="col-form-label">Username</label>
                  <input type="text" class="form-control" name="username" id="eusername" required>
                </div>

              <div class="col-6 mb-2">
                <label class="col-form-label">New Password</label>
                <input type="password" class="form-control" name="password" id="epassword" >
              </div>

            </div>

        </div>
        <div class="modal-footer">
            <div class="eupdate-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">User is Successfully Updated</label>
               </div>
                   <div class="ereject-validation mr-auto ml-3" style="display: none">
                    <label class="label text-success">Employer Job is Successfully Rejected</label>
                   </div>
                   <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
                <button type="button" class="btn btn-sm btn-secondary" id="ebtn-close" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-sm btn-primary" id="ebtn-update" >Update</button>
        </div>
      </div>
    </div>
  </div>


    <!--Confirm Modal-->
    <div class="modal fade" id="archiveModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Are you sure do you want to archive this user?</p>
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
            <button class="btn btn-sm btn-outline-dark" type="submit" id="btn_archive_user">Yes</button>
            <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>


