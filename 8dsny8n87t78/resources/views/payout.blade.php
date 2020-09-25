@extends('layout.master')

@section('title')
{{APP_NAME}}

@endsection

@section('content')
@php 
  if(isset(auth()->user()->AccessPrivilages->payouts)) 
    $payoutAccess = explode(",",auth()->user()->AccessPrivilages->payouts); 
  else
    $payoutAccess = array();

@endphp
<div class="content-wrapper">
  <div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
      <h3 class="content-header-title mb-0 d-inline-block">{{strtoUpper($type)}} {{strtoUpper(trans('constants.payout'))}}</h3>
      <div class="row breadcrumbs-top d-inline-block">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{url('/')}}/admin/dashboard">{{strtoUpper(trans('constants.dashboard'))}}</a>
            </li>
            <li class="breadcrumb-item">
              <a href="#">{{strtoUpper($type)}} {{strtoUpper(trans('constants.payout'))}}</a>
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
                      <th>{{ucfirst($type)}}</th>
                      <th>{{trans('constants.phone')}}</th>   
                      <th>{{trans('constants.total_order')}}</th>   
                      <th>{{trans('constants.total')}} {{trans('constants.to_paid')}}</th>   
                      <th @if(isset(auth()->user()->role) && auth()->user()->role==3 && !in_array(2,(array)$payoutAccess)) style="display:none" @endif>{{trans('constants.action')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $i=1; @endphp
                    @foreach($data as $value)
                    <tr>
                      <td>{{$i}}</td>
                      <td>@if($type=='restaurant') {{$value->restaurant_name}} @else {{$value->name}} @endif</td>
                      <td>{{$value->phone}}</td>
                      <td>{{$value->foodrequest_count}}</td>
                      <td>{{DEFAULT_CURRENCY_SYMBOL}} {{$value->pending_payout}}</td>
                      <td @if(isset(auth()->user()->role) && auth()->user()->role==3 && !in_array(2,(array)$payoutAccess)) style="display:none" @endif><!--amount/restaurant_id or driver_id -->
                        <a href="{{url('/')}}/admin/add_payout/{{$type}}/{{$value->pending_payout}}/{{$value->id}}" class="button btn btn-icon btn-success mr-1 link_clr">Make Payment</a>
                      </td>
                    </tr>
                    @php $i++ @endphp
                    @endforeach
                  </div>
                </div>

                @endsection     
