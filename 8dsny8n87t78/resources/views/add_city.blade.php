@extends('layout.master')

@section('title')

{{APP_NAME}}

@endsection

@section('content')

 <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">{{ strtoUpper(trans('constants.add')) }} {{ strtoUpper(trans('constants.city')) }}</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/city_list">{{ strtoUpper(trans('constants.city')) }} {{ strtoUpper(trans('constants.list')) }}</a>
                </li>
                <li class="breadcrumb-item"><a href="#">{{ strtoUpper(trans('constants.add')) }} {{ strtoUpper(trans('constants.city')) }}</a>
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
                  <h4 class="card-title"></h4>
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

                    <form action="{{url('/')}}/admin/city_add" method="post"   class="icons-tab-steps wizard-notification">
                     <input type="hidden" name="_token" value="{{csrf_token()}}">

                    <fieldset>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="city_name">{{trans('constants.city')}}<span style="color: red;">*</span></label>
                              <input type="text" class="form-control" name="city" id="city_name" placeholder="City" required value="{{ old('city') }}">
                              @if ($errors->has('city'))
                                  <div class="text-danger">{{ $errors->first('city') }}</div>
                              @endif
                            </div>
                          </div>
                          
                          <div class="col-md-6">
                            <div class="form-group">
                              <label  for="projectinput4">{{trans('constants.status')}}<span style="color: red;">*</span></label>
                              <select name="status" id="" class="form-control" required>
                                <option value="1" @if( old('status') ==1) {{ 'selected' }} @endif>{{trans('constants.active')}}</option>
                                <option value="2" @if( old('status') ==2) {{ 'selected' }} @endif>{{trans('constants.inactive')}}</option>
                              </select> 
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                              <label  for="projectinput4">{{trans('constants.country')}}<span style="color: red;">*</span></label>
                              <select name="country" id="country" class="form-control" required>
                                <option value="" selected="" disabled="">Select {{trans('constants.country')}}</option>
                              @foreach($country as $c)
                                <option value="{{$c->id}}" @if(old('country')==$c->id) selected @endif >{{$c->country}}</option>
                              @endforeach
                              <input type="hidden" name="country_value" value="(old('country')">
                            </select>
                          </div>
                          <div class="col-md-6">
                              <label  for="projectinput4">{{trans('constants.state')}}<span style="color: red;">*</span></label>
                              <select name="state" id="state" class="form-control" required>
                              </select>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label for="email">{{ trans('constants.region')}}<span style="color: red;">*</span></label>
                              <input type="button" name="delete-button" id="delete-button"  type="button" value="Delete Polygon" class="btn btn-primary btn-sm" style="float:right;">
                              <div id="map_polygon" style="width: 100%; height: 400px; position: relative; overflow: hidden; background-color: rgb(229, 227, 223);margin-bottom:15px;"></div>
                              <input type="hidden" id="get_map_id" name="get_map_id" value="0">
                              <textarea id="geofence_latlng" name="geofence_latlng" style="display:none;"></textarea>
                                <input type="hidden" id="latitude" name="latitude" value="@if(old('latitude')) {{ old('latitude') }} @else {{ env('DEFAULT_LAT')}} @endif">
                                <input type="hidden" id="longitude" name="longitude" value="@if(old('longitude')) {{ old('longitude') }} @else {{ env('DEFAULT_LNG')}} @endif">
                                @if ($errors->has('geofence_latlng'))
                                    <div class="text-danger">{{ $errors->first('geofence_latlng') }}</div>
                                @endif
                            </div>
                          </div>
                        </div>
                        
                          <h4 class="card-title">{{trans('constants.admin_commision')}} {{trans('constants.setting')}}</h4>
                          
                          <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="password">{{trans('constants.admin_commision')}} In %<span style="color: red;">*</span></label>
                             <input type="text" class="form-control" name="admin_commision" id="pass" required value="{{ old('admin_commision') }}">
                             @if ($errors->has('admin_commision'))
                                  <div class="text-danger">{{ $errors->first('admin_commision') }}</div>
                              @endif
                             </div>
                            </div>
                            
                           
                          </div>
                        <h4 class="card-title">{{trans('constants.delivery_charge_setting')}}</h4>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="number">{{trans('constants.default_delivery_amt')}}<span style="color: red;">*</span></label>
                             <input type="text" class="form-control" name="default_delivery_amount" id="number" required value="{{ old('default_delivery_amount') }}">
                            </div> 
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label  for="min_dist_delivery_price">{{trans('constants.min_distance_baseprice')}}<span style="color: red;">*</span></label>
                              <input type="text" class="form-control" name="min_dist_delivery_price" required id="min_dist_delivery_price" value="{{ old('min_dist_delivery_price') }}" >
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="extra_fee_deliveryamount">{{trans('constants.extra_fee_amt')}}<span style="color: red;">*</span></label>
                             <input type="text" name="extra_fee_deliveryamount" class="form-control" required id="extra_fee_deliveryamount" value="{{ old('extra_fee_deliveryamount') }}">
                            </div> 
                          </div>
                        </div>
                     <h4 class="card-title">{{trans('constants.driver_charge_setting')}}</h4>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="number">{{trans('constants.driver_baseprice')}}<span style="color: red;">*</span></label>
                             <input type="text" class="form-control" required name="driver_base_price" id="number" value="{{ old('driver_base_price') }}" >
                            </div> 
                         </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label  for="projectinput4">{{trans('constants.min_distance_baseprice')}}<span style="color: red;">*</span></label>
                              <input type="text" class="form-control" required name="min_dist_base_price" id="number" value="{{ old('min_dist_base_price') }}" >
                            </div>
                          </div>
                     </div>
                      <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="number">{{trans('constants.extra_fee_amt')}}<span style="color: red;">*</span></label>
                             <input type="text" name="extra_fee_amount" required class="form-control" id="number" value="{{ old('extra_fee_amount') }}">
                            </div> 
                         </div>
                          <!-- <div class="col-md-6">
                            <div class="form-group">
                              <label for="number">{{trans('constants.extra_fee_for_unit')}}</label>
                             <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="defaultUnchecked" name="extra_fee_amount_each">
                                <label class="custom-control-label" for="defaultUnchecked">Km</label>
                              </div>
                              <!-- Default checked -->
                              <!--<div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="defaultChecked" name="extra_fee_amount_each" checked>
                                <label class="custom-control-label" for="defaultChecked">Miles</label>
                              </div>
                            </div>
                          </div> -->
                     </div>
                      <h4 class="card-title">Night Fare Amount</h4>
                      <div class="row">
                          
                            <div class="col-md-6">
                             <div class="form-group">
                             <label  for="projectinput4">Amount</label>
                           <input type="text" class="form-control" name="night_fare_amount" id="number"  value="{{ old('night_fare_amount') }}">
                         </div>
                       </div>
                        <div class="col-md-6">
                             <div class="form-group">
                             <label  for="projectinput4">Driver Share % (Rest Will Be For Admin)</label>
                           <input type="text" class="form-control" name="night_driver_share" id="number"  value="{{ old('night_driver_share') }}" >
                         </div>
                       </div>
                     </div>
                     <div class="row">
                          
                            <div class="col-md-6" id="datetimepicker3">
                             <div class="form-group">
                             <label  for="projectinput4">Start Time</label>
                           <input type="text" class="form-control" data-format="hh:mm:ss" name="start_time" id="number" value="{{ old('start_time')}}">
                           <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
                         </div>
                       </div>
                        <div class="col-md-6">
                             <div class="form-group">
                             <label  for="projectinput4">End Time</label>
                           <input type="text" class="form-control" name="end_time" id="number"   value="{{ old('end_time')}}">
                         </div>
                       </div>
                     </div>
                     <h4 class="card-title">Surge Fare Setting</h4>
                      <div class="row">
                          <div class="col-md-6">
                             <div class="form-group">
                             <label  for="projectinput4">Amount</label>
                           <input type="text" class="form-control" name="surge_fare_amount" id="number" value="{{ old('surge_fare_amount') }}" >
                         </div>
                       </div>
                        <div class="col-md-6">
                             <div class="form-group">
                             <label  for="projectinput4">Driver Share % (Rest Will Be For Admin)</label>
                           <input type="text" class="form-control" name="surge_driver_share" id="number" value="{{ old('surge_driver_share') }}" >
                         </div>
                       </div>
                          </div>
                          <!--  <div class="row">
                          
                        
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

 @section('script')

<script type="text/javascript">

$(document).on('change','#country',function(){

  var country=$(this).val();
  $.ajax({
    type: "GET",
    url: "{{url('/')}}/admin/get_state_ajax/"+country,
    dataType:'json',
    success: function(data){

      var value="";
      data.forEach(function(element) {

        value +="<option value='"+element.id+"' >"+element.state+"</option>";

      });

      $('#state').html(value);

    }
  });
});


      $(function() {
    $('#datetimepicker3').datetimepicker({
      pickDate: false
    });
  });

  
var mapnew ='';
var value = document.getElementById('geofence_latlng').value;
function initAutocomplete() {    
    // var lat = document.getElementById('latitude1').value;
    // var lng = document.getElementById('longitude1').value;
    // lat = (lat!='') ? lat : '33.312805';
    // lng = (lng!='') ? lng : '43.081466';

    var lat = document.getElementById('latitude').value;
    var lng = document.getElementById('longitude').value;

         mapnew = new google.maps.Map(document.getElementById('map_polygon'), {
            zoom: 10,
            center: new google.maps.LatLng(lat, lng),
            // mapTypeId: google.maps.MapTypeId.ROADMAP,
            noClear:true
        });
        // map.controls[google.maps.ControlPosition.RIGHT_BOTTOM]
        //   .push(document.getElementById('save-button'));
        // map.controls[google.maps.ControlPosition.RIGHT_BOTTOM]
        //   .push(document.getElementById('delete-button'));
        var polyOptions = {
            strokeWeight: 3,
            fillOpacity: 0.2
        };
        var tempLat = [];
        var temp_arr = [];
        var latArray = [];
        var shapes={
          collection:{},
          selectedShape:null,
          add:function(e){
            var shape=e.overlay,
                that=this;              
            shape.type=e.type;
            shape.id=new Date().getTime()+'_'+Math.floor(Math.random()*1000);
            this.collection[shape.id]=shape;
            this.setSelection(shape);
            google.maps.event.addListener(shape,'click',function(){
                that.setSelection(this);
            });            
            google.maps.event.addListener(shape.getPath(), 'set_at', function() {
        
      
                shapes.save();
            });
            google.maps.event.addListener(shape.getPath(), 'insert_at', function() {
                shapes.save();
            });            
            shapes.save();
          },
          setSelection:function(shape){
            if(this.selectedShape!==shape){
              this.clearSelection();
              this.selectedShape = shape;
              shape.set('draggable',true);
              shape.set('editable',true);
            }
          },
          deleteSelected:function(){
          
            if(this.selectedShape){
              var shape= this.selectedShape;
              this.clearSelection();
              shape.setMap(null);
              delete this.collection[shape.id];
              shapes.save();
              document.getElementById('geofence_latlng').value="";
            }
           },
          
          
          clearSelection:function(){
            if(this.selectedShape){
              this.selectedShape.set('draggable',false);
              this.selectedShape.set('editable',false);
              this.selectedShape=null;
            }
          },
          save:function(){
            var collection=[];
            for(var k in this.collection){
              var shape=this.collection[k],
                  types=google.maps.drawing.OverlayType;
              switch(shape.type){
                case types.POLYGON:
                    var locations = shape.getPath().getArray();
                    locations.forEach(this.mkArray);
                    temp_arr.push(temp_arr[0]);
                    console.log(temp_arr);
                    latArray.push(temp_arr);
                    collection.push(latArray);
                    temp_arr =[] ; latArray = [];
                    // console.log('locations',shape,shape.getPath(),locations.toString());
                   // collection.push({ type:shape.type,path:google.maps.geometry.encoding.encodePath(shape.getPath())});
                  break;
                default:
                  // alert('implement a storage-method for '+shape.type)
              }
            }
            //collection is the result
           //  console.log("array"+collection);
            document.getElementById('geofence_latlng').value = JSON.stringify(collection);
          },
          mkArray:function(item,index){
            tempLat.push(item.lng());
            tempLat.push(item.lat());
            temp_arr.push(tempLat);
            tempLat = [];
          },
          newPolyLine:function(polyOptions){
            var polyLine = new google.maps.Polyline(polyOptions);
            polyLine.setMap(mapnew);
            google.maps.event.addListener(polyLine, 'click', function (event) {
                shapes.setSelection(polyLine);
            });  
            var overlay = {
              overlay: polyLine, 
              type: google.maps.drawing.OverlayType.POLYGON
            };
            return overlay;
          },
          newPolyOptions:function(path){
                return new google.maps.Polygon({
                    path:path,
                    fillOpacity:0.5,
                    clickable:true,
                    draggable: true
                });
            },
            mapToLatLng:function(source, index, array){
                return new google.maps.LatLng(parseFloat(source[1]), parseFloat(source[0]));
            },
            toLatLng:function(array){
              return array.map(this.mapToLatLng);
            }
        };

        
        // console.log('value',value);
        if(value!=''){
            value = JSON.parse(value);
            //value = value[0];
            // console.log('value',value,value[0].length);
            for (var i = value.length - 1; i >= 0; i--) {   
                // console.log(i);
                // console.log(value[i][0]);
                shapes.add(shapes.newPolyLine(shapes.newPolyOptions(shapes.toLatLng(value[i][0]))));
            }
            shapes.save();
        }
        
         var drawingManager = new google.maps.drawing.DrawingManager({
            drawingControl: true,
            drawingControlOptions: {
                drawingModes: [google.maps.drawing.OverlayType.POLYGON]
            },
            //drawingMode: google.maps.drawing.OverlayType.POLYGON,
            drawingMode: null,
            polygonOptions: polyOptions,
            map: mapnew
        });

        google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {
            drawingManager.setDrawingMode(null);
            shapes.add(e);
        });


        google.maps.event.addListener(drawingManager, 
                                      'drawingmode_changed', 
                                      function(){shapes.clearSelection();});
        google.maps.event.addListener(mapnew, 
                                      'click', 
                                      function(){shapes.clearSelection();});
        google.maps.event.addDomListener(document.getElementById('delete-button'), 
                                      'click', 
                                      function(){shapes.deleteSelected();});
        // google.maps.event.addDomListener(document.getElementById('save-button'), 
        //                               'click', 
        //                               function(){shapes.save();});


        /** Search box related script - start **/
        var input = document.getElementById('city_name');
        var searchBox = new google.maps.places.SearchBox(input);
        searchBox.bindTo('bounds', mapnew);

        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();
            if(places[0] && places[0].geometry)
            {
              $loc=places[0].geometry;
            }else{
              $loc=places.geometry;
            }
            var lat =$loc.location.lat(),
              lng =$loc.location.lng();
            document.getElementById("latitude").value = lat;
            document.getElementById("longitude").value = lng;
            mapnew.setCenter(new google.maps.LatLng(parseFloat(lat),parseFloat(lng)));
            mapnew  .setZoom(15);
        });
        /** Search box related script - end **/

    }

  function load(lat,lng,pickup){
        if(pickup&&pickup!=''){
        if (pickup.geometry.viewport) {
                    mapnew.fitBounds(pickup.geometry.viewport);
                } else {
                    mapnew.setCenter(pickup.geometry.location);
                    mapnew  .setZoom(10);  // Why 17? Because it looks good.
            }
        }
        else{
        mapnew.setCenter(new google.maps.LatLng(lat, lng));
        mapnew.setZoom(15);  
        }

    }

    $(document).ready(function (){
      
      
      var country=$("#country").val();
      if(country!='null'){
      $.ajax({
        type: "GET",
        url: "{{url('/')}}/admin/get_state_ajax/"+country,
        dataType:'json',
        success: function(data){
          let old = "{{old('state')}}";
          //alert(old);
          var value="";
          data.forEach(function(element) {

            value +="<option value='"+element.id+"'";
             if(old == element.id)
              {
                value +="selected"; 
              }
            value += ">"+element.state+"</option>";

          });
          $('#state').html(value);
        }
      });
     }
    });

    </script>

<script src="https://maps.googleapis.com/maps/api/js?key={{GOOGLE_API_KEY}}&libraries=geometry,places,drawing&callback=initAutocomplete" ></script>

    <script type="text/javascript"
     src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js">
    </script> 
    
    <script type="text/javascript"
     src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
    </script>
    <script type="text/javascript"
     src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js">
    </script>

 @endsection