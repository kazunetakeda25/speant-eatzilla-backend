@extends('layout.master')

@section('title')

Foodie
@endsection

@section('content')

 <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">PROCESSING ORDERS</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">DASHBOARD</a>
                </li>
                <li class="breadcrumb-item"><a href="#">PROCESSING ORDERS</a>
                </li>
               
              </ol>
            </div>
          </div>
        </div>
        <!-- <div class="content-header-right col-md-6 col-12">
          <div class="dropdown float-md-right">
            <button class="btn btn-danger dropdown-toggle round btn-glow px-2" id="dropdownBreadcrumbButton"
            type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
            <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton"><a class="dropdown-item" href="#"><i class="la la-calendar-check-o"></i> Calender</a>
              <a class="dropdown-item" href="#"><i class="la la-cart-plus"></i> Cart</a>
              <a class="dropdown-item" href="#"><i class="la la-life-ring"></i> Support</a>
              <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="la la-cog"></i> Settings</a>
            </div>
          </div>
        </div> -->
      </div>
      <div class="content-body">
        <!-- Basic form layout section start -->


         <section id="configuration">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-head">
                  <div class="card-header">
                  <!-- <h4 class="card-title" style="height:50px;color:red;">
                ** Demo Mode : No Permission to Edit and Delete.</h4> -->
                  <h4 class="card-title">PROCESSING ORDERS</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                  <div class="heading-elements">
                     <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <!--  <li>  <button class="btn btn-primary btn-sm"><i class="ft-plus white"></i><a style=" color: white !important;" href="{{URL('/')}}/admin/add_dispmanager"> Add Dispute Manager</a></button></li> -->
                      </ul>
                      </div>
                      
                    </div>
                </div>

                <div class="content-body">
                 <div class="card"> 
                  <div class="card-header">
                   <h3>Order Details : </h3><br>
                   <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">Order Id </dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->order_id}}</span> </dd>
                      </div>
                       </div>
                      </div>
                    </div>
                 <div class="row">
                    <div class="card">
                    <div class="card-header text-white" style="background-color: #00AA9E;">
                      User Details
                    </div>
                    <div class="card-body">
                     <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">User Name </dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->user_name}}</span> </dd>
                      </div>
                      <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">Email</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->user_email}}</span> </dd>
                      </div>
                      <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">Phone</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->user_phone}}</span> </dd>
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header text-white" style="background-color: #00AA9E;">
                      Restaurant Details
                    </div>
                    <div class="card-body">
                     <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">Name</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->res_name}}</span> </dd>
                      </div>
                      <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">Email  </dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->res_email}}</span> </dd>
                      </div>
                      <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">Phone</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->res_phone}}</span> </dd>
                      </div>
                       <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">Address 1</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->}}</span> </dd>
                      </div>
                       <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">Address 2</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->res_phone}}</span> </dd>
                      </div>
                      <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">City</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->res_phone}}</span> </dd>
                      </div>
                      <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">State</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->res_phone}}</span> </dd>
                      </div>
                      <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">Country</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->res_phone}}</span> </dd>
                      </div>
                      <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">Zip Code</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->res_phone}}</span> </dd>
                      </div>
                    </div>
                  </div>
              </div>
               <div class="row">
                    <div class="card">
                    <div class="card-header text-white" style="background-color: #00AA9E;">
                      Driver Details
                    </div>
                    <div class="card-body">
                     <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">Name</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->user_name}}</span> </dd>
                      </div>
                      <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">Email</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->user_email}}</span> </dd>
                      </div>
                      <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">Phone</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->user_phone}}</span> </dd>
                      </div>
                      <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">Address 1</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->}}</span> </dd>
                      </div>
                       <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">Address 2</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->res_phone}}</span> </dd>
                      </div>
                      <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">City</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->res_phone}}</span> </dd>
                      </div>
                      <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">State</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->res_phone}}</span> </dd>
                      </div>
                      <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">Country</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->res_phone}}</span> </dd>
                      </div>
                      <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">Zip Code</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->res_phone}}</span> </dd>
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header text-white" style="background-color: #00AA9E;">
                      Order Details
                    </div>
                    <div class="card-body">
                     <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">Food Items</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->res_name}}</span> </dd>
                      </div>
                      <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">Email  </dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->res_email}}</span> </dd>
                      </div>
                      <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">Phone</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->res_phone}}</span> </dd>
                      </div>
                       <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">Address 1</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->}}</span> </dd>
                      </div>
                       <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">Address 2</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->res_phone}}</span> </dd>
                      </div>
                      <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">City</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->res_phone}}</span> </dd>
                      </div>
                      <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">State</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->res_phone}}</span> </dd>
                      </div>
                      <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">Country</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->res_phone}}</span> </dd>
                      </div>
                      <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0">Zip Code</dt>
                          <dd class="col-sm-9 order-txt "><span>: {{$restaurant->res_phone}}</span> </dd>
                      </div>
                    </div>
                  </div>
              </div>
      


              </div>
            </div>
          </div>
        </section>

        <!-- // Basic form layout section end -->
      </div>
    </div>
 

   @endsection     
