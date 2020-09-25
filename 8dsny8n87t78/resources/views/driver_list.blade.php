@extends('layout.master')

@section('title')

{{APP_NAME}}
@endsection

@section('content')
 <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">DELIVERY PEOPLE</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard">{{strtoUpper(trans('constants.dashboard'))}}</a>
                <li class="breadcrumb-item"><a href="#">DELIVERY PEOPLE LIST</a>
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
       <section id="minimal-statistics-bg">
          <div class="row">
            
            
            <div class="col-xl-4 col-lg-6 col-12">
              <div class="card bg-info">
                <div class="card-content">
                  <div class="card-body pb-1">
                    <div class="row text-white">
                      <div class="col-6">
                        <h1><i class="la la-line-chart background-round text-white"></i></h1>
                        <h4 class="pt-1 m-0 text-white">{{$all_drivers}}<i class="la la-arrow-up"></i>
                      </div>
                      <div class="col-6 text-right">
                        <h3 class="text-white mb-2">All Drivers</h3>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-12">
              <div class="card bg-success">
                <div class="card-content">
                  <div class="card-body pb-1">
                    <div class="row text-white">
                      <div class="col-6">
                        <h1><i class="la la-cart-arrow-down background-round text-white"></i></h1>
                        <h4 class="pt-1 m-0 text-white">{{$active_drivers}}<i class="la la-arrow-up"></i></h4>
                      </div>
                      <div class="col-6 text-right">
                        <h3 class="text-white mb-2">Active Drivers</h3>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-12">
              <div class="card bg-danger">
                <div class="card-content">
                  <div class="card-body pb-1">
                    <div class="row text-white">
                      <div class="col-6">
                        <h1><i class="la la-cart-plus background-round text-white"></i></h1>
                        <h4 class="pt-1 m-0 text-white">{{$in_active_drivers}} <i class="la la-arrow-down"></i></h4>
                      </div>
                      <div class="col-6 text-right">
                        <h3 class="text-white mb-2">In Active Drivers</h3>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="col-xl-3 col-lg-6 col-12">
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
            </div> -->
          </div>
        </section>

         <section id="configuration">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-head">
                  <div class="card-header">
                  <h4 class="card-title" style="height:50px;color:red;">
                 </h4>
                  <h4 class="card-title"></h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                  <div class="heading-elements">
                     <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                     <li>  <button class="btn btn-primary btn-sm"><i class="ft-plus white"></i><a style=" color: white !important;" href="{{URL('/')}}/admin/add_new_driver"> Add Delivery People</a></button></li>
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
                            <th>Partner Id</th>
                            <th>Name</th>
                            <!-- <th>Email</th> -->
                            <th>Service Zone</th>
                            <th>Contact Details</th>
                            <th>Availability Status</th>
                            <th>Image</th>
                            <th>Rating</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i=1; ?>
                          @foreach($data as $d)
                          <tr>
                            <td>
                              {{$i}}
                            </td>
                            <td>{{$d->partner_id}}
                            <td>{{$d->name}}</td>
                            <!-- <td>{{$d->email}}</td> -->
                            <td>@isset($d->Deliverypartner_detail->Citylist) {{$d->Deliverypartner_detail->Citylist->city}} @endisset</td>
                            <td>{{$d->phone}}</td>
                            <td>
                              @php
                                try{
                                  $status = file_get_contents(FIREBASE_URL."/available_providers/".$d->id.".json");
                                }catch(Exception $e){
                                  $status = "null";
                                }
                              @endphp
                              @if($status!="null") <b class="text-success"> Online <b> @else <b class="text-danger"> Offline <b> @endif
                            </td>
                            <td><img src="{{$d->profile_pic}}" width="100px" alt=""></td>
                            <td>
                            @if(isset($d->Foodrequest))
                              @php 
                                $total = 0; 
                                $total_count = 0; 
                                $rating = 0; 
                              @endphp

                              @foreach($d->Foodrequest as $d1)
                                @if(isset($d1['OrderRatings']))
                                    @php
                                    $total += $d1['OrderRatings']['delivery_boy_rating'];
                                    $total_count = $total_count+1;
                                    @endphp
                                @endif
                              @endforeach

                            @if($total_count != 0 && $total != 0)
                              <!-- ($total / ($total_count-1)); -->
                              @php 
                                $rating = $total / ($total_count);
                              @endphp
                                
                              <!--isset orderrating checked rating-->

                              @for($x=1;$x<=(float)$rating;$x++) 
                              <i class="fa fa-star" style="color: #e6910d;font-size: 17px;"></i> 
                              @endfor

                              @if(strpos((float)$d->rating,'.'))
                              <i class="fa fa-star-half-o" style="color: #e6910d;font-size: 17px;"></i>
                              @php $x++; @endphp
                              @endif

                              @while ($x<=5)
                              <i class="fa fa-star-o" style="color: #e6910d;font-size: 17px;"></i>
                              @php $x++; @endphp
                              @endwhile 

                              <!-- -->

                            @else <!--isset orderrating false-->
                              @for($l=1;$l<=5; $l++)
                                 <span class="fa fa-star-o" style="color: #e6910d;font-size: 17px;"></span>
                              @endfor
                            @endif <!-- -->
                            @else <!--isset request false-->
                              @for($m=1;$m<=5; $m++)
                               <span class="fa fa-star-o" style="color: #e6910d;font-size: 17px;"></span>
                              @endfor
                            @endif <!-- -->
                            </td>
                            <td>
                              <button class="btn btn-primary btn-sm"><i class="ft-map white"></i><a style=" color: white !important;" href="{{URL('/')}}/admin/track_driver/{{$d->id}}"> Track</a></button>
                            </td>
                            <td>
                            <!-- <button class="table-btn btn btn-icon btn-danger" form="resource-settle-55">Unsettle</button> -->
                            <li><a href="{{url('/')}}/admin/edit_delivery_boy_details/{{$d->id}}" class="button btn btn-icon btn-success mr-1 link_clr"><i class="ft-edit"></i></a>
                              <a href="{{url('/')}}/admin/view_delivery_boy_order_details/{{$d->id}}" class="button btn btn-icon btn-success mr-1 link_clr"><i class="ft-eye"></i></a>
                              <button type="button" class="btn btn-icon btn-success mr-1 link_clr" data-id="1" data-toggle="modal"  data-target="#{{$d->id}}"><i class="ft-delete"></i></button>
                             </td>
                          </tr>

                                    <!---  Delete Delivery Partner Model -->

                                <div class="modal animated slideInRight text-left" id="{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel76" aria-hidden="true">
                                       <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                         <div class="modal-header">
                                          <h4 class="modal-title" id="myModalLabel76">Delete Delivery Partner</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                         </div>
                                         <form method="post" action="{{url('/')}}/admin/delete_delivery_partner">
                                            <div class="modal-body">
                                              
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                  <input type="hidden" name="id" value="{{$d->id}}">
                                                 <div class="form-group">
                                                    <label for="eventName2">Are you sure to delete delivery partner : {{$d->partner_id}}</label>
                                                  </div>
                                            
                                            </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-warning mr-1" data-dismiss="modal" style="padding: 10px 15px;">
                                                   <i class="ft-x"></i> Cancel
                                                    </button>
                                                  <button type="submit" class="btn btn-primary mr-1" style="padding: 10px 15px;">
                                                <i class="ft-check-square"></i> Delete
                                                 </button>
                                            </div>
                                          </form>
                                      </div>
                                    </div>
                                  </div>
                                   <!--  Delete Delivery Partner Model Ends-->
                          <?php $i++; ?>
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
 