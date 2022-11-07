@include('modals.reorder_modals')
@extends('layouts.doctor')

@section('content')


                    <!-- Page Heading -->
                     <h1 class="h3 mb-2 text-gray-800">Inventory</h1>
                     
                    {{-- <div class="update-success-validation mr-auto ml-3" style="display: none">
                        <label class="label text-success">Employer is successfully Approved</label>
                      </div>
                      <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none"> --}}
                <!-- Debug Table Content -->
                <div class="row">

                </div>

                <div class="row mb-2">



                            <div class="col-sm-2 mb-3">
                            <select class="form-control" style="width:auto;" name="branch" id="inventorybranch">
                                                <option value="All Branches">All Branches</option>
                                                @foreach($users4 as $item)
                                                    <option value="{{$item->id}}">{{$item->branchname}}</option>
                                                @endforeach
                                                </select>
                              <!-- <h6 class="h6 mt-2 text-gray-800">{{$users6->branchname}}</h6> -->
                              <!-- <input type="hidden" name="branch" id="inventorybranch" value="{{$LoggedUserInfo -> branch_id}}"> -->
                              </div>

                              <!-- <div class="mt-2">
                                -
                                </div> -->

                              <!-- <div class="col-sm-2 mb-3">
                                <input data-column="9" type="date" class="form-control" id="vacantdate_to" value="{{ date('Y-m-d') }}">
                                </div>
                                    
                                    <div class="mt-2">
                                </div> -->

                             </div>

                
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">

                          <ul class="nav nav-tabs" id="myTab" role="tablist">

                            <li class="nav-item">
                              <a class="nav-link  active" id="validation-tab" data-toggle="tab" href="#validationtab" role="tab" aria-controls="contact" aria-selected="true">Products

                              </a>
                             </li>
                              <li class="nav-item">
                                  <a class="nav-link" id="verified-tab" data-toggle="tab" href="#verifiedtab" role="tab" aria-controls="home" aria-selected="false">Reorder

                                  </a>
                              </li>

                          </ul>
                          <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="validationtab" role="tabpanel" aria-labelledby="validation-tab">

                              <table class="table responsive table-bordered table-hover" id="inventory-table" width="100%" cellspacing="0">
                                <thead>
                                  <tr>
                                            <th style="min-width: 5px">Product Code</th>
                                            <th>Product Name</th>
                                            <th style="min-width: 200px">Branch Name</th>
                                            <th>Qty</th>
                                            <th>Reorder</th>
                                            <th>Category</th>
                                            <th>Original Price</th>
                                            <th>Selling Price</th>
                                            <th>Markup Rate</th>
                                  </tr>
                              </thead>

                              </table>
                             <!-- <img src="('assets/arrow_ltr.png')}}" alt="">
                              <button class="btn btn-sm btn-success mt-3" id="btn-bulk-verified">Mark as verified</button>
                              <div class="update-success-validation mr-auto ml-3" style="display: none">
                                <label class="label text-success">Customer is successfully added validate</label>
                              </div>
                              <img src="../../assets/loader.gif" class="loader" alt="loader" style="display: none">-->


                            </div>
                            <div class="tab-pane fade" id="verifiedtab" role="tabpanel" aria-labelledby="verified-tab">

                              <table class="table responsive table-bordered table-hover" id="reorder-table" width="100%">
                                <thead>
                                  <tr>
                                            <th style="min-width: 5px">Product Code</th>
                                            <th>Name</th>
                                            <th style="min-width: 200px">Branch</th>
                                            <th>Qty</th>
                                            <th>Reorder</th>
                                            <th>Category</th>
                                            <th>Original Price</th>
                                            <th>Selling Price</th>
                                            <th>Markup Rate</th>
                                            <th>Action</th>
                                  </tr>
                              </thead>

                              </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
            <!-- End of Main Content -->

            @endsection

