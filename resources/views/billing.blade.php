
@extends('layouts.admin')
@include('modals.void')
@section('content')
<style>
    table,#product-container{
        font-size:19px;
    }
    table td {
        text-align: right !important;
    }
</style>

<div class="content-header"></div>

<div class="page-header">
  <h3 class="mt-2" id="page-title">Cashiering</h3>
  <hr>
</div>

<div class="form-inline ml-0 mb-2 form-search-product ">
    <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" id="input-search-userid" type="number" placeholder="User ID" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-dark btn-search-userid">
                    <i class="fas fa-search"></i>
                </button>
            </div>
     </div>
     &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
     <div class=" col-md-3 input-group input-group-sm">
     <input class="form-control form-control-navbar" id="input-patientname" type="text" placeholder="Name" aria-label="Search">
     </div>
     &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp
     <div class=" col-2 input-group input-group-sm ">
            <select class="form-control" name="type" id="type">
                    <option value="Product">Product</option>
                    <option value="Service">Service</option>
                    
            </select>
    </div>
    <!-- <div class=" col-2 input-group input-group-sm ">
                  <select class="form-control" name="branch" id="ebranch">
                  @foreach($users4 as $item)
                      <option value="{{$item->id}}">{{$item->branchname}}</option>
                  @endforeach
                  </select> -->
</div>






  @if(count($errors)>0)
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)

          <li>{{$error}}</li>
              
          @endforeach
      </ul>
  </div>
  @endif

  @if(\Session::has('success'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> </h5>
    {{ \Session::get('success') }}
  </div>
  @endif
<style>
    thead{
        position: sticky;
        top: 0;
        background-color: #FFF;
        border-color: #C4BFC2;
        z-index: 999;
    }
</style>
  <div class="row mt-1">
    <div class="col-md-12 col-lg-12 mt-3">
      <div class="card">
          <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-7">
                        <div class="row mr-2">
                            <div class="col-12 tray-container" style="overflow-y: auto; height:auto;">
                                <table class="table responsive table-bordered table-hover tbl-tray" style="margin-bottom:20px;">
                                    <thead>
                                        <th width="150px">Product/Service Code</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th width='130px'>Amount</th>
                                        <th width="50px">Action</th>
                                    </thead>
                                    <tbody>                
                                    </tbody>    
                                </table>
                                <div class="loader-container">
                                    <div class="lds-default" id="tray-loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <table class="table responsive table-bordered" style=" margin-bottom:20px;">
                                    <tr>
                                        <th>Tendered</th>
                                        <th>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text">&#8369</span>
                                                </div>
                                                <input  type="number" id="tendered" step=".01" class="form-control">
                                            </div>
                                        </th>
                                    </tr> 
                                    <tr>
                                        <th>Change</th>
                                        <th>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text">&#8369</span>
                                                </div>
                                                <input  type="number" id="change" step=".01" class="form-control" readonly>
                                            </div></th>
                                    </tr>  
                                    <tr>
                                        <th>Invoice #</th>
                                        <th><input type="number" id="invoice-no" class="form-control"></th>
                                    </tr>    
                                </table>
                            </div>
                            <div class="col-sm-12 ml-1 mt-1">
                             @php
                                 $discount = \DB::table('tbl_discount')->first();
                             @endphp 
                             
                                <input type="hidden" id="discount-percentage" value="{{$discount->discount_percentage}}">
                                <input type="hidden" id="minimum-purchase" value="{{$discount->minimum_purchase}}">  

                                <input type="radio" name="rad_discount" data-force="0" value="{{$discount->senior_discount}}">
                                <label for="html">Senior Discount</label>
                                <small class="mr-2"> {{ $discount->senior_discount * 100 }}%</small>
                                <input type="radio" name="rad_discount" data-force="0" value="{{$discount->pwd_discount}}">
                                <label for="css">PWD Discount</label>
                                <small class="mr-2"> {{ $discount->pwd_discount * 100 }}%</small>
                            </div>
                            <div class="col-sm-12 ml-1 mt-1">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="rad_discount" data-force="1" value="{{$discount->discount_percentage}}">
                                    <label class="form-check-label" for="exampleCheck1">Force Discount</label><small> {{$discount->discount_percentage*100}}%</small>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <button class="btn btn-sm btn-success" id="proccess">Process</button>
                            </div>
                        </div>        
                    </div>

                    <div class="col-sm-12 col-md-5 border p-2">
                        <div class="row">
                        <div class="col-6">
                                <form action="">
                                    <div class="form-inline ml-0 mb-6 form-search-product float-left">
                                        <div class="input-group input-group-sm">
                                                <select class="form-control" style="width:250px;" name="branch" id="billingbranch">
                                                @foreach($users4 as $item)
                                                    <option value="{{$item->id}}">{{$item->branchname}}</option>
                                                @endforeach
                                                </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-6">
                                <form action="">
                                    <div class="form-inline ml-0 mb-2 form-search-product float-right">
                                        <div class="input-group input-group-sm">
                                          <input class="form-control form-control-navbar" id="input-search-product" type="search" placeholder="Search Here" aria-label="Search">
                                          <div class="input-group-append">
                                          </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="loader-container">
                            <div class="lds-default" id="product-loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                        </div>
                        <div class="row" id="product-container" style="overflow-y: auto; height:720px;"> 
                        </div>
        
                    </div>
                    
                </div>
          </div>
      </div>
  </div>

  <!-- /.row (main row) -->
  
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
