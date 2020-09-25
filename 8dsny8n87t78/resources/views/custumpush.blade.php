@extends('layout.master')

@section('title')

{{APP_NAME}}
@endsection

@section('content')
 <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">{{ strtoUpper(trans('constants.custom_push')) }}</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=" ">{{ strtoUpper(trans('constants.push_notification')) }}</a>
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
                  <h4 class="card-title">{{ trans('constants.push_notification') }}</h4>
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
                    <form action="{{url('/')}}/admin/send_custumpush" enctype="multipart/form-data" class="icons-tab-steps wizard-notification" method="post">
                       <input type="hidden" name="_token" value="{{csrf_token()}}">
                     <fieldset>
                      <div class="row">
                       <div class="col-md-12">
                        <div class="form-group row">
                          <div class="col-md-2">
                           <label  >Sent to </label>
                          </div>
                          <div class="col-md-10">
                           <select class="form-control" name="send_to" onchange="switch_send(this.value)">
                            <option value="ALL" @if( old('send_to') =='ALL') selected @endif >All Users and Delivery Boys</option>
                            <option value="USERS" @if( old('send_to') =='USERS') selected @endif>All Users</option>
                            <option value="PROVIDERS" @if( old('send_to') =='PROVIDERS') selected @endif>All Delivery Boys</option>
                          </select>
                         </div>
                        </div>
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.title') }}</label>                          
                         <div class="col-md-10">
                             <input type="text" name="title" class="form-control" placeholder="Title of the message" required="" value="{{ old('title') }}">
                        </div>
                       </div>
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.message') }}</label>                          
                         <div class="col-md-10">
                             <textarea name="message" id="message" rows="4" class="form-control" placeholder="Type message content" required="">{{ old('message') }}  </textarea>
                             <div id="characterleft">100 characters left</div>
                        </div>
                       </div>
                       <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.image') }}</label>                          
                         <div class="col-md-10">
                           <input type="file" name="image" id="image" class="form-control" >
                        </div>
                       </div>

                       <div class="form-group row">
                        <label class="col-md-2"></label>
                          <div class="col-md-10">
                            <button type="submit" class="btn btn-primary mr-1" style="padding: 10px 15px;">Push Now</button> &nbsp;
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
   


    @endsection     
 