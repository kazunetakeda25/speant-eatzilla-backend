@extends('layout.master')

@section('title')

{{APP_NAME}}

@endsection

@section('content')
 <style>
     .checked {
         color: orange;
        }
       ul {
         list-style-type: none;
        }
        /* .link_clr{
          color: white;
        }
        a:hover{
          color: white !important;
        } */
            .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
@php $restaurantAccess = explode(",",auth()->user()->AccessPrivilages->restaurant); @endphp
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">{{strtoUpper(trans('constants.restaurant'))}}</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard">{{strtoUpper(trans('constants.dashboard'))}}</a>
                <li class="breadcrumb-item"><a href="#">{{strtoUpper(trans('constants.restaurant'))}} {{strtoUpper(trans('constants.list'))}}</a>
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
                  <h4 class="card-title">&nbsp;</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                  <div class="heading-elements">
                     <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                     <li @if(auth()->user()->role==3 && !in_array(2,(array)$restaurantAccess)) style="display:none" @endif> <button class="btn btn-primary btn-sm"><i class="ft-plus white"></i><a style=" color: white !important;" href="{{URL('/')}}/admin/add_restaurant"> Add Restaurant</a></button></li>
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
                            <th>SI.No</th>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Image</th>
                            <th>Address</th>
                            <th>Contact Details</th>
                            <th>Credit Status</th>
                            <th>Rating</th>
                            <th @if(auth()->user()->role==3 && !in_array(2,(array)$restaurantAccess)) style="display:none" @endif>status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                           <?php $i = 1;  ?>
                            @foreach($data as $d)
                          <tr>
                            <td>{{$i}}</td>
                            <td>{{$d->restaurant_name}}</td>
                            <td>{{$d->email}}</td>
                            <td><img src="{{RESTAURANT_UPLOADS_PATH.$d->image}}" width="100px" alt=""></td>
                            <td>{{$d->address}}</td>
                            <td>{{$d->phone}}</td>
                            <td>@if($d->credit_accept==1) <strong style="color:green">Credit</strong> @else - @endif</td>
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
                                    $total += $d1['OrderRatings']['restaurant_rating'];
                                    $total_count = $total_count+1;
                                    @endphp
                                @endif
                              @endforeach

                            @if($total_count != 0 && $total != 0)

                              @php 
                                $rating = ($total / ($total_count)); 
                              @endphp
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
                              <!--isset orderrating checked rating-->

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
                            <td @if(auth()->user()->role==3 && !in_array(5,(array)$restaurantAccess)) style="display:none" @endif>
                            @if($d->status == 1)
                              <label class="switch">
                                   <input type="checkbox" name="status" onclick="javascript:window.location.href='{{url('/')}}/admin/status_disable/{{$d->id}}'" value="1" 
                              @if(isset($d->status)){{($d->status==1)?"checked":"" }}@endif>                       
                              <span class="slider round checked"></span></label>
                              @else
                              <label class="switch">
                                   <input type="checkbox" name="status" onclick="javascript:window.location.href='{{url('/')}}/admin/status_enable/{{$d->id}}'" value="1" 
                              @if(isset($d->status)){{($d->status==1)?"checked":"" }}@endif>                       
                              <span class="slider round checked"></span></label>
                              @endif
                            </td>
                            <td>
                              <ul>
                        
                              <li>
                                <a href="{{url('/')}}/admin/restaurant_view/{{$d->id}}" class="button btn btn-icon btn-success mr-1 link_clr"><i class="ft-eye"></i></a>
                                <a href="{{url('/')}}/admin/edit_restaurant/{{$d->id}}" class="button btn btn-icon btn-success mr-1 link_clr" @if(auth()->user()->role==3 && !in_array(3,(array)$restaurantAccess)) style="display:none" @endif><i class="ft-edit"></i></a>
                                <button type="button" class="btn btn-icon btn-success mr-1 link_clr" data-id="1" data-toggle="modal"  data-target="#{{$d->id}}" @if(auth()->user()->role==3 && !in_array(4,(array)$restaurantAccess)) style="display:none" @endif><i class="ft-delete"></i></button>
                                </li>
                             </ul>
                            </td>
                          </tr>

                          <!--- Deleted Restaurant / Model -->
                                  <div class="modal animated slideInRight text-left" id="{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel76" aria-hidden="true">
                                       <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                         <div class="modal-header">
                                          <h4 class="modal-title" id="myModalLabel76">Delete Restaurant</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                         </div>
                                         <form method="post" action="{{url('/')}}/admin/delete_restaurant/{{$d->id}}">
                                            <div class="modal-body">
                                              
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                  <input type="hidden" name="id" value="{{$d->id}}">
                                                 <div class="form-group">
                                                    <label for="eventName2">Are you sure to delete restaurant : {{$d->restaurant_name}}
                                                    <br>Some Food Items are based on this Restaurant will also be deleted.
                                                    </label>
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

                          <!--- End Deleted Restaurant / Modulel -->

                          <?php $i = $i+1; ?>
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
 