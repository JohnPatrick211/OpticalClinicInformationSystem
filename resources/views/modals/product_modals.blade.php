
<!-- Add Product -->
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
          <div class="existproduct-success" style="display: none;">
          <span style="margin-left:180px;" class="text-danger">Product Already Used</span>
          </div>
        <div class="modal-footer">
          <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
          <button class="btn btn-sm btn-outline-dark" type="button" name="ok_button" id="btn_product_delete">Yes</button>
        <button class="btn btn-sm btn-danger cancel-delete" data-dismiss="modal">Cancel</button>

        </div>
      </div>
    </div>
  </div>


  <!-- Edit Modal -->
  @yield('productmodal')
<div class="modal fade" id="ProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Add Product</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <form action="storeproduct" method="POST" enctype="multipart/form-data">

              <div class="row">
                {{ csrf_field() }}

                <input type="hidden" id="discount_hidden">

                <div class="col-md-12">
                    <label class="col-form-label">Product Name</label>
                    <input type="text" class="form-control" name="productname" id="productname" required>
                    <span class="text-danger" id="brancherror"></span>
                  </div>

                  <div class="col-sm-12 col-md-6 col-lg-4 mt-2">    
                              <label class="col-form-label">Category</label>
                              <select class="form-control" name="category_id" id="category_id" required>
                              <option value="0" disabled selected>-- Select category --</option>
                              @foreach($users3 as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach

                              </select>
                            </div>

                  <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label class="col-form-label">Qty</label>
                     <input type="number" step=".01" class="form-control" name="qty" id="qty">
                  </div>

                  <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label class="col-form-label">Original Price</label>
                     <input type="number" step=".01" class="form-control" name="originalprice" id="originalprice">
                  </div>
        
                  <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label class="col-form-label">Markup Rate</label>
                      <input type="number" step=".01" class="form-control" name="markup" id="markup" min="0">
                  </div>
        
                  <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label class="col-form-label">Selling Price</label>
                      <input type="number" step=".01" class="form-control" name="sellingprice" id="sellingprice" readonly>
                  </div>

                  <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label class="col-form-label">Reorder</label>
                     <input type="number" step=".01" class="form-control" name="reorder" id="reorder">
                  </div>

                  <div class="col-md-4">
                            <label class="col-form-label">Upload Image</label>
                          <input type="file"  name="productimage" id="productimage" enctype="multipart/form-data">
                          </div>

                  <div class="col-12">
                            <label class="col-form-label">Branch</label>
                            <select class="form-control" name="productbranch" id="productbranch">
                            @foreach($users4 as $item)
                                <option value="{{$item->id}}">{{$item->branchname}}</option>
                            @endforeach
                  </select>
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

<div class="modal fade" id="EditProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Edit Product</h4>
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

                <div class="col-md-12">
                    <label class="col-form-label">Product Name</label>
                    <input type="text" class="form-control" name="editproductname" id="editproductname" required>
                    <span class="text-danger" id="brancherror"></span>
                  </div>

                  <div class="col-sm-12 col-md-6 col-lg-4 mt-2">    
                              <label class="col-form-label">Category</label>
                              <select class="form-control" name="editcategory_id" id="editcategory_id"required>
                                <option value="0" disabled selected>-- Select category --</option>
                                @foreach($users3 as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach

                              </select>
                            </div>

                  <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label class="col-form-label">Qty</label>
                     <input type="number" step=".01" class="form-control" name="editqty" id="editqty">
                  </div>

                  <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label class="col-form-label">Original Price</label>
                     <input type="number" step=".01" class="form-control" name="editoriginalprice" id="editoriginalprice">
                  </div>
        
                  <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label class="col-form-label">Markup Rate</label>
                      <input type="number" step=".01" class="form-control" name="editmarkup" id="editmarkup" min="0">
                  </div>
        
                  <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label class="col-form-label">Selling Price</label>
                      <input type="number" step=".01" class="form-control" name="editsellingprice" id="editsellingprice" readonly>
                  </div>

                  <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label class="col-form-label">Reorder</label>
                     <input type="number" step=".01" class="form-control" name="editreorder" id="editreorder">
                  </div>

                  <div class="col-md-6">
                            <label class="col-form-label">Upload Image</label>
                          <input type="file"  name="editproductimage" id="editproductimage" enctype="multipart/form-data">
                          </div>

                          <div class="col-12">
                            <label class="col-form-label">Branch</label>
                            <select class="form-control" name="editproductbranch" id="editproductbranch">
                            @foreach($users4 as $item)
                                <option value="{{$item->id}}">{{$item->branchname}}</option>
                            @endforeach
                  </select>
                  </div>

                  
          </div>
          <br><br>
          <div class="modal-footer">
            <div class="update-success-validation mr-auto ml-3" style="display: none">
                <label class="label text-success">Edit Successfully</label>
               </div>
                <div class="existproduct-success" style="display: none;">
          <span style="margin-left:180px;" class="text-danger">Product Already Used</span>
          </div>
               <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">
                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-sm btn-primary" id="btn-edit-save-product">Edit</button>
          </div>
        </form>
        </div>
      </div>
  </div>
</div>

