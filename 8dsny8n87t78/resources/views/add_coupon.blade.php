@extends('layout.master')

@section('title')

{{APP_NAME}}

@endsection

@section('content')

 <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">ADD COUPON</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
              <!--   <li class="breadcrumb-item"><a href=" "></a>
                </li> -->
                <li class="breadcrumb-item"><a href=" ">ADD COUPON</a>
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
                  <h4 class="card-title"> COUPON</h4>
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
                    <form action="{{url('/')}}/admin/coupon_add" method="post"   class="icons-tab-steps wizard-notification">
                     <input type="hidden" name="_token" value="{{csrf_token()}}">
                      @if(isset($data))
                        <input type="hidden" class="form-control" value="{{$data->id}}" name="id" >
                         @endif

                    <fieldset>
                        <div class="row">
                         
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="eventName2">Coupon Type<span style="color: red;">*</span></label>
                              <select name="coupon_type" id="" class="form-control" required="">
                                


                                  @if(isset($data->coupon_type))
                                @if($data->coupon_type==1)
                                <option value="1">Admin</option>
                                @else
                                <option value="2">Restaurant</option>
                                @endif
                                
                                @endif
                                 
                                <option value="1">Admin</option>
                                <option value="2">Restaurant</option>
                                
                            </select> 
                            </div>
                          </div>
                        
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="email">Code<span style="color: red;">*</span></label>
                             <input type="text" class="form-control" name="code" value="@if(isset($data->code)){{$data->code}}@endif" id="email" placeholder="">
                             </div>
                            </div>
                          </div>
                          <div class="row">
                         
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="eventName2">Discount Type<span style="color: red;">*</span></label>
                              <select name="discount_type" id="" class="form-control" required="">
                                
                                
                                
                                  @if(isset($data->discount_type))
                                @if($data->discount_type==1)
                                <option value="1">Flat Discount</option>
                                @else
                                <option value="2">Percentage Discount</option>
                                @endif
                               
                                @endif
                                 
                                <option value="1">Flat Discount</option>
                                <option value="2">Percentage Discount</option>
                                
                            </select> 
                            </div>
                          </div>
                        
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="email">Amount<span style="color: red;">*</span></label>
                             <input type="text" class="form-control" name="amount" value="@if(isset($data->amount)){{$data->amount}}@endif"  id="email" placeholder="">
                             </div>
                            </div>
                          </div>
                          <div class="row">
                         
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="eventName2">Usage Limit Per Coupon<span style="color: red;">*</span></label>
                              <input type="text" class="form-control" name="usage_limit_per_coupon" value="@if(isset($data->usage_limit_per_coupon)){{$data->usage_limit_per_coupon}}@endif" id="email" placeholder="">
                            </div>
                          </div>
                        
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="email">Usage Limit Per User<span style="color: red;">*</span></label>
                             <input type="text" class="form-control" name="usage_limit_per_user" id="email" value="@if(isset($data->usage_limit_per_user)){{$data->usage_limit_per_user}}@endif" placeholder="">
                             </div>
                            </div>
                          </div>
                          <div class="row">
                         
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="eventName2">Valid From<span style="color: red;">*</span></label>
                              <input type="text" class="form-control pickadate-selectors picker__input picker__input--active" name="valid_from" value="@if(isset($data->valid_from)){{$data->valid_from}}@endif" id="email" placeholder="">
                            </div>
                          </div>
                        
                          <div class="col-md-6">
                             <div class="form-group">
                             <label  for="projectinput4">Status<span style="color: red;">*</span></label>
                            <select name="status" id="" class="form-control" required="">
                                 @if(isset($data->status))
                                @if($data->status==1)
                                <option value="1">Active</option>
                                @else
                                <option value="2">Inactive</option>
                                @endif

                                @endif
                                 
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                                
                            </select> 
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
   

    @endsection     
 