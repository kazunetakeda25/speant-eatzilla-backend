@extends('layout.master')

@section('title')

{{APP_NAME}}
@endsection

@section('content')

    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">DELIVERIES</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">DASHBOARD</a>
                </li>
                <li class="breadcrumb-item"><a href="deliveries.html">DELIVERIES</a>
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
                  <h4 class="card-title">DELIVERIES</h4>
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
                    <form action="#" class="icons-tab-steps wizard-notification">
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
                    </form>
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                      <thead> 


                          <tr>
                            <th>SI.No</th>
                            <th>Customer Name</th>
                            <th>Delievery People</th>
                            <th>Restaurant</th>
                            <th>Address</th>
                            <th>Cost</th>
                            <th>Status</th> 
                            <th>Order List</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>Saron</td>
                            <td>Test Delivery Boy</td>
                            <td>McDonald</td>
                            <td>23/573</td>
                            <td> ₹130</td>
                            <td> <span class="btn btn-info">COMPLETED</span> </td>
                            <td><button class="btn btn-primary" data-id="1">Order List</button></td>
                          </tr>
                           <tr>
                            <td>2</td>
                            <td>Karthi</td>
                            <td>Test Delivery Boy</td>
                            <td>McDonald</td>
                            <td>23/573</td>
                            <td> ₹130 </td>
                            <td> <span class="btn btn-info">COMPLETED</span> </td>
                            <td><button class="btn btn-primary" data-id="1">Order List</button></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
             <div class="card-block">
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
 