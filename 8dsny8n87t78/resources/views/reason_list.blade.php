@extends('layout.master')

@section('title')
{{APP_NAME}}

@endsection

@section('content')
@php $cancelAccess = explode(",",auth()->user()->AccessPrivilages->cancel_reason); @endphp
 <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">REASON LIST</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard">{{strtoUpper(trans('constants.dashboard'))}}</a>
                <li class="breadcrumb-item"><a href="#">REASON LIST</a>
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
                    <!--  <li>  <button class="btn btn-primary btn-sm"><i class="ft-plus white"></i><a style=" color: white !important;" href="{{URL('/')}}/admin/add_dispmanager"> Add Dispute Manager</a></button></li> -->
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
                            <th>Reason</th>
                            <th>Cancellation For</th>
                            <th>Status</th>
                            <th>{{__('constants.action')}}</th>
                            <!-- <th>Action</th> -->
                          </tr>
                        </thead>
                        <tbody>
                          <!--{{$s_no=1}}-->
                          @foreach($reason_list as $reason)
                          <tr>
                           
                            <td>{{$s_no}}</td>
                            <td>{{$reason->reason}}</td>
                            
                            <td>
                             
                              <?php

                            switch ((int) $reason->cancellation_for) {
                              case 1:
                                echo 'Restaurant';
                              break;
                              case 2:
                                echo 'User ';
                              break;
                              
                              
                              default:
                                echo 'NULL';
                                break;
                            }
                            ?></td>
                            
                           <td><button class="btn btn-danger">
                             
                              <?php

                            switch ((int) $reason->status) {
                              case 1:
                                echo 'Active';
                              break;
                              default:
                                echo 'In Active ';
                              break;
                            }
                            ?></button></td>
                            <td>
                                <a href="{{url('/')}}/admin/update_cancellation_reason/{{$reason->id}}" class="button btn btn-icon btn-success mr-1 link_clr" @if(auth()->user()->role==3 && !in_array(3,(array)$cancelAccess)) style="display:none" @endif><i class="ft-edit"></i></a>
                                <button type="button" class="btn btn-icon btn-success mr-1 link_clr" data-id="1" data-toggle="modal"  data-target="#{{$reason->id}}" @if(auth()->user()->role==3 && !in_array(4,(array)$cancelAccess)) style="display:none" @endif><i class="ft-delete"></i></button>
                              </td>
                            </tr>
                             <!----------  Delete Banner Model --------------------->

                             <div class="modal animated slideInRight text-left" id="{{$reason->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel76" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                  <h4 class="modal-title" id="myModalLabel76">Delete Cancel Reason</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form method="post" action="{{url('/')}}/admin/delete_cancel_reason">
                                    <div class="modal-body">
                                      
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                          <input type="hidden" name="id" value="{{$reason->id}}">
                                          <div class="form-group">
                                            <label for="eventName2">Are you sure to delete the reason : {{$reason->reason}} ?
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
                            <!----------  Delete Banner Model Ends--------------------->
                          <!--{{$s_no++}}-->
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
