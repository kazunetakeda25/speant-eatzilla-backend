@extends('layout.master')

@section('title')

Foodie
@endsection

@section('content')

 <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">PICKED UP ORDERS</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">DASHBOARD</a>
                </li>
                <li class="breadcrumb-item"><a href="#">PICKED UP ORDERS</a>
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
                  <h4 class="card-title">PICKED UP ORDERS</h4>
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

                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                      <thead> 


                          <tr>
                            <th>Sl.No</th>
                            <th>Order Id</th>
                            <th>User Name</th>
                            <th>Restaurant</th>
                            <th>Driver</th>
                            <th>Status</th>
                            <th>User Phone</th>
                            <th>Restaurant Phone</th>
                            <th>Driver Phone</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!--{{$s_no=1}}-->
                          @foreach($pickup_orders as $pickup)
                          <tr>
                            <td>{{$s_no}}</td>
                            <td>{{$pickup->order_id}}</td>
                            <td>{{$pickup->user_name}}</td>
                            <td>{{$pickup->res_name}}</td>
                            <td>{{$pickup->driver_name}}</td>
                            
                            <td><button class="btn btn-success">
                             
                              <?php

                            switch ((int) $pickup->order_status) {
                              case 0:
                                echo 'Order Placed';
                              break;
                              case 1:
                                echo 'Order Accepted by Restaurant';
                              break;
                              case 2:
                                echo 'Food is being prepared';
                              break;
                              case 3:
                                echo 'Delivery Boy Started towards Restaurant';
                              break;
                              case 4:
                                echo 'Delivery Boy Reached restaurant';
                              break;
                              case 5:
                                echo 'Started towards Customer';
                              break;
                              case 6:
                                echo 'Food delivered';
                              break;
                              case 7:
                                echo 'Order Completed';
                              break;
                              case 10:
                                echo 'Order Cancelled';
                              break;
                              
                              default:
                                echo 'NULL';
                                break;
                            }
                            ?></button></td>
                            <td>{{$pickup->user_phone}}</td>
                            <td>{{$pickup->res_phone}}</td>
                            <td>{{$pickup->driver_phone}}</td>
                           
                            <td>
                          
                           <button class="btn btn-primary btn-sm"><i class="ft-edit"></i><a style=" color: white !important;" href="{{URL('/')}}/admin/view_areas/{{$pickup->id}}"> View</a></button>
                             </td>

                          </tr>
                          <!--{{$s_no++}}-->
                          @endforeach
                         

                          
                          
                        </tbody>


                      </table>
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
