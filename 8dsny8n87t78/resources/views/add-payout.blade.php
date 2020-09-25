@extends('layout.master')

@section('title')
{{APP_NAME}}
@endsection

@section('content')
  <div class="content-wrapper">

  <div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
      <h3 class="content-header-title mb-0 d-inline-block">{{strtoUpper($type)}} {{strtoUpper(trans('constants.payout'))}}</h3>
      <div class="row breadcrumbs-top d-inline-block">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{url('/')}}/admin">{{strtoUpper(trans('constants.dashboard'))}}</a>
            </li>
            <li class="breadcrumb-item">
              <a href="">{{strtoUpper($type)}} {{strtoUpper(trans('constants.payout'))}}</a>
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
                    <form action="{{url('/')}}/admin/add_payout" class="icons-tab-steps wizard-notification" method="post">
                     <input type="hidden" name="_token" value="{{csrf_token()}}">
                     <input type="hidden" name="id" value="{{$id}}">
                     <input type="hidden" name="type" value="{{$type}}">
                    <fieldset>
                        <div class="row">
                          <div class="col-md-12">
                             <div class="form-group">
                              <label for="name"> {{trans('constants.pending')}} : <strong>{{env('CURRENCY_CODE')}} {{$amount}}</strong></label>
                            </div>
                          </div>
                          <div class="col-md-12">
                             <div class="form-group">
                                <label for="name">{{trans('constants.total')}}</label>
                                <input type="text" required class="form-control" name="amount" value="" >
                              </div>
                             <div class="form-group">
                                <label for="name">{{trans('constants.notes')}}</label>
                                <textarea class="form-control" name="description" value="" ></textarea>
                              </div>
                              
                             <div class="col-md-4 col-md-offset-4">
                              <button type="submit" class="btn btn-primary mr-1" style="padding: 10px 15px;"> Pay now
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
      <script type="text/javascript">
        
      </script>
    @endsection     
 