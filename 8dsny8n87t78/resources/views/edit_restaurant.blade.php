@extends('layout.master')

@section('title')

{{APP_NAME}}

@endsection

@section('content')
 <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">RESTAUTANT</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=" ">EDIT SHOP</a>
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
                  <h4 class="card-title">Edit Shop</h4>
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
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="eventName2">Name :</label>
                              <input type="text" class="form-control" id="name" value="WaterFall Food Restaurant">
                            </div>
                             <div class="form-group">
                              <label for="email">Email Address:</label>
                             <input type="text" class="form-control" id="email" value="raja@gmail.com">
                             
                            </div>

                            <div class="form-group">
                              <label for="status">Cuisine :</label>
                              <select class="c-select form-control" id="Cuisine" name="status">
                                <option value="">Rice</option>
                                <option value="Banned">Biriyani</option>
                                <option value="Active">Chicken 65</option>
                              </select>
                            </div>
                             <div class="form-group">
                              <label for="content">Content Details :</label>
                             <input type="text" class="form-control" id="details" value="9886688686">
                             
                            </div>

                            <div class="form-group">
                              <label for="pass">Password :</label>
                             <input type="password" class="form-control" id="password">
                             
                            </div>

                             <div class="form-group">
                              <label for="pass">Conform Password :</label>
                             <input type="password" class="form-control" id="con_password">
                             
                            </div>

                            <div class="form-group">
                              <label for="status">Status :</label>
                              <select class="c-select form-control" id="status" name="status">
                                <option value="">Onboarding</option>
                                <option value="Banned">Banned</option>
                                <option value="Active">Active</option>
                              </select>
                            </div>
                             <div class="form-group">
                            <label for="password-confirm">Everyday</label>

                            <input id="everyday" type="checkbox" checked="" class="form-control" name="everyday" value="1">
                        </div>
                         <div class="row  everyday="">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_opening">Everyday</label>
                                    <input type="checkbox" class="chk form-control" checked="" name="day[ALL]" value="ALL">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_opening">Shop Opens</label>

                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" name="hours_opening[ALL]" value="00:00" required="">
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_closing">Shop Closes</label>

                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" name="hours_closing[ALL]" value="00:00" required="">
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row   singleday " style="display:none" "="">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_opening">Sunday</label>
                                    <input type="checkbox" class="chk form-control" name="day[SUN]" value="SUN">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_opening">Shop Opens</label>

                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" name="hours_opening[SUN]" value="00:00" required="">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_closing">Shop Closes</label>

                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" name="hours_closing[SUN]" value="00:00" required="">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="row   singleday " style="display:none" "="">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_opening">Monday</label>
                                    <input type="checkbox" class="chk form-control" name="day[MON]" value="MON">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_opening">Shop Opens</label>

                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" name="hours_opening[MON]" value="00:00" required="">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_closing">Shop Closes</label>

                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" name="hours_closing[MON]" value="00:00" required="">
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                          <div class="row   singleday " style="display:none" "="">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_opening">Tuesday</label>
                                    <input type="checkbox" class="chk form-control" name="day[TUE]" value="TUE">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_opening">Shop Opens</label>

                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" name="hours_opening[TUE]" value="00:00" required="">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_closing">Shop Closes</label>

                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" name="hours_closing[TUE]" value="00:00" required="">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="row   singleday " style="display:none" "="">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_opening">Wednesday</label>
                                    <input type="checkbox" class="chk form-control" name="day[WED]" value="WED">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_opening">Shop Opens</label>

                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" name="hours_opening[WED]" value="00:00" required="">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_closing">ShopCloses</label>

                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" name="hours_closing[WED]" value="00:00" required="">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row   singleday " style="display:none" "="">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_opening">Tuesday</label>
                                    <input type="checkbox" class="chk form-control" name="day[TUE]" value="TUE">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_opening">Shop Opens</label>

                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" name="hours_opening[TUE]" value="00:00" required="">
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_closing">Shop Closes</label>

                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" name="hours_closing[TUE]" value="00:00" required="">
                                        
                                    </div>
                                   </div>
                                  </div>
                                 </div>
                           <div class="row   singleday " style="display:none" "="">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_opening">Wednesday</label>
                                    <input type="checkbox" class="chk form-control" name="day[WED]" value="WED">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_opening">Shop Opens</label>

                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" name="hours_opening[WED]" value="00:00" required="">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_closing">Shop Closes</label>

                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" name="hours_closing[WED]" value="00:00" required="">
                                        
                                    </div>
                                  </div>
                                 </div>
                                </div>
                           <div class="row   singleday " style="display:none" "="">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_opening">Thursday</label>
                                    <input type="checkbox" class="chk form-control" name="day[THU]" value="THU">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_opening">Shop Opens</label>

                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" name="hours_opening[THU]" value="00:00" required="">
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_closing">Shop Closes</label>

                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" name="hours_closing[THU]" value="00:00" required="">
                                        
                                    </div>
                                   </div>
                                  </div>
                                </div>
                           <div class="row   singleday " style="display:none" "="">
                             <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_opening">Friday</label>
                                    <input type="checkbox" class="chk form-control" name="day[FRI]" value="FRI">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_opening">Shop Opens</label>

                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" name="hours_opening[FRI]" value="00:00" required="">
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_closing">Shop Closes</label>

                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" name="hours_closing[FRI]" value="00:00" required="">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                                                <div class="row   singleday " style="display:none" "="">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_opening">Saturday</label>
                                    <input type="checkbox" class="chk form-control" name="day[SAT]" value="SAT">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_opening">Shop Opens</label>

                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" name="hours_opening[SAT]" value="00:00" required="">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="hours_closing">Shop Closes</label>

                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control" name="hours_closing[SAT]" value="00:00" required="">
                                       <!-- <span class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </span>-->
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="form-group row">
                          <label class="col-md-3 label-control" for="projectinput4">Image</label>
                          <div class="col-md-9">   
                          <img id="blah" src="http://placehold.it/180" alt="your image" / style="max-width:180px;"><br>
                            <input type='file' onchange="readURL(this);" / style="padding:10px;background:000;">
                          </div>
                         </div>
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="projectinput4">Image</label>
                          <div class="col-md-9">  
                          <img id="blah1" src="http://placehold.it/180" alt="your image" / style="max-width:180px;"><br>
                           <input type='file' onchange="readURL1(this);" / style="padding:10px;background:000;">
                          </div>
                         </div>
                        </div>

                          <div class="col-md-6">
                            <div class="form-group">
                            <label for="eventLocation2">Pure Veg : </label>
                            <label class="radio-inline">
                                <input type="radio" value="non-veg" name="food_type">No
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="veg" name="food_type" checked="">Yes
                            </label>

                            </div>
                            <div class="form-group">
                               <label for="amount">Min Amount :</label>
                                 <input type="number" class="form-control" id="amount" name="position" value="50">
                             </div>

                              <div class="form-group">
                               <label for="percentage">Offer Percentage :</label>
                                 <input type="number" class="form-control" id="percentage" name="position" value="5">
                             </div>

                               <div class="form-group">
                               <label for="percentage">Max Delivery Time :</label>
                                 <input type="number" class="form-control" id="delivery" name="position" value="30">
                             </div>

                             <div class="form-group">
                              <label for="description">Description :</label>
                              <textarea name="description" id="description" rows="4" class="form-control" placeholder="Enter Description"></textarea>
                             
                            </div>               
                          
                              <div class="form-group">
                              <label for="description">Address :</label>
                              <textarea name="Address" id="Address" rows="4" class="form-control" placeholder="Enter Address"></textarea>
                             
                            </div>

                          <div class="form-group">
                            <div class="card-header">
                              <h4 class="card-title">World Map</h4>
                              <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                             
                            </div>
                          <div class="card-content">
                            <div class="card-body height-400">
                              <div id="world-map" class="jqvmap-area"></div>
                               <iframe width="100%" height="300" src="https://maps.google.com/maps?width=100%&height=600&hl=en&q=Malet%20St%2C%20London%20WC1E%207HU%2C%20United%20Kingdom+(Your%20Business%20Name)&ie=UTF8&t=&z=14&iwloc=B&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.mapsdirections.info/en/custom-google-maps/">Create a custom Google Map</a> by <a href="https://www.mapsdirections.info/en/">Measure area on map</a></iframe>
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
                          </div>
                        </div>
                        <script>
     function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
            function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah1')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
          
</script>
    <!-- BEGIN VENDOR JS-->
    <script src="https://foodie.deliveryventure.com/assets/admin/vendors/js/vendors.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://foodie.deliveryventure.com/assets/admin/plugins/clockpicker/dist/bootstrap-clockpicker.min.js"></script>
    <script type="text/javascript" src="https://foodie.deliveryventure.com/assets/admin/plugins/dropify/dist/js/dropify.min.js"></script>
    <script type="text/javascript">
    function disableEnterKey(e)
    {
        var key;
        if(window.e)
            key = window.e.keyCode; // IE
        else
            key = e.which; // Firefox

        if(key == 13)
            return e.preventDefault();
    }
    $('.clockpicker').clockpicker({
        donetext: "Done"
    });
    $('.dropify').dropify();
    $('#everyday').change(function() {
        if($(this).is(":checked")) {
            $('.everyday').show();
            $('.singleday').hide();
            $('.singleday .chk').prop('checked',false);
            $('.everyday .chk').prop('checked',true);
        }else{
            $('.everyday').hide();
            $('.singleday').show();
            $('.everyday .chk').prop('checked',false);
            $('.singleday .chk').prop('checked',true);
        }
    });
</script>

    
    @endsection     
 