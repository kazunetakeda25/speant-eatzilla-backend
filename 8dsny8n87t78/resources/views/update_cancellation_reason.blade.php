@extends('layout.master')

@section('title')
{{APP_NAME}}
@endsection

@section('content')
@foreach($reason_list as $reason)
  <div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">EDIT CANCELLATION REASONS</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/')}}/admin/reason_list"> REASON LIST</a>
                <li class="breadcrumb-item"><a href="#">EDIT CANCELLATION REASONS</a>
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
                    <form action="{{url('/')}}/admin/update_cancellation_reason" class="icons-tab-steps wizard-notification" method="post">
                       <input type="hidden" name="_token" value="{{csrf_token()}}">
                       <input type="hidden" name="id" value="{{$reason->id}}">

                    <fieldset>
                        <div class="row">
                          <div class="col-md-4">
                             <div class="form-group">
                              <label for="name">Reason</label>
                              <input id="name" type="text" class="form-control" name="reason" value="{{$reason->reason}}"  required="" autofocus="">
                            </div>
                             </div>
                             <div class="col-md-4">
                             <div class="form-group">
                             <label  for="projectinput4">Cancellation For</label>
                             <select class="c-select form-control" id="status" required name="cancellation_for">
                                <option value="1" {{ ($reason->cancellation_for==1)?"selected":"" }}>Restaurant</option>
                                <option value="2" {{ ($reason->cancellation_for==2)?"selected":"" }}>User</option>
                              </select>
                         </div>
                       </div>
                             <div class="col-md-4">
                             <div class="form-group">
                             <label  for="projectinput4">Status</label>
                             <select class="c-select form-control" id="status" required name="status">
                                <option value="1" {{ ($reason->status==1)?"selected":"" }}>Active</option>
                                <option value="2" {{ ($reason->status==2)?"selected":"" }}>In Active</option>
                              </select>
                         </div>
                       </div>
                       
                        </div>
                             <div class="form-actions">
                              <button type="button" class="btn btn-warning mr-1" style="padding: 10px 15px;">
                               <i class="ft-x"></i> Cancel
                                </button>
                              <button type="submit" class="btn btn-primary mr-1" style="padding: 10px 15px;">
                               <i class="ft-check-square"></i> Save
                                </button>
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
  

    @endforeach
    @endsection     
 