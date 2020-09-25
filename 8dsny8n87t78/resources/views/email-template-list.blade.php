@extends('layout.master')

@section('title')
{{APP_NAME}}
@endsection

@section('content')
<div class="content-wrapper">
  <div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
      <h3 class="content-header-title mb-0 d-inline-block"> {{strtoUpper(trans('constants.email_template'))}}  {{strtoUpper(trans('constants.list'))}}</h3>
      <div class="row breadcrumbs-top d-inline-block">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard">{{strtoUpper(trans('constants.dashboard'))}}</a>
            <li class="breadcrumb-item">
              <a href="#">{{strtoUpper(trans('constants.email_template'))}} {{strtoUpper(trans('constants.list'))}} </a>
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
                <h4 class="card-title"> &nbsp;</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                <div class="heading-elements">
                 <ul class="list-inline mb-0">
                  <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                  <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                  <li><a data-action="expand"><i class="ft-maximize"></i></a></li>

                     <li> <button class="btn btn-primary btn-sm"><i class="ft-plus white"></i><a style=" color: white !important;" href="{{url('/')}}/admin/add_email"> {{trans('constants.add')}} {{trans('constants.email_template')}}</a></button></li>
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
                      <th>Title</th>   
                      <th>Subject</th> 
                      <th>Action</th>   
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>   
                      <td>title</td>   
                      <td>subject</td>   
                      <td><button class="btn btn-success btn-sm"><a style=" color: white !important;" href="{{URL('/')}}/admin/add_email"><i class="ft-edit white"></i></a></button></td>   
                    </tr>
                  </div>
                </div>

                @endsection     
