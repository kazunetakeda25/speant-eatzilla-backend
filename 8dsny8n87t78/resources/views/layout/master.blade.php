<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <link rel="stylesheet" type="text/css" href="https://foodie.deliveryventure.com/assets/admin/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://foodie.deliveryventure.com/assets/admin/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://foodie.deliveryventure.com/assets/admin/plugins/clockpicker/dist/bootstrap-clockpicker.min.css">

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="{{APP_NAME}} admin is super flexible, powerful, responsive bootstrap 4 admin panel.">
  <meta name="keywords" content="{{APP_NAME}} admin is super flexible, powerful, responsive bootstrap 4 admin panel.">
  <!-- <meta name="author" content="PIXINVENT"> -->
  <title>{{APP_NAME}}</title>
  <link rel="icon" href="{{URL::asset(RESTAURANT_UPLOADS_PATH.SITE_FAVICON)}}">
  <!-- <title>@yield('title')</title> -->
  <link rel="apple-touch-icon" href="{{URL::asset(RESTAURANT_UPLOADS_PATH.SITE_FAVICON)}}">
  <link rel="shortcut icon" type="image/x-icon" href="{{URL::asset(RESTAURANT_UPLOADS_PATH.SITE_FAVICON)}}">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/vendors.css')}}">

  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/components.min.css')}}">
  
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/forms/selects/select2.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/pickers/daterange/daterangepicker.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/pickers/pickadate/pickadate.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
  <!-- END VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/bootstrap-extended.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/colors.min.css')}}">
    

  <!-- BEGIN MODERN CSS-->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/app.css')}}">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/core/menu/menu-types/vertical-menu-modern.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/core/colors/palette-gradient.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/fonts/simple-line-icons/style.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/pages/app-chat.min.css')}}">
  
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/charts/morris.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/fonts/simple-line-icons/style.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/plugins/pickers/daterange/daterange.css')}}">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/assets/css/style.css')}}">
  <!-- END Custom CSS-->
  
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/view-orders.css')}}">
  <!-- END Page Level CSS-->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/forms/toggle/switchery.min.css')}}">

  <script type="text/javascript"
     src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script> 

   <!--  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> -->

</head>
<style type="text/css">
  .main-menu.menu-dark .navigation {
    background: {{MENU_COLOR}} !important;
}
.main-menu.menu-dark .navigation > li.open > a {
    background: {{HIGHLIGHT_COLOR}} !important;
}
.main-menu.menu-dark .navigation > li > ul {
    background: {{MENU_COLOR}}  !important;
}
.navbar-semi-dark .navbar-header {
    background: {{MENU_COLOR}}  !important;
}
.main-menu.menu-dark {
    background: {{MENU_COLOR}}  !important;
}
.error_message {
  color: red;
}
</style>

<audio id="myAudio">
    <source src="{{url('/')}}/public/sound/notification.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
  </audio>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  <!-- fixed-top-->
  <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          <li class="nav-item mr-auto">
            <a class="navbar-brand" href="#">
              <img class="brand-logo" alt="{{APP_NAME}}" src="{{URL::asset(RESTAURANT_UPLOADS_PATH.SITE_FAVICON)}}">
              <h3 class="brand-text">{{APP_NAME}}</h3>
            </a>
          </li>
          <li class="nav-item d-none d-md-block float-right"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon ft-toggle-right font-medium-3 white" data-ticon="ft-toggle-right"></i></a></li>
          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
      <div class="navbar-container content">
        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">
            
          </ul>
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-user nav-item">
              <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">{{trans('constants.welcome_title')}}
                  <span class="user-name text-bold-700">{{ucfirst(session()->get('user_name'))}}</span>
                </span>
                <span class="avatar avatar-online">
                  <img src="{{URL::asset('public/app-assets/images/portrait/small/avatar-s-19.png')}}" alt="avatar"><i></i></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <!-- <a class="dropdown-item" href="#"><i class="ft-user"></i> Edit Profile</a> -->
                <!-- <a class="dropdown-item" href="#"><i class="ft-mail"></i> My Inbox</a>
                <a class="dropdown-item" href="#"><i class="ft-check-square"></i> Task</a>
                <a class="dropdown-item" href="#"><i class="ft-message-square"></i> Chats</a> -->
                <!-- <div class="dropdown-divider"></div> -->
                <a class="dropdown-item" href="{{url('/')}}/admin/logout"><i class="ft-power"></i> {{trans('constants.logout_txt')}}</a>
              </div>
            </li>
          <!--   <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-gb"></i><span class="selected-language"></span></a>
              <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-gb"></i> English</a>
                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a>
                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-cn"></i> Chinese</a>
                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-de"></i> German</a>
              </div>
            </li> -->
 <!--            <li class="dropdown dropdown-notification nav-item">
              <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-bell"></i>
                <span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow">5</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                <li class="dropdown-menu-header">
                  <h6 class="dropdown-header m-0">
                    <span class="grey darken-2">Notifications</span>
                  </h6>
                  <span class="notification-tag badge badge-default badge-danger float-right m-0">5 New</span>
                </li>
                <li class="scrollable-container media-list w-100">
                  <a href="javascript:void(0)">
                    <div class="media">
                      <div class="media-left align-self-center"><i class="ft-plus-square icon-bg-circle bg-cyan"></i></div>
                      <div class="media-body">
                        <h6 class="media-heading">You have new order!</h6>
                        <p class="notification-text font-small-3 text-muted">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                        <small>
                          <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">30 minutes ago</time>
                        </small>
                      </div>
                    </div>
                  </a>
                  <a href="javascript:void(0)">
                    <div class="media">
                      <div class="media-left align-self-center"><i class="ft-download-cloud icon-bg-circle bg-red bg-darken-1"></i></div>
                      <div class="media-body">
                        <h6 class="media-heading red darken-1">99% Server load</h6>
                        <p class="notification-text font-small-3 text-muted">Aliquam tincidunt mauris eu risus.</p>
                        <small>
                          <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Five hour ago</time>
                        </small>
                      </div>
                    </div>
                  </a>
                  <a href="javascript:void(0)">
                    <div class="media">
                      <div class="media-left align-self-center"><i class="ft-alert-triangle icon-bg-circle bg-yellow bg-darken-3"></i></div>
                      <div class="media-body">
                        <h6 class="media-heading yellow darken-3">Warning notifixation</h6>
                        <p class="notification-text font-small-3 text-muted">Vestibulum auctor dapibus neque.</p>
                        <small>
                          <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Today</time>
                        </small>
                      </div>
                    </div>
                  </a>
                  <a href="javascript:void(0)">
                    <div class="media">
                      <div class="media-left align-self-center"><i class="ft-check-circle icon-bg-circle bg-cyan"></i></div>
                      <div class="media-body">
                        <h6 class="media-heading">Complete the task</h6>
                        <small>
                          <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last week</time>
                        </small>
                      </div>
                    </div>
                  </a>
                  <a href="javascript:void(0)">
                    <div class="media">
                      <div class="media-left align-self-center"><i class="ft-file icon-bg-circle bg-teal"></i></div>
                      <div class="media-body">
                        <h6 class="media-heading">Generate monthly report</h6>
                        <small>
                          <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last month</time>
                        </small>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all notifications</a></li>
              </ul>
            </li> -->
 <!--            <li class="dropdown dropdown-notification nav-item">
              <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-mail">             </i></a>
              <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                <li class="dropdown-menu-header">
                  <h6 class="dropdown-header m-0">
                    <span class="grey darken-2">Messages</span>
                  </h6>
                  <span class="notification-tag badge badge-default badge-warning float-right m-0">4 New</span>
                </li>
                <li class="scrollable-container media-list w-100">
                  <a href="javascript:void(0)">
                    <div class="media">
                      <div class="media-left">
                        <span class="avatar avatar-sm avatar-online rounded-circle">
                          <img src="{{URL::asset('public/app-assets/images/portrait/small/avatar-s-19.png')}}" alt="avatar"><i></i></span>
                      </div>
                      <div class="media-body">
                        <h6 class="media-heading">Margaret Govan</h6>
                        <p class="notification-text font-small-3 text-muted">I like your portfolio, let's start.</p>
                        <small>
                          <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Today</time>
                        </small>
                      </div>
                    </div>
                  </a>
                  <a href="javascript:void(0)">
                    <div class="media">
                      <div class="media-left">
                        <span class="avatar avatar-sm avatar-busy rounded-circle">
                          <img src="{{URL::asset('public/app-assets/images/portrait/small/avatar-s-2.png')}}" alt="avatar"><i></i></span>
                      </div>
                      <div class="media-body">
                        <h6 class="media-heading">Bret Lezama</h6>
                        <p class="notification-text font-small-3 text-muted">I have seen your work, there is</p>
                        <small>
                          <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Tuesday</time>
                        </small>
                      </div>
                    </div>
                  </a>
                  <a href="javascript:void(0)">
                    <div class="media">
                      <div class="media-left">
                        <span class="avatar avatar-sm avatar-online rounded-circle">
                          <img src="{{URL::asset('public/app-assets/images/portrait/small/avatar-s-3.png')}}" alt="avatar"><i></i></span>
                      </div>
                      <div class="media-body">
                        <h6 class="media-heading">Carie Berra</h6>
                        <p class="notification-text font-small-3 text-muted">Can we have call in this week ?</p>
                        <small>
                          <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Friday</time>
                        </small>
                      </div>
                    </div>
                  </a>
                  <a href="javascript:void(0)">
                    <div class="media">
                      <div class="media-left">
                        <span class="avatar avatar-sm avatar-away rounded-circle">
                          <img src="{{URL::asset('public/app-assets/images/portrait/small/avatar-s-6.png')}}" alt="avatar"><i></i></span>
                      </div>
                      <div class="media-body">
                        <h6 class="media-heading">Eric Alsobrook</h6>
                        <p class="notification-text font-small-3 text-muted">We have project party this saturday.</p>
                        <small>
                          <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">last month</time>
                        </small>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all messages</a></li>
              </ul>
            </li> -->
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
     @include('includes.navBar')
 </div>
 <div class="app-content content">
    <div class="row">
      <div class="col-md-1">
      </div>
      <div class="col-md-10">
          @if(Session::has('error'))
                <p class="alert alert-danger" style="margin-top: 20px;">{{ Session::get('error') }}</p>
            @endif

            @if(Session::has('success'))
                <p class="alert alert-success" style="margin-top: 20px;">{{ Session::get('success') }}</p>
            @endif
      </div>
      <div class="col-md-5">
        <!--FOR NEW ORDER NOTIFICATION ALERT  -->
         <div class="card" id="notification">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-danger rounded-left">
                            <i class="fa fa-user-circle-o font-small-3 text-white"></i>
                        </div>
                        <div class="py-1 px-2 media-body">
                            <h5 class="danger">New Order Received. To view click <a href="{{url('/')}}/admin/orders/new">Here</a> <a onclick="myFunction()" style="float: right"> x </a></h5>
                           
                        </div>
                    </div>
                </div>
            </div>
             <!--FOR NEW ORDER NOTIFICATION ALERT ENDS  -->
              <!--FOR NEW chat NOTIFICATION ALERT  -->
            <div class="card" style="margin-left: 1rem;" id="chat_notification">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-danger rounded-left">
                            <i class="fa fa-user-circle-o font-small-3 text-white"></i>
                        </div>
                        <div class="py-1 px-2 media-body">
                            <h5 class="danger">New Chat Received. To view click <a id="chat_window">Here</a> <a onclick="myFunction()" style="float: right"> x </a></h5>
                           
                        </div>
                    </div>
                </div>
            </div>
             <!--FOR NEW chat NOTIFICATION ALERT ENDS  -->
      </div>
      
    </div>
    
     @yield('content')
</div>
@include('includes.footer')

@yield('script')
<script src="{{URL::asset('public/app-assets/js/scripts/pages/chat-application.min.js')}}"></script>
<!--FOR NEW ORDER NOTIFICATION ALERT  -->
<script type="text/javascript">
  var path = window.location.pathname;
  var page = path.split('/');
  let page_name = (page[3])?page[3]:"";
  
  document.getElementById('notification').hidden = true;
  document.getElementById('chat_notification').hidden = true;
  if(page_name=='web_chat')
    document.getElementById('webchat_notification').hidden = true;

function myFunction() {
  document.getElementById('notification').hidden = true;
  document.getElementById('chat_notification').hidden = true;
  if(page_name=='web_chat')
    document.getElementById('webchat_notification').hidden = true;

  play_wav();
}

var isStop = false;
var myaudio = document.getElementById("myAudio"); 
var refreshIntervalId;
function WebSocketTest() { 
            
    if ("WebSocket" in window) {
        console.log("WebSocket is supported by your Browser!");
        
        // Let us open a web socket
        var ws = new WebSocket("ws://{{$_SERVER['HTTP_HOST']}}:8081");

        ws.onopen = function() {
          console.log('Socket connected successfully!..');
        };

        ws.onmessage = function (evt) { 
          try {
            isStop = false;
            var received_msg = JSON.parse(evt.data);
            console.log("Message is received..."+evt.data);
            let id = received_msg.msg;
            console.log("Message is received..."+evt.data);
            if (id == {{Session::get('userid')}}) {
              if(myaudio.pause){
                refreshIntervalId = setInterval(function(){ 
                  if(!isStop){
                    console.log(myaudio);
                    document.querySelector('audio').play();
                      //myaudio.play(); 
                      console.log("playing");
                  }
                }, 200);
              }
              document.getElementById('notification').hidden = false;
            }
            if ({{Session::get('role')}}==1) {
              if(myaudio.pause){
                refreshIntervalId = setInterval(function(){ 
                  if(!isStop){
                    document.querySelector('audio').play();
                      // myaudio.play(); 
                        console.log("playing");
                  }
                }, 200);
                document.getElementById('notification').hidden = false;
              }
            }
          } catch (error) {
              
          }
        };

        ws.onclose = function() { 
          console.log("Connection is closed..."); 
        };

    } else {
        console.log("WebSocket NOT supported by your Browser!");
    }
  }

  WebSocketTest();

$.ajax({
  type: "GET",
  url: "{{url('/')}}/admin/get_orders_count",
  success: function(data){
    console.log(data);
    if(data.new_orders!=0) $('#new_order').html(data.new_orders);
    if(data.processing_orders!=0) $('#processing_order').html(data.processing_orders);
    if(data.pickup_orders!=0) $('#order_pickup').html(data.pickup_orders);
    if(data.delivered_orders!=0) $('#deliverd_order').html(data.delivered_orders);
    if(data.cancelled_orders!=0) $('#cancelled_order').html(data.cancelled_orders);
    if(data.pickuporder!=0) $('#pickup_order').html(data.pickuporder);
    if(data.diningorder!=0) $('#dining_order').html(data.diningorder);
  }
});


//connection open for admin chat
var wsUri = "{{WEBSOCKET_URL}}";
    var websocket;
    var res_id = {{Session::get('userid')}};
    if ({{Session::get('role')}}==1){
      var socket_id = "Admin_1";
    }else{
      var socket_id = "Restaurant_"+res_id;
    }
    websocket = new WebSocket(wsUri);
    console.log(websocket);
    websocket.onopen = function(evt) {
        let msg = {};
        msg.type = "init";
        msg.id = socket_id;
        console.log(JSON.stringify(msg));
        websocket.send(JSON.stringify(msg));
    };
</script>
<script language = "javascript" type = "text/javascript">
    
    // var wsUri = "{{WEBSOCKET_URL}}";
    // var websocket;
    //let id = "Admin_1";
    //websocket = new WebSocket(wsUri);
    //console.log(websocket);
    // websocket.onopen = function(evt) {
    //   let msg = {};
    //   msg.type = "init";
    //   msg.id = id; pm2 start --name "anyname" node index.js
    //   console.log(JSON.stringify(msg));
    //   websocket.send(JSON.stringify(msg));
    // };

    websocket.onmessage = function(evt) {
        onMessage(evt)
    };

    // var divSection = document.getElementById("chat-app-window");
    //    divSection.scrollTop = divSection.scrollHeight - divSection.clientHeight;

     
    $("#send").click(function(){
      let user_id = $("#user_id").val();
      let message = $("#message").val();
      let type = parseInt($("#type").val());
      if(message != '' && message != null){
      $("#message").val("");
      var html = '<div class="chat" id="admin_msg"><div class="chat-avatar"><a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title=""><img src="{{url('/')}}/public/app-assets/images/portrait/small/avatar-s-1.png" alt="avatar" /></a></div><div class="chat-body"><div class="chat-content"><p id="admin_msg">'+message+'</p></div></div></div>';
      $("#chats").append(html);

       var divSection = document.getElementById("chat-app-window");
       console.log('div', divSection)
       divSection.scrollTop = divSection.scrollHeight - divSection.clientHeight;
       // divSection.scrollTop = 0;

      let request_id = $("#request_id").val();
      let from_id = socket_id;
      if(type==2){
        var sender_id = "User_"+user_id;
      }else if(type==3 && {{Session::get('role')}}==1){
        var sender_id = "Restaurant_"+user_id;
      }else if(type==3 && {{Session::get('role')}}!=1){
        var sender_id = "Admin_1";
      }else{
        var sender_id = "Provider_"+user_id;
      }
      
      let msg = {};
      msg.type = "message";
      msg.to_id = sender_id;
      msg.message = message;
      msg.from_id = from_id;
      msg.provider_id = 1;
      msg.provider_type = type
      msg.user_id = user_id;
      msg.request_id = request_id;
      console.log(msg);
      websocket.send(JSON.stringify(msg));

    //websocket.send({"type":"message","to":receiver_id,"message":message});
  }
});

  /**
  */

$(document).keypress(function (e) {
  if (e.which == 13) {
    let user_id = $("#user_id").val();
      let message = $("#message").val();
      var type = parseInt($("#type").val());
      if(message != '' && message != null){
      $("#message").val("");
      var html = '<div class="chat" id="admin_msg"><div class="chat-avatar"><a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title=""><img src="{{url('/')}}/public/app-assets/images/portrait/small/avatar-s-1.png" alt="avatar" /></a></div><div class="chat-body"><div class="chat-content"><p id="admin_msg">'+message+'</p></div></div></div>';
      $("#chats").append(html);

       var divSection = document.getElementById("chat-app-window");
       console.log('div', divSection)
       divSection.scrollTop = divSection.scrollHeight - divSection.clientHeight;
       // divSection.scrollTop = 0;

      let request_id = $("#request_id").val();
      let from_id = socket_id;
      if(type==2){
        var sender_id = "User_"+user_id;
      }else if(type==3 && {{Session::get('role')}}==1){
        var sender_id = "Restaurant_"+user_id;
      }else if(type==3 && {{Session::get('role')}}!=1){
        var sender_id = "Admin_1";
      }else{
        var sender_id = "Provider_"+user_id;
      }
      let msg = {};
      msg.type = "message";
      msg.to_id = sender_id;
      msg.message = message;
      msg.from_id = from_id;
      msg.provider_id = 1;
      msg.provider_type = type;
      msg.user_id = user_id;
      msg.request_id = request_id;
      console.log(msg);
      websocket.send(JSON.stringify(msg));
 }
}
});

function onMessage(evt) {
  var path = window.location.pathname;
  var page = path.split('/');
  let page_name = (page[3])?page[3]:"";
  var data = JSON.parse(evt.data);
  var type = $("#type").val();
  isStop = false;
  console.log(data);
  console.log(data.provider_type);
  if(page_name=='web_chat')
  {
    let user_id = $("#user_id").val();
    let request_id = $("#request_id").val();
    if(user_id==data.user_id && request_id==data.request_id && type==data.provider_type)
    {
      if (({{Session::get('role')}}==1 && data.to_id=="Admin_1") || ({{Session::get('role')}}!=1 && data.to_id!="Admin_1")) {
        html1='<div id="user_chat"><div class="chat chat-left"><div class="chat-avatar"><a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title=""><img src="{{url('/')}}/public/app-assets/images/portrait/small/avatar-s-1.png" alt="avatar" /></a></div><div class="chat-body"><div class="chat-content"><p>'+data.message+'</p></div></div></div></div>';  
      }else{
        html1='<div id="user_chat"><div class="chat chat-right"><div class="chat-avatar"><a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title=""><img src="{{url('/')}}/public/app-assets/images/portrait/small/avatar-s-1.png" alt="avatar" /></a></div><div class="chat-body"><div class="chat-content"><p>'+data.message+'</p></div></div></div></div>';  
      }
      $("#chats").append(html1);
      var divSection = document.getElementById("chat-app-window");
      console.log('div', divSection)
      divSection.scrollTop = divSection.scrollHeight - divSection.clientHeight;
    }else
    {
      $("#webchat_window").attr('href','{{url('/')}}/admin/web_chat/'+data.provider_type+'/'+data.request_id);
      document.getElementById('webchat_notification').hidden = false;
      if(myaudio.pause){
        refreshIntervalId = setInterval(function(){ 
          if(!isStop){
            document.querySelector('audio').play();
              // myaudio.play(); 
                console.log("playing");
          }
        }, 200);
      }
    }
  }else
  {
    $("#chat_window").attr('href','{{url('/')}}/admin/web_chat/'+data.provider_type+'/'+data.request_id);
    document.getElementById('chat_notification').hidden = false;
    if(myaudio.pause){
      refreshIntervalId = setInterval(function(){ 
        if(!isStop){
          document.querySelector('audio').play();
            // myaudio.play(); 
              console.log("playing");
        }
      }, 200);
    }
  }
}


function play_wav()
{
  console.log("myaudio",myaudio);
  if(myaudio){
    isStop = true;
    clearInterval(refreshIntervalId);
    // myaudio.pause();
    console.log("paused");
    return;
  } 
}

  function WebSocketTest() { 
            
      if ("WebSocket" in window) {
          console.log("WebSocket is supported by your Browser!");
          
          // Let us open a web socket
          var ws = new WebSocket("ws://{{$_SERVER['HTTP_HOST']}}:8081");
  
          ws.onopen = function() {
            console.log('Socket connected successfully!..');
          };
  
          ws.onmessage = function (evt) { 
            try {
              isStop = false;
              var received_msg = JSON.parse(evt.data);
              console.log("Message is received..."+evt.data);
              let id = received_msg.msg;
              console.log("Message is received..."+evt.data);
              if (id == {{Session::get('userid')}}) {
                if(myaudio.pause){
                  refreshIntervalId = setInterval(function(){ 
                    if(!isStop){
                      console.log(myaudio);
                      document.querySelector('audio').play();
                        //myaudio.play(); 
                        console.log("playing");
                    }
                  }, 200);
                }
                document.getElementById('notification').hidden = false;
              }
              if ({{Session::get('role')}}==1) {
                if(myaudio.pause){
                  refreshIntervalId = setInterval(function(){ 
                    if(!isStop){
                      document.querySelector('audio').play();
                       // myaudio.play(); 
                          console.log("playing");
                    }
                  }, 200);
                  document.getElementById('notification').hidden = false;
                }
              }
            } catch (error) {
                
            }
          };
  
          ws.onclose = function() { 
            console.log("Connection is closed..."); 
          };

      } else {
          console.log("WebSocket NOT supported by your Browser!");
      }
    }

    WebSocketTest();

</script>
 <!--FOR NEW ORDER NOTIFICATION ALERT ENDS -->