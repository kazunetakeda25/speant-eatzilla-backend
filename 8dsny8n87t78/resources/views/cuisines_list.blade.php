@extends('layout.master')

@section('title')

{{APP_NAME}}
@endsection

@section('content')
@php $cuisinesAccess = explode(",",auth()->user()->AccessPrivilages->cuisines); @endphp
 <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">{{strtoUpper(trans('constants.cuisines'))}} {{strtoUpper(trans('constants.list'))}}</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard">{{strtoUpper(trans('constants.dashboard'))}}</a>
                <li class="breadcrumb-item"><a href="#">{{strtoUpper(trans('constants.cuisines'))}} {{strtoUpper(trans('constants.list'))}}</a>
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
                  <h4 class="card-title" style="height:50px;color:red;">
                </h4>
                  <h4 class="card-title"></h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                  <div class="heading-elements">
                     <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                     <li @if(auth()->user()->role==3 && !in_array(2,(array)$cuisinesAccess)) style="display:none" @endif>  <button class="btn btn-primary btn-sm"><i class="ft-plus white"></i><a style=" color: white !important;" href="{{URL('/')}}/admin/add_cuisines"> Add Cuisines</a></button>
                     </li>
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
                            <th>SI</th>
                            <th>Name</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i=0; ?>
                          @foreach($data as $d)
                          <tr>
                            <td>{{$i}}</td>
                            <td>{{$d->name}}</td>
                            <td><button type="button" class="button btn btn-icon btn-success mr-1" data-id="1" data-toggle="modal"  
                                data-target="#{{$d->id}}" @if(auth()->user()->role==3 && !in_array(3,(array)$cuisinesAccess)) style="display:none" @endif><i class="ft-edit"></i></button>
                                 <button type="button" class="btn btn-icon btn-success mr-1 link_clr" data-id="1" data-toggle="modal"  data-target="#delete{{$d->id}}" @if(auth()->user()->role==3 && !in_array(4,(array)$cuisinesAccess)) style="display:none" @endif><i class="ft-delete"></i></button></li>
                            </td>
                          </tr>
                          <?php $i++; ?>
                           <!----------  Edit Cuisine Partner Model --------------------->
                        <div class="modal animated slideInRight text-left" id="{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel76" aria-hidden="true">
                               <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                 <div class="modal-header">
                                  <h4 class="modal-title" id="myModalLabel76">Edit Cuisines</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <form method="post" action="{{url('/')}}/admin/add_to_cuisines">
                                    <div class="modal-body">
                                      
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                          <input type="hidden" name="id" value="{{$d->id}}">
                                         <div class="form-group">
                                            <label for="eventName2">Cuisine Name:</label>
                                            <input type="text" class="form-control" id="cuisine_name" name="cuisine_name" value="{{$d->name}}">
                                          </div>
                                    
                                    </div>
                                     <div class="modal-footer">
                                        <button type="button" class="btn btn-warning mr-1" data-dismiss="modal" style="padding: 10px 15px;">
                                           <i class="ft-x"></i> Cancel
                                            </button>
                                          <button type="submit" class="btn btn-primary mr-1" style="padding: 10px 15px;">
                                        <i class="ft-check-square"></i> Update
                                         </button>
                                    </div>
                                  </form>
                              </div>
                            </div>
                          </div>
                           <!----------  Edit Cuisine Model Ends--------------------->
                            <!----------  Delete Cuisine Partner Model --------------------->

                                  <div class="modal animated slideInRight text-left" id="delete{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel76" aria-hidden="true">
                                       <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                         <div class="modal-header">
                                          <h4 class="modal-title" id="myModalLabel76">Delete Cuisine</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                         </div>
                                         <form method="post" action="{{url('/')}}/admin/delete_cuisine">
                                            <div class="modal-body">
                                              
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                  <input type="hidden" name="id" value="{{$d->id}}">
                                                 <div class="form-group">
                                                    <label for="eventName2">Are you sure want to delete : {{$d->name}}
                                                    <br>Some Restaurants and Food Items are based on this {{__('constants.cuisines')}} will also be deleted. 
                                                    <br>If you need those Restaurants and Food list, kindly remove the {{__('constants.cuisines')}} from those list before delete!
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
 