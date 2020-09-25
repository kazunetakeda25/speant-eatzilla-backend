@extends('layout.master')

@section('title')
{{APP_NAME}}
@endsection

@section('content')

<div class="content-wrapper">
  <div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
      <h3 class="content-header-title mb-0 d-inline-block"> {{strtoUpper(trans('constants.email_template'))}}</h3>
      <div class="row breadcrumbs-top d-inline-block">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href=" ">{{trans('constants.add')}} {{trans('constants.email_template')}}</a>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="content-body">
    <!-- Basic form layout section start -->
    <section id="horizontal-form-layouts">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title" id="horz-layout-basic"></i> {{trans('constants.create')}} {{trans('constants.email_template')}}</h4>
              <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                  <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                  <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="card-content collpase show">
              <div class="card-body">
                <form action="#" class="icons-tab-steps wizard-notification">
                  <fieldset>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="SenderEmail">{{trans('constants.title')}} :</label>
                          <input type="text" class="form-control" id="SenderEmail">
                        </div> 
                        <div class="form-group">
                          <label for="EmailSubject"> {{trans('constants.content')}}:</label>
                          <input type="text" class="form-control" id="EmailSubject">
                        </div> 
                      </div>
                    </div>
                  </fieldset>
                  <div class="form-actions center">
                    <button type="button" class="btn btn-warning mr-1" style="padding: 10px 15px;">
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
   </section>
   <!-- // Basic form layout section end -->
 </div>
 @endsection     
 