@extends('layout.master')

@section('title')

{{APP_NAME}}

@endsection

@section('content')

  <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">USERS</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=" ">USER LIST</a>
                </li>
                <li class="breadcrumb-item"><a href=" ">ADD USER</a>
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
                  <h4 class="card-title">ADD USER</h4>
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
                    <form action="#" class="icons-tab-steps wizard-notification">

                    <fieldset>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="Name">Name :</label>
                              <input type="text" class="form-control" id="eventName2">
                            </div>
                             
                          <div class="form-group">
                              <label for="email">Email :</label>
                              <input type="email" class="form-control" id="email">
                            </div>

                            <div class="form-group">
                              <label for="password">Password :</label>
                              <input type="password" class="form-control" id="pass">
                            </div>

                             <div class="form-group">
                              <label for="password">Conform Password :</label>
                              <input type="password" class="form-control" id="con_pass">
                            </div>
                           
                             <div class="form-group row">
                             <label class="col-md-3 label-control" for="projectinput4">Image</label>
                            <div class="col-md-9">
                              <img id="blah" src="http://placehold.it/180" alt="your image" / style="max-width:180px;"><br>
                               <input type='file' onchange="readURL(this);" / style="padding:10px;background:000;">
                          </div>
                         </div>

                          <div class="input-group" data-repeater-item="">
                           <div class="col-md-2">
                            <input id="country_code" class="form-control" name="country_code" autocomplete="off" type="tel" value="" required="" placeholder="Country Code">
                           </div>
                          <div class="col-md-10">
                           <input id="phone1" type="text" class="form-control" name="phone_number" value="" placeholder="Phone Number" required="" autofocus="">
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
 