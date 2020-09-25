@extends('layout.master')

@section('title')

{{APP_NAME}}
@endsection

@section('content')
<style>
  .onChat {
    position: absolute;
    margin: 0px 0 0px 33px;
}
.chatIcon {
    margin: 45px 0px;
}
</style>

   <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">{{strtoUpper($title)}} {{strtoUpper(trans('constants.order'))}} {{strtoUpper(trans('constants.list'))}}</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/order_dashboard">{{strtoUpper(trans('constants.order'))}} {{strtoUpper(trans('constants.dashboard'))}}</a>
                </li>
                <li class="breadcrumb-item"><a href="#">{{strtoUpper($title)}} {{strtoUpper(trans('constants.order'))}} {{strtoUpper(trans('constants.list'))}}</a>
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
                  <h4 class="card-title"></h4>
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
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                      <thead> 
                          <tr>
                            <th>{{trans('constants.sno')}}</th>
                            <th>{{trans('constants.order_id')}}</th>
                            <th>Order Created on</th>
                            <th>{{trans('constants.customer')}} {{trans('constants.name')}}</th>
                            <th>{{trans('constants.delivery_people')}}</th>
                            <th>{{trans('constants.restaurant')}}</th>
                            <th>{{trans('constants.address')}}</th>
                            <th>Order Date</th>
                            <th>{{trans('constants.total')}}</th>
                            <th>{{trans('constants.order_det')}}</th>
                            @if($title!='cancelled')
                            <th>{{trans('constants.support')}}</th>
                            @endif
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php $i=1; @endphp
                          @foreach($data as $val)
                          <tr>
                            <td>{{$i}}</td>
                            <td>{{$val->order_id}}</td>
                            <td>{{$val->ordered_time}}</td>
                            <td>@isset($val->Users) {{$val->Users->name}} <br>{{$val->Users->phone}} @endisset</td>
                            <td>@isset($val->Deliverypartners) {{$val->Deliverypartners->name}} @endisset</td>
                            <td>@isset($val->Restaurants) {{$val->Restaurants->restaurant_name}}<br>
                            {{$val->Restaurants->phone}} @endisset</td>
                            <td>{{$val->delivery_address}}</td>
                            <td>{{date("Y-m-d h:i a",strtotime($val->ordered_time))}}</td>
                            <td>{{DEFAULT_CURRENCY_SYMBOL}} {{$val->bill_amount}}</td>
                            <td>   
                               <a href="{{url('/')}}/admin/view_order/{{$val->id}}" class="btn btn-success">{{trans('constants.view')}} {{trans('constants.order')}}</a>
                          </td>
                           @if($title!='cancelled')
                          <td>
                            @if(session()->get('role')==1)
                            <a href="{{url('/')}}/admin/web_chat/2/{{$val->id}}" class="btn btn-sm btn-primary" style="margin-bottom: 2px;">User chat
                              @if($val->chatcount!=0)<span class="badge badge-pill badge-default badge-danger badge-glow badge-default onChat" id="new_order">{{$val->chatcount}}</span>@endif
                              <!-- <i  class="fa fa-comments-o chatIcon" aria-hidden="true" style='font-size:48px;color:blue'></i> -->
                            </a>
                            @endif
                            <a href="{{url('/')}}/admin/web_chat/3/{{$val->id}}" class="btn btn-sm btn-primary" style="margin-bottom: 2px;">@if(session()->get('role')==1) Restaurant chat @else Admin chat @endif
                            @if($val->res_chatcount!=0)<span class="badge badge-pill badge-default badge-danger badge-glow badge-default onChat" id="new_order">{{$val->res_chatcount}}</span>@endif
                            </a>
                            @if($val->delivery_boy_id!=0 && session()->get('role')==1)
                            <a href="{{url('/')}}/admin/web_chat/4/{{$val->id}}" class="btn btn-sm btn-primary" style="margin-bottom: 2px;">Driver chat
                            @if($val->driver_chatcount!=0)<span class="badge badge-pill badge-default badge-danger badge-glow badge-default onChat" id="new_order">{{$val->driver_chatcount}}</span>@endif
                            </a>
                            @endif
                          </td>
                           @endif
                          <td>

                            @if($val->status==0)
                              @if(session()->get('role')==1)
                                <a href="#">{{trans('constants.wait_for_accept')}}</a>
                              @else
                                <a href="{{url('/')}}/admin/accept_request/{{$val->id}}" class="btn btn-info">{{trans('constants.accept')}}</a>
                                <a href="{{url('/')}}/admin/cancel_request/{{$val->id}}" class="btn btn-info">{{trans('constants.cancel')}}</a>
                              @endif
                            @endif
                            @if($val->status==1)
                              @if(session()->get('role')==1)
                                <a href="#">{{trans('constants.wait_for_assign')}}</a>
                              @else
                                <a href="{{url('/')}}/admin/assign_request/{{$val->id}}" class="btn btn-info">{{trans('constants.assign')}}</a>
                                <a href="{{url('/')}}/admin/cancel_request/{{$val->id}}" class="btn btn-info">{{trans('constants.cancel')}}</a>
                              @endif
                            @endif
                            @if($val->status==2)
                            <a href="#">{{trans('constants.food_prepare')}}</a>
                            @endif
                            @if($val->status==3)
                            <a href="#">{{trans('constants.deliveryboy_assigned')}}</a>
                            @endif
                            @if($val->status==4)
                            <a href="#">{{trans('constants.order_pickup')}}</a>
                            @endif
                            @if($val->status==5)
                            <a href="#">{{trans('constants.onthe_way')}}</a>
                            @endif
                            @if($val->status==6)
                            <a href="#">{{trans('constants.pending_pay')}}</a>
                            @endif
                            @if($val->status==7)
                            <a href="#">{{trans('constants.complete')}}</a>
                            @endif
                            @if($val->status == 10)
                            <a href="#">{{trans('constants.cancelled')}}</a>
                            @endif
                            @if(session()->get('role')==1)
                              <a href="{{url('/')}}/admin/assign_request/{{$val->id}}" class="btn btn-info">{{trans('constants.assign')}}</a>
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
 