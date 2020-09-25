@extends('layout.master')
  <title>{{APP_NAME}}</title>
  <link rel="icon" href="{{URL::asset(RESTAURANT_UPLOADS_PATH.SITE_FAVICON)}}">
  <!-- <title>@yield('title')</title> -->
  <link rel="apple-touch-icon" href="{{URL::asset(RESTAURANT_UPLOADS_PATH.SITE_FAVICON)}}">
  <link rel="shortcut icon" type="image/x-icon" href="{{URL::asset(RESTAURANT_UPLOADS_PATH.SITE_FAVICON)}}">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/vendors.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/pages/chat-application.min.css')}}">
    <!-- END: Page CSS-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/vendors.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/bootstrap-extended.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/colors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/components.min.css')}}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/core/menu/menu-types/vertical-menu-modern.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/core/colors/palette-gradient.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/fonts/simple-line-icons/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/pages/app-chat.min.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/assets/css/style.css')}}">
    
  </head>
  <!-- END: Head-->

  <body class="vertical-layout vertical-menu-modern content-left-sidebar chat-application  fixed-navbar chatApp" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
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
      <div class="col-md-5"><br>
        
              <!--FOR NEW chat NOTIFICATION ALERT  -->
         <div class="card" style="margin-left: 20rem; width: 75%;" id="webchat_notification">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-danger rounded-left">
                            <i class="fa fa-user-circle-o font-small-3 text-white"></i>
                        </div>
                        <div class="py-1 px-2 media-body">
                            <h5 class="danger">New Chat Received. To view click <a id="webchat_window">Here</a> <a onclick="myFunction()" style="float: right"> x </a></h5>
                           
                        </div>
                    </div>
                </div>
            </div>
             <!--FOR NEW chat NOTIFICATION ALERT ENDS  -->
      </div>
      
    </div>

    <div class="chatBox">
    <h5>
      <strong>{{$order_id->order_id}} 

      ({{(!empty($order_id->chat_person)) ? $order_id->chat_person : trans('constants.guest') }}
     
      - {{$order_id->chat_person_phone}})
      </strong>
    </h5> 
   
      {{--<div class="sidebar-left sidebar-fixed">
        @foreach($data as $d)
        <div class="sidebar"><div class="sidebar-content card">
    }
    }
    <div id="users-list" class="list-group position-relative">
        <div class="users-list-padding media-list">
            <a href="#" class="media">
                <div class="media-left pr-1">
                    <span class="avatar avatar-md avatar-online"><img class="media-object rounded-circle" src="{{url('/')}}/public/app-assets/images/portrait/small/avatar-s-3.png"
                            alt="Generic placeholder image">
                        <i></i>
                    </span>
                </div>
                <div class="media-body w-100">
                    <h6 class="list-group-item-heading">{{$d->Users->name}}<span class="font-small-3 float-right info">{{$d->created_at}}
                            </span></h6>
                    <p class="list-group-item-text text-muted mb-0"><i class="ft-check primary font-small-2"></i> Okay
                        <span class="float-right primary"><i class="font-medium-1 icon-pin blue-grey lighten-3"></i></span></p>
                </div>
            </a>
        </div>
    </div>
</div>
        </div>
        @endforeach
      </div>--}}
    
      <div class="content-right">
        <div class="content-wrapper">
          <div class="content-header row mb-1">
          </div>
          <div class="content-body"><div class="content-overlay"></div>
<section class="chat-app-window" id="chat-app-window">
    <div class="sidebar-toggle d-block d-lg-none"><i class="ft-menu font-large-1"></i></div>
    <div class="chats">
        <div class="chats" id="chats">
          <div id="msg_received"></div>
          @if($type==2)
            <input type="hidden" id="user_id" value="{{$order_id->user_id}}">
          @elseif($type==3)
            <input type="hidden" id="user_id" value="{{$order_id->restaurant_id}}">
          @else
            <input type="hidden" id="user_id" value="{{$order_id->delivery_boy_id}}">
          @endif
          <input type="hidden" id="type" value="{{$type}}">
          <input type="hidden" id="request_id" value="{{$order_id->id}}">
          @foreach($query as $q)
          @if(($q->from_id=="Admin_1" && session()->get('role')==1)||($q->to_id=="Admin_1" && session()->get('role')!=1))
          <div class="chat">
            <div class="chat-avatar">
              <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                  <img src="{{url('/')}}/public/app-assets/images/portrait/small/avatar-s-1.png" alt="avatar" />
              </a>
            </div>
            <div class="chat-body">
              <div class="chat-content">
                <p id="admin_msg">{{$q->message}}</p>
              </div>
            </div>
          </div>
          @else
            <div id="user_chat">
            <div class="chat chat-left">
            <div class="chat-avatar">
              <a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                <?php
                $filename = UPLOADS_PATH.$q->profile_image;
                if (file_exists($filename)) {
                ?>
                <img src="{{$q->profile_image}}" alt="avatar" />
                <?php }else{ ?>
                <img src="{{url('/')}}/public/app-assets/images/portrait/small/avatar-s-1.png" alt="avatar" />
                <?php } ?>
              </a>
            </div>
            <div class="chat-body">
              <div class="chat-content">
                <p>{{$q->message}}</p>
              </div>
            </div>
          </div>
       </div>   
          @endif
            @endforeach
            </div>
          </div>
          </section>
        </div>
    </div>
  </div>

<section class="chat-app-form sendSection" id="sendSection">
  <form class="chat-app-input d-flex" action="javascript:void(0);">
    <fieldset class="form-group position-relative has-icon-left col-10 m-0">
      <div class="form-control-position">
      </div>
      <input type="text" name="chat" class="form-control message" id="message" placeholder="Type your message">
      <div class="form-control-position control-position-right">
      </div>
    </fieldset>
    <fieldset class="form-group position-relative has-icon-left col-2 m-0">
      <button type="button" class="btn btn-primary send" id="send" name="send"><i class="la la-paper-plane-o d-lg-none"></i> <span class="d-none d-lg-block">Send</span></button>
    </fieldset>
  </form>
</section>
          </div>
        </div>
      </div>
    </div>
    <!-- END: Content-->
    <!-- BEGIN: Page JS-->
    <!-- <script src="{{URL::asset('public/app-assets/vendors/js/vendors.min.js')}}"></script>
    <script src="{{URL::asset('public/app-assets/js/scripts/pages/chat-application.min.js')}}"></script> -->
