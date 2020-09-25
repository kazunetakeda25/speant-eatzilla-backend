@extends('layout.master')

@section('title')

{{APP_NAME}}

@endsection

@section('content')
@php 
  $bannerAccess=array();
  if(isset(auth()->user()->AccessPrivilages->banner)) 
    $bannerAccess = explode(",",auth()->user()->AccessPrivilages->banner); 
 
@endphp
  <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block"> BANNER</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard">{{strtoUpper(trans('constants.dashboard'))}}</a>
                <li class="breadcrumb-item"><a href="#">MANAGE BANNER</a>
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
                            <th>SI.No</th>
                            <th>Shop Name</th>
                            <th>Image</th>
                            <th>Status</th> 
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i=1; ?>
                          @foreach($banner_list as $key)
                          <tr>
                            <td>{{$i}}</td>
                            <td>{{$key->restaurant_name}}</td>
                            
                            <td><img src="{{$key->banner_image}}" width="100px" alt=""></td>
                            <td><button class="btn btn-danger">
                             
                              <?php

                            switch ((int) $key->banner_status) {
                              case 1:
                                echo 'Active';
                              break;
                              case 2:
                                echo 'In Active ';
                              break;
                              
                              
                              default:
                                echo 'NULL';
                                break;
                            }
                            ?></button></td>
                            <td>
                              <ul>
                                 <li @if(isset(auth()->user()->role)) @if(auth()->user()->role==3 && !in_array(3,(array)$bannerAccess)) style="display:none" @endif @endif><a href="{{url('/')}}/admin/edit_banner/{{$key->banner_id}}" class="button btn btn-icon btn-success mr-1 link_clr"><i class="ft-edit"></i></a>
                              <a href="{{url('/')}}/admin/delete_banner/{{$key->banner_id}}" class="btn btn-icon btn-success mr-1 link_clr" data-id="1" data-toggle="modal"  data-target="#{{$key->banner_id}}" @if(isset(auth()->user()->role)) @if(auth()->user()->role==3 && !in_array(4,(array)$bannerAccess)) style="display:none" @endif @endif><i class="ft-delete"></i></a></li>
                              </ul>
                            </td>
                          </tr>

                                   <!----------  Delete Banner Model --------------------->

                                  <div class="modal animated slideInRight text-left" id="{{$key->banner_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel76" aria-hidden="true">
                                       <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                         <div class="modal-header">
                                          <h4 class="modal-title" id="myModalLabel76">Delete Banner</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                         </div>
                                         <form method="post" action="{{url('/')}}/admin/delete_banner">
                                            <div class="modal-body">
                                              
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                  <input type="hidden" name="banner_id" value="{{$key->banner_id}}">
                                                 <div class="form-group">
                                                    <label for="eventName2">Are you sure to delete this banner ?</label>
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

                          <?php $i++; ?>
                         @endforeach 
                        </tbody>
                   
                        <tfoot>
                          <tr>
                            <th>SI.No</th>
                            <th>Shop Name</th>
                            <th>Image</th>
                            <th>Status</th> 
                            <th>Action</th>
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
    </div>
  


    @endsection     
 