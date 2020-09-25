@extends('layout.master')

@section('title')

{{APP_NAME}}
@endsection

@section('content')

<div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">ADD DELIVERY PEOPLE</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=" ">DELIVERY PEOPLE LIST</a>
                </li>
                <li class="breadcrumb-item"><a href=" ">ADD DELIVERY PEOPLE</a>
                </li>
              </ol>
            </div>
          </div>
        </div>
        
      </div>
      <div class="content-body">
        <section id="icon-tabs">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">ADD DELIVERY PEOPLE</h4>
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

                <div class="card-content collapse show">
                  <div class="card-body">
                   <form action="{{url('/')}}/admin/add_to_deliverypeople" enctype="multipart/form-data" method="post" class="icons-tab-steps wizard-notification">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        @if(isset($delivery_partner))
                        <input type="hidden" class="form-control" value="{{$delivery_partner->id}}" name="id" >
                        @else
                         <input type="hidden" class="form-control" value="12345678" name="password" id="password">
                         @endif

                    <fieldset>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="name">Name :</label>
                              <input type="text" class="form-control" name="name" value="@if(isset($delivery_partner->name)){{$delivery_partner->name}}@endif" id="name" required>
                            </div>

                             <div class="form-group">
                              <label for="email">Email :</label>
                              <input type="email" class="form-control" name="email" value="@if(isset($delivery_partner->email)){{$delivery_partner->email}}@endif" id="email">
                            </div>

                             <div class="form-group">
                              <label for="driving_license_no">Driving License Number :</label>
                              <input type="text" class="form-control" name="driving_license_no" id="driving_license_no" value="@if(isset($delivery_partner->driving_license_no)){{$delivery_partner->driving_license_no}}@endif" required>
                            </div>

                             <div class="form-group">
                              <label for="service_zone">Service Zone :</label>
                              <input type="text" class="form-control" name="service_zone" value="@if(isset($delivery_partner->service_zone)){{$delivery_partner->service_zone}}@endif" id="service_zone" required>
                            </div>

                           <!--   <div class="form-group">
                              <label for="password">Password :</label>
                              <input type="password" class="form-control" name="password" id="password">
                            </div>

                            <div class="form-group">
                              <label for="conformpassword">Confirm Password :</label>
                              <input type="password" class="form-control" name="confirm_password" id="password1">
                            </div> -->

                              <div class="form-group">
                              <label for="commision">Commision in %:</label>
                              <input type="text" class="form-control" name="commision" id="commision" value="{{$delivery_partner_commision}}" required>
                            </div>

                            </div>
                           </div>
                             
                        <div class="row">
                          <div class="col-md-12">
                             <div class="form-group">
                              <label for="address">Address :</label>
                              <input type="text" class="form-control" name="address" value="@if(isset($delivery_partner->address)){{$delivery_partner->address}}@endif" id="address" required>
                            </div>

                            <div class="form-group row">
                             <label class="col-md-3 label-control" for="projectinput4">Profile Picture</label>
                            <div class="col-md-9">
                              <img id="blah" src="{{$profile_icon}}" alt="your image" / style="max-width:180px;"><br>
                               <input type='file' name="profile_pic" onchange="readURL(this);" / style="padding:10px;background:000;">
                           </div>
                          </div>
                        </div>

                      </div>
                    @if(!isset($delivery_partner))
                    <div class="input-group" data-repeater-item="">
                         <div class="col-md-2">
                           <input id="country_code" class="form-control" name="country_code" autocomplete="off" type="text" value="" required="" placeholder="91">
                        </div>
                         <div class="col-md-10">
                            <input id="phone" type="text" class="form-control" name="phone" value="" placeholder="Phone Number" required="" >
                        </div>
                    </div>
                    @endif

                    <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="bank_name">Bank Name :</label>
                              <input type="text" class="form-control" name="bank_name" value="@if(isset($delivery_partner->bank_name)){{$delivery_partner->bank_name}}@endif" id="bank_name" required>
                            </div>
                            <div class="form-group">
                              <label for="acc_no">Account Number :</label>
                              <input type="text" class="form-control" name="acc_no" value="@if(isset($delivery_partner->acc_no)){{$delivery_partner->acc_no}}@endif" id="acc_no" required>
                            </div>
                            <div class="form-group">
                              <label for="ifsc_code">IFSC Code :</label>
                              <input type="text" class="form-control" name="ifsc_code" value="@if(isset($delivery_partner->ifsc_code)){{$delivery_partner->ifsc_code}}@endif" id="ifsc_code" required>
                            </div>
                          </div>
                    </div>
                         <div class="form-actions">
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
 