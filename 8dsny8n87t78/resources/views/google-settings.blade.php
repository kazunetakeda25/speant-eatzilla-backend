@extends('layout.master')

@section('title')
{{APP_NAME}}
@endsection

@section('content')
 <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">{{ strtoUpper(trans('constants.google_setting')) }}</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard">{{strtoUpper(trans('constants.dashboard'))}}</a></li>
                <li class="breadcrumb-item"><a href="#">{{ strtoUpper(trans('constants.google_setting')) }}</a>
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
                  <h4 class="card-title"> &nbsp;</h4>
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
                   
                <div class="card-content collapse show">
                  <div class="card-body">
                    <form action="{{url('/')}}/admin/update-setting" class="icons-tab-steps wizard-notification" method="post" enctype="multipart/form-data">
                       <input type="hidden" name="_token" value="{{csrf_token()}}">
                       <input type="hidden" name="type" value="google">
                     <fieldset>
                      <div class="row">
                       <div class="col-md-12">  
                       @if(isset($data['google_api_key']))
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.google_api_key') }} </label>                          
                           <div class="col-md-10">
                               <input type="text" name="google_api_key" class="form-control" placeholder="Title of the message" required="" value="@if(isset($data['google_api_key'])){{$data['google_api_key']}}@endif">
                          </div>
                       </div>
                       @endif
                       @if(isset($data['firebase_url']))
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.firebase_url') }} </label>                          
                           <div class="col-md-10">
                               <input type="text" name="firebase_url" class="form-control" placeholder="Title of the message" required="" value="@if(isset($data['firebase_url'])){{$data['firebase_url']}}@endif">
                          </div>
                       </div>
                       @endif
                       @if(isset($data['user_notification_key']))
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.user_notification_key') }} </label>                          
                           <div class="col-md-10">
                               <input type="text" name="user_notification_key" class="form-control" placeholder="Title of the message" required="" value="@if(isset($data['user_notification_key'])){{$data['user_notification_key']}}@endif">
                          </div>
                       </div>
                       @endif
                       @if(isset($data['partner_notification_key']))
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.partner_notification_key') }} </label>                          
                           <div class="col-md-10">
                               <input type="text" name="partner_notification_key" class="form-control" placeholder="Title of the message" required="" value="@if(isset($data['partner_notification_key'])){{$data['partner_notification_key']}}@endif">
                          </div>
                       </div>
                       @endif
                       @if(isset($data['stripe_pk_key']))
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.stripe_pk_key') }} </label>                          
                           <div class="col-md-10">
                               <input type="text" name="stripe_pk_key" class="form-control" placeholder="Title of the message" required="" value="@if(isset($data['stripe_pk_key'])){{$data['stripe_pk_key']}}@endif">
                          </div>
                       </div>
                       @endif
                       @if(isset($data['stripe_sk_key']))
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.stripe_sk_key') }} </label>                          
                           <div class="col-md-10">
                               <input type="text" name="stripe_sk_key" class="form-control" placeholder="Title of the message" required="" value="@if(isset($data['stripe_sk_key'])){{$data['stripe_sk_key']}}@endif">
                          </div>
                       </div>
                       @endif
                       <div class="form-group row">
                        <label class="col-md-2"></label>
                          <div class="col-md-10">
                            <button type="submit" class="btn btn-primary mr-1" style="padding: 10px 15px;">Update Settings</button> &nbsp;
                             <!-- <button type="button" class="btn btn-success mr-1" style="padding: 10px 15px;">Schedule Push</button> -->
                        </div>
                       </div>
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
   

</script>

    @endsection     
 