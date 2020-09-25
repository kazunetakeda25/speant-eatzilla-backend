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
                <li class="breadcrumb-item"><a href=" ">DELIVERY PEOPLE LIST</a>
                </li>
                <li class="breadcrumb-item"><a href="#">DELIVERIES</a>
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
                          <div class="col-md-6">
                             <div class="form-group">
                              <label for="eventLocation2">Name :</label>
                              <select class="c-select form-control" id="status" name="location">
                                <option value="">Raja</option>
                                <option value="Gowtham">Gowtham</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                          <div class="form-group">
                        <label>Date : </label>
                        <div class="input-group">
                          <input type='text' class="form-control pickadate-arrow" placeholder="Change Formats"/>
                        </div>
                      </div>
                      <button class="pull-right btn btn-danger" style="padding: 8px 10px;">Search</button>
                          </div>
                        </div>
                      </fieldset>
                    </form>
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                      <thead> 
                          <tr>
                            <th>Time</th>
                            <th>Customer Name</th>
                            <th>Delivery People</th>
                            <th>Restaurant</th>
                            <th>Address</th>
                            <th>Cost</th>
                            <th>Status</th>
                            <th>Order List</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>  </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                            </td>
                            <td>
                            
                             </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="card-body">
                     <h3>Total Earning:- </h3>
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
 