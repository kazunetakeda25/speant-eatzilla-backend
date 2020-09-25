@extends('layout.master')

@section('title')

{{APP_NAME}}
@endsection

@section('content')
<div class="content-wrapper">
      <div class="content-header row">
      </div>
       <div class="content-body">
        <section id="sortable-tabs">
          <div class="row">

            <!-- Icon Tab with top line -->
            <div class="col-xl-12 col-lg-12">
              <div class="card">
                <div class="card-body">
                  <ul class="nav nav-tabs nav-top-border no-hover-bg nav-justified" id="tab-top-line-drag">
                    <li class="nav-item">
                      <a class="nav-link active" id="activeIcon1-tab1" data-toggle="tab" href="#activeIcon1"
                      aria-controls="activeIcon1" aria-expanded="true"><i class="la la-check"></i> Pending Orders</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="linkIcon1-tab1" data-toggle="tab" href="#linkIcon1" aria-controls="linkIcon1"
                      aria-expanded="false"><i class="la la-link"></i>Accepted Orders</a>
                    </li>
                   <li class="nav-item">
                      <a class="nav-link" id="ongoing-tab1" data-toggle="tab" href="#ongoing" aria-controls="ongoing"
                      aria-expanded="false"><i class="la la-link"></i>Ongoing Orders</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="linkIconOpt1-tab1" data-toggle="tab" href="#linkIconOpt1"
                      aria-controls="linkIconOpt1"><i class="la la-share-alt-square"></i> Completed Orders</a>
                    </li>
                  </ul>
        <div class="tab-content px-1 pt-1">
          <div role="tabpanel" class="tab-pane active show" id="activeIcon1" aria-labelledby="activeIcon1-tab1" aria-expanded="true">  
              <div class="form-group">
                       <h4 class="card-title">CUSTOMER PENDING LIST</h4>
                        <div class="input-group">
                           <div class="col-md-6">
                         <input type='text' class="form-control pickadate-disable-dates" placeholder="Disable Dates"/>
                        </div>
                         <div class="col-md-6">
                         <button class="btn-success">Search</button>
                        </div>
                       </div>
                      </div>

        <div class="row">
          <div class="vertical-scroll scroll-example height-400 col-md-7 col-sm-12">
           
              
              @foreach($pending_orders as $pending)
              <div class="card text-white box-shadow-0 bg-gradient-x2-pink">
                <div class="card-header">
                  <h4 class="card-title text-white">Customer Pending List</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                
                <div class="card-content collapse show">
                  <div class="card-body">
                    <div class="row">
                    <div class="col-md-4">
                    <div class="media-left">
                    <a href="#" class="profile-image">
                      <img src="{{URL::asset('public/app-assets/images/portrait/small/avatar-s-8.png')}}" class="rounded-circle img-border height-100"
                      alt="Card image">
                    </a>
                  </div>
                  </div> 
                   <div class="col-md-8">
                   <p>#{{$pending->order_id}}</p>
                    <p>{{$pending->customer_name}}</p>
                    <p>{{$pending->phone}}</p>
                    <div ><button class="btn btn-success"  data-toggle="modal"  data-target="#{{$pending->order_id}}">View Order</button>
                     </div>
                  </div> 
                  <div class="modal animated slideInRight text-left" id="{{$pending->order_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel76" aria-hidden="true">
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
                            <dd class="col-sm-9 order-txt orderid"><span>: </span>{{$pending->order_id}}</dd>
                        </div>
                       <!--  <div class="row m-0">
                            <dt class="col-sm-3 order-txt p-0">Restaurant Name</dt>
                            <dd class="col-sm-9 order-txt rest_name"><span>: </span>Lido azul</dd>
                        </div> -->
                        <div class="row m-0">
                            <dt class="col-sm-3 order-txt p-0">Customer Name</dt>
                            <dd class="col-sm-9 order-txt cust_name"><span>: </span>{{$pending->name}}</dd>
                        </div>
                        <div class="row m-0">
                            <dt class="col-sm-3 order-txt p-0">Address</dt>
                            <dd class="col-sm-9 order-txt address"><span>: </span>{{$pending->delivery_address}}</dd>
                        </div>
                        <div class="row m-0">
                            <dt class="col-sm-3 order-txt p-0">Phone Number</dt>
                            <dd class="col-sm-9 order-txt cust_phone"><span>: </span>{{$pending->phone}}</dd>
                        </div>
                        <div class="row m-0">
                            <dt class="col-sm-3 order-txt p-0">Delivery Date</dt>
                            <dd class="col-sm-9 order-txt cust_delivery_date"><span>: </span>{{$pending->ordered_time}}</dd>
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
                            <dd class="col-sm-9 order-txt tot_amt"><span>: </span>{{$pending->bill_amount}}</dd>
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
                        {{--<table class="table">
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
                              @if($d1->request_id == $pending->request_id)
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
                                    <th ><span>: </span> {{$pending->restaurant_packaging_charge}}</th>
                                    <th> </th>
                                </tr>
                                 <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Discount</th>
                                    <th class="discount"><span>: </span> {{$pending->offer_discount}}</th>
                                    <th> </th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Delivery Charge</th>
                                    <th class="delivery_charge"><span>: </span> {{$pending->delivery_charge}}</th>
                                    <th> </th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Tax</th>
                                    <th class="tax"><span>: </span> {{$pending->tax}}</th>
                                    <th> </th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Total</th>
                                    <th class="tot_amt"><span>: </span> {{$pending->bill_amount}}</th>
                                    <th> </th>
                                </tr>
                            </tfoot>
                        </table>--}}
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
                  </div>

                </div>
                </div>
              </div>

             @endforeach
            </div>

             
   
            <div class="col-md-5 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">World Map</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content">
                  <div class="card-body height-400">
                    <div id="world-map" class="jqvmap-area"></div>
                     <iframe width="100%" height="300" src="https://maps.google.com/maps?width=100%&height=600&hl=en&q=Malet%20St%2C%20London%20WC1E%207HU%2C%20United%20Kingdom+(Your%20Business%20Name)&ie=UTF8&t=&z=14&iwloc=B&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.mapsdirections.info/en/custom-google-maps/">Create a custom Google Map</a> by <a href="https://www.mapsdirections.info/en/">Measure area on map</a></iframe>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
         <div class="tab-pane" id="linkIcon1" role="tabpanel" aria-labelledby="linkIcon1-tab1" aria-expanded="false">

               <div class="form-group">
                       <h4 class="card-title">DELIVERY PEOPLE LIST</h4>
                      </div>

        <div class="row">
          <div class="vertical-scroll scroll-example height-400 col-md-7 col-sm-12">
            @foreach($accepted_orders as $accepted)
              <div class="card text-white box-shadow-0 bg-gradient-y-success">
                <div class="card-header">
                  <h4 class="card-title text-white">DELIVERY PEOPLE LIST</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                
                <div class="card-content collapse show">
                  <div class="card-body">
                    <div class="row">
                    <div class="col-md-4">
                    <div class="media-left">
                    <a href="#" class="profile-image">
                      <img src="{{URL::asset('public/app-assets/images/portrait/small/avatar-s-8.png')}}" class="rounded-circle img-border height-100"
                      alt="Card image">
                    </a>
                  </div>
                  </div> 
                  <div class="col-md-8">
                   <p>#{{$accepted->order_id}}</p>
                    <p>{{$accepted->customer_name}}</p>
                    <p>{{$accepted->phone}}</p>
                    <div ><button class="btn   btn-success">Order List</button>
                     </div>
                  </div> 
                  </div> 
                  </div>

                </div>
                </div>
              </div>
             @endforeach
            </div>

             
   
            <div class="col-md-5 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">World Map</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content">
                  <div class="card-body height-400">
                    <div id="world-map" class="jqvmap-area"></div>
                     <iframe width="100%" height="300" src="https://maps.google.com/maps?width=100%&height=600&hl=en&q=Malet%20St%2C%20London%20WC1E%207HU%2C%20United%20Kingdom+(Your%20Business%20Name)&ie=UTF8&t=&z=14&iwloc=B&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.mapsdirections.info/en/custom-google-maps/">Create a custom Google Map</a> by <a href="https://www.mapsdirections.info/en/">Measure area on map</a></iframe>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

                    
    <div class="tab-pane" id="ongoing" role="tabpanel" aria-labelledby=" " aria-expanded="false">
        <div class="form-group">
           <h4 class="card-title">ONGOING ORDERS</h4>
              </div>

        <div class="row">
          <div class="vertical-scroll scroll-example height-400 col-md-7 col-sm-12">
           @foreach($ongoing_orders as $ongoing)
              <div class="card text-white box-shadow-0 bg-gradient-x-primary">
                <div class="card-header">
                  <h4 class="card-title text-white">ONGOING ORDERS</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                
                <div class="card-content collapse show">
                  <div class="card-body">
                    <div class="row">
                    <div class="col-md-4">
                    <div class="media-left">
                    <a href="#" class="profile-image">
                      <img src="{{URL::asset('public/app-assets/images/portrait/small/avatar-s-8.png')}}" class="rounded-circle img-border height-100"
                      alt="Card image">
                    </a>
                  </div>
                  </div> 
                   <div class="col-md-8">
                   <p>#{{$ongoing->order_id}}</p>
                    <p>{{$ongoing->customer_name}}</p>
                    <p>{{$ongoing->phone}}</p>
                    <div ><button class="btn   btn-success">Order List</button>
                     </div>
                  </div> 
                  </div> 
                  </div>

                </div>
                </div>
              </div>
              @endforeach
            </div>

             
   
            <div class="col-md-5 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">World Map</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content">
                  <div class="card-body height-400">
                    <div id="world-map" class="jqvmap-area"></div>
                     <iframe width="100%" height="300" src="https://maps.google.com/maps?width=100%&height=600&hl=en&q=Malet%20St%2C%20London%20WC1E%207HU%2C%20United%20Kingdom+(Your%20Business%20Name)&ie=UTF8&t=&z=14&iwloc=B&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.mapsdirections.info/en/custom-google-maps/">Create a custom Google Map</a> by <a href="https://www.mapsdirections.info/en/">Measure area on map</a></iframe>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
  <div class="tab-pane" id="linkIconOpt1" role="tabpanel" aria-labelledby="linkIconOpt1-tab1" aria-expanded="false">
                    <div class="form-group">
                       <h4 class="card-title">COMPLETED ORDERS</h4>
                      </div>

        <div class="row">
          <div class="vertical-scroll scroll-example height-400 col-md-7 col-sm-12">
           
              @foreach($completed_orders as $completed)
              <div class="card text-white box-shadow-0 bg-gradient-radial-warning">
                <div class="card-header">
                  <h4 class="card-title text-white">COMPLETED ORDERS</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                
                <div class="card-content collapse show">
                  <div class="card-body">
                    <div class="row">
                    <div class="col-md-4">
                    <div class="media-left">
                    <a href="#" class="profile-image">
                      <img src="{{URL::asset('public/app-assets/images/portrait/small/avatar-s-8.png')}}" class="rounded-circle img-border height-100"
                      alt="Card image">
                    </a>
                  </div>
                  </div> 
                    <div class="col-md-8">
                   <p>#{{$completed->order_id}}</p>
                    <p>{{$completed->customer_name}}</p>
                    <p>{{$completed->phone}}</p>
                    <div ><button class="btn   btn-success">Order List</button>
                     </div>
                  </div> 
                  </div> 
                  </div>

                </div>
                </div>
              </div>
              @endforeach
            </div>

             
   
            <div class="col-md-5 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">World Map</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content">
                  <div class="card-body height-400">
                    <div id="world-map" class="jqvmap-area"></div>
                     <iframe width="100%" height="300" src="https://maps.google.com/maps?width=100%&height=600&hl=en&q=Malet%20St%2C%20London%20WC1E%207HU%2C%20United%20Kingdom+(Your%20Business%20Name)&ie=UTF8&t=&z=14&iwloc=B&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.mapsdirections.info/en/custom-google-maps/">Create a custom Google Map</a> by <a href="https://www.mapsdirections.info/en/">Measure area on map</a></iframe>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
         
         
        </section>
      </div>
    </div>

    @endsection
 