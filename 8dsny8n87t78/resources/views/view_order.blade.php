@extends('layout.master')

@section('title')

{{APP_NAME}}

@endsection

@section('content')
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">{{strtoUpper(trans('constants.order'))}} </h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="{{url('/')}}/admin/order_dashboard">{{strtoUpper(trans('constants.order'))}} {{strtoUpper(trans('constants.dashboard'))}}</a>
                </li> 
                <li class="breadcrumb-item"><a href="#">{{strtoUpper(trans('constants.order_det'))}}</a>
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-body">
        <!-- card-1 start -->
        <section id="configuration">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-head">
                  <div class="card-header">
                    <h4 class="card-title"><i class="la la-home"></i> {{trans('constants.order_det')}} 
                    <a href="{{url('/')}}/admin/generate_pdf/{{$data->id}}" style="float:right" target="_blank" class="btn btn-primary btn-sm"><b style="font-size: 16px;">Invoice</b></a>
                    </h4>
                    <hr><br>
                  </div>
                </div>

                <div class="row order" style="margin-top: -40px;">
                  <div class="col-xl-12 col-lg-12 col-md-12">
                    <h3>{{trans('constants.order_id')}} : <span class="id-color">{{$data->order_id}}</span></h3>
                    <p class="order-p"><span>{{trans('constants.order_det')}}</span></p>
                  </div>
                </div>
                  
            </div>
          </div>
        </section>
        <!-- card-1 end -->

        <!-- card-2 start -->
        <section id="configuration">
          <div class="row create">
            <div class="col-12">
              <div class="card">
                <div class="row" style="margin-left: 30px;">
                  <div class="col-xl-6 col-lg-6 col-md-6 pt-3 px-2">
                    <p>{{trans('constants.delivery_date')}}: {{ date('M d, Y  h:i A',strtotime($data->ordered_time))}}</p>
                    <h4>{{trans('constants.status')}} </h4>
                    <h3>       @php

                            switch ((int) $data->status) {
                              case 0:
                                echo 'New';
                              break;
                              case 1:
                                echo 'Order Accepted';
                              break;
                              case 2:
                                echo 'Delivery boy assigned';
                              break;
                              case 3:
                                echo 'Food delivered to Delivery boy';
                              break;
                              case 4:
                                echo 'Towards Customer';
                              break;
                              case 5:
                                echo 'Reached Customer';
                              break;
                              case 6:
                                echo 'Delivered to Customer';
                              break;
                              case 7:
                                echo 'Completed';
                              break;
                              
                              default:
                                echo ' Cancelled';
                                break;
                            }
                            @endphp</h3>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 pt-3 px-2">
                    <h4>{{strtoUpper(trans('constants.customer'))}} </h4>
                    <div class="row m-1">
                          <dt class="col-sm-3 order-txt p-0"> {{trans('constants.name')}}:</dt>
                          <dd class="col-sm-9 order-txt "><span> @isset($data->Users->name) {{$data->Users->name}} @endisset</span> </dd>
                    </div>   
                    <div class="row m-1">
                        <dt class="col-sm-3 order-txt p-0"> {{trans('constants.phone')}}: </dt>
                        <dd class="col-sm-9 order-txt "><span>@isset($data->Users->phone) {{$data->Users->phone}} @endisset</span> </dd>
                    </div>
                    <div class="row m-1">
                        <dt class="col-sm-3 order-txt p-0"> {{trans('constants.email')}}: </dt>
                        <dd class="col-sm-9 order-txt "><span>@isset($data->Users->email) {{$data->Users->email}} @endisset</span> </dd>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- card-2 end -->
        
        <!-- card-3 start -->
        <section id="configuration">
          <div class="row">
            <div class="col-12">
              <div class="card padding-bottom-30">
                <div class="row card-padding-20">
                  <div class="col-xl-6 col-lg-6 col-md-6 pt-3 px-2">
                    <div class="border">
                      <h4 class="h4-design-1"><b><i class="la la-user"></i>&nbsp;&nbsp; {{trans('constants.user')}}</b> {{trans('constants.details')}}</h4>
                      <div class="my-card-0">
                        <div class="row m-1">
                          <dt class="col-sm-4 order-txt p-0"> {{trans('constants.user')}}{{strtoLower(trans('constants.name'))}}</dt>
                          <dd class="col-sm-8 order-txt "><span>:  @isset($data->Users->name) {{$data->Users->name}} @endisset</span> </dd>
                        </div>   
                        <div class="row m-1">
                          <dt class="col-sm-4 order-txt p-0"> {{trans('constants.email')}} </dt>
                          <dd class="col-sm-8 order-txt "><span>: @isset($data->Users->email) {{$data->Users->email}} @endisset</span> </dd>
                        </div>
                        <div class="row m-1">
                          <dt class="col-sm-4 order-txt p-0"> {{trans('constants.phone')}}  </dt>
                          <dd class="col-sm-8 order-txt "><span>:  @isset($data->Users->phone) {{$data->Users->phone}} @endisset </span> </dd>
                        </div>                        
                      </div>
                    </div>
                  </div>
                  @isset($data->Restaurants)
                  <div class="col-xl-6 col-lg-6 col-md-6 pt-3 px-2">
                    <div class="border">
                      <h4 class="h4-design-2"><b><i class="la la-cutlery"></i>&nbsp;&nbsp;{{trans('constants.restaurant')}}</b> {{trans('constants.details')}}</h4>
                      <div class="my-card">
                        <div class="row m-1">
                          <dt class="col-sm-5 order-txt p-0"> {{trans('constants.name')}}</dt>
                          <dd class="col-sm-7 order-txt "><span>: {{$data->Restaurants->restaurant_name}}</span> </dd>
                        </div>   
                        <div class="row m-1">
                          <dt class="col-sm-5 order-txt p-0"> {{trans('constants.email')}} </dt>
                          <dd class="col-sm-7 order-txt "><span>: {{$data->Restaurants->email}}</span> </dd>
                        </div>
                        <div class="row m-1">
                          <dt class="col-sm-5 order-txt p-0"> {{trans('constants.phone')}} </dt>
                          <dd class="col-sm-7 order-txt "><span>: {{$data->Restaurants->phone}}</span> </dd>
                        </div> 
                        <div class="row m-1">
                          <dt class="col-sm-5 order-txt p-0"> {{trans('constants.address')}} 1</dt>
                          <dd class="col-sm-7 order-txt "><span>: {{$data->Restaurants->address}}</span> </dd>
                        </div>        
                        <div class="row m-1">
                          <dt class="col-sm-5 order-txt p-0"> {{trans('constants.city')}}</dt>
                          <dd class="col-sm-7 order-txt "><span>: @if(!empty($data->Restaurants->city_list)) {{$data->Restaurants->city_list->city}} @endif</span> </dd>
                        </div> 
                        <div class="row m-1">
                          <dt class="col-sm-5 order-txt p-0"> {{trans('constants.area')}}</dt>
                          <dd class="col-sm-7 order-txt "><span>: @if(!empty($data->Restaurants->Area)) {{$data->Restaurants->Area->area}} @endif</span> </dd>
                        </div> 
                      </div>
                    </div>
                  </div>@endisset
                </div>
                <div class="row card-padding-20">
                  @isset($data->Deliverypartners)
                  <div class="col-xl-6 col-lg-6 col-md-6 pt-3 px-2">
                    <div class="border">
                      <h4 class="h4-design-3"><b><i class="la la-truck"></i>&nbsp;&nbsp;{{trans('constants.driver')}}</b> {{trans('constants.details')}}</h4>
                      <div class="my-card">
                        <div class="row m-1">
                          <dt class="col-sm-5 order-txt p-0"> {{trans('constants.name')}}</dt>
                          <dd class="col-sm-7 order-txt "><span>: {{$data->Deliverypartners->name}}</span> </dd>
                        </div>   
                        <div class="row m-1">
                          <dt class="col-sm-5 order-txt p-0"> {{trans('constants.email')}} </dt>
                          <dd class="col-sm-7 order-txt "><span>: {{$data->Deliverypartners->email}}</span> </dd>
                        </div>
                        <div class="row m-1">
                          <dt class="col-sm-5 order-txt p-0"> {{trans('constants.phone')}} </dt>
                          <dd class="col-sm-7 order-txt "><span>: {{$data->Deliverypartners->phone}}</span> </dd>
                        </div> 
                        <div class="row m-1">
                          <dt class="col-sm-5 order-txt p-0"> {{trans('constants.address')}} </dt>
                          <dd class="col-sm-7 order-txt "><span>:  {{$data->Deliverypartners->address}}</span> </dd>
                        </div>        
                      </div>
                    </div>
                  </div>@endisset
                  @isset($data->Requestdetail)
                  <div class="col-xl-6 col-lg-6 col-md-6 pt-3 px-2">
                    <div class="border">
                      <h4 class="h4-design-4"><b><i class="la la-suitcase"></i>&nbsp;&nbsp;{{trans('constants.order')}}</b> {{trans('constants.details')}}</h4>
                      <div class="my-card">
                        <div class="row m-1">
                          <dt class="col-sm-5 order-txt p-0"> Food Items</dt>
                        </div>
                        <div class="row m-1">
                          <dt class="col-sm-5 order-txt p-0"> Delivery Address</dt>
                          <dd class="col-sm-7 order-txt "><span>: {{$data->delivery_address}}</span> </dd>
                        </div>
                        @forelse($data->Requestdetail as $detail)
                        <div class="row m-1">
                          <dt class="col-sm-5 order-txt p-0"> 
                          @if(!empty($detail->Foodlist)) {{$detail->Foodlist->name}} @endif 
                          
                          X {{$detail->quantity}}</dt>
                          <dd class="col-sm-7 order-txt "><span>: @if(!empty($detail->Foodlist)) {{DEFAULT_CURRENCY_SYMBOL}} {{$detail->Foodlist->price * $detail->quantity}} @endif</span> </dd>
                          <dt class="col-sm-5 order-txt p-0" style="font-weight:500";>
                          @if(!empty($detail->FoodQuantity)) {{$detail->FoodQuantity->name}} @endif 
                          @if(count($detail->RequestdetailAddons)>0) 
                            (
                            @foreach($detail->RequestdetailAddons as $value)
                              {{ $loop->first ? '' : ', ' }} {{$value->name}}
                            @endforeach
                            )
                          @endif
                          </dt>
                        </div>  
                        @empty
                          No Food Found
                        @endforelse
                        <div class="row m-1">
                          <dt class="col-sm-5 order-txt p-0"> Billing</dt>
                        </div> 
                        <div class="row m-1">
                          <dt class="col-sm-5 order-txt p-0"> {{trans('constants.packing_charge')}} </dt>
                          <dd class="col-sm-7 order-txt "><span>: {{DEFAULT_CURRENCY_SYMBOL}} {{$data->restaurant_packaging_charge}}</span> </dd>
                        </div>
                        <div class="row m-1">
                          <dt class="col-sm-5 order-txt p-0"> {{trans('constants.discount')}} </dt>
                          <dd class="col-sm-7 order-txt "><span>:  {{DEFAULT_CURRENCY_SYMBOL}} {{$data->offer_discount}}</span> </dd>
                        </div> 
                        <div class="row m-1">
                          <dt class="col-sm-5 order-txt p-0"> {{trans('constants.delivery_charge')}} </dt>
                          <dd class="col-sm-7 order-txt "><span>: {{DEFAULT_CURRENCY_SYMBOL}} {{$data->delivery_charge}}</span> </dd>
                        </div>                        
                        <div class="row m-1">
                          <dt class="col-sm-5 order-txt p-0"> Tax</dt>
                          <dd class="col-sm-7 order-txt "><span>: {{DEFAULT_CURRENCY_SYMBOL}} {{$data->tax}}</span> </dd>
                        </div> <br>
                        <div class="row m-1">
                          <dt class="col-sm-5 order-txt p-0"> Total</dt>
                          <dd class="col-sm-7 order-txt "><span>: {{DEFAULT_CURRENCY_SYMBOL}} {{$data->bill_amount}}</span> </dd>
                        </div>  
                      </div>
                    </div>
                  </div>@endisset
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- card-3 end -->
      </div>
    </div>
    @endsection     
 