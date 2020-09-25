 	
 @extends('layout.master')

@section('title')

{{APP_NAME}}
@endsection

@section('content')

 
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <!-- Revenue, Hit Rate & Deals -->


      <section id="minimal-statistics-bg">
          <div class="row">
             <div class="col-xl-3 col-lg-6 col-12">
              <div class="card bg-primary">
                <div class="card-content">
                  <div class="card-body pb-1">
                    <div class="row text-white">
                      <div class="col-6">
                        <h1><i class="la la-hand-o-up background-round text-white"></i></h1>
                        <h4 class="pt-1 m-0 text-white">5 <i class="la la-arrow-up"></i></h4>
                      </div>
                      <div class="col-6 text-right">
                        <h3 class="text-white mb-2">New Orders</h3>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
           
            <div class="col-xl-3 col-lg-6 col-12">
              <div class="card bg-success">
                <div class="card-content">
                  <div class="card-body pb-1">
                    <div class="row text-white">
                      <div class="col-6">
                        <h1><i class="la la-cart-arrow-down background-round text-white"></i></h1>
                        <h4 class="pt-1 m-0 text-white">5 <i class="la la-arrow-up"></i></h4>
                      </div>
                      <div class="col-6 text-right">
                        <h3 class="text-white mb-2">Orders Received</h3>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
              <div class="card bg-danger">
                <div class="card-content">
                  <div class="card-body pb-1">
                    <div class="row text-white">
                      <div class="col-6">
                        <h1><i class="la la-cart-plus background-round text-white"></i></h1>
                        <h4 class="pt-1 m-0 text-white">3 <i class="la la-arrow-down"></i></h4>
                      </div>
                      <div class="col-6 text-right">
                        <h3 class="text-white mb-2">Orders Delivered</h3>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
              <div class="card bg-info">
                <div class="card-content">
                  <div class="card-body pb-1">
                    <div class="row text-white">
                      <div class="col-6">
                        <h1><i class="la la-line-chart background-round text-white"></i></h1>
                        <h4 class="pt-1 m-0 text-white">$200 <i class="la la-arrow-up"></i>
                      </div>
                      <div class="col-6 text-right">
                        <h3 class="text-white mb-2">Today Earnings</h3>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
              <div class="card bg-warning">
                <div class="card-content">
                  <div class="card-body pb-1">
                    <div class="row text-white">
                      <div class="col-6">
                        <h1><i class="la la-money background-round text-white"></i></h1>
                        <h4 class="pt-1 m-0 text-white">82% <i class="la la-arrow-up"></i>
                      </div>
                      <div class="col-6 text-right">
                        <h3 class="text-white mb-2">Monthly Earnings</h3>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- PRODUCTS SALES -->
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">PRODUCTS SALES</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">
                    <div id="basic-area" class="height-400 echart-container"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">RECENT DELIVERIES</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>

              <div class="card-content">
                <div class="card-body  py-4 px-0">
                  <div class="list-group">
                    <a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left pr-1">
                          <span class="avatar avatar-sm avatar-online rounded-circle">
                            <img src="{{URL::asset('public/app-assets/images/portrait/small/avatar-s-1.png')}}" alt="avatar"><i></i></span>
                        </div>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">Margaret Govan
                            <span class="amount-right">$26</span></h6>
                         <span class="badge badge-success">Delivered</span>
                        </div>
                      </div>
                    </a>
                    <a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left pr-1">
                          <span class="avatar avatar-sm avatar-busy rounded-circle">
                            <img src="{{URL::asset('public/app-assets/images/portrait/small/avatar-s-2.png')}}" alt="avatar"><i></i></span>
                        </div>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">Bret Lezama
                            <span class="amount-right">$106</span></h6>
                           <span class="badge badge-danger">Cancelled</span>
                        </div>
                      </div>
                    </a>
                    <a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left pr-1">
                          <span class="avatar avatar-sm avatar-online rounded-circle">
                            <img src="{{URL::asset('public/app-assets/images/portrait/small/avatar-s-3.png')}}" alt="avatar"><i></i></span>
                        </div>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">Carie Berra
                            <span class="amount-right">$56</span></h6>
                           <span class="badge badge-success">Delivered</span>
                        </div>
                      </div>
                    </a>
                    <a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left pr-1">
                          <span class="avatar avatar-sm avatar-away rounded-circle">
                            <img src="{{URL::asset('public/app-assets/images/portrait/small/avatar-s-6.png')}}" alt="avatar"><i></i></span>
                        </div>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">Eric Alsobrook
                            <span class="amount-right">$266</span></h6>
                          <span class="badge badge-warning">Pending</span>
                        </div>
                      </div>
                    </a>
                    <a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-left pr-1">
                          <span class="avatar avatar-sm avatar-away rounded-circle">
                            <img src="{{URL::asset('public/app-assets/images/portrait/small/avatar-s-8.png')}}" alt="avatar"><i></i></span>
                        </div>
                        <div class="media-body">
                          <h6 class="media-heading mb-0">John Alsobrook 
                        <span class="amount-right">$156</span></h6> 
                            <span class="badge badge-warning">Pending</span>
                        
                        
                      
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
                </div>
                
              </div>
            </div>
          </div>


 <section id="dom">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">RECENT ORDERS</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                    <p class="card-text">Total paid invoices <span>$240</span>, unpaid <span>$150</span>. 
                      <span class="amount-right"><a href="#">Invoice Summary <i class="ft-arrow-right"></i></a></span></p></p>
                       <div class="table-responsive">
                    <table class="table table-striped table-bordered dom-jQuery-events">
                      <thead>
                        <tr>
                           <th>Order Id</th>
                          <th>Customer Name</th>
                          <th>Restaturant Name</th>
                          <th>Delivery People</th>
                          <th>Status</th>
                          <th>Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>39</td>
                          <td>Shiva</td>
                          <td>Edinburgh</td>
                          <td></td>
                          <td> <span class="badge badge-success">RECEIVED</span></td>
                          <td>$20,800</td>
                        </tr>
                        <tr>
                          <td>27</td>
                          <td>Arun</td>
                          <td>Tokyo</td>
                          <td></td>
                          <td><span class="badge badge-success">RECEIVED</span></td>
                          <td>$170,750</td>
                        </tr>
                        <tr>
                          <td>43</td>
                          <td>Jhon</td>
                          <td>San Francisco</td>
                          <td></td>
                          <td><span class="badge badge-success">RECEIVED</span></td>
                          <td>$86,000</td>
                        </tr>
                        <tr>
                          <td>23</td>
                          <td>Senthil</td>
                          <td>Edinburgh</td>
                          <td></td>
                          <td><span class="badge badge-success">RECEIVED</span></td>
                          <td>$33,060</td>
                        </tr>
                        <tr>
                          <td>44</td>
                          <td>Karthi</td>
                          <td>Tokyo</td>
                          <td></td>
                          <td><span class="badge badge-success">RECEIVED</span></td>
                          <td>$162,700</td>
                        </tr>
                        <tr>
                          <td>34</td>
                          <td>Praveen</td>
                          <td>New York</td>
                          <td></td>
                          <td><span class="badge badge-warning">PENDING</span></td>
                          <td>$72,000</td>
                        </tr>
                      </tbody>
                      
                    </table>
                   </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>


      </div>
    </div>
  </div>
@endsection