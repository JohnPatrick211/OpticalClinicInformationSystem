<div class="modal fade" id="EditReorderProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Add Quantity</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">


          <div class="row justify-content-center">
                <div class="col-md-2.5 m-auto ">
                    <img class="responsive" id="image" height="200px" width="250px"
                    >
                  </div>
                </div>
                <br><br>
              <div class="row">


                  <input type="hidden" id="cust-id-hidden">
                  <input type="hidden" id="productimage-hidden">

                <div class="col-md-6">
                    <label class="col-form-label">Product Code</label>
                    <input type="text" class="form-control" name="inventoryproductid" id="inventoryproductid"  readonly>
                    <span class="text-danger" id="brancherror"></span>
                  </div>

                  <div class="col-md-6">
                    <label class="col-form-label">Product Name</label>
                    <input type="text" class="form-control" name="inventoryproductname" id="inventoryproductname"  readonly>
                    <span class="text-danger" id="brancherror"></span>
                  </div>



                  <div class="col-md-6">    
                              <label class="col-form-label">Category</label>
                              <input type="text" class="form-control" name="inventorycategory" id="inventorycategory" readonly>
                              <span class="text-danger" id="brancherror"></span>
                            </div>

                  <div class="col-md-6">
                    <label class="col-form-label">Qty</label>
                     <input type="number" step="1" class="form-control" name="inventoryqty" id="inventoryqty" readonly>
                </div>

                <div class="col-md-6">
                    <label class="col-form-label">Add Qty</label>
                     <input type="number" step="1" class="form-control" name="addinventoryqty" id="addinventoryqty" required>
                </div>

                  
          </div>
          <br><br>
          <div class="modal-footer">
            <div class="update-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">Add Successfully</label>
               </div>
                <div class="existproduct-success" style="display: none;">
          <span style="margin-left:180px;" class="text-danger">Product Already Used</span>
          </div>
               <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-sm btn-primary" id="btn-inventoryproduct">Add</button>
          </div>
        </form>
        </div>
      </div>
  </div>
</div>

