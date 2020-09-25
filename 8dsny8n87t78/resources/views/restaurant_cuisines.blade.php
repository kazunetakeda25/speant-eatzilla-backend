@extends('layout.master')

@section('title')

{{APP_NAME}}

@endsection

@section('content')
 <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">{{strtoUpper(__('constants.cuisines'))}} {{strtoUpper(__('constants.list'))}}</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard">{{ strtoUpper(trans('constants.dashboard'))}}</a>
                </li>
                <li class="breadcrumb-item"><a href="#">{{strtoUpper(__('constants.cuisines'))}} {{strtoUpper(__('constants.list'))}}</a>
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
                  <h4 class="card-title">&nbsp;</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                  <div class="heading-elements">
                     <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                     <li>  <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_cuisine"><i class="ft-plus white"></i>Add Cuisines</button>
                     </li>
                   </ul>
                  </div>   
                </div>
                </div>


                 <!----------  Add Cuisine Partner Model --------------------->
                <div class="modal animated slideInRight text-left" id="add_cuisine" tabindex="-1" role="dialog" aria-labelledby="myModalLabel76" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                        <div class="modal-content">
                         <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel76">Add Cuisines</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                         </div>
                         <form method="post" action="{{url('/')}}/admin/add_to_restaurant_cuisines">
                            <div class="modal-body">
                              
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                 <div class="form-group">
                                    <label for="eventName2">Cuisine Name:</label>
                                     <select class="c-select form-control" id="cuisine_name" name="cuisine_id">
                                      <option value="">Choose Cuisines</option>
                                      @foreach($cuisines as $c)
                                      <option value="{{$c->id}}" >{{$c->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                            </div>
                             <div class="modal-footer">
                                <button type="button" class="btn btn-warning mr-1" data-dismiss="modal" style="padding: 10px 15px;">
                                   <i class="ft-x"></i> Cancel
                                    </button>
                                  <button type="submit" class="btn btn-primary mr-1" style="padding: 10px 15px;">
                                <i class="ft-check-square"></i> Add
                                 </button>
                            </div>
                          </form>
                      </div>
                    </div>
                  </div>
                   <!----------  Add Cuisine Model Ends--------------------->


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
                          <?php $i=1; ?>
                          @foreach($restaurant_cuisines as $key)
                          <tr>
                            <td>{{$i}}</td>
                            <td>{{$key->cuisine_name}}</td>
                            <td>
                                 <button type="button" class="btn btn-icon btn-success mr-1 link_clr" data-id="1" data-toggle="modal"  data-target="#delete{{$key->cid}}"><i class="ft-delete"></i></button>
                            </td>
                          </tr>
                          <?php $i++; ?>
                        
                            <!----------  Delete Cuisine Partner Model --------------------->

                                  <div class="modal animated slideInRight text-left" id="delete{{$key->cid}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel76" aria-hidden="true">
                                       <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                         <div class="modal-header">
                                          <h4 class="modal-title" id="myModalLabel76">Delete Cuisine</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                         </div>
                                         <form method="post" action="{{url('/')}}/admin/delete_restaurant_cuisine">
                                            <div class="modal-body">
                                              
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                  <input type="hidden" name="cuisine_id" value="{{$key->cid}}">
                                                 <div class="form-group">
                                                    <label for="eventName2">Are you sure to delete  : {{$key->cuisine_name}}</label>
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
 