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
                  <h4 class="card-title">{{strtoUpper(trans('constants.add'))}} {{strtoUpper(trans('constants.addon'))}}</h4>
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
                    <form action="{{url('/')}}/admin/store_addons" method="POST" class="icons-tab-steps wizard-notification">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    @if(isset($data))
                      <input type="hidden" class="form-control" value="{{$data->id}}" name="id" >
                    @endif
                    <fieldset>
                        <div class="row">
                          <div class="col-md-12">
                          @if(session()->get('role')==1)
                            <div class="form-group">
                                <label for="eventName2">{{trans('constants.restaurant')}}<span style="color: red;">*</span></label>
                                <select name="restaurant_name" id="" class="form-control" required="">
                                  @foreach($restaurant as $res)
                                    @if(isset($res->restaurant_name))
                                      <option value="{{$res->id}}" @if(isset($data)){{ (($data->restaurant_id==$res->id)?'selected':"") }} @endif>{{$res->restaurant_name}}</option>
                                  @endif
                                  @endforeach
                              </select> 
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="name">{{trans('constants.name')}}<span style="color: red;">*</span></label>
                                <input id="name" type="text" class="form-control" name="name" value="{{(isset($data) ? $data->name : "")}}" required="" autofocus="">
                                @if ($errors->has('name'))
                                  <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                              </div>
                              <div class="form-group">
                                <label for="price">{{trans('constants.price')}}<span style="color: red;">*</span></label>
                                <input id="price" type="text" class="form-control" name="price" value="{{(isset($data) ? $data->price : "")}}" required="" autofocus="">
                                @if ($errors->has('price'))
                                  <div class="text-danger">{{ $errors->first('price') }}</div>
                                @endif
                              </div>
                              <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" style="padding: 8px 15px;"> Save
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
 