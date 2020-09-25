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
        .link_clr{
          color: white;
        }
        .height-150 {
    height: 100px !important;
    width: 100px;
}
</style>

 
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0 d-inline-block">{{trans('constants.restaurant')}}</h3>
        </div>
      </div>
      <div class="content-body">
       <div class="card">
         <div class="card-head">
                  <div class="card-header">
                  <h4>Restaurant Full Details : </h4>
                    </div>
                </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-12">
            <div class="row m-1">
                <dt class="col-sm-3 order-txt p-0">Restaurant Name </dt>
                <dd class="col-sm-9 order-txt "><span>: {{$restaurant->restaurant_name}}</span> </dd>
            </div>
            <div class="row m-1">
                <dt class="col-sm-3 order-txt p-0">Email </dt>
                <dd class="col-sm-9 order-txt "><span>: {{$restaurant->email}}</span> </dd>
            </div>
            <div class="row m-1">
                <dt class="col-sm-3 order-txt p-0">City </dt>
                <dd class="col-sm-9 order-txt "><span>: {{$restaurant->city_list->city}}</span> </dd>
            </div>
             <div class="row m-1">
                <dt class="col-sm-3 order-txt p-0">Area </dt>
                <dd class="col-sm-9 order-txt "><span>: {{$restaurant->Area->area}}</span> </dd>
            </div>
            <div class="row m-1">
                <dt class="col-sm-3 order-txt p-0">Contact </dt>
                <dd class="col-sm-9 order-txt "><span>: {{$restaurant->phone}}</span> </dd>
            </div>
                
            </div>
            <!-- <div class="col-xl-6 col-lg-6 col-12 pt-3 px-2">
                <a href="#" class="profile-image card-header">
                      <img src="" class="rounded-circle img-border height-150"
                      alt="Card image">
                    </a>
                    <p class="card-header"><b style=" margin: 36px;">Truck Image</b></p>
            </div> -->
          </div>
        </div>
       </div>    

      <div class="content-body">
       <div class="card"> 
        <div class="card-header">
         <h3>About Restaurant : </h3>
         <br>
            <div class="row m-1">
                <dt class="col-sm-3 order-txt p-0">Delivery Type </dt>
                @php
                 $delivery_type = json_decode($restaurant->delivery_type);
                @endphp
                @if(!empty($delivery_type))
                  <dd class="col-sm-9 order-txt ">
                  @for($i=0; $i<count($delivery_type); $i++)
                    @if($delivery_type[$i]==1) <span>  Delivery</span> <br>@endif
                    @if($delivery_type[$i]==2) <span>  Pickup </span><br> @endif
                    @if($delivery_type[$i]==3) <span>  Dining </span><br> @endif
                  @endfor
                  </dd>
                @endif
            </div>
            <div class="row m-1">
                <dt class="col-sm-3 order-txt p-0">Cuisines List </dt>
                @if(!empty($restaurant->Cuisines))
                <dd class="col-sm-9 order-txt ">
                  @foreach($restaurant->Cuisines as $val)
                    <span>  {{$val->name}} </span> <br>
                  @endforeach
                  </dd>
                @endif
            </div>             
            <div class="row m-1">
                <dt class="col-sm-3 order-txt p-0">Packaging Charge </dt>
                <dd class="col-sm-9 order-txt "><span>: {{$restaurant->packaging_charge}}</span> </dd>
            </div>
            <div class="row m-1">
                <dt class="col-sm-3 order-txt p-0">Description </dt>
                <dd class="col-sm-9 order-txt "><span>: {{$restaurant->shop_description}}</span> </dd>
            </div>
            <div class="row m-1">
                <dt class="col-sm-3 order-txt p-0">Status </dt>
                <dd class="col-sm-9 order-txt "><span>:<button class="btn btn-danger">
                             
                              <?php

                            switch ((int) $restaurant->status) {
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
                            ?></button></span> </dd>
            </div>
             <div class="row m-1">
                <dt class="col-sm-3 order-txt p-0">Address </dt>
                <dd class="col-sm-9 order-txt "><span>: {{$restaurant->address}}</span> </dd>
            </div>
            <div class="row m-1">
                <dt class="col-sm-3 order-txt p-0">Offer Percentage </dt>
                <dd class="col-sm-9 order-txt "><span>: {{$restaurant->offer_percentage}}</span> </dd>
            </div>
                
            
            
       </div>
        </div>
      </div>

      <div class="content-body">
       <div class="card"> 
        <div class="card-header">
         <h3>Restaurant Hours : </h3><br>
         <div class="row m-1">
            <dt class="col-sm-3 order-txt p-0">{{trans('constants.estimate_delivery_time')}} </dt>
            <dd class="col-sm-9 order-txt "><span>: {{$restaurant->estimated_delivery_time}} {{trans('constants.mins')}}</span> </dd>
        </div>
         <h5>{{trans('constants.res_timing_weekday')}} </h5>
         @foreach($restaurant->RestaurantTimer as $time)
          @if($time->is_weekend==0)
            <div class="row m-1">
              <dt class="col-sm-3 order-txt p-0">{{trans('constants.res_opens')}} </dt>
              <dd class="col-sm-3 order-txt "><span>: {{$time->opening_time}}</span> </dd>
              <dt class="col-sm-3 order-txt p-0">{{trans('constants.res_close')}}</dt>
              <dd class="col-sm-3 order-txt "><span>: {{$time->closing_time}} </span> </dd>
            </div>
           @endif
          @endforeach
          
         <h5>{{trans('constants.res_timing_weekend')}} </h5>
         @foreach($restaurant->RestaurantTimer as $time)
          @if($time->is_weekend==1)
            <div class="row m-1">
              <dt class="col-sm-3 order-txt p-0">{{trans('constants.res_opens')}} </dt>
              <dd class="col-sm-3 order-txt "><span>: {{$time->opening_time}}</span> </dd>
              <dt class="col-sm-3 order-txt p-0">{{trans('constants.res_close')}}</dt>
              <dd class="col-sm-3 order-txt "><span>: {{$time->closing_time}} </span> </dd>
            </div>
           @endif
          @endforeach

       </div>
        </div>
      </div>

       <div class="content-body">
       <div class="card"> 
        <div class="card-header">
         <h3>Offer Details : </h3><br>
         <div class="row m-1">
                <dt class="col-sm-3 order-txt p-0">Discount Type </dt>
                <dd class="col-sm-9 order-txt "><span>: <button class="btn btn-danger">
                             
                              <?php

                            switch ((int) $restaurant->discount_type) {
                              case 1:
                                echo 'Flat Offer';
                              break;
                              case 2:
                                echo 'Percentage Offer ';
                              break;
                              
                              
                              default:
                                echo 'NULL';
                                break;
                            }
                            ?></button></span> </dd>
            </div>
            <div class="row m-1">
                <dt class="col-sm-3 order-txt p-0">Target Amount</dt>
                <dd class="col-sm-9 order-txt "><span>: {{$restaurant->target_amount}} </span> </dd>
            </div>
         <div class="row m-1">
                <dt class="col-sm-3 order-txt p-0">Offer Amount </dt>
                <dd class="col-sm-9 order-txt "><span>: {{$restaurant->offer_amount}}</span> </dd>
            </div>
            <div class="row m-1">
                <dt class="col-sm-3 order-txt p-0">{{trans('constants.admin_commision')}} % </dt>
                <dd class="col-sm-9 order-txt "><span>: {{$restaurant->admin_commision}}%</span> </dd>
            </div>
            <div class="row m-1">
                <dt class="col-sm-3 order-txt p-0">{{trans('constants.driver_commission')}} % </dt>
                <dd class="col-sm-9 order-txt "><span>: {{$restaurant->driver_commision}}%</span> </dd>
            </div>
            <div class="row m-1">
                <dt class="col-sm-3 order-txt p-0">{{trans('constants.restaurant')}} {{trans('constants.delivery_charge')}} </dt>
                <dd class="col-sm-9 order-txt "><span>: {{$restaurant->restaurant_delivery_charge}}</span> </dd>
            </div>
          
       </div>
        </div>
      </div>
        <!-- // Basic form layout section end -->
      </div>
   <!-- // Basic form layout section end -->
      
 

   @endsection     
