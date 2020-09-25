@extends('layout.master')

@section('title')
{{APP_NAME}}

@endsection

@section('content')
@php $promoAccess = explode(",",auth()->user()->AccessPrivilages->promocode); @endphp
 <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">{{strtoUpper(trans('constants.promo_code'))}}</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard">{{strtoUpper(trans('constants.dashboard'))}}</a>
                <li class="breadcrumb-item"><a href="#">{{strtoUpper(trans('constants.promo_code'))}}</a>
                </li>
               
              </ol>
            </div>
          </div>
        </div>
        <!-- <div class="content-header-right col-md-6 col-12">
          <div class="dropdown float-md-right">
            <button class="btn btn-danger dropdown-toggle round btn-glow px-2" id="dropdownBreadcrumbButton"
            type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
            <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton"><a class="dropdown-item" href="#"><i class="la la-calendar-check-o"></i> Calender</a>
              <a class="dropdown-item" href="#"><i class="la la-cart-plus"></i> Cart</a>
              <a class="dropdown-item" href="#"><i class="la la-life-ring"></i> Support</a>
              <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="la la-cog"></i> Settings</a>
            </div>
          </div>
        </div> -->
      </div>
      <div class="content-body">
        <!-- Basic form layout section start -->


         <section id="configuration">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-head">
                  <div class="card-header">
                  <!-- <h4 class="card-title" style="height:50px;color:red;">
                ** Demo Mode : No Permission to Edit and Delete.</h4> -->
                  <h4 class="card-title">&nbsp;</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                  <div class="heading-elements">
                     <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                     <li @if(auth()->user()->role==3 && !in_array(2,(array)$promoAccess)) style="display:none" @endif>  <button class="btn btn-primary btn-sm"><i class="ft-plus white"></i><a style=" color: white !important;" href="{{URL('/')}}/admin/add_promocode"> {{(trans('constants.add'))}} {{(trans('constants.promo_code'))}}</a></button></li>
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
                            <th>Sl.No</th>
                            <th>{{(trans('constants.promo_code'))}}</th>
                            <th>{{(trans('constants.offer_type'))}}</th>
                            <th>{{(trans('constants.discount'))}}</th>
                            <th>{{(trans('constants.available_from'))}}</th>
                            <th>{{(trans('constants.expiry_date'))}}</th>
                            <th>{{(trans('constants.limit_user'))}}</th>
                            <th>{{(trans('constants.max_amount'))}}</th>
                            <th>{{(trans('constants.total_usage'))}}</th>
                            <th>{{(trans('constants.status'))}}</th>
                            <th>{{(trans('constants.action'))}}</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i=1; ?>
                          @foreach($promocodes_list as $key)
                          <tr>
                            <td>
                              {{$i}}
                            </td>
                            <td>{{$key->code}}</td>
                            <td><?php if($key->offer_type==0)
                            {
                              echo "%";
                            }else {
                             echo "amount";
                            } ?></td>
                            <td>{{$key->value}}</td>
                            <td>{{$key->available_from}}</td>
                            <td>{{$key->valid_till}}
                            </td>
                            <td>{{$key->use_per_customer}}</td>
                            <td>{{$key->max_amount}}</td>
                            <td>{{$key->total_use}}</td>
                            <td><?php if($key->status==2)
                            {
                              echo "INACTIVE";
                            }else {
                             echo "ACTIVE";
                            } ?></td>
                            <td>
                             <a href="{{url('/')}}/admin/edit_promocode/{{$key->id}}" class="button btn btn-icon btn-success mr-1 link_clr" @if(auth()->user()->role==3 && !in_array(3,(array)$promoAccess)) style="display:none" @endif><i class="ft-edit"></i></a>
                              <button type="button" class="btn btn-icon btn-danger mr-1 link_clr" data-id="1" data-toggle="modal"  data-target="#{{$key->id}}" @if(auth()->user()->role==3 && !in_array(4,(array)$promoAccess)) style="display:none" @endif><i class="ft-trash"></i></button>
                             </td>
                          </tr>
                            <!---  Delete Delivery Partner Model -->

                                  <div class="modal animated slideInRight text-left" id="{{$key->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel76" aria-hidden="true">
                                       <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                         <div class="modal-header">
                                          <h4 class="modal-title" id="myModalLabel76"> Delete {{trans('constants.promo_code')}}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                         </div>
                                         <form method="post" action="{{url('/')}}/admin/delete_promocode/{{$key->id}}">
                                            <div class="modal-body">
                                              
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                  <input type="hidden" name="id" value="{{$key->id}}">
                                                   @if($key->status==0)
                                                      <input type="hidden" name="status" value="1">
                                                    @else
                                                      <input type="hidden" name="status" value="0">
                                                    @endif
                                                 <div class="form-group">
                                                    <label for="eventName2">Are you sure to  delete Promocode : {{$key->code}}</label>
                                                  </div>
                                            
                                            </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-warning mr-1" data-dismiss="modal" style="padding: 10px 15px;">
                                                   <i class="ft-x"></i> Cancel
                                                    </button>
                                                  <button type="submit" class="btn btn-primary mr-1" style="padding: 10px 15px;">
                                                <i class="ft-check-square"></i>  Delete
                                                 </button>
                                            </div>
                                          </form>
                                      </div>
                                    </div>
                                  </div>
                                   <!--  Delete Delivery Partner Model Ends -->
                          <?php $i++; ?>
                          @endforeach
                         
                          
                        </tbody>


                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- // Basic form layout section end -->
      </div>
    </div>
 


    @endsection     
 