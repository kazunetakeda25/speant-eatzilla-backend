@extends('layout.master')

@section('title')

{{APP_NAME}}

@endsection

@section('content')

 <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">ADD DOCUMENT</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/')}}/admin/document_list">{{ strtoUpper(trans('constants.document'))}} {{ strtoUpper(trans('constants.list'))}}</a>
                </li>
                <li class="breadcrumb-item"><a href="#">ADD DOCUMENT</a>
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
                    <form action="{{url('/')}}/admin/document_add" method="post"   class="icons-tab-steps wizard-notification">
                     <input type="hidden" name="_token" value="{{csrf_token()}}">

                    <fieldset>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                             <label  for="projectinput4">Document For<span style="color: red;">*</span></label>
                            <select name="document_for" id="" class="form-control" >
                                 <option value="" selected="" disabled="">--Document For--</option>
                                
                                 <option value="1">Driver</option>
                                  <option value="2">Restaurant</option>
                                
                            </select> 
                         </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="email">Document Name<span style="color: red;">*</span></label>
                             <input type="text" class="form-control" name="document_name" id="email" placeholder="">
                             </div>
                            </div>
                          </div>
                          
                          

                          <div class="row">
                          

 
                             <div class="col-md-6">
                             <div class="form-group">
                             <label  for="projectinput4">Status<span style="color: red;">*</span></label>
                            <select name="status" id="" class="form-control" >
                                 <option value="" selected="" disabled="">Status</option>
                                
                                 <option value="1">Active</option>
                                  <option value="2">In Active</option>
                                
                            </select> 
                         </div>
                       </div>
                       <div class="col-md-6">
                             <div class="form-group">
                              <label for="number">Expiry Date Needed<span style="color: red;">*</span></label>
                             <div class="custom-control custom-radio">
                              <input type="radio" class="custom-control-input" id="defaultUnchecked" name="expiry_date_needed" value="1" required="">
                             <label class="custom-control-label" for="defaultUnchecked">Yes</label>
                         </div>
                         <br>
                      
                      <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="defaultChecked" name="expiry_date_needed" value="2" checked>
                      <label class="custom-control-label" for="defaultChecked">No</label>
                    </div>
                         </div>
                       </div>
                           
                          </div>
                        
                        
                           <!-- <div class="row">
                          
                        
                          </div> -->
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

         
 