
<!-- Add Category -->
  <!--Confirm Modal-->
  <div class="modal fade" id="proconfirmModal" tabindex="-1" role="dialog">
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
          <span style="margin-left:180px;" class="text-success">Deleted Successfully!</span>
          </div>
          <div class="existcategory-success" style="display: none;">
          <span style="margin-left:180px;" class="text-danger">Clinic Branch Already Used</span>
          </div>
        <div class="modal-footer">
          <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
          <button class="btn btn-sm btn-outline-dark" type="button" name="ok_button" id="btn_category_delete">Yes</button>
        <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>

        </div>
      </div>
    </div>
  </div>


  <!-- Edit Modal -->
  @yield('categorymodal')
<div class="modal fade" id="CategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Add Clinic Branch</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <form action="storebranch" method="POST" enctype="multipart/form-data">

              <div class="row">
                {{ csrf_field() }}

                <input type="hidden" id="discount_hidden">

                <div class="col-md-8">
                    <label class="col-form-label">Branch Name</label>
                    <input type="text" class="form-control" name="branchname" id="branchname" required>
                    <span class="text-danger" id="brancherror"></span>
                  </div>

                  <div class="col-md-8">
                    <label class="col-form-label">Address</label>
                    <input type="text" class="form-control" name="address" id="address" required>
                    <span class="text-danger" id="addresserror"></span>
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

<div class="modal fade" id="EditCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Edit Clinic Branch</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">



              <div class="row">


                <input type="hidden" id="cust-id-hidden">

                <div class="col-md-8">
                    <label class="col-form-label">Branch Name</label>
                    <input type="text" class="form-control" name="editbranchname" id="editbranchname" required>
                    <span class="text-danger" id="brancherror"></span>
                  </div>

                  <div class="col-md-8">
                    <label class="col-form-label">Address</label>
                    <input type="text" class="form-control" name="editaddress" id="editaddress" required>
                    <span class="text-danger" id="addresserror"></span>
                  </div>
          </div>
          <br><br>
          <div class="modal-footer">
            <div class="update-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">Edit Successfully</label>
               </div>
                <div class="existcategory-success" style="display: none;">
          <span style="margin-left:180px;" class="text-danger">Clinic Branch Already Used</span>
          </div>
               <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-sm btn-primary" id="btn-edit-save-category">Edit</button>
          </div>
        </form>
        </div>
      </div>
  </div>
</div>

