@extends('layout.master')

@section('title')
{{APP_NAME}}
@endsection

@section('content')

 <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">{{strtoUpper(trans('constants.vehicle'))}} {{strtoUpper(trans('constants.list'))}}</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard">{{strtoUpper(trans('constants.dashboard'))}}</a>
                <li class="breadcrumb-item"><a href="#">{{strtoUpper(trans('constants.vehicle'))}} {{strtoUpper(trans('constants.list'))}}</a>
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
                  <h4 class="card-title"></h4>
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
                            <th>{{trans('constants.vehicle')}}</th>
                            <th>{{trans('constants.vehicle_no')}}</th>
                            <th>{{trans('constants.vehicle')}}{{trans('constants.image')}}</th>
                            <th>{{trans('constants.rc_no')}}</th>
                            <th>{{trans('constants.rc_image')}}</th>
                            <th>{{trans('constants.rc')}}{{trans('constants.expiry_date')}}</th>
                            
                            <th>{{trans('constants.insurance_no')}}</th>
                            <th>{{trans('constants.insurance_image')}}</th>
                            <th>{{trans('constants.insurance')}}{{trans('constants.expiry_date')}}</th>
                            <th>Status</th>
                            
                            <!-- <th>Action</th> -->
                          </tr>
                        </thead>
                        <tbody>
                          <!--{{$s_no=1}}-->
                          @foreach($vehicle_list as $vehicle)
                          <tr>
                           
                            <td>{{$s_no}}</td>
                            <td>{{$vehicle->vehicle_name}}</td> 
                            <td>{{$vehicle->vehicle_no}}</td>                           
                            <td>
                              @if($vehicle->vehicle_image !="")
                                @if(file_exists(DOCROOT.VEHICLE_UPLOADS_PATH.$vehicle->vehicle_image))
                                <img src="{{BASE_URL}}{{VEHICLE_UPLOADS_PATH}}{{$vehicle->vehicle_image}}" style="width:8em;">
                                @endif
                              @endif
                            </td>       
                            <td>{{$vehicle->rc_no}}</td>                         
                            <td>
                              @if($vehicle->rc_image !="") 
                                @if(file_exists(DOCROOT.VEHICLE_UPLOADS_PATH.$vehicle->rc_image))
                                <img src="{{BASE_URL}}{{VEHICLE_UPLOADS_PATH}}{{$vehicle->rc_image}}" style="width:8em;">
                                @endif
                              @endif
                            </td>                
                            <td>{{$vehicle->rc_expiry_date}}</td>                    
                            <td>{{$vehicle->insurance_no}}</td>                           
                            <td>
                              @if($vehicle->insurance_image !="") 
                                @if(file_exists(DOCROOT.VEHICLE_UPLOADS_PATH.$vehicle->insurance_image))
                                <img src="{{BASE_URL}}{{VEHICLE_UPLOADS_PATH}}{{$vehicle->insurance_image}}" style="width:8em;">
                                @endif
                              @endif
                            </td>                        
                            <td>{{$vehicle->insurance_expiry_date}}</td>
                            
                            <td>
                            <a href="{{url('/')}}/admin/vehicle_edit/{{$vehicle->id}}" class="button btn btn-icon btn-success mr-1 link_clr"><i class="ft-edit"></i></a>
                            <button class="btn btn-danger">
                              <?php

                            switch ((int) $vehicle->status) {
                              case 1:
                                echo 'Active';
                              break;
                              case 2:
                                echo 'In Active ';
                              break;
                              
                              
                              default:
                                echo 'NULL';
                                break;
                            }
                            ?></button>
                            
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
