@extends('layout.master')

@section('title')

{{APP_NAME}}

@endsection

@section('content')

 <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">ADD NOTICE</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=" ">NOTICE BOARD LIST</a>
                </li>
                <li class="breadcrumb-item"><a href=" ">ADD NOTICE BOARD  </a>
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
                  <h4 class="card-title">ADD NOTICE</h4>
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
                              <label for="Resturant">DeliveryPeople :</label>
                              <select class="c-select form-control" id="resturant" name="location">
                                <option value="">Choose Delivery People</option>
                                <option value="Vishnu">Vishnu</option>
                                <option value="Arun">Arun</option>
                                <option value="Krishna">Krishna</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="Resturant">Notice Title :</label>
                               <input class="form-control" type="text" id="title">
                            </div>

                            <div class="form-group">
                              <label for="lastName2">Notice :</label>
                              <textarea name="participants" id="participants2" rows="4" class="form-control"></textarea>
                             
                            </div>

                            <div class="form-group">
                              <label for="Resturant">Extra Note :</label>
                               <input class="form-control" type="text" id="note">
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
 