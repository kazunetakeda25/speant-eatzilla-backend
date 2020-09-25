@extends('layout.master')

@section('title')

{{APP_NAME}}
@endsection

@section('content')
   <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">COMMISSION SETTINGS</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">DASHBOARD</a>
                </li><li class="breadcrumb-item"><a href="categorylist.html">COMMISSION SETTINGS</a>
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
                      ** Demo Mode : No Permission to Edit and Delete.</h4>
                  <h4 class="card-title">COMMISSION SETTINGS LIST</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                  <div class="heading-elements">
                     <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                     <li> <button class="btn btn-primary btn-sm"><i class="ft-plus white"></i><a style=" color: white !important;" href="#"> Add Commission</a></button></li>
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
                            <th>Name</th>   
                            <th>Commission in %</th>   
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        
                          <tr>
                            <td>1</td>
                            <td>Admin Commission</td>
                            <td>{{$admin_commission->value}}%</td>
                            <td> <button type="button" class="button btn btn-icon btn-success mr-1" data-id="1" data-toggle="modal"  data-target="#{{$commission_id[0]}}"><i class="ft-edit"></i></button>
                          </tr>
                           <tr>
                            <td>2</td>
                            <td>Restaurant Commission</td>
                            <td>{{$restaurant_commission->value}}%</td>
                            <td><button type="button" class="button btn btn-icon btn-success mr-1" data-id="1" data-toggle="modal"  data-target="#{{$commission_id[1]}}"><i class="ft-edit"></i></button></td>
                          </tr>
                           <tr>
                            <td>3</td>
                            <td>Delivery Boy Commission</td>
                            <td>{{$delivery_boy_commission->value}}%</td>
                            <td><button type="button" class="button btn btn-icon btn-success mr-1" data-id="1" data-toggle="modal"  data-target="#{{$commission_id[2]}}"><i class="ft-edit"></i></button></td>
                          </tr>
                         
                        </tbody>
                  
                      </table>
                    </div>
                  </div>
                </div>

                   <div class="modal animated slideInRight text-left" id="{{$commission_id[0]}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel76" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                        <div class="modal-content">
                         <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel76">View Order</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                         </div>
                         <form method="post" action="{{url('/')}}/admin/update_commission_settings">
                            <div class="modal-body">
                              
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                  <input type="hidden" name="id" value="{{$commission_id[0]}}">
                                 <div class="form-group">
                                    <label for="eventName2">Commission Value in % :</label>
                                    <input type="text" name="commission_value" class="form-control"  value="{{$admin_commission->value}}" required>
                                  </div>
                            
                            </div>
                             <div class="modal-footer">
                                <button type="button" class="btn btn-warning mr-1" data-dismiss="modal" style="padding: 10px 15px;">
                                   <i class="ft-x"></i> Cancel
                                    </button>
                                  <button type="submit" class="btn btn-primary mr-1" style="padding: 10px 15px;">
                                <i class="ft-check-square"></i> Save
                                 </button>
                            </div>
                          </form>
                      </div>
                    </div>
                  </div>

                    <div class="modal animated slideInRight text-left" id="{{$commission_id[1]}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel76" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                        <div class="modal-content">
                         <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel76">View Order</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                         </div>
                          <form method="post" action="{{url('/')}}/admin/update_commission_settings">
                            <div class="modal-body">
                             
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                  <input type="hidden" name="id" value="{{$commission_id[1]}}">
                                 <div class="form-group">
                                    <label for="eventName2">Commission Value in % :</label>
                                    <input type="text" name="commission_value" class="form-control"  value="{{$restaurant_commission->value}}" required>
                                  </div>
                             
                            </div>
                             <div class="modal-footer">
                                <button type="button" class="btn btn-warning mr-1" data-dismiss="modal" style="padding: 10px 15px;">
                                   <i class="ft-x"></i> Cancel
                                    </button>
                                  <button type="submit" class="btn btn-primary mr-1" style="padding: 10px 15px;">
                                <i class="ft-check-square"></i> Save
                                 </button>
                            </div>
                         </form>
                      </div>
                    </div>
                  </div>

                    <div class="modal animated slideInRight text-left" id="{{$commission_id[2]}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel76" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                        <div class="modal-content">
                         <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel76">View Order</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                         </div>
                          <form method="post" action="{{url('/')}}/admin/update_commission_settings">
                            <div class="modal-body">
                             
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                  <input type="hidden" name="id" value="{{$commission_id[2]}}">
                                 <div class="form-group">
                                    <label for="eventName2">Commission Value in % :</label>
                                    <input type="text" name="commission_value" class="form-control"  value="{{$delivery_boy_commission->value}}" required>
                                  </div>
                              
                            </div>
                             <div class="modal-footer">
                                <button type="button" class="btn btn-warning mr-1" data-dismiss="modal" style="padding: 10px 15px;">
                                   <i class="ft-x"></i> Cancel
                                    </button>
                                  <button type="submit" class="btn btn-primary mr-1" style="padding: 10px 15px;">
                                <i class="ft-check-square"></i> Save
                                 </button>
                            </div>
                        </form>
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
 