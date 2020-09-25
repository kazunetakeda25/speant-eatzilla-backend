@extends('layout.master')

@section('title')
{{APP_NAME}}

@endsection

@section('content')
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
                      <th>{{Ucfirst($type)}}</th>   
                      <th>{{trans('constants.total')}}</th>   
                      <th>{{trans('constants.transaction_id')}}</th>  
                      <th>{{trans('constants.description')}}</th> 
                      <th>{{trans('constants.status')}}</th>   
                    </tr>
                  </thead>
                  <tbody>
                    @php $i = 1; @endphp
                    @forelse($data as $d)
                    <tr>
                      <td>@php echo $i++; @endphp</td>
                      <td>@if($type=='restaurant') {{$d['Restaurants']['restaurant_name']}} @else($type=='driver')  {{$d['Deliverypartners']['name']}} @endif</td>
                      <td>{{DEFAULT_CURRENCY_SYMBOL}} {{$d['payout_amount']}}</td>
                      <td>{{$d['transaction_id']}}</td>
                      <td>{{$d['description']}}</td>
                      <td>{{$d['status']}}</td>   
                    </tr>
                    @empty
                      {{trans('constants.no_data')}}
                    @endforelse
                  </div>
                </div>

                @endsection     
