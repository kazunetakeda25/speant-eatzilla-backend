
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
  <meta name="description" content="Eatzilla admin is super flexible, powerful, responsive bootstrap 4 admin panel.">
  <meta name="keywords" content="Eatzilla admin is super flexible, powerful, responsive bootstrap 4 admin panel.">
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
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/core/menu/menu-types/vertical-menu-modern.css')}}">
     <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/fonts/simple-line-icons/style.min.css')}}">
  
  
  <!-- END VENDOR CSS-->
  <!-- BEGIN MODERN CSS-->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/app.css')}}">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/core/menu/menu-types/vertical-menu-modern.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/core/colors/palette-gradient.css')}}">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/assets/css/style.css')}}">
  <!-- END Custom CSS-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/forms/toggle/switchery.min.css')}}">


  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/charts/c3.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/plugins/charts/c3-chart.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/vendors/css/charts/c3.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/app-assets/css/plugins/charts/c3-chart.css')}}">
  
<style>
     .checked {
         color: orange;
        }
       ul {
         list-style-type: none;
        }
        .link_clr{
          color: white;
        }
        .card-body1 {
            flex: 1 1 auto;
           padding: 1.0rem;
        }
        .bg-info1 {
           background-color: #ff4961 !important;
        }  
        .card-header1 {
    padding: 0.5rem 0.5rem;
    margin-bottom: 0;
    background-color: #ff847c;
    border-bottom: 1px solid rgba(0, 0, 0, 0.06);
}
 .card-header2 {
    padding: 0.5rem 0.5rem;
    margin-bottom: 0;
    background-color: #ff4961;
    border-bottom: 1px solid rgba(0, 0, 0, 0.06);
}
.card-header3 {
    padding: 0.5rem 0.5rem;
    margin-bottom: 0;
    background-color: #91ca8f;
    border-bottom: 1px solid rgba(0, 0, 0, 0.06);
}
.card-header4 {
    padding: 0.5rem 0.5rem;
    margin-bottom: 0;
    background-color: #ce9160;
    border-bottom: 1px solid rgba(0, 0, 0, 0.06);
}
.error_message {
  color: red;
}
       
</style>

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
            <!--<li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
             <li class="dropdown nav-item mega-dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Mega</a>
              <ul class="mega-dropdown-menu dropdown-menu row">
                <li class="col-md-2">
                  <h6 class="dropdown-menu-header text-uppercase mb-1"><i class="la la-newspaper-o"></i> News</h6>
                  <div id="mega-menu-carousel-example">
                    <div>
                      <img class="rounded img-fluid mb-1" src="{{URL::asset('public/app-assets/images/slider/slider-2.png')}}"
                      alt="First slide"><a class="news-title mb-0" href="#">Poster Frame PSD</a>
                      <p class="news-content">
                        <span class="font-small-2">January 26, 2018</span>
                      </p>
                    </div>
                  </div>
                </li>
                <li class="col-md-3">
                  <h6 class="dropdown-menu-header text-uppercase"><i class="la la-random"></i> Drill down menu</h6>
                  <ul class="drilldown-menu">
                    <li class="menu-list">
                      <ul>
                        <li>
                          <a class="dropdown-item" href="layout-2-columns.html"><i class="ft-file"></i> Page layouts & Templates</a>
                        </li>
                        <li><a href="#"><i class="ft-align-left"></i> Multi level menu</a>
                          <ul>
                            <li><a class="dropdown-item" href="#"><i class="la la-bookmark-o"></i>  Second level</a></li>
                            <li><a href="#"><i class="la la-lemon-o"></i> Second level menu</a>
                              <ul>
                                <li><a class="dropdown-item" href="#"><i class="la la-heart-o"></i>  Third level</a></li>
                                <li><a class="dropdown-item" href="#"><i class="la la-file-o"></i> Third level</a></li>
                                <li><a class="dropdown-item" href="#"><i class="la la-trash-o"></i> Third level</a></li>
                                <li><a class="dropdown-item" href="#"><i class="la la-clock-o"></i> Third level</a></li>
                              </ul>
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="la la-hdd-o"></i> Second level, third link</a></li>
                            <li><a class="dropdown-item" href="#"><i class="la la-floppy-o"></i> Second level, fourth link</a></li>
                          </ul>
                        </li>
                        <li>
                          <a class="dropdown-item" href="color-palette-primary.html"><i class="ft-camera"></i> Color palette system</a>
                        </li>
                        <li><a class="dropdown-item" href="sk-2-columns.html"><i class="ft-edit"></i> Page starter kit</a></li>
                        <li><a class="dropdown-item" href="changelog.html"><i class="ft-minimize-2"></i> Change log</a></li>
                        <li>
                          <a class="dropdown-item" href="https://pixinvent.ticksy.com/"><i class="la la-life-ring"></i> Customer support center</a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li class="col-md-3">
                  <h6 class="dropdown-menu-header text-uppercase"><i class="la la-list-ul"></i> Accordion</h6>
                  <div id="accordionWrap" role="tablist" aria-multiselectable="true">
                    <div class="card border-0 box-shadow-0 collapse-icon accordion-icon-rotate">
                      <div class="card-header p-0 pb-2 border-0" id="headingOne" role="tab"><a data-toggle="collapse" data-parent="#accordionWrap" href="#accordionOne"
                        aria-expanded="true" aria-controls="accordionOne">Accordion Item #1</a></div>
                      <div class="card-collapse collapse show" id="accordionOne" role="tabpanel" aria-labelledby="headingOne"
                      aria-expanded="true">
                        <div class="card-content">
                          <p class="accordion-text text-small-3">Caramels dessert chocolate cake pastry jujubes bonbon.
                            Jelly wafer jelly beans. Caramels chocolate cake liquorice
                            cake wafer jelly beans croissant apple pie.</p>
                        </div>
                      </div>
                      <div class="card-header p-0 pb-2 border-0" id="headingTwo" role="tab"><a class="collapsed" data-toggle="collapse" data-parent="#accordionWrap"
                        href="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">Accordion Item #2</a></div>
                      <div class="card-collapse collapse" id="accordionTwo" role="tabpanel" aria-labelledby="headingTwo"
                      aria-expanded="false">
                        <div class="card-content">
                          <p class="accordion-text">Sugar plum bear claw oat cake chocolate jelly tiramisu
                            dessert pie. Tiramisu macaroon muffin jelly marshmallow
                            cake. Pastry oat cake chupa chups.</p>
                        </div>
                      </div>
                      <div class="card-header p-0 pb-2 border-0" id="headingThree" role="tab"><a class="collapsed" data-toggle="collapse" data-parent="#accordionWrap"
                        href="#accordionThree" aria-expanded="false" aria-controls="accordionThree">Accordion Item #3</a></div>
                      <div class="card-collapse collapse" id="accordionThree" role="tabpanel" aria-labelledby="headingThree"
                      aria-expanded="false">
                        <div class="card-content">
                          <p class="accordion-text">Candy cupcake sugar plum oat cake wafer marzipan jujubes
                            lollipop macaroon. Cake dragée jujubes donut chocolate
                            bar chocolate cake cupcake chocolate topping.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="col-md-4">
                  <h6 class="dropdown-menu-header text-uppercase mb-1"><i class="la la-envelope-o"></i> Contact Us</h6>
                  <form class="form form-horizontal">
                    <div class="form-body">
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label" for="inputName1">Name</label>
                        <div class="col-sm-9">
                          <div class="position-relative has-icon-left">
                            <input class="form-control" type="text" id="inputName1" placeholder="John Doe">
                            <div class="form-control-position pl-1"><i class="la la-user"></i></div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label" for="inputEmail1">Email</label>
                        <div class="col-sm-9">
                          <div class="position-relative has-icon-left">
                            <input class="form-control" type="email" id="inputEmail1" placeholder="john@example.com">
                            <div class="form-control-position pl-1"><i class="la la-envelope-o"></i></div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-3 form-control-label" for="inputMessage1">Message</label>
                        <div class="col-sm-9">
                          <div class="position-relative has-icon-left">
                            <textarea class="form-control" id="inputMessage1" rows="2" placeholder="Simple Textarea"></textarea>
                            <div class="form-control-position pl-1"><i class="la la-commenting-o"></i></div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 mb-1">
                          <button class="btn btn-info float-right" type="button"><i class="la la-paper-plane-o"></i> Send </button>
                        </div>
                      </div>
                    </div>
                  </form>
                </li>
              </ul>
            </li>
            <li class="nav-item nav-search"><a class="nav-link nav-link-search" href="#"><i class="ficon ft-search"></i></a>
              <div class="search-input">
                <input class="input" type="text" placeholder="Explore Modern...">
              </div>
            </li> -->
          </ul>
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-user nav-item">
              <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">{{trans('constants.welcome_title')}},
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
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <!-- Revenue, Hit Rate & Deals -->
        <!-- FOR NEW ORDER NOTIFICATION ALERT -->
        <div class="row">
          <div class="col-md-3">
          </div>
          <div class="col-md-3">
          </div>
          <div class="col-md-6">
             <div class="card" id="notification">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-danger rounded-left">
                            <i class="fa fa-user-circle-o font-small-3 text-white"></i>
                        </div>
                        <div class="py-1 px-2 media-body">
                            <h5 class="danger">New Order Received. To view click <a href="{{url('/')}}/admin/orders/new">Here</a> <a onclick="myFunction()" style="float:right"> x </a></h5>
                           
                        </div>
                    </div>
                </div>
            </div>
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
          </div>
        </div>

      <section id="minimal-statistics-bg">
          <div class="row">
            @if(Session::get('role') == 1)
            <div class="col-xl-3 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-danger rounded-left">
                            <i class="fa fa-user-circle-o font-large-2 text-white"></i>
                        </div>
                        <div class="py-1 px-2 media-body">
                            <h5 class="danger">Total Users</h5>
                            <h5 class="text-bold-400">{{$total_users}}</h5>
                            <div class="progress mt-1 mb-0" style="height: 7px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            @endif
            @if(Session::get('role') == 2)
            <div class="col-xl-3 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-danger rounded-left">
                            <i class="fa fa-shopping-cart font-large-2 text-white"></i>
                        </div>
                        <div class="py-1 px-2 media-body">
                            <h5 class="danger">Total Orders</h5>
                            <h5 class="text-bold-400">{{$total_res_orders}}</h5>
                            <div class="progress mt-1 mb-0" style="height: 7px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            @endif
             @if(Session::get('role') == 1)
            <div class="col-xl-3 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-success rounded-left">
                            <i class="fa fa-motorcycle font-large-2 text-white"></i>
                        </div>
                        <div class="py-1 px-2 media-body">
                            <h5 class="success">Total Delivery Partners</h5>
                            <h5 class="text-bold-400">{{$total_delivery_partners}}</h5>
                            <div class="progress mt-1 mb-0" style="height: 7px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            @endif
             @if(Session::get('role') == 2)
            <div class="col-xl-3 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-success rounded-left">
                            <i class="fa fa-shopping-cart font-large-2 text-white"></i>
                        </div>
                        <div class="py-1 px-2 media-body">
                            <h5 class="success">Today Orders</h5>
                            <h5 class="text-bold-400">{{$today_orders}}</h5>
                            <div class="progress mt-1 mb-0" style="height: 7px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            @endif
            @if(Session::get('role') == 2)
             <div class="col-xl-3 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-info rounded-left">
                             <i class="fa fa-cutlery font-large-2 text-white"></i>
                        </div>
                        <div class="py-1 px-2 media-body">
                            <h5 class="info">Today Restaurant Comission</h5>
                            <h5 class="text-bold-400">{{$today_res_comission}}</h5>
                            <div class="progress mt-1 mb-0" style="height: 7px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            @endif
             @if(Session::get('role') == 1)
            <div class="col-xl-3 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-info rounded-left">
                             <i class="fa fa-cutlery font-large-2 text-white"></i>
                        </div>
                        <div class="py-1 px-2 media-body">
                            <h5 class="info">Total Restaurants</h5>
                            <h5 class="text-bold-400">{{$total_restaurants}}</h5>
                            <div class="progress mt-1 mb-0" style="height: 7px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            @endif
             @if(Session::get('role') == 2)
            <div class="col-xl-3 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-warning rounded-left">
                            <i class="fa fa-money font-large-2 text-white"></i>
                        </div>
                        <div class="py-1 px-2 media-body">
                            <h5 class="warning">Total Restaurant Comission</h5>
                            <h5 class="text-bold-400">{{DEFAULT_CURRENCY_SYMBOL}}{{$total_res_comission}}</h5>
                            <div class="progress mt-1 mb-0" style="height: 7px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            @endif
             @if(Session::get('role') == 1)
            <div class="col-xl-3 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-warning rounded-left">
                            <i class="fa fa-money font-large-2 text-white"></i>
                        </div>
                        <div class="py-1 px-2 media-body">
                            <h5 class="warning">Total Earnings</h5>
                            <h5 class="text-bold-400">{{DEFAULT_CURRENCY_SYMBOL}}{{$total_earnings}}</h5>
                            <div class="progress mt-1 mb-0" style="height: 7px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            @endif
          </div>
        </section>
         <section id="minimal-statistics-bg">
          <div class="row">
             @if(Session::get('role') == 1)
            <div class="col-xl-3 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-danger rounded-left">
                            <i class="fa fa-money font-large-2 text-white"></i>
                        </div>
                        <div class="py-1 px-2 media-body">
                            <h5 class="danger">Total Admin Comission</h5>
                            <h5 class="text-bold-400">{{DEFAULT_CURRENCY_SYMBOL}}{{$total_admin_comission}}</h5>
                            <div class="progress mt-1 mb-0" style="height: 7px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            @endif
             @if(Session::get('role') == 1)
            <div class="col-xl-3 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-success rounded-left">
                            <i class="fa fa-money font-large-2 text-white"></i>
                        </div>
                        <div class="py-1 px-2 media-body">
                            <h5 class="success">Total Restaurant Comission</h5>
                            <h5 class="text-bold-400">{{DEFAULT_CURRENCY_SYMBOL}}{{$total_restaurant_comission}}</h5>
                            <div class="progress mt-1 mb-0" style="height: 7px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            @endif
             @if(Session::get('role') == 1)
            <div class="col-xl-3 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-info rounded-left">
                             <i class="fa fa-money font-large-2 text-white"></i>
                        </div>
                        <div class="py-1 px-2 media-body">
                            <h5 class="info">Total Delivery Boy Comission</h5>
                            <h5 class="text-bold-400">{{DEFAULT_CURRENCY_SYMBOL}}{{$total_delivery_boy_comission}}</h5>
                            <div class="progress mt-1 mb-0" style="height: 7px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            @endif
             @if(Session::get('role') == 1)
            <div class="col-xl-3 col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="media align-items-stretch">
                        <div class="p-2 text-center bg-warning rounded-left">
                            <i class="fa fa-money font-large-2 text-white"></i>
                        </div>
                        <div class="py-1 px-2 media-body">
                            <h5 class="warning">Today Earnings</h5>
                            <h5 class="text-bold-400">{{DEFAULT_CURRENCY_SYMBOL}}{{$today_earnings}}</h5>
                            <div class="progress mt-1 mb-0" style="height: 7px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            @endif
          </div>
        </section>

        <!-- PRODUCTS SALES -->
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Weekly&Monthly Reports</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
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
                    <div id="pie-chart" class="height-400 "></div>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="col-md-8">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">PRODUCTS SALES</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
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
                    <div id="basic-area" class="height-400 echart-container"></div>
                  </div>
                </div>
              </div>
            </div> -->
            <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">RECENT ORDERS</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>

              <div class="card-content">
                <div class="card-body  py-4 px-0">
                  <div class="list-group">
                     @foreach($recent_deliveries as $delivery)
                    <a href="{{url('/')}}/admin/view_order/{{$delivery->id}}" class="list-group-item">
                     
                      <div class="media">
                        <div class="media-left pr-1">
                          <!-- <span class="avatar avatar-sm avatar-online rounded-circle">
                            <img src="{{URL::asset(RESTAURANT_UPLOADS_PATH.SITE_FAVICON)}}" alt="avatar"><i></i></span> -->
                           
                        </div>
                        <div class="media-body">
                           <p>{{$delivery->order_id}}</p>
                          <h6 class="media-heading mb-0">{{$delivery->name}}
                            <span class="amount-right">{{DEFAULT_CURRENCY_SYMBOL}}{{$delivery->bill_amount}}</span></h6>
                          
                         <span class="badge badge-success"> <span class="badge badge-success">@php

                            switch ((int) $delivery->status) {
                              case 0:
                                echo 'New Order';
                              break;
                              case 1:
                                echo 'Order Accepted';
                              break;
                              case 2:
                                echo 'Delivery boy assigned';
                              break;
                              case 3:
                                echo 'Food delivered to Delivery boy';
                              break;
                              case 4:
                                echo 'Towards Customer';
                              break;
                              case 5:
                                echo 'Reached Customer';
                              break;
                              case 6:
                                echo 'Delivered to Customer';
                              break;
                              case 7:
                                echo 'Completed';
                              break;
                              
                              default:
                                echo ' Cancelled';
                                break;
                            }
                            @endphp</span></span>
                        </div>
                      </div>
                      
                    </a>
                    @endforeach                     
                    
                  </div>
                </div>
              </div>
                </div>
                
              </div>
            </div>
          </div>


            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">PRODUCTS SALES</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
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
                    <div id="basic-area" class="height-400 echart-container"></div>
                  </div>
                </div>
              </div>
            </div>


      </div>
    </div>
  </div>
  
   <script src="{{URL::asset('public/app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
   <script src="{{URL::asset('public/app-assets/js/scripts/pages/chat-application.min.js')}}"></script>

  <script src="{{URL::asset('public/app-assets/vendors/js/tables/datatable/datatables.min.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('public/app-assets/js/core/app-menu.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('public/app-assets/js/core/app.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/customizer.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/dropdowns/dropdowns.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/tables/datatables/datatable-basic.js')}}"
  type="text/javascript"></script>
  <script src="{{URL::asset('public/app-assets/vendors/js/forms/icheck/icheck.min.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('public/app-assets/vendors/js/forms/toggle/switchery.min.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('public/app-assets/vendors/js/forms/icheck/icheck.min.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('public/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js')}}"
  type="text/javascript"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/tables/components/table-components.js')}}"
  type="text/javascript"></script>


   <script src="{{URL::asset('public/app-assets/vendors/js/charts/d3.min.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('public/app-assets/vendors/js/charts/c3.min.js')}}" type="text/javascript"></script>
  
  <script src="{{URL::asset('public/app-assets/js/scripts/charts/c3/bar-pie/bar.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/charts/c3/bar-pie/column.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/charts/c3/bar-pie/donut.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/charts/c3/bar-pie/pie.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/charts/c3/bar-pie/stacked-bar.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('public/app-assets/js/scripts/charts/c3/bar-pie/stacked-column.js')}}"
  type="text/javascript"></script>

 <script src="{{URL::asset('public/app-assets/vendors/js/charts/echarts/echarts.js')}}" type="text/javascript"></script>
   <script src="{{URL::asset('public/app-assets/vendors/js/charts/echarts/chart/line.js')}}" type="text/javascript"></script>
   <script src="{{URL::asset('public/app-assets/vendors/js/charts/echarts/chart/bar.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('public/app-assets/js/scripts/charts/echarts/line-area/basic-area.js')}}"
  type="text/javascript"></script>

  <!--FOR NEW ORDER NOTIFICATION ALERT  -->
<script type="text/javascript">

document.getElementById('notification').hidden = true;
document.getElementById('chat_notification').hidden = true;

function myFunction() {
  document.getElementById('notification').hidden = true;
  document.getElementById('chat_notification').hidden = true;
  play_wav();
}

var isStop = false;
var myaudio = document.getElementById("myAudio"); 
var refreshIntervalId;

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
</script>
 <!--FOR NEW ORDER NOTIFICATION ALERT ENDS -->
 <script language = "javascript" type = "text/javascript">
    
    websocket.onmessage = function(evt) {
        onMessage(evt)
    };


function onMessage(evt) {
  var data = JSON.parse(evt.data);
  isStop = false;
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
                    document.querySelector('audio').play();
                      // myaudio.play(); 
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
        }catch(error) {
            
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
  </script>
 
  <script type="text/javascript">
  $(window).on("load", function(){

    // Callback that creates and populates a data table, instantiates the pie chart, passes in the data and draws it.
    var pieChart = c3.generate({
        bindto: '#pie-chart',
        color: {
            pattern: ['#ff847c','#ff4961','#91ca8f', '#ce9160']
        },

        data: {
            // iris data from R
            columns: [
               
            ],
            type : 'pie',
            onclick: function (d, i) { console.log("onclick", d, i); },
            onmouseover: function (d, i) { console.log("onmouseover", d, i); },
            onmouseout: function (d, i) { console.log("onmouseout", d, i); }
        }
    });

    // Instantiate and draw our chart, passing in some options.
    setTimeout(function () {
        pieChart.load({
            columns: [
                ["Current Week Earnings", {{$current_week}}],
                ["Current Month Earnings", {{$current_month}}],
                ["Last Week Earnings", {{$last_week}}],
                ["Last Month Earnings", {{$last_month}}],
            ]
        });
    }, 1500);

   
    $(".menu-toggle").on('click', function() {
        pieChart.resize();
    });


    var pieChart1 = c3.generate({
        bindto: '#pie-chart1',
        color: {
            pattern: ['#91ca8f','#ce9160']
        },

        data: {
            // iris data from R
            columns: [
               
            ],
            type : 'pie',
            onclick: function (d, i) { console.log("onclick", d, i); },
            onmouseover: function (d, i) { console.log("onmouseover", d, i); },
            onmouseout: function (d, i) { console.log("onmouseout", d, i); }
        }
    });

    // Instantiate and draw our chart, passing in some options.
    setTimeout(function () {
        pieChart1.load({
            columns: [
                ["Last Year Earnings", ],
                ["Current Year Earnings", ],
               
            ]
        });
    }, 1500);

   
    $(".menu-toggle").on('click', function() {
        pieChart1.resize();
    });
});
</script>


 @if(Session::get('role') == 1)
<script type="text/javascript">
  
  $(window).on("load", function(){

    // Set paths
    // ------------------------------

    require.config({
        paths: {
            echarts: '../../../app-assets/vendors/js/charts/echarts'
        }
    });


    // Configuration
    // ------------------------------

    require(
        [
            'echarts',
            'echarts/chart/bar',
            'echarts/chart/line'
        ],


        // Charts setup
        function (ec) {
            // Initialize chart
            // ------------------------------
            var myChart = ec.init(document.getElementById('basic-area'));

            // Chart Options
            // ------------------------------
            chartOptions = {

                // Setup grid
                grid: {
                    x: 40,
                    x2: 20,
                    y: 35,
                    y2: 25
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis'
                },

                // Add legend
                legend: {
                    data: ['Admin Comission', 'Restaurant Comission', 'DeliveryBoy Comission']
                },

                // Add custom colors
                color: ['#FF4961', '#40C7CA', '#FF9149'],

                // Enable drag recalculate
                calculable: true,

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    boundaryGap: false,
                    data: [
                        'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'
                    ]
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value'
                }],

                // Add series
                series: [
                    {
                        name: 'Admin Comission',
                        type: 'line',
                        smooth: true,
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: [{{$admin_earnings}}]
                    },
                    {
                        name: 'Restaurant Comission',
                        type: 'line',
                        smooth: true,
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: [{{$restaurant_earnings}}]
                    },
                    {
                        name: 'DeliveryBoy Comission',
                        type: 'line',
                        smooth: true,
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: [{{$delivery_boy_earnings}}]
                    }
                ]
            };

            // Apply options
            // ------------------------------

            myChart.setOption(chartOptions);

            // Resize chart
            // ------------------------------

            $(function () {

                // Resize chart on menu width change and window resize
                $(window).on('resize', resize);
                $(".menu-toggle").on('click', resize);

                // Resize function
                function resize() {
                    setTimeout(function() {

                        // Resize chart
                        myChart.resize();
                    }, 200);
                }
            });
        }
    );
});
</script>
@endif

 @if(Session::get('role') == 2)
<script type="text/javascript">
  
  $(window).on("load", function(){

    // Set paths
    // ------------------------------

    require.config({
        paths: {
            echarts: '../../../app-assets/vendors/js/charts/echarts'
        }
    });


    // Configuration
    // ------------------------------

    require(
        [
            'echarts',
            'echarts/chart/bar',
            'echarts/chart/line'
        ],


        // Charts setup
        function (ec) {
            // Initialize chart
            // ------------------------------
            var myChart = ec.init(document.getElementById('basic-area'));

            // Chart Options
            // ------------------------------
            chartOptions = {

                // Setup grid
                grid: {
                    x: 40,
                    x2: 20,
                    y: 35,
                    y2: 25
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis'
                },

                // Add legend
                legend: {
                    data: ['Admin Comission', 'Restaurant Comission', 'DeliveryBoy Comission']
                },

                // Add custom colors
                color: ['#FF4961', '#40C7CA', '#FF9149'],

                // Enable drag recalculate
                calculable: true,

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    boundaryGap: false,
                    data: [
                        'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'
                    ]
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value'
                }],

                // Add series
                series: [
                    {
                        name: 'Admin Comission',
                        type: 'line',
                        smooth: true,
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: [{{$res_admin_earnings}}]
                    },
                    {
                        name: 'Restaurant Comission',
                        type: 'line',
                        smooth: true,
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: [{{$res_restaurant_earnings}}]
                    },
                    {
                        name: 'DeliveryBoy Comission',
                        type: 'line',
                        smooth: true,
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: [{{$res_delivery_boy_earnings}}]
                    }
                ]
            };

            // Apply options
            // ------------------------------

            myChart.setOption(chartOptions);

            // Resize chart
            // ------------------------------

            $(function () {

                // Resize chart on menu width change and window resize
                $(window).on('resize', resize);
                $(".menu-toggle").on('click', resize);

                // Resize function
                function resize() {
                    setTimeout(function() {

                        // Resize chart
                        myChart.resize();
                    }, 200);
                }
            });
        }
    );
});


</script>
@endif
