@extends('layout.master')

@section('title')

{{APP_NAME}}
@endsection

@section('content')

   <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">NEW ORDER LIST</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=" ">DASHBOARD</a>
                </li>
                <li class="breadcrumb-item"><a href=" ">NEW ORDER LIST</a>
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-body">
        <!-- Basic form layout section start -->


        <section id="configuration">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-head">
                  <div class="card-header">
                  <h4 class="card-title">NEW ORDER LISTS</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                  <div class="heading-elements">
                     <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      </ul>
                      </div>
                      
                    </div>
                </div>


               <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
            <!--         <form action="#" class="icons-tab-steps wizard-notification">
                    <fieldset>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="firstName2">Delivery People :</label>
                              <select class="c-select form-control" id="Delivery_People" name="location"> 
                                <option value="">Select</option>
                                <option value="Aravind">Aravind</option>
                                <option value="Karthi">Karthi</option>
                              </select>  
                            </div>
                          </div>
                         
                            <div class="col-md-6"> 
                             <div class="form-group">
                             <label>Start Date : </label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                 <span class="input-group-text">
                                   <span class="la la-calendar-o"></span>
                                </span>
                                </div>
                              <input type='text' class="form-control pickadate-arrow" placeholder="Change Formats"/>
                            </div>
                           </div>
                           </div>
                           <div class="col-md-6"> 
                            <div class="form-group">
                             <label>End Date : </label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                 <span class="input-group-text">
                                   <span class="la la-calendar-o"></span>
                                </span>
                                </div>
                              <input type='text' class="form-control pickadate-arrow" placeholder="Change Formats"/>
                            </div>
                           </div>
                          </div>
                         </div>
                      </fieldset>
                    </form> -->
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                      <thead> 
                          <tr>
                            <th>SI.No</th>
                            <th>Customer Name</th>
                            <th>Delivery People</th>
                            <!-- <th>Restaurant</th> -->
                            <th>Address</th>
                            <th>Cost</th>
                            <!-- <th>Status</th>  -->
                            <!-- <th>Order List</th> -->
                            <th>Order List</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i=1; ?>
                          @foreach($data as $d)
                          <tr>
                            <td>{{$i}}</td>
                            <td>{{$d->user_name}}</td>
                            <td>Test Boy</td>
                            <!-- <td></td> -->
                            <td>{{$d->delivery_address}}</td>
                            <td> {{$d->bill_amount}}</td>
                            <!-- <td> <span class="btn btn-info">COMPLETED</span> </td> -->
                            <!-- <td><button class="btn btn-primary" data-id="1">Order List</button></td> -->
                             <td>   
                              <div class="form-group">       
                                 <button type="button" class="btn btn-success" data-id="1" data-toggle="modal"  data-target="#{{$d->order_id}}">  View Order  </button>

                                  <div class="modal animated slideInRight text-left" id="{{$d->order_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel76" aria-hidden="true">
                                   <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                     <div class="modal-header">
                                      <h4 class="modal-title" id="myModalLabel76">View Order</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                     </div>
            <div class="modal-body">
                <div class="row m-0">
                    <dl class="order-modal-top">
                        <div class="row m-0">
                            <dt class="col-sm-3 order-txt p-0">Order ID</dt>
                            <dd class="col-sm-9 order-txt orderid"><span>: </span>{{$d->order_id}}</dd>
                        </div>
                       <!--  <div class="row m-0">
                            <dt class="col-sm-3 order-txt p-0">Restaurant Name</dt>
                            <dd class="col-sm-9 order-txt rest_name"><span>: </span>Lido azul</dd>
                        </div> -->
                        <div class="row m-0">
                            <dt class="col-sm-3 order-txt p-0">Customer Name</dt>
                            <dd class="col-sm-9 order-txt cust_name"><span>: </span>{{$d->user_name}}</dd>
                        </div>
                        <div class="row m-0">
                            <dt class="col-sm-3 order-txt p-0">Address</dt>
                            <dd class="col-sm-9 order-txt address"><span>: </span>{{$d->delivery_address}}</dd>
                        </div>
                        <div class="row m-0">
                            <dt class="col-sm-3 order-txt p-0">Phone Number</dt>
                            <dd class="col-sm-9 order-txt cust_phone"><span>: </span>{{$d->phone}}</dd>
                        </div>
                        <div class="row m-0">
                            <dt class="col-sm-3 order-txt p-0">Delivery Date</dt>
                            <dd class="col-sm-9 order-txt cust_delivery_date"><span>: </span>{{$d->ordered_time}}</dd>
                        </div>
                         <div class="row m-0">
                            <dt class="col-sm-3 order-txt p-0">Note</dt>
                            <dd class="col-sm-9 order-txt cust_order_note"><span>: -- </span></dd>
                        </div>
                        <div class="row m-0">
                            <dt class="col-sm-3 order-txt p-0">Shop Rating</dt>
                            <dd class="col-sm-9 order-txt rate_shop"><span>: -- </span></dd>
                        </div>
                        <div class="row m-0">
                            <dt class="col-sm-3 order-txt p-0">Delivery boy rating</dt>
                            <dd class="col-sm-9 order-txt rate_deliveryboy"><span>: -- </span></dd>
                        </div>
                        <div class="row m-0">
                            <dt class="col-sm-3 order-txt p-0">Total Amount</dt>
                            <dd class="col-sm-9 order-txt tot_amt"><span>: </span>{{$d->bill_amount}}</dd>
                            <br>
                            <br>
                        </div>
                        <div class="row m-0">
                            <dt class="col-sm-3 order-txt p-0 status-title">Status</dt>
                            <dt class="col-sm-9 order-txt ">Time</dt>
                        </div>
                       <!--   <div class="row m-0" id="order_status_list">
                          <dd class="col-sm-3 order-txt p-0">ORDERED</dd>                
                          <dd class="col-sm-9 order-txt "> 2018-03-17 14:24:15</dd>
                          <dd class="col-sm-3 order-txt p-0">RECEIVED</dd>                
                          <dd class="col-sm-9 order-txt "> 2018-03-17 14:24:25</dd>
                          <dd class="col-sm-3 order-txt p-0">ASSIGNED</dd>                
                          <dd class="col-sm-9 order-txt "> 2018-03-17 14:24:47</dd>
                          <dd class="col-sm-3 order-txt p-0">PROCESSING</dd>                
                          <dd class="col-sm-9 order-txt "> 2018-03-17 14:24:56</dd>
                          <dd class="col-sm-3 order-txt p-0">REACHED</dd>                
                          <dd class="col-sm-9 order-txt "> 2018-03-17 14:25:00</dd>
                          <dd class="col-sm-3 order-txt p-0">PICKEDUP</dd>                
                          <dd class="col-sm-9 order-txt "> 2018-03-17 14:25:04</dd>
                          <dd class="col-sm-3 order-txt p-0">ARRIVED</dd>                
                          <dd class="col-sm-9 order-txt "> 2018-03-17 14:25:07</dd>
                          <dd class="col-sm-3 order-txt p-0">COMPLETED</dd>                
                          <dd class="col-sm-9 order-txt "> 2018-03-17 14:25:08</dd>
                        </div> -->
                        <hr>
                    </dl>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <!-- <th>Product Image</th> -->
                                    <th>Product Name</th>
                                    <th>Note</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Cost</th>
                                </tr>
                            </thead>
                            <tbody class="cartstbl">
                              @foreach($data1 as $d1)
                              @if($d1->request_id == $d->request_id)
                              <tr>
                                <!-- <td>
                                  <img src="http://ecx.images-amazon.com/images/I/51bRhyVTVGL._SL50_.jpg" width="100px" alt=""></td> -->
                                  <td>{{$d1->food_name}}</td>
                                  <td>null</td>
                                  <td>{{$d1->price}}</td>
                                  <td>{{$d1->quantity}}</td>
                                  <td>{{$d1->price * $d1->quantity}}</td>
                                </tr>
                                @endif
                                @endforeach
                              </tbody>
                            <tfoot>
                              <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Packaging Charge</th>
                                    <th ><span>: </span> {{$d->restaurant_packaging_charge}}</th>
                                    <th> </th>
                                </tr>
                                 <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Discount</th>
                                    <th class="discount"><span>: </span> {{$d->offer_discount}}</th>
                                    <th> </th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Delivery Charge</th>
                                    <th class="delivery_charge"><span>: </span> {{$d->delivery_charge}}</th>
                                    <th> </th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Tax</th>
                                    <th class="tax"><span>: </span> {{$d->tax}}</th>
                                    <th> </th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Total</th>
                                    <th class="tot_amt"><span>: </span> {{$d->bill_amount}}</th>
                                    <th> </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td>
                        @if($d->order_status==0)
                        <a href="{{url('/')}}/admin/accept_request/{{$d->request_id}}" class="btn btn-info">Accept</a>
                        <a href="{{url('/')}}/admin/cancel_request/{{$d->request_id}}" class="btn btn-info">Cancel Order</a>
                        @endif
                         @if($d->order_status==1)
                        <a href="{{url('/')}}/admin/assign_request/{{$d->request_id}}" class="btn btn-info">Assign</a>
                        <a href="{{url('/')}}/admin/cancel_request/{{$d->request_id}}" class="btn btn-info">Cancel Order</a>
                        @endif
                        @if($d->order_status==2)
                        <a href="#">Delivery boy assigned</a>
                        @endif
                        @if($d->order_status==3)
                        <a href="#">Food delivered to Delivery boy</a>
                        @endif
                        @if($d->order_status==4)
                        <a href="#">Towards Customer</a>
                        @endif
                        @if($d->order_status==5)
                        <a href="#">Reached Customer</a>
                        @endif
                        @if($d->order_status==6)
                        <a href="#">Delivered to Customer</a>
                        @endif
                        @if($d->order_status==7)
                        <a href="#">Completed</a>
                        @endif
                        @if($d->order_status == 10)
                        <a href="#">Cancelled</a>
                        @endif
                      </td>
                 </tr>
                 <?php $i++; ?>
                 @endforeach

                  </tbody>
                 </table>
                </div>
                <br><br>
           <!--   <div class="card-block">
               <h3>Total Earning:- </h3>
                     <div class="row m-1">
                        <dt class="col-sm-3 order-txt p-0">Total Earning</dt>
                        <dd class="col-sm-9 order-txt "><span>: ₹58067.00</span></dd>
                    </div>
                    <div class="row m-1">
                        <dt class="col-sm-3 order-txt p-0">Commision from Food Items</dt>
                        <dd class="col-sm-9 order-txt "><span>: ₹2519.00</span> </dd>
                    </div>
                    <div class="row m-1">
                        <dt class="col-sm-3 order-txt p-0">Commision from Delivery Charge</dt>
                        <dd class="col-sm-9 order-txt "><span>: ₹53.50</span> </dd>
                    </div>
                    <div class="row m-1">
                        <dt class="col-sm-3 order-txt p-0">Total Commision </dt>
                        <dd class="col-sm-9 order-txt "><span>: ₹2572.50</span> </dd>
                    </div>
                </div> -->
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
 