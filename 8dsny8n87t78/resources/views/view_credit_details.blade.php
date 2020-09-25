@extends('layout.master')

@section('title')
{{APP_NAME}}
@endsection

@section('content')
  <div class="content-wrapper">

  <div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
      <h3 class="content-header-title mb-0 d-inline-block">CREDIT DETAILS</h3>
      <div class="row breadcrumbs-top d-inline-block">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{url('/')}}/admin">USER CREDITS</a>
            </li>
            <li class="breadcrumb-item">
              <a href="">APPROVE/DECLINE CREDITS</a>
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
                  <h4 class="card-title">&nbsp;</h4>
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
                 <hr>

                <div class="card-content collapse show">
                  <div class="card-body">
                    <form action="{{url('/')}}/admin/update_usercredit" class="icons-tab-steps wizard-notification" method="post">
                     <input type="hidden" name="_token" value="{{csrf_token()}}">
                     <input type="hidden" name="id" value="{{$user_detail->id}}">
                    <fieldset>
                        <div class="row">
                          <div class="col-md-12">
                             <div class="form-group">
                              <label for="name"> {{trans('constants.pending')}} : <strong>{{DEFAULT_CURRENCY_SYMBOL}} {{$user_detail->amount}}</strong></label>
                            </div>
                          </div>
                          
                          <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Average Daily Balance: </label>
                                @if($asset_status==false)
                                    <span style="color:red">Not able to fetch records from Plaid</span>
                                @else
                                <span style="color:green"><strong>{{$average}}</strong></span>
                                @endif
                              </div>
                             <div class="form-group">
                                <label for="name">Accept Amount</label>
                                <input type="text" required class="form-control" name="amount" value="{{$user_detail->amount}}" >
                                <span style="color:blue"><i>Note: You can change the credit amount here before approve.</i></span>
                              </div>
                             
                              
                             <div class="col-md-4 col-md-offset-4">
                              <button type="submit" class="btn btn-primary mr-1" style="padding: 10px 15px;"> Approve
                              </button>
                              <button type="button" data-id="1" data-toggle="modal" data-target="#{{$user_detail->id}}" class="btn btn-danger mr-1" style="padding: 10px 15px;"> Decline
                              </button>
                            </div>
                            
                          </div>
                        </div>
                      </fieldset>
                    </form>
                    <div class="modal animated slideInRight text-left" id="{{$user_detail->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel76" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel76">Decline User Credit</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <form method="post" action="{{url('/')}}/admin/decline_usercredit">
                            <div class="modal-body">                                        
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="id" value="{{$user_detail->id}}">
                                    <div class="form-group">
                                    <label for="eventName2">Are you sure want to decline this user credit?</label>
                                    </div>
                            
                                </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-warning mr-1" data-dismiss="modal" style="padding: 10px 15px;">
                                        <i class="ft-x"></i> Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary mr-1" style="padding: 10px 15px;">
                                    <i class="ft-check-square"></i> Decline
                                        </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>      
@endsection     

 