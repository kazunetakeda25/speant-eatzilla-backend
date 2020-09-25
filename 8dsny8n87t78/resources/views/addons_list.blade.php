@extends('layout.master')

@section('title')

{{APP_NAME}}

@endsection

@section('content')
  <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">{{strtoUpper(trans('constants.addon'))}}</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard">{{strtoUpper(trans('constants.dashboard'))}}</a>
                </li><li class="breadcrumb-item"><a href="#">{{strtoUpper(trans('constants.addon'))}} {{strtoUpper(trans('constants.list'))}}</a>
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
                      @if(session()->get('role')!=1)
                        <li> <button class="btn btn-primary btn-sm"><i class="ft-plus white"></i><a style=" color: white !important;" href="{{url('/')}}/admin/add_addons"> {{trans('constants.add')}} {{trans('constants.addon')}}</a></button></li>
                      @endif
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
                            <th>{{trans('constants.price')}}</th>
                            @if(session()->get('role')!=1)
                              <th>{{trans('constants.action')}}</th>
                            @endif
ss                        </thead>
                        <tbody>
                          @php $i=1; @endphp
                          @foreach($addons_list as $value)
                            <tr>
                              <td>{{$i}}</td>
                              @if(session()->get('role')==1)
                                <td>@if(!empty($value->Restaurant)) {{$value->Restaurant->restaurant_name}} @endif</td>
                              @endif
                              <td>{{$value->name}}</td>
                              <td>{{DEFAULT_CURRENCY_SYMBOL}} {{$value->price}}</td>
                              @if(session()->get('role')!=1)
                                <td>
                                  <a href="{{url('/')}}/admin/edit_addons/{{$value->id}}" class="button btn btn-icon btn-success mr-1 link_clr"><i class="ft-edit"></i></a>
                                  <button type="button" class="btn btn-icon btn-success mr-1 link_clr" data-id="1" data-toggle="modal"  data-target="#delete{{$value->id}}"><i class="ft-delete"></i></button></li>
                                </td>
                              @endif
                            </tr>
                          @php $i=$i+1; @endphp
                            <!----------  Delete Cuisine Partner Model --------------------->

                            <div class="modal animated slideInRight text-left" id="delete{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel76" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel76">Delete Addons</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form method="post" action="{{url('/')}}/admin/delete_add_ons/{{$value->id}}">
                                  <div class="modal-body">
                                    
                                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input type="hidden" name="id" value="{{$value->id}}">
                                        <div class="form-group">
                                          <label for="eventName2">Are you sure to delete  : {{$value->name}}
                                          <br>This Addon in some Food Items will also be deleted.
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
                          <!----------  Delete Cuisine Model Ends--------------------->
                          @endforeach
                        </tbody>
                   
                        <tfoot>
                          <tr>
                             <th>{{trans('constants.sno')}}</th>
                            <th>{{trans('constants.name')}}</th>
                            <th>{{trans('constants.price')}}</th>
                            <th>{{trans('constants.action')}}</th>
                          </tr>
                         </tfoot>
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
  
    @endsection     
 