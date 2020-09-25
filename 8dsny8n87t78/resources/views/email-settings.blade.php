@extends('layout.master')

@section('title')
{{APP_NAME}}
@endsection

@section('content')
 <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">{{ strtoUpper(trans('constants.email_setting')) }}</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard">{{strtoUpper(trans('constants.dashboard'))}}</a></li>
                <li class="breadcrumb-item"><a href="#">{{ strtoUpper(trans('constants.email_setting')) }}</a>
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
                   
                <div class="card-content collapse show">
                  <div class="card-body">
                    <form action="{{url('/')}}/admin/update-setting" class="icons-tab-steps wizard-notification" method="post" enctype="multipart/form-data">
                       <input type="hidden" name="_token" value="{{csrf_token()}}">
                       <input type="hidden" name="type" value="email">
                     <fieldset>
                      <div class="row">
                       <div class="col-md-12">  
                       @if(isset($data['email_user_name']))
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.email') }}</label>                          
                           <div class="col-md-10">
                               <input type="text" name="email_user_name" class="form-control" placeholder="{{ trans('constants.email') }}" required="" value="@if(isset($data['email_user_name'])){{$data['email_user_name']}}@endif">
                          </div>
                       </div>
                       @endif
                       @if(isset($data['email_password']))
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.password') }}  </label>                          
                           <div class="col-md-10">
                               <input type="text" name="email_password" class="form-control" placeholder="{{ trans('constants.password') }}" required="" value="@if(isset($data['email_password'])){{$data['email_password']}}@endif">
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
 