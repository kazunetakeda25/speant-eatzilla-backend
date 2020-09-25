@extends('layout.master')

@section('title')

{{APP_NAME}}

@endsection

@section('content')
  <div class="content-wrapper">
      <div class="content-body">
        <section id="icon-tabs">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">{{strtoUpper(trans('constants.create'))}} {{strtoUpper(trans('constants.vehicle'))}}</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                </div>
                 <hr>

                <div class="card-content collapse show">
                  <div class="card-body">
                    <form action="{{url('/')}}/admin/vehicle_add" class="icons-tab-steps wizard-notification" method="post"  enctype="multipart/form-data" >
                       <input type="hidden" name="_token" value="{{csrf_token()}}">
                       <input type="hidden" name="id" value="@if(isset($data->id)){{$data->id}}@endif">
                    <fieldset>
                        <div class="row">
                          <div class="col-md-6">
                             <div class="form-group">
                              <label for="name">{{trans('constants.vehicle')}} {{trans('constants.name')}}<span style="color: red;">*</span></label>
                              <input id="name" type="text" class="form-control" name="vehicle_name" value="@if(isset($data->vehicle_name)){{$data->vehicle_name}}@endif" required="" autofocus="">
                            </div>
                             <div class="form-group">
                              <label for="name">{{trans('constants.vehicle_no')}}<span style="color: red;">*</span></label>
                              <input id="name" type="text" class="form-control" name="vehicle_no" value="@if(isset($data->vehicle_no)){{$data->vehicle_no}}@endif" required="" autofocus="">
                            </div>
                             <div class="form-group">
                              <label for="name">{{trans('constants.insurance_no')}}<span style="color: red;">*</span></label>
                              <input id="name" type="text" class="form-control" name="insurance_no" value="@if(isset($data->insurance_no)){{$data->insurance_no}}@endif" required="" autofocus="">
                            </div>
                             <div class="form-group">
                              <label for="name">{{trans('constants.rc_no')}}<span style="color: red;">*</span></label>
                              <input id="name" type="text" class="form-control" name="rc_no" value="@if(isset($data->rc_no)){{$data->rc_no}}@endif"  required="" autofocus="">
                            </div>
                             <div class="form-group">
                              <label for="name">{{trans('constants.insurance')}} {{trans('constants.expiry_date')}}<span style="color: red;">*</span></label>
                              <input id="name" type="text" class="form-control pickadate-selectors picker__input" name="insurance_expiry_date" value="@if(isset($data->insurance_expiry_date)){{$data->insurance_expiry_date}}@endif" required="">
                            </div>
                             <div class="form-group">
                              <label for="name">{{trans('constants.rc')}} {{trans('constants.expiry_date')}}<span style="color: red;">*</span></label>
                              <input id="name" type="text" class="form-control pickadate-selectors picker__input" name="rc_expiry_date" value="@if(isset($data->rc_expiry_date)){{$data->rc_expiry_date}}@endif" required="">
                            </div>
                            </div>
                          <div class="col-md-6">
                             <div class="form-group">
                             <label  for="projectinput4">{{trans('constants.status')}}<span style="color: red;">*</span></label>
                            <select name="status" id="" class="form-control" required="" >
                                 <option value="1" @if(isset($data) && $data->status ==1) Selected @endif>{{trans('constants.active')}}</option>
                                 <option value="2" @if(isset($data) && $data->status ==2) Selected @endif>{{trans('constants.inactive')}}</option>
                            </select> 
                         </div>

                              @if(isset($data->vehicle_image) && ($data->vehicle_image !=""))
                              <img src="{{BASE_URL}}{{VEHICLE_UPLOADS_PATH}}{{$data->vehicle_image}}" style="width: 8em;">@endif
                             <div class="form-group">
                              <label for="name">{{trans('constants.vehicle')}}{{trans('constants.image')}}</label>
                              <input id="name" type="file" class="form-control" name="vehicle_image" value="" autofocus="">
                            </div>

                              @if(isset($data->insurance_image) && ($data->insurance_image !=""))
                              <img src="{{BASE_URL}}{{VEHICLE_UPLOADS_PATH}}{{$data->insurance_image}}" style="width: 8em;">@endif
                             <div class="form-group">
                              <label for="name">{{trans('constants.insurance_image')}}<span style="color: red;">*</span></label>
                              <input id="name" type="file" class="form-control" name="insurance_image" value="" @if(!isset($data)) required="" @endif autofocus="">
                            </div>

                              @if(isset($data->rc_image) && ($data->rc_image !=""))
                              <img src="{{BASE_URL}}{{VEHICLE_UPLOADS_PATH}}{{$data->rc_image}}" style="width: 8em;">@endif
                             <div class="form-group">
                              <label for="name">{{trans('constants.rc_image')}}<span style="color: red;">*</span></label>
                              <input id="name" type="file" class="form-control" name="rc_image" value="" @if(!isset($data)) required="" @endif autofocus="">
                            </div>
                             </div>

                        </div>
                             <div class="form-actions" style="text-align: center">
                              <button type="button" class="btn btn-warning mr-1" style="padding: 10px 15px;">
                               <i class="ft-x"></i> Cancel
                                </button>
                              <button type="submit" class="btn btn-primary mr-1" style="padding: 10px 15px;">
                               <i class="ft-check-square"></i> Save
                                </button>
                            </div>
                        </fieldset>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              </section>
            </div>
          </div>
  


    @endsection     
 