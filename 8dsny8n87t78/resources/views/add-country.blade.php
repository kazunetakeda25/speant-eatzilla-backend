@extends('layout.master')

@section('title')
{{APP_NAME}}
@endsection

@section('content')

<div class="content-wrapper">
  <div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
      <h3 class="content-header-title mb-0 d-inline-block"> {{strtoUpper(trans('constants.country'))}}</h3>
      <div class="row breadcrumbs-top d-inline-block">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">{{trans('constants.add')}} {{trans('constants.country')}}</a>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="content-body">
    <!-- Basic form layout section start -->
    <section id="horizontal-form-layouts">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic"></i> {{trans('constants.add')}} {{trans('constants.country')}}</h4>
              <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                  <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                  <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="card-content collpase show">
              <div class="card-body">
                <form action="{{url('/')}}/admin/save_country" class="icons-tab-steps wizard-notification" method="post">
                     <input type="hidden" name="_token" value="{{csrf_token()}}">
                     <input type="hidden" name="id" value="@if(isset($data->id)){{$data->id}}@endif">
                  <fieldset>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="SenderEmail">{{trans('constants.country')}} :</label>
                          <input type="text" class="form-control" name="country" value="@if(isset($data->country)){{$data->country}}  @else {{ old('country') }}  @endif " required="">
                        </div> 
                      </div> 
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="EmailSubject"> {{trans('constants.country')}} {{trans('constants.code')}}:</label>
                          <input type="text" class="form-control" name="country_code" value="@if(isset($data->country_code)){{$data->country_code}} @else {{ old('country_code') }} @endif " required="">
                        </div> 
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="SenderEmail"> {{trans('constants.currency')}} {{trans('constants.code')}}:</label>
                          <input type="text" class="form-control" name="currency_code"  value="@if(isset($data->currency_code)){{$data->currency_code}} @else {{ old('currency_code') }} @endif " required="">
                        </div> 
                      </div> 
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="EmailSubject">{{trans('constants.currency')}}  {{trans('constants.symbol')}}:</label>
                          <input type="text" class="form-control" name="currency_symbol" value="@if(isset($data->currency_symbol)){{$data->currency_symbol}} @else {{ old('currency_symbol') }} @endif"  required="">
                        </div> 
                      </div>
                    </div>
                  </fieldset>
                  <div class="form-actions center">
                    <button type="button" class="btn btn-warning mr-1" style="padding: 10px 15px;">
                     <i class="ft-x"></i> Cancel
                   </button>
                   <button type="submit" class="btn btn-primary mr-1" style="padding: 10px 15px;">
                     <i class="ft-check-square"></i> Save
                   </button>
                 </div>
               </form>
             </div>
           </div>
         </div>
       </div>
     </div>
   </section>
   <!-- // Basic form layout section end -->
 </div>
 @endsection     
 