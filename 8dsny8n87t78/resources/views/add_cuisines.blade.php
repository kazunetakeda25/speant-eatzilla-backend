@extends('layout.master')

@section('title')

{{APP_NAME}}
@endsection

@section('content')
  <div class="content-wrapper">
      <div class="content-body">
        <section id="icon-tabs">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">CREATE CUISINES</h4>
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
                    <form action="{{url('/')}}/admin/add_to_cuisines" class="icons-tab-steps wizard-notification" method="post">
                       <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <fieldset>
                        <div class="row">
                          <div class="col-md-12">
                             <div class="form-group">
                              <label for="name">Name</label>
                              <input id="name" type="text" class="form-control" name="cuisine_name" value="" required="" autofocus="">
                            </div>
                             <div class="col-md-4 col-md-offset-4">
                              <button type="submit" class="btn btn-primary mr-1" style="padding: 10px 15px;"> Save
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
  


    @endsection     
 