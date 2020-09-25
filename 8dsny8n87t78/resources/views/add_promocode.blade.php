@extends('layout.master')

@section('title')

{{APP_NAME}}

@endsection

@section('content')

   <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">{{strtoUpper(trans('constants.create'))}} {{strtoUpper(trans('constants.promo_code'))}}</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/promocodes_list">{{trans('constants.promo_code')}}</a>
                </li>
                <li class="breadcrumb-item"><a href="#">{{trans('constants.add')}} {{trans('constants.promo_code')}}</a>
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
                    <form action="{{url('/')}}/admin/add_to_promocode" method="post" id="add_promo" class="icons-tab-steps wizard-notification">
                       <input type="hidden" name="_token" value="{{csrf_token()}}">
                        @if(isset($data))
                        <input type="hidden" class="form-control" value="{{$data->id}}" name="id" >
                         @endif
                    <fieldset>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="promo">{{trans('constants.title')}} <span style="color: red;">*</span></label>
                              <input type="text" class="form-control" id="promocode_title" name="title" value="@if(isset($data->title)){{$data->title}}@endif" required>
                            </div>

                            <div class="form-group">
                              <label for="promo">{{trans('constants.description')}} <span style="color: red;">*</span></label>
                              <input type="text" class="form-control" id="description" name="description" value="@if(isset($data->description)){{$data->description}}@endif" required>
                            </div>

                            <div class="form-group">
                              <label for="promo">{{trans('constants.promo_code')}} <span style="color: red;">*</span></label>
                              <input type="text" class="form-control" id="promo_code" name="promo_code" value="@if(isset($data->code)){{$data->code}}@endif" onkeyup="Promocode()" required>
                            </div>
                            
                            <div class="form-group">
                              <label for="promocode">Delivery Type<span style="color: red;">*</span> </label>
                              <div class="input-group">
                                <div class="d-inline-block custom-control custom-radio mr-1">
                                  <input type="radio" name="delivery_type" class="custom-control-input" value="0" id="All" @if(isset($data->delivery_type)) @if($data->delivery_type==0) checked @endif @else checked @endif>
                                  <label class="custom-control-label" for="All">All</label>
                                </div>
                                <div class="d-inline-block custom-control custom-radio">
                                  <input type="radio" name="delivery_type" class="custom-control-input" value="1" @if(isset($data->delivery_type) && $data->delivery_type==1) checked @endif id="home_delivery">
                                  <label class="custom-control-label" for="home_delivery">Home Delivery</label>
                                </div>
                                <div class="d-inline-block custom-control custom-radio">
                                  <input type="radio" name="delivery_type" class="custom-control-input" value="2" @if(isset($data->delivery_type) && $data->delivery_type==2) checked @endif id="pickup">
                                  <label class="custom-control-label" for="pickup">Pickup</label>
                                </div>
                                <div class="d-inline-block custom-control custom-radio">
                                  <input type="radio" name="delivery_type" class="custom-control-input" value="3" @if(isset($data->delivery_type) && $data->delivery_type==3) checked @endif id="dining">
                                  <label class="custom-control-label" for="dining">Dining</label>
                                </div>
                              </div>
                            </div>
                            
                            <div class="form-group">
                              <label for="promocode">Coupon Type<span style="color: red;">*</span> </label>
                              <!-- <select class="c-select form-control" id="coupon_type" name="coupon_type" required>
                                <option value="1" @if(isset($data->coupon_type) && $data->coupon_type==1) selected @endif>All</option>
                                <option value="2" @if(isset($data->coupon_type) && $data->coupon_type==2) selected @endif>Minimum Order Value</option>
                              </select> -->
                              <div class="input-group">
                                <div class="d-inline-block custom-control custom-radio mr-1">
                                  <input type="radio" name="coupon_type" class="custom-control-input" value="1" id="all_coupon" @if(isset($data->coupon_type)) @if($data->coupon_type==1) checked @endif @else checked @endif>
                                  <label class="custom-control-label" for="all_coupon">All</label>
                                </div>
                                <div class="d-inline-block custom-control custom-radio">
                                  <input type="radio" name="coupon_type" class="custom-control-input" value="2" @if(isset($data->coupon_type) && $data->coupon_type==2) checked @endif id="minimum_order">
                                  <label class="custom-control-label" for="minimum_order">Minimum Order Value</label>
                                </div>
                              </div>
                            </div>
                            
                            <div class="form-group coupon_value">
                               <label for="status">Coupon Value <span style="color: red;">*</span></label>
                                 <input type="text" name="coupon_value" class="form-control" id="coupon_value" value="@if(isset($data->coupon_value)){{$data->coupon_value}}@endif">
                             </div>

                            <div class="form-group">
                              <label for="promocode">{{trans('constants.offer_type')}}<span style="color: red;">*</span> </label>
                              <select class="c-select form-control" id="offer_type" name="offer_type" onchange="offerType()" required>
                                <option value="1" @if(isset($data->offer_type) && $data->offer_type==1) selected @endif>Amount</option>
                                <option value="0" @if(isset($data->offer_type) && $data->offer_type==0) selected @endif>Percent</option>
                              </select>
                            </div>

                           <div class="form-group max_amount">
                               <label for="status">{{trans('constants.max_amount')}} <span style="color: red;">*</span></label>
                                 <input type="text" name="max_amount" class="form-control" id="max_amount" value="@if(isset($data->max_amount)){{$data->max_amount}}@endif">
                             </div>

                           <div class="form-group">
                               <label for="status">{{trans('constants.discount')}} <span style="color: red;">*</span></label>
                                 <input type="text" class="form-control" id="discount" value="@if(isset($data->value)){{$data->value}}@endif" name="discount" required>
                             </div>

                             <div class="form-group">
                               <label for="status">{{trans('constants.limit_coupon')}} <span style="color: red;">*</span></label>
                                 <input type="text" class="form-control" id="usage_coupon" name="total_use" value="@if(isset($data->total_use)){{$data->total_use}}@endif" required>
                             </div>

                             <div class="form-group">
                               <label for="status">{{trans('constants.limit_user')}}<span style="color: red;">*</span></label>
                                 <input type="text" class="form-control" id="usage_user" name="use_per_customer" value="@if(isset($data->use_per_customer)){{$data->use_per_customer}}@endif" required>
                             </div>


                           <div class="form-group">
                            <label>{{trans('constants.available_from')}} <span style="color: red;">*</span></label>
                             <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <span class="la la-calendar-o"></span>
                                </span>
                              </div>
                              <input type='text' class="form-control pickadate-arrow" placeholder="Date" name="available_from" value="@if(isset($data->available_from)){{$data->available_from}}@endif" id="available_from" required>
                             </div>
                           </div>

                           <div class="form-group">
                            <label>{{trans('constants.expiry_date')}} <span style="color: red;">*</span> </label>
                             <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <span class="la la-calendar-o"></span>
                                </span>
                              </div>
                              <input type='text' class="form-control pickadate-arrow" id="expiry_date" placeholder="Date" name="valid_till" value="@if(isset($data->valid_till)){{$data->valid_till}}@endif" required>
                             </div>
                           </div>

                          <div class="form-group">
                              <label for="promocode1">{{trans('constants.status')}} <span style="color: red;">*</span></label>
                              <select class="c-select form-control" id="promo_type1" name="status" required>
                                <option value="1" @if(isset($data) && $data->status==1) selected @endif>{{trans('constants.active')}}</option>
                                <option value="2" @if(isset($data) && $data->status==2) selected @endif>{{trans('constants.inactive')}}</option>
                              </select>
                            </div>
                            <span class="error_message" id="promo_error"></span>
                            <div class="form-actions">
                              <button type="button" class="btn btn-warning mr-1" style="padding: 10px 15px;">
                               <i class="ft-x"></i> Cancel
                                </button>
                              <button onclick="javascript:form_validation();" class="btn btn-primary mr-1" style="padding: 10px 15px;">
                               <i class="ft-check-square"></i> Save
                                </button>
                            </div>
                          </div>
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

  <script>
    function form_validation() {
        var available_from = document.getElementById('available_from').value;
        var expiry_date = document.getElementById('expiry_date').value;
        var promocode_title = document.getElementById('promocode_title').value;
        var description = document.getElementById('description').value;
        var promo_code = document.getElementById('promo_code').value;
        var offer_type = document.getElementById('offer_type').value;
        var discount = document.getElementById('discount').value;
        var total_use = document.getElementById('total_use').value;
        var use_per_customer = document.getElementById('use_per_customer').value;

        if(available_from =='' || expiry_date ==''|| promocode_title =='' || description =='' || promo_code =='' || offer_type =='' || discount =='' || total_use =='' || use_per_customer =='')
        {
          $('#promo_error').fadeIn().html('Please enter all the fields').delay(3000).fadeOut('slow');
        }else{
          // document.getElementById("add_promo").submit();
        }
    }
  </script>
  
<script>

$( document ).ready(function() {
  @if(isset($data))
    @if($data->offer_type ==0)
      $('.max_amount').show();
      @else
      $('.max_amount').hide();
    @endif
    @if($data->coupon_type ==2)
      $('.coupon_value').show();
    @else
      $('.coupon_value').hide();
    @endif
  @else
    $('.max_amount').hide();
    $('.coupon_value').hide();
  @endif
});
function Promocode() {
  var x = document.getElementById("promo_code");
  x.value = x.value.toUpperCase();
}

function offerType() {
  var x = document.getElementById("offer_type").value;

  if(x == 0){
    $('.max_amount').show();
  }else{
    $('#max_amount').val('0');
    $('.max_amount').hide();
  }
}

$( "input[type='radio']" ).change(function() {
  var radioValue = $("input[name='coupon_type']:checked").val();
  if(radioValue==2){
    $('.coupon_value').show();
  }else{
    $('#coupon_value').val('0');
    $('.coupon_value').hide();
  }
});
</script>
    @endsection     
 