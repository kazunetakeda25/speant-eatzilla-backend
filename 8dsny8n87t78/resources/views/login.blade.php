<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="pizza, delivery food, fast food, sushi, take away, chinese, italian food">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>{{APP_NAME}}</title>
    <!-- BASE CSS -->
    <link href="{{URL::asset('public/login-assets/LOGIN/css/base.css')}}" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{URL::asset(RESTAURANT_UPLOADS_PATH.SITE_FAVICON)}}">
     
</head>
<style type="text/css">
    .btn.btn-submit {
    width: 100%;
    margin-top: 30px;
    color: #191b19;
    padding: 10px;
    background: #fff;
    font-weight: 600;
    outline: 0;
    -webkit-transition: all .2s ease;
    transition: all .2s ease;
    font-size: 16px;
}
</style>

<body style="background-image: url('public/uploads/login-background1.jpg') !important;position: relative;background-size: cover;">

    <div id="preloader">
        <div class="sk-spinner sk-spinner-wave" id="status">
            <div class="sk-rect1"></div>
            <div class="sk-rect2"></div>
            <div class="sk-rect3"></div>
            <div class="sk-rect4"></div>
            <div class="sk-rect5"></div>
        </div>
    </div><!-- End Preload -->
    
   
    <!-- End Header =============================================== -->
    
    <!-- SubHeader =============================================== -->
    <section>
     
        <div class="col-md-12" >
           <div class="modal-popup col-md-6 col-md-offset-3" style="margin-top:115px;">
            <h3><B>WELCOME TO {{strtoUpper(APP_NAME)}} ADMIN</B></h3>
            <h3><B>LOGIN</B></h3>
             <div style="font-size:17px;" >
                  @if(session()->has('success'))
                        <div class="card" style="color:green;"><!-- gainsboro -->
                            <div class="card-content">
                                <strong>{{ Session::get('success')}}</strong>
                            </div>
                        </div>
                    @endif
                    
                    @if(session()->has('error'))
                        <div class="card" style="color:red;"><!-- #f97c7c -->
                            <div class="card-content">
                                <strong>{{ Session::get('error')}}</strong>
                            </div>
                        </div>
                    @endif
                   </div>    
           <form action="{{url('/')}}/admin/login" method="post" class="popup-form" id="myLogin">
               <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <!-- <div class="login_icon"><i class="icon_lock_alt"></i></div> -->
                    <img src="{{URL::asset(RESTAURANT_UPLOADS_PATH.SITE_LOGO)}}" width="250">
                    <input type="text" class="form-control form-white" placeholder="Username" name="email" required="">
                    <input type="Password" class="form-control form-white" placeholder="Password" name="password" required="">
                    <!-- <div class="text-left">
                        <a href="#">Forgot Password?</a>
                    </div> -->
                    <button type="submit" class="btn btn-submit">Submit</button>
                </form>
                </div>
        </div><!-- End sub_content -->
    
   
   
    </section><!-- End Header video -->
    <!-- End SubHeader ============================================ -->
<!-- COMMON SCRIPTS -->
<script src="{{URL::asset('public/login-assets/LOGIN/js/jquery-2.2.4.min.js')}}"></script>
<script src="{{URL::asset('public/login-assets/LOGIN/js/common_scripts_min.js')}}"></script>
<script src="{{URL::asset('public/login-assets/LOGIN/js/functions.js')}}"></script>
<script src="{{URL::asset('public/login-assets/LOGIN/assets/validate.js')}}"></script>

<!-- SPECIFIC SCRIPTS -->
<script src="{{URL::asset('public/login-assets/LOGIN/js/video_header.js')}}"></script>
<script>
$(document).ready(function() {
    'use strict';
      HeaderVideo.init({
      container: $('.header-video'),
      header: $('.header-video--media'),
      videoTrigger: $("#video-trigger"),
      autoPlayVideo: true
    });    

});
</script>

</body>

<!-- Mirrored from www.ansonika.com/quickfood/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Aug 2018 13:44:46 GMT -->
</html>