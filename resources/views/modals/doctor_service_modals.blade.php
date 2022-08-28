
<!-- Add Service -->
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
            <label class="col-form-label">Are you sure you want to archive?</label>
          <p class="delete-message"></p>
        </div>
        <div class="delete-success" style="display: none;">
          <span style="margin-left:180px;" class="text-success">Archive Successfully!</span>
          </div>
          <div class="existservice-success" style="display: none;">
          <span style="margin-left:180px;" class="text-danger">Service Already Used</span>
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
  @yield('servicemodal')
<div class="modal fade" id="DoctorServiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Add Service</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <form action="storeservice" method="POST" enctype="multipart/form-data">

              <div class="row">
                {{ csrf_field() }}

                <input type="hidden" id="discount_hidden">

                <div class="col-md-12">
                    <label class="col-form-label">Service Name</label>
                    <input type="text" class="form-control" name="servicename" id="servicename" required>
                    <span class="text-danger" id="brancherror"></span>
                  </div>

                  <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label class="col-form-label">Original Price</label>
                     <input type="number" step=".01" class="form-control" name="originalprice" id="originalprice">
                  </div>
        
                  <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label class="col-form-label">Markup</label>
                      <input type="number" step=".01" class="form-control" name="markup" id="markup" min="0">
                  </div>
        
                  <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label class="col-form-label">Selling Price</label>
                      <input type="number" step=".01" class="form-control" name="sellingprice" id="sellingprice" readonly>
                  </div>

                  <div class="col-12">
                            <label class="col-form-label">Branch</label>
                            <!-- <select class="form-control" name="servicebranch" id="servicebranch">
                            @foreach($users4 as $item)
                                <option value="{{$item->id}}">{{$item->branchname}}</option>
                            @endforeach
                  </select> -->
                  <input class="form-control form-control-navbar" name="servicebranch" id="servicebranch" type="hidden" value="{{$LoggedUserInfo -> branch_id}}" aria-label="Search" >
                  <input class="form-control form-control-navbar" name="displayservicebranch" id="displayservicebranch" type="text" value="{{$users6->branchname}}" aria-label="Search" disabled>
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

<div class="modal fade" id="DoctorEditServiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Edit Service</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">



              <div class="row">


                <input type="hidden" id="cust-id-hidden">

                <div class="col-md-12">
                    <label class="col-form-label">Service Name</label>
                    <input type="text" class="form-control" name="editservicename" id="editservicename" required>
                    <span class="text-danger" id="brancherror"></span>
                  </div>

                  <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label class="col-form-label">Original Price</label>
                     <input type="number" step=".01" class="form-control" name="editoriginalprice" id="editoriginalprice">
                  </div>
        
                  <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label class="col-form-label">Markup</label>
                      <input type="number" step=".01" class="form-control" name="editmarkup" id="editmarkup" min="0">
                  </div>
        
                  <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label class="col-form-label">Selling Price</label>
                      <input type="number" step=".01" class="form-control" name="editsellingprice" id="editsellingprice" readonly>
                  </div>

                  <div class="col-12">
                            <label class="col-form-label">Branch</label>
                            <!-- <select class="form-control" name="editservicebranch" id="editservicebranch">
                            @foreach($users4 as $item)
                                <option value="{{$item->id}}">{{$item->branchname}}</option>
                            @endforeach
                  </select> -->
                  <input class="form-control form-control-navbar" name="editservicebranch" id="editservicebranch" type="hidden" value="{{$LoggedUserInfo -> branch_id}}" aria-label="Search" disabled>
                  <input class="form-control form-control-navbar" name="displayeditservicebranch" id="displayeditservicebranch" type="text" value="{{$users6->branchname}}" aria-label="Search" disabled>
                  </div>
          </div>
          <br><br>
          <div class="modal-footer">
            <div class="update-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">Edit Successfully</label>
               </div>
                <div class="existservice-success" style="display: none;">
          <span style="margin-left:180px;" class="text-danger">Service Already Used</span>
          </div>
               <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-sm btn-primary" id="btn-edit-save-service">Edit</button>
          </div>
        </form>
        </div>
      </div>
  </div>
</div>

