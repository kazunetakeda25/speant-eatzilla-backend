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
                  <h4 class="card-title">{{strtoUpper(trans('constants.edit'))}} {{strtoUpper($data->title)}}</h4>
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
                    <form action="{{url('/')}}/admin/page/{{$data->page_name}}" method="POST" class="icons-tab-steps wizard-notification">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    @if(isset($data))
                      <input type="hidden" class="form-control" value="{{$data->id}}" name="id" >
                    @endif
                    <fieldset>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                                <label for="title">Page {{trans('constants.name')}}<span style="color: red;">*</span></label>
                                <input id="title" type="text" class="form-control" name="title" value="{{(isset($data) ? $data->title : "")}}" required="" autofocus="">
                                @if ($errors->has('title'))
                                  <div class="text-danger">{{ $errors->first('title') }}</div>
                                @endif
                              </div>
                              <div class="form-group">
                                <label for="description">{{trans('constants.description')}}<span style="color: red;">*</span></label>
                                <textarea class="form-control" name="description" id="summary-ckeditor">{{(isset($data) ? $data->description : "")}}</textarea>
                              </div>
                              <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" style="padding: 8px 15px;"> Update
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
 
@section('script')
    <script src="{{URL::asset('public/js/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace( 'summary-ckeditor' );
    </script>
 @endsection