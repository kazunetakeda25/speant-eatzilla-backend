@extends('layout.master')

@section('title')
{{APP_NAME}}

@endsection

@section('content')
<style type="text/css">
   .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
@php 
if(isset(auth()->user()->AccessPrivilages->food_management)) $foodAccess = explode(",",auth()->user()->AccessPrivilages->food_management); 
else $foodAccess=array();
@endphp
  <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">{{strtoUpper(trans('constants.product'))}} {{strtoUpper(trans('constants.list'))}}</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard">{{strtoUpper(trans('constants.dashboard'))}}</a>
                </li><li class="breadcrumb-item"><a href="#">{{strtoUpper(trans('constants.product'))}} {{strtoUpper(trans('constants.list'))}}</a>
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
                    <h4 class="card-title" style="height:50px;color:red;">
                      </h4>
                  <h4 class="card-title"></h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                  <div class="heading-elements">
                     <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li @if(isset(auth()->user()->role) && auth()->user()->role==3 && !in_array(2,(array)$foodAccess)) style="display:none" @endif> <button class="btn btn-primary btn-sm"><i class="ft-plus white"></i><a style=" color: white !important;" href="{{URL('/')}}/admin/add_product"> {{trans('constants.add')}} {{trans('constants.product')}}</a></button></li>
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
                            @if(session()->get('role')==1)
                              <th>{{trans('constants.restaurant')}} {{trans('constants.name')}}</th>
                            @endif
                            <th>{{trans('constants.name')}}</th>
                            <th>{{trans('constants.menu')}} {{trans('constants.name')}}</th>
                            <th>{{trans('constants.category')}}</th>
                            <!-- <th>{{trans('constants.tax')}} in %</th> -->
                            <th>{{trans('constants.price')}}</th>
                            @if(session()->get('role')!=1)
                              <th>Today's Special</th>
                              <th>{{trans('constants.status')}}</th>
                            @endif
                            <th>{{trans('constants.action')}}</th>
                          </tr>
                        </thead>
                        <tbody>

                          @foreach($data as $d)
                          <tr>
                            <td>{{$d->id}}</td>
                            @if(session()->get('role')==1)
                              <td>@isset($d->Restaurants->restaurant_name) {{$d->Restaurants->restaurant_name}} @endisset</td>
                            @endif
                            <td>@isset($d->name) {{$d->name}} @endisset</td>
                            <td>@isset($d->Menu->menu_name) {{$d->Menu->menu_name}} @endisset</td>
                            <td>@isset($d->Category->category_name) {{$d->Category->category_name}} @endisset</td>
                            <!-- <td>{{$d->tax}}</td> -->
                            <td>{{DEFAULT_CURRENCY_SYMBOL}} {{$d->price}}</td>
                            @if(session()->get('role')!=1)
                            <td>
                              @if($d->is_special == 1)
                                <label class="switch">
                                    <input type="checkbox" name="is_special" onclick="javascript:window.location.href='{{url('/')}}/admin/food_special_disable/{{$d->id}}'" value="1" 
                                    checked>                       
                                <span class="slider round"></span></label>
                              @else
                                <label class="switch">
                                    <input type="checkbox" name="status" onclick="javascript:window.location.href='{{url('/')}}/admin/food_special_enable/{{$d->id}}'" value="1" >                       
                                <span class="slider round"></span></label>
                              @endif
                            </td>
                            <td>
                            @if($d->status == 1)
                              <label class="switch">
                                   <input type="checkbox" name="status" onclick="javascript:window.location.href='{{url('/')}}/admin/food_status_disable/{{$d->id}}'" value="1" 
                                   checked>                       
                              <span class="slider round"></span></label>
                              @else
                              <label class="switch">
                                   <input type="checkbox" name="status" onclick="javascript:window.location.href='{{url('/')}}/admin/food_status_enable/{{$d->id}}'" value="1" >                       
                              <span class="slider round"></span></label>
                              @endif
                            </td>
                            @endif
                            <td>
                               <li @if(isset(auth()->user()->role) && auth()->user()->role==3 && !in_array(3,(array)$foodAccess)) style="display:none" @endif><a href="{{url('/')}}/admin/edit_product_list/{{$d->id}}" class="button btn btn-icon btn-success mr-1 link_clr"><i class="ft-edit"></i></a>
                               <button @if(isset(auth()->user()->role) && auth()->user()->role==3 && !in_array(4,(array)$foodAccess)) style="display:none" @endif type="button" class="btn btn-icon btn-success mr-1 link_clr" data-id="1" data-toggle="modal"  data-target="#{{$d->id}}"><i class="ft-delete"></i></button>
                            </td>
                          </tr>

                          <!--- Deleted Restaurant / Model -->
                          <div class="modal animated slideInRight text-left" id="{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel76" aria-hidden="true">
                                       <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                         <div class="modal-header">
                                          <h4 class="modal-title" id="myModalLabel76">Delete Product</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                         </div>
                                         <form method="post" action="{{url('/')}}/admin/delete_product/{{$d->id}}">
                                            <div class="modal-body">
                                              
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                  <input type="hidden" name="id" value="{{$d->id}}">
                                                 <div class="form-group">
                                                    <label for="eventName2">Are you sure to delete product : {{$d->name}}
                                                    </label>
                                                  </div>
                                            
                                            </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-warning mr-1" data-dismiss="modal" style="padding: 10px 15px;">
                                                   <i class="ft-x"></i> Cancel
                                                    </button>
                                                  <button type="submit" class="btn btn-primary mr-1" style="padding: 10px 15px;">
                                                <i class="ft-check-square"></i> Delete
                                                 </button>
                                            </div>
                                          </form>
                                      </div>
                                    </div>
                                  </div>

                          <!--- End Deleted Restaurant / Modulel -->
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
 