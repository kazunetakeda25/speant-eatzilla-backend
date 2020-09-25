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
              <h4 class="card-title">CREATE DRIVER</h4>
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
                <form role="form" action="{{url('/')}}/admin/add_driver" class="icons-tab-steps wizard-notification" method="post" enctype="multipart/form-data" id="add_driver">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  @if(isset($insert1))
                  <input type="hidden" name="id" value="{{($insert1->id ?$insert1->id:'')}}"  >
                  @endif

                  <fieldset>
                    <div class="row">
                      @php
                        $driver_name = "";
                        if(old('driver_name')) $driver_name = old('driver_name');
                        elseif(isset($insert1->name)) $driver_name = $insert1->name;
                      @endphp
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="name">Driver Name<span style="color: red;">*</span></label>
                          <input id="name" type="text" class="form-control" name="driver_name" value="{{$driver_name}}" required >
                        </div>
                      </div>
                      @php
                        $email = "";
                        if(old('email')) $email = old('email');
                        elseif(isset($insert1->email)) $email = $insert1->email;
                      @endphp
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="name">Email</label>
                          <input id="name" type="email" class="form-control" name="email" value="{{$email}}" >
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label  for="projectinput4">Status<span style="color: red;">*</span></label>
                          <select name="status" id="" class="form-control" required>
                            <option value="1" @if(old('status')) @if(old('status')==1) selected @endif @else @if(isset($insert1->status) && $insert1->status==1) selected @endif @endif>Active</option>
                            <option value="2" @if(old('status')) @if(old('status')==2) selected @endif @else @if(isset($insert1->status) && $insert1->status==2) selected @endif @endif>In Active</option>
                          </select> 
                        </div>
                      </div>
                    </div>
                    @php
                      $phone_no = "";
                      if(old('phone_no')) $phone_no = old('phone_no');
                      elseif(isset($insert1->phone)) $phone_no = $insert1->phone;
                    @endphp
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="name">Phone No<span style="color: red;">*</span></label>
                          <input id="name" type="text" class="form-control" name="phone_no" value="{{$phone_no}}" required>
                        </div>
                      </div>
                      @php
                        $address_line_1 = "";
                        if(old('address_line_1')) $address_line_1 = old('address_line_1');
                        elseif(isset($insert1->Deliverypartner_detail->address_line_1)) $address_line_1 = $insert1->Deliverypartner_detail->address_line_1;
                      @endphp
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="name">Address Line 1<span style="color: red;">*</span></label>
                          <input id="name" type="text" class="form-control" name="address_line_1" value="{{$address_line_1}}" required >
                        </div>
                      </div>
                      @php
                        $address_line_2 = "";
                        if(old('address_line_2')) $address_line_2 = old('address_line_2');
                        elseif(isset($insert1->Deliverypartner_detail->address_line_2)) $address_line_2 = $insert1->Deliverypartner_detail->address_line_2;
                      @endphp
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="name">Address Line 2</label>
                          <input id="name" type="text" class="form-control" name="address_line_2" value="{{$address_line_2}}">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      @php
                        $country_id = "";
                        if(old('country')) $country_id = old('country');
                        elseif(isset($insert1->Deliverypartner_detail->country)) $country_id = $insert1->Deliverypartner_detail->country;
                      @endphp
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="name">Country<span style="color: red;">*</span></label>
                          <select class="c-select form-control" id="country" name="country" required onchange="getprovience(1)">
                            <option value="">--select country--</option>
                            @foreach($country as $c)
                            <option value="{{$c->id}}" @if($country_id==$c->id) selected @endif>{{$c->country}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      @php
                        $state_id = "";
                        if(old('state_province')) $state_id = old('state_province');
                        elseif(isset($insert1->Deliverypartner_detail->state_province)) $state_id = $insert1->Deliverypartner_detail->state_province;
                      @endphp
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="name">State/Province<span style="color: red;">*</span></label>
                          <select class="c-select form-control" id="state_province" name="state_province" required onchange="getprovience(2)">
                            @if(!empty($state))
                              <option value="{{$state->id}}" @if($state_id==$state->id) selected @endif>{{$state->state}}</option>
                            @endif
                          </select>
                        </div>
                      </div>
                      @php
                        $city_id = "";
                        if(old('city')) $city_id = old('city');
                        elseif(isset($insert1->Deliverypartner_detail->city)) $city_id = $insert1->Deliverypartner_detail->city;
                      @endphp
                      <div class="col-md-4">
                        <div class="form-group">
                        <label for="name">City<span style="color: red;">*</span></label>
                          <select class="c-select form-control" id="city" onchange="getcity_area()" name="city" required>
                            @if(!empty($city))
                              <option value="{{$city->id}}" @if($city_id==$city->id) selected @endif>{{$city->city}}</option>
                            @endif
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      @php
                        $area_id = "";
                        if(old('area')) $area_id = old('area');
                        elseif(isset($insert1->Deliverypartner_detail->area)) $area_id = $insert1->Deliverypartner_detail->area;
                      @endphp
                      <div class="col-md-4">
                        <div class="form-group">
                        <label for="name">Area<span style="color: red;">*</span></label>
                          <select class="c-select form-control" id="area" name="area" required>
                            @if(!empty($area))
                              <option value="{{$area->id}}" @if($area_id==$area->id) selected @endif>{{$area->area}}</option>
                            @endif
                          </select>
                        </div>
                      </div>
                      @php
                        $zip_code = "";
                        if(old('zip_code')) $zip_code = old('zip_code');
                        elseif(isset($insert1->Deliverypartner_detail->zip_code)) $zip_code = $insert1->Deliverypartner_detail->zip_code;
                      @endphp
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="name">Zip Code<span style="color: red;">*</span></label>
                          <input id="name" type="text" class="form-control" name="zip_code" value="{{$zip_code}}" required >
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="name">Avatar @if(!isset($insert1))<span style="color: red;">*</span>@endif</label>
                            @if(isset($insert1->profile_pic))
                                @if(file_exists(DOCROOT.DRIVER_IMAGE_PATH.$insert1->profile_pic))
                                <img id="blah" src="{{BASE_URL.DRIVER_IMAGE_PATH.$insert1->profile_pic}}" alt="your image"  style="max-width:180px;"><br>
                                @else
                                <img id="blah" src="{{BASE_URL.UPLOADS_PATH.PROFILE_ICON}}" alt="your image"  style="max-width:180px;"><br>
                                @endif
                              @endif
                          <input id="name" type="file" class="form-control" name="profile_pic" value="@if(isset($insert1->profile_pic)){{$insert1->profile_pic}}@endif" @if(!isset($insert1)) required @endif >
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="name">About</label>
                          <textarea name="about"  rows="4" class="form-control" placeholder="About"></textarea>
                        </div>
                      </div>
                    </div>

                    <h3>Document Settings</h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="name">NID @if(!isset($insert1))<span style="color: red;">*</span>@endif</label>
                          <input id="name" type="file" class="form-control" name="license" value="@if(isset($insert1->profile_pic)){{$insert1->profile_pic}}@endif" @if(!isset($insert1)) required @endif >
                        </div>
                      </div>
                      @php
                        $license_expiry = "";
                        if(old('license_expiry')) $license_expiry = old('license_expiry');
                        elseif(isset($insert1->expiry_date)) $license_expiry = $insert1->expiry_date;
                      @endphp
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="name">Expiry Date<span style="color: red;">*</span></label>
                          <input id="license_expiry" type="text" class="form-control required picker__input  picker__input--active" name="license_expiry" value="{{$license_expiry}}" required  >
                      </div>
                    </div>
                    </div>
                    <h3>Account Settings</h3>
                    <div class="row">
                      @php
                        $account_name = "";
                        if(old('account_name')) $account_name = old('account_name');
                        elseif(isset($insert1->Deliverypartner_detail->account_name)) $account_name = $insert1->Deliverypartner_detail->account_name;
                      @endphp
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="name">Account Name<span style="color: red;">*</span></label>
                          <input id="name" type="text" class="form-control" name="account_name" value="{{$account_name}}" required >
                        </div>
                      </div>
                      @php
                        $account_address = "";
                        if(old('account_address')) $account_address = old('account_address');
                        elseif(isset($insert1->Deliverypartner_detail->account_address)) $account_address = $insert1->Deliverypartner_detail->account_address;
                      @endphp
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="name">Account Address<span style="color: red;">*</span></label>
                          <input id="name" type="text" class="form-control" name="account_address" value="{{$account_address}}"  required >
                        </div>
                      </div>
                      @php
                        $account_no = "";
                        if(old('account_no')) $account_no = old('account_no');
                        elseif(isset($insert1->Deliverypartner_detail->account_no)) $account_no = $insert1->Deliverypartner_detail->account_no;
                      @endphp
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="name">Account Number<span style="color: red;">*</span></label>
                          <input id="name" required type="text" class="form-control" name="account_no" value="{{$account_no}}">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      @php
                        $bank_name = "";
                        if(old('bank_name')) $bank_name = old('bank_name');
                        elseif(isset($insert1->Deliverypartner_detail->bank_name)) $bank_name = $insert1->Deliverypartner_detail->bank_name;
                      @endphp
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="name">Bank Name<span style="color: red;">*</span></label>
                          <input id="name" required type="text" class="form-control" name="bank_name"  value="{{$bank_name}}" required >
                        </div>
                      </div>
                      @php
                        $branch_name = "";
                        if(old('branch_name')) $branch_name = old('branch_name');
                        elseif(isset($insert1->Deliverypartner_detail->branch_name)) $branch_name = $insert1->Deliverypartner_detail->branch_name;
                      @endphp
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="name">Branch Name<span style="color: red;">*</span></label>
                          <input id="name" type="text" required class="form-control" name="branch_name" value="{{$branch_name}}" required >
                        </div>
                      </div>
                      @php
                        $branch_address = "";
                        if(old('branch_address')) $branch_address = old('branch_address');
                        elseif(isset($insert1->Deliverypartner_detail->branch_address)) $branch_address = $insert1->Deliverypartner_detail->branch_address;
                      @endphp
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="name">Branch Address <span style="color: red;">*</span></label>
                          <input id="name" type="text" required class="form-control" name="branch_address"  value="{{$branch_address}}" required >
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      @php
                        $swift_code = "";
                        if(old('swift_code')) $swift_code = old('swift_code');
                        elseif(isset($insert1->Deliverypartner_detail->swift_code)) $swift_code = $insert1->Deliverypartner_detail->swift_code;
                      @endphp
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="name">Swift Code</label>
                          <input id="name" type="text" class="form-control" name="swift_code" value="{{$swift_code}}"  >
                        </div>
                      </div>
                      @php
                        $routing_no = "";
                        if(old('routing_no')) $routing_no = old('routing_no');
                        elseif(isset($insert1->Deliverypartner_detail->routing_no)) $routing_no = $insert1->Deliverypartner_detail->routing_no;
                      @endphp
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="name">Routing Number</label>
                          <input id="name" type="text" class="form-control" name="routing_no" value="{{$routing_no}}">
                        </div>
                      </div>
                    </div>
                    @if(!isset($insert1))
                    <h3>Security Settings</h3>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="password">Password<span style="color: red;">*</span></label>
                          <input id="password" type="password" class="form-control" name="password"  value="@if(old('password')) {{old('password')}} @else @if(isset($insert1->password)){{$insert1->password}}@endif @endif" required >
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="confirm_password">Confirm Password<span style="color: red;">*</span></label>
                          <input id="confirm_password" name="confirm_password" type="password" class="form-control" value="@if(old('confirm_password')) {{old('confirm_password')}} @endif" required >
                        </div>
                      </div>
                    </div>
                    @endif
                    <span class="error_message" id="password_error"></span>
                    <h3>{{trans('constants.vehicle')}} Settings</h3>
                    <div class="row">
                      @php
                        $vehicle_name = "";
                        if(old('vehicle_name')) $vehicle_name = old('vehicle_name');
                        elseif(isset($insert1->Vehicle->vehicle_name)) $vehicle_name = $insert1->Vehicle->vehicle_name;
                      @endphp
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="vehname">{{trans('constants.vehicle')}} {{trans('constants.name')}}<span style="color: red;">*</span></label>
                          <input id="vehname" required type="text" class="form-control" name="vehicle_name" value="{{$vehicle_name}}" required >
                        </div>
                      </div>
                      @php
                        $vehicle_no = "";
                        if(old('vehicle_no')) $vehicle_no = old('vehicle_no');
                        elseif(isset($insert1->Vehicle->vehicle_no)) $vehicle_no = $insert1->Vehicle->vehicle_no;
                      @endphp
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="vehicle_no">{{trans('constants.vehicle_no')}}<span style="color: red;">*</span></label>
                          <input id="vehicle_no" type="text" class="form-control" name="vehicle_no" value="{{$vehicle_no}}" required >
                        </div>
                      </div>
                      @php
                        $insurance_no = "";
                        if(old('insurance_no')) $insurance_no = old('insurance_no');
                        elseif(isset($insert1->Vehicle->insurance_no)) $insurance_no = $insert1->Vehicle->insurance_no;
                      @endphp
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="insurance_no">{{trans('constants.insurance_no')}}<span style="color: red;">*</span></label>
                          <input id="insurance_no" type="text" class="form-control" name="insurance_no" value="{{$insurance_no}}" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      @php
                        $rc_no = "";
                        if(old('rc_no')) $rc_no = old('rc_no');
                        elseif(isset($insert1->Vehicle->rc_no)) $rc_no = $insert1->Vehicle->rc_no;
                      @endphp
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="rc_no">{{trans('constants.rc_no')}}<span style="color: red;">*</span></label>
                          <input id="rc_no" type="text" class="form-control" name="rc_no" value="{{$rc_no}}" required >
                        </div>
                      </div>
                      @php
                        $insurance_expiry_date = "";
                        if(old('insurance_expiry_date')) $insurance_expiry_date = old('insurance_expiry_date');
                        elseif(isset($insert1->Vehicle->insurance_expiry_date)) $insurance_expiry_date = $insert1->Vehicle->insurance_expiry_date;
                      @endphp
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="insurance_expiry_date">{{trans('constants.insurance')}} {{trans('constants.expiry_date')}}<span style="color: red;">*</span></label>
                          <input id="insurance_expiry_date" required type="text" class="form-control pickadate-selectors picker__input required" name="insurance_expiry_date" value="{{$insurance_expiry_date}}">
                        </div>
                      </div>
                      @php
                        $rc_expiry_date = "";
                        if(old('rc_expiry_date')) $rc_expiry_date = old('rc_expiry_date');
                        elseif(isset($insert1->Vehicle->rc_expiry_date)) $rc_expiry_date = $insert1->Vehicle->rc_expiry_date;
                      @endphp
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="rc_expiry_date">{{trans('constants.rc')}} {{trans('constants.expiry_date')}}<span style="color: red;">*</span></label>
                          <input id="rc_expiry_date" required type="text" class="form-control required pickadate-selectors picker__input" name="rc_expiry_date" value="{{$rc_expiry_date}}">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          @if(isset($insert1->Vehicle->insurance_image))
                              @if(file_exists(DOCROOT.DRIVER_IMAGE_PATH.$insert1->Vehicle->insurance_image))
                              <img id="blah" src="{{BASE_URL.DRIVER_IMAGE_PATH.$insert1->Vehicle->insurance_image}}" alt="your image"  style="max-width:180px;"><br>
                              @else
                              <img id="blah" src="{{BASE_URL.UPLOADS_PATH.PROFILE_ICON}}" alt="your image"  style="max-width:180px;"><br>
                              @endif
                            @endif
                          <label for="insurance_image">{{trans('constants.insurance_image')}} @if(!isset($insert1)) <span style="color: red;">*</span>@endif</label>
                          <input id="insurance_image" type="file" class="form-control" name="insurance_image" value="" @if(!isset($insert1)) required @endif >
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          @if(isset($insert1->Vehicle->rc_image))
                            @if(file_exists(DOCROOT.DRIVER_IMAGE_PATH.$insert1->Vehicle->rc_image))
                            <img id="blah" src="{{BASE_URL.DRIVER_IMAGE_PATH.$insert1->Vehicle->rc_image}}" alt="your image"  style="max-width:180px;"><br>
                            @else
                            <img id="blah" src="{{BASE_URL.UPLOADS_PATH.PROFILE_ICON}}" alt="your image"  style="max-width:180px;"><br>
                            @endif
                          @endif
                          <label for="rc_image">{{trans('constants.rc_image')}} @if(!isset($insert1)) <span style="color: red;">*</span>@endif</label>
                          <input id="rc_image" type="file" class="form-control" name="rc_image" value="" @if(!isset($insert1)) required @endif >
                        </div>
                      </div>
                    </div>
                    <div class="form-actions">
                      <button type="button" class="btn btn-warning mr-1" style="padding: 10px 15px;">
                       <i class="ft-x"></i> Cancel
                      </button>
                      <button type="" onclick="javascript:return form_validation();" class="btn btn-primary mr-1" style="padding: 10px 15px;">
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

@section('script')

<script>
  $('#license_expiry').pickadate({
    min: new Date(),
    selectYears: true,
    selectMonths: true
  });

  function form_validation()
  {
    var password = document.getElementById('password').value;
    var confirm_password = document.getElementById('confirm_password').value;
    var license_expiry = document.getElementById('license_expiry').value;
    var insurance_image = document.getElementById('insurance_image').value;
    var rc_image = document.getElementById('rc_image').value;
    counter=0;
    $(".required").each(function(){
      if($(this).val()=="")
      {
        if($(this).parent().next(".date_error").length==0){
          $(this).parent().after("<div class='date_error' style='color:red'>This field is required</div>");
        }
        counter++;
      }else
      {
        $(this).parent().next(".date_error").remove();
      }
    });
    //alert(counter);
    if(counter>0)
      return false;

    if(password != confirm_password)
    {
      $('#password_error').fadeIn().html('Password and Confirm Password does not match').delay(3000).fadeOut('slow');
      return false;
    }
    // else
    // {
    //   document.getElementById("add_driver").submit();
    // }
  }

  function getprovience(id)
  {
    if(id==1)
      var provienceid = $('#country').val();
    else
     var provienceid = $("#state_province").val();

    $.ajax({
      url : "{{url('/')}}/admin/getprovience/"+provienceid+"/"+id,
      method : "get",
      success : function (data)
      {
        if(id==1){
          var state='<option value="">--select state--</option>';
          if(data.state != '') 
          {
            $.each( data.state, function( key, value ) {
              state += '<option value="'+value.id+'">'+value.state+'</option>';
            });
          }
          $('#state_province').html(state);

        }else{
          var city='<option value="">--select city--</option>';
          if(data.city != '') 
          {
            $.each( data.city, function( key, value ) {
              city += '<option value="'+value.id+'">'+value.city+'</option>';
            });
          }
          $('#city').html(city);
        }
      }

    });
  }


  function getcity_area()
  {
    var city_id = $('#city').val();
    $.ajax({
      url : "{{url('/')}}/admin/getcity_area/"+city_id,
      method : "get",
      success : function (data)
      {
      console.log(data.area);
        if(data.area != '') 
        {
          var area='';
          $.each( data.area, function( key, value ) {
            area += '<option value="'+value.id+'">'+value.area+'</option>';
          });
          $('#area').html(area);
        }
        else
        {
            $('#area').html("");
        }
      }

    });
  }
</script>

@endsection