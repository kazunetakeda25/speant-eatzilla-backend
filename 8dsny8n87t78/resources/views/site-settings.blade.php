@extends('layout.master')

@section('title')
{{APP_NAME}}
@endsection

@section('content')
 <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">{{ strtoUpper(trans('constants.site_setting')) }}</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard">{{strtoUpper(trans('constants.dashboard'))}}</a></li>
                <li class="breadcrumb-item"><a href="#">{{ strtoUpper(trans('constants.site_setting')) }}</a>
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
                    <form action="{{url('/')}}/admin/update-setting" class="icons-tab-steps wizard-notification" method="post" enctype="multipart/form-data">
                       <input type="hidden" name="_token" value="{{csrf_token()}}">
                       <input type="hidden" name="type" value="site">
                     <fieldset>
                      <div class="row">
                       <div class="col-md-12">  
                        @if(isset($data['app_name']))
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.app_name') }} </label>                          
                           <div class="col-md-10">
                               <input type="text" name="app_name" class="form-control" placeholder="Title of the message" required="" value="@if(isset($data['app_name'])){{$data['app_name']}}@endif">
                          </div>
                       </div>
                       @endif
                       @if(isset($data['site_logo']))
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.site_logo') }} </label>                          
                           <div class="col-md-10">
                               <img src="@if(isset($data['site_logo'])){{RESTAURANT_UPLOADS_PATH}}{{$data['site_logo']}}@endif" id="site_logo" width="200em">
                               <input type="file" onchange="loadFile(event)" name="site_logo" class="form-control">
                          </div>
                       </div>
                       @endif
                       @if(isset($data['site_favicon']))
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.site_favicon') }} </label>                          
                           <div class="col-md-10">
                               <img src="@if(isset($data['site_favicon'])){{RESTAURANT_UPLOADS_PATH}}{{$data['site_favicon']}} @endif" id="site_favicon" width="200em">
                               <input type="file"  name="site_favicon" class="form-control">
                               

                          </div>
                       </div>
                       @endif
                       @if(isset($data['site_email']))
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.site_email') }} </label>                          
                           <div class="col-md-10">
                               <input type="text" name="site_email" class="form-control" placeholder="Title of the message" required="" value="@if(isset($data['site_email'])){{$data['site_email']}}@endif">
                          </div>
                       </div>
                       @endif
                       @if(isset($data['site_contact']))
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.site_contact') }} </label>                          
                           <div class="col-md-10">
                               <input type="text" name="site_contact" class="form-control" placeholder="Title of the message" required="" value="@if(isset($data['site_contact'])){{$data['site_contact']}}@endif">
                          </div>
                       </div>
                       @endif
                       @if(isset($data['menu_color']))
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.menu_color') }} </label>                          
                           <div class="col-md-10">
                               <input type="text" name="menu_color" class="form-control" placeholder="Title of the message" required="" value="@if(isset($data['menu_color'])){{$data['menu_color']}}@endif">
                          </div>
                       </div>
                       @endif
                       @if(isset($data['highlight_color']))
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.highlight_color') }} </label>
                           <div class="col-md-10">
                               <input type="text" name="highlight_color" class="form-control" placeholder="Title of the message" required="" value="@if(isset($data['highlight_color'])){{$data['highlight_color']}}@endif">
                          </div>
                       </div>
                       @endif
                       @if(isset($data['admin_commission']))
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.admin_commission') }} </label>                          
                           <div class="col-md-10">
                               <input type="text" name="admin_commission" class="form-control" placeholder="Title of the message" required="" value="@if(isset($data['admin_commission'])){{$data['admin_commission']}}@endif">
                          </div>
                       </div>
                       @endif
                       @if(isset($data['delivery_boy_commission']))
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.delivery_boy_commission') }} </label>                          
                           <div class="col-md-10">
                               <input type="text" name="delivery_boy_commission" class="form-control" placeholder="Title of the message" required="" value="@if(isset($data['delivery_boy_commission'])){{$data['delivery_boy_commission']}}@endif">
                          </div>
                       </div>
                       @endif
                       @if(isset($data['restaurant_commission']))
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.restaurant_commission') }} </label>                          
                           <div class="col-md-10">
                               <input type="text" name="restaurant_commission" class="form-control" placeholder="Title of the message" required="" value="@if(isset($data['restaurant_commission'])){{$data['restaurant_commission']}}@endif">
                          </div>
                       </div>
                       @endif
                       @if(isset($data['default_radius']))
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.default_radius') }} </label>                          
                           <div class="col-md-10">
                               <input type="text" name="default_radius" class="form-control" placeholder="Title of the message" required="" value="@if(isset($data['default_radius'])){{$data['default_radius']}}@endif">
                          </div>
                       </div>
                       @endif
                       @if(isset($data['default_unit']))
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.default_unit') }} </label>
                           <div class="col-md-10">
                               <input type="text" name="default_unit" class="form-control" placeholder="Title of the message" required="" value="@if(isset($data['default_unit'])){{$data['default_unit']}}@endif">
                          </div>
                       </div>
                       @endif
                      
                       @if(isset($data['order_prefix']))
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.order_prefix') }} </label>
                           <div class="col-md-10">
                               <input type="text" name="order_prefix" class="form-control" placeholder="Title of the message" required="" value="@if(isset($data['order_prefix'])){{$data['order_prefix']}}@endif">
                          </div>
                       </div>
                       @endif
                       @if(isset($data['email_enable']))
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.email_enable') }} </label>                          
                           <div class="col-md-10">
                            <label class="radio-inline">
                                <input type="radio" value="0" name="email_enable"  @if($data['email_enable']==0) checked="" @endif required="" >No
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="1" name="email_enable"   @if($data['email_enable']==1) checked="" @endif required="" >Yes
                            </label>
                          </div>
                       </div>
                       @endif
                       @if(isset($data['sms_enable']))
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.sms_enable') }} </label>                          
                           <div class="col-md-10">
                            <label class="radio-inline">
                                <input type="radio" value="0" name="sms_enable" @if($data['sms_enable']==0) checked="" @endif>No
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="1" name="sms_enable" @if($data['sms_enable']==1) checked="" @endif >Yes
                            </label>

                          </div>
                       </div>
                       @endif
                       @if(isset($data['time_zone']))
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.time_zone') }} </label>                          
                           <div class="col-md-10">
                              <select name="time_zone" id="" class="form-control" required="">
                               <option value="America/Los_Angeles" @if($data['time_zone']=='America/Los_Angeles') selected="" @endif> Los Angeles /pacific </option>
                              </select>
                          </div>
                       </div>
                       @endif
                       @if(isset($data['provider_timeout']))
                         <div class="form-group row">                        
                           <label class="col-md-2">Provider Timeout (In Seconds) </label>
                           <div class="col-md-10">
                               <input type="text" name="provider_timeout" class="form-control" placeholder="Title of the message" required="" value="@if(isset($data['provider_timeout'])){{$data['provider_timeout']}}@endif">
                          </div>
                       </div>
                       @endif
                       @if(isset($data['idel_time']))
                         <div class="form-group row">                        
                           <label class="col-md-2">{{ trans('constants.idel_time') }} (In Minutes)</label>
                           <div class="col-md-10">
                               <input type="text" name="idel_time" class="form-control" placeholder="{{__('idel_time')}}" required="" value="@if(isset($data['idel_time'])){{$data['idel_time']}}@endif">
                          </div>
                       </div>
                       @endif
                       @if(isset($data['websocket_url']))
                         <div class="form-group row">                        
                           <label class="col-md-2">Web Socket url</label>
                           <div class="col-md-10">
                               <input type="text" name="websocket_url" class="form-control" placeholder="{{__('websocket_url')}}" value="@if(isset($data['websocket_url'])){{$data['websocket_url']}}@endif">
                          </div>

                       </div>
                       @endif
                       <div class="form-group row">
                        <label class="col-md-2"></label>
                          <div class="col-md-10">
                            <button type="submit"  class="btn btn-primary mr-1" style="padding: 10px 15px;">Update Settings</button> &nbsp;
                             <!-- <button type="button" class="btn btn-success mr-1" style="padding: 10px 15px;">Schedule Push</button> -->
                        </div>
                       </div>
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
   

<!-- <script type="text/javascript">  
  var loadFile = function(event) {
  var output = document.getElementById('site_logo');
  output.src = URL.createObjectURL(event.target.files[0]);
};
var _URL = window.URL || window.webkitURL;

$("#site_logo").change(function(e) {
    var file, img;


    if ((file = this.files[0])) {
        img = new Image();
        img.onload = function() {
        if(this.width <= 360 && this.height <= 640){
        
            alert(this.width + " " + this.height);
        }else{
          alert('invalid file size');
        }
        };
        img.onerror = function() {
            alert( "not a valid file: " + file.type);
        };
        img.src = _URL.createObjectURL(file);


    }

});
</script> -->

<script type="text/javascript">  
  var loadFile1 = function(event) {
  var fileUpload = document.getElementById("fileUpload");
 
    //Check whether the file is valid Image.
    var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.gif)$");
    if (regex.test(fileUpload.value.toLowerCase())) {
 
        //Check whether HTML5 is supported.
        if (typeof (fileUpload.files) != "undefined") {
            //Initiate the FileReader object.
            var reader = new FileReader();
            //Read the contents of Image File.
            reader.readAsDataURL(fileUpload.files[0]);
            reader.onload = function (e) {
                //Initiate the JavaScript Image object.
                var image = new Image();
 
                //Set the Base64 string return from FileReader as source.
                image.src = e.target.result;
                       
                //Validate the File Height and Width.
                image.onload = function () {
                    var height = this.height;
                    var width = this.width;
                    if (height > 100 || width > 100) {
                        alert("Height and Width must not exceed 100px.");
                        return false;
                    }
                    alert("Uploaded image has valid Height and Width.");
                    return true;
                };
 
            }
        } else {
            alert("This browser does not support HTML5.");
            return false;
        }
    } else {
        alert("Please select a valid Image file.");
        return false;
    }

}
</script>

<!-- <script type="text/javascript">
function Upload() {
    //Get reference of FileUpload.
    var fileUpload = document.getElementById("fileUpload");
 
    //Check whether the file is valid Image.
    var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.gif)$");
    if (regex.test(fileUpload.value.toLowerCase())) {
 
        //Check whether HTML5 is supported.
        if (typeof (fileUpload.files) != "undefined") {
            //Initiate the FileReader object.
            var reader = new FileReader();
            //Read the contents of Image File.
            reader.readAsDataURL(fileUpload.files[0]);
            reader.onload = function (e) {
                //Initiate the JavaScript Image object.
                var image = new Image();
 
                //Set the Base64 string return from FileReader as source.
                image.src = e.target.result;
                       
                //Validate the File Height and Width.
                image.onload = function () {
                    var height = this.height;
                    var width = this.width;
                    if (height > 100 || width > 100) {
                        alert("Height and Width must not exceed 100px.");
                        return false;
                    }
                    alert("Uploaded image has valid Height and Width.");
                    return true;
                };
 
            }
        } else {
            alert("This browser does not support HTML5.");
            return false;
        }
    } else {
        alert("Please select a valid Image file.");
        return false;
    }
}
</script> -->

    @endsection     
 