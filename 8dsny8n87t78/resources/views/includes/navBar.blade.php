   <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                <li class="navigation-header"><span>General</span><i data-toggle="tooltip" data-placement="right" data-original-title="General" class=" ft-minus"></i>
                </li>
                @if(Session::get('role') != 2)
                    <li {{{ (Request::is('admin/dashboard') ? 'class=active' : '') }}} class="nav-item" 
                        @if(auth()->user()->role==3 && empty(auth()->user()->AccessPrivilages->dashboard)) style="display:none" @endif
                        >
                        <a href="{{URL('/')}}/admin/dashboard"><i class="ft-home"></i><span data-i18n="" class="menu-title">Super Admin Dashboard</span></a>
                    </li>
                    <li {{{ (Request::is('admin/availability_map') ? 'class=active' : '') }}}
                        @if(auth()->user()->role==3 && empty(auth()->user()->AccessPrivilages->availability_map)) style="display:none" @endif
                        >
                        <a href="{{URL('/')}}/admin/availability_map" class="menu-item">Availability Map</a>
                    </li>
                @endif
                @if(Session::get('role') == 2)
                <li {{{ (Request::is('admin/dashboard') ? 'class=active' : '') }}} class="nav-item" >
                    <a href="{{URL('/')}}/admin/dashboard"><i class="ft-home"></i><span data-i18n="" class="menu-title">Restaurant Dashboard</span></a>
                </li>
                <!-- <li class=" nav-item">
                    <a href="{{URL('/')}}/admin/dispatcher"><i class="ft-monitor"></i><span data-i18n="" class="menu-title">Dispatcher</span></a>
                </li> -->
                @endif
                
                <li {{{ (Request::is('admin/order_dashboard') ? 'class=active' : '') }}}
                    {{{ (Request::is('admin/orders/new') ? 'class=active' : '') }}} {{{ (Request::is('admin/orders/availability_map') ? 'class=active' : '') }}}
                    {{{ (Request::is('admin/orders/processing') ? 'class=active' : '') }}} {{{ (Request::is('admin/orders/pickup') ? 'class=active' : '') }}}{{{ (Request::is('admin/orders/delivered') ? 'class=active' : '') }}}{{{ (Request::is('admin/orders/cancelled') ? 'class=active' : '') }}} {{{ (Request::is('admin/pickup-orders') ? 'class=active' : '') }}} {{{ (Request::is('admin/dining-orders') ? 'class=active' : '') }}} class="nav-item has-sub"
                    @if(isset(auth()->user()->role) && auth()->user()->role==3 && isset(auth()->user()->AccessPrivilages->order_management) && empty(auth()->user()->AccessPrivilages->order_management)) style="display:none" @endif >
                    <a href="#"><i class="ft-menu"></i><span data-i18n="" class="menu-title">{{trans('constants.order_mng')}}</span></a>
                    @php 
                        if(isset(auth()->user()->AccessPrivilages->order_management)) 
                            $orderAccess = explode(",",auth()->user()->AccessPrivilages->order_management);
                        else 
                            $orderAccess = array(); 
                    @endphp
                    <ul class="menu-content">
                        <li {{{ (Request::is('admin/order_dashboard') ? 'class=active' : '') }}} @if(isset(auth()->user()->role) && auth()->user()->role==3 && !in_array(1,(array)$orderAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/order_dashboard" class="menu-item">{{trans('constants.order')}} {{trans('constants.dashboard')}}</a></li>
                        <li {{{ (Request::is('admin/orders/new') ? 'class=active' : '') }}} @if(isset(auth()->user()->role) && auth()->user()->role==3 && !in_array(2,(array)$orderAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/orders/new" class="menu-item">{{trans('constants.new')}} {{trans('constants.order')}}</a><span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow" id="new_order"></span></li>
                        <li {{{ (Request::is('admin/orders/processing') ? 'class=active' : '') }}} @if(isset(auth()->user()->role) && auth()->user()->role==3 && !in_array(3,(array)$orderAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/orders/processing" class="menu-item">{{trans('constants.process')}} {{trans('constants.order')}}</a><span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow" id="processing_order"></span></li>
                        <li {{{ (Request::is('admin/orders/pickup') ? 'class=active' : '') }}} @if(isset(auth()->user()->role) && auth()->user()->role==3 && !in_array(4,(array)$orderAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/orders/pickup" class="menu-item"> {{trans('constants.order')}} {{trans('constants.pickup')}}</a><span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow" id="order_pickup"></span></li>
                        <li {{{ (Request::is('admin/orders/delivered') ? 'class=active' : '') }}} @if(isset(auth()->user()->role) && auth()->user()->role==3 && !in_array(5,(array)$orderAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/orders/delivered" class="menu-item"> {{trans('constants.delivered')}} {{trans('constants.order')}}</a><span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow" id="deliverd_order"></span></li>
                        <li {{{ (Request::is('admin/orders/cancelled') ? 'class=active' : '') }}} @if(isset(auth()->user()->role) && auth()->user()->role==3 && !in_array(6,(array)$orderAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/orders/cancelled" class="menu-item"> {{trans('constants.cancelled')}} {{trans('constants.order')}}</a><span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow" id="cancelled_order"></span></li>
                        <li {{{ (Request::is('admin/pickup-orders') ? 'class=active' : '') }}} @if(isset(auth()->user()->role) && auth()->user()->role==3 && !in_array(7,(array)$orderAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/pickup-orders" class="menu-item"> {{trans('constants.pickup')}} {{trans('constants.order')}}</a><span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow" id="pickup_order"></span></li>
                        <li {{{ (Request::is('admin/dining-orders') ? 'class=active' : '') }}} @if(isset(auth()->user()->role) && auth()->user()->role==3 && !in_array(8,(array)$orderAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/dining-orders" class="menu-item"> {{trans('constants.dining')}} {{trans('constants.order')}}</a><span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow" id="dining_order"></span></li>
                    </ul>
                </li>

                 @if(Session::get('role') != 2)
                
               <!--  <li class="nav-item   has-open has-sub">
                    <a href="#">
                        <i class="ft-user"></i>
                        <span data-i18n="" class="menu-title">Dispute</span>  
                    </a>
                    <ul class="menu-content">
                        <li><a href="{{URL('/')}}/admin/dispatcher" class="menu-item">User Disputes</a></li>
                        <li><a href="{{URL('/')}}/admin/dispatcher" class="menu-item">DB Disputes</a></li>
                        <li><a href="{{URL('/')}}/admin/dispatcher" class="menu-item">Restaurant Disputes</a></li>
                        <li><a href="{{URL('/')}}/admin/dispatcher" class="menu-item">Common Dispute Message</a></li>
                        
                    </ul>
                </li> -->
                
                <li {{{ (Request::is('admin/restaurant_list') ? 'class=active' : '') }}}
                    {{{ (Request::is('admin/add_restaurant') ? 'class=active' : '') }}} class="nav-item has-sub" @if(auth()->user()->role==3 && empty(auth()->user()->AccessPrivilages->restaurant)) style="display:none" @endif><a href="#"><i class="fa fa-coffee"></i><span data-i18n="" class="menu-title">Restaurant</span></a>
                    <ul class="menu-content">
                        @php $restaurantAccess = explode(",",auth()->user()->AccessPrivilages->restaurant); @endphp
                        <li {{{ (Request::is('admin/restaurant_list') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(1,(array)$restaurantAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/restaurant_list" class="menu-item">Restaurant List</a></li>
                        <li {{{ (Request::is('admin/add_restaurant') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(2,(array)$restaurantAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/add_restaurant" class="menu-item">Add Restaurant</a></li>
                    </ul>
                </li>
                <li {{{ (Request::is('admin/city_list') ? 'class=active' : '') }}}
                    {{{ (Request::is('admin/add_city') ? 'class=active' : '') }}} 
                    {{{ (Request::is('admin/country_list') ? 'class=active' : '') }}}{{{ (Request::is('admin/state_list') ? 'class=active' : '') }}}class="nav-item has-sub" @if(auth()->user()->role==3 && empty(auth()->user()->AccessPrivilages->city_management)) style="display:none" @endif><a href="#"><i class="ft-users"></i><span data-i18n="" class="menu-title">City Management</span></a>
                    <ul class="menu-content">
                        @php $cityAccess = explode(",",auth()->user()->AccessPrivilages->city_management); @endphp
                        <!-- <li><a href="#" class="menu-item">City Dashboard</a></li> -->
                        <li {{{ (Request::is('admin/city_list') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(1,(array)$cityAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/city_list" class="menu-item">City List</a></li>
                            
                        <li {{{ (Request::is('admin/add_city') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(2,(array)$cityAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/add_city" class="menu-item">Add City</a></li>

                        <li {{{ (Request::is('admin/country_list') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(7,(array)$cityAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/country_list" class="menu-item">{{ trans('constants.country') }} {{ trans('constants.list') }}</a></li>

                        <li {{{ (Request::is('admin/state_list') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(11,(array)$cityAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/state_list" class="menu-item">{{ trans('constants.state') }} {{ trans('constants.list') }}</a></li>
                    </ul>
                </li>
                <li {{{ (Request::is('admin/product_list') ? 'class=active' : '') }}} class="nav-item has-sub" @if(auth()->user()->role==3 && empty(auth()->user()->AccessPrivilages->food_management)) style="display:none" @endif><a href="#"><i class="fa fa-cubes"></i><span data-i18n="" class="menu-title">Food Management</span></a>
                    <ul class="menu-content">
                    @php $foodAccess = explode(",",auth()->user()->AccessPrivilages->food_management); @endphp
                        <li {{{ (Request::is('admin/product_list') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(1,(array)$foodAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/product_list" class="menu-item">Food List</a></li>
                        <li {{{ (Request::is('admin/add_product') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(2,(array)$foodAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/add_product" class="menu-item">Add Food</a></li>
                    </ul>
                </li>
                <!-- <li {{{ (Request::is('admin/vehicle_list') ? 'class=active' : '') }}}
                    {{{ (Request::is('admin/add_vehicle') ? 'class=active' : '') }}} class="nav-item has-sub"><a href="#"><i class="ft-wind"></i><span data-i18n="" class="menu-title">Vehicle Management</span></a>
                    <ul class="menu-content">
                       
                        <li {{{ (Request::is('admin/vehicle_list') ? 'class=active' : '') }}}><a href="{{URL('/')}}/admin/vehicle_list" class="menu-item">Vehicle List</a></li>
                            
                        <li {{{ (Request::is('admin/add_vehicle') ? 'class=active' : '') }}}><a href="{{URL('/')}}/admin/add_vehicle" class="menu-item">Add Vehicle</a></li>
                    </ul>
                </li> -->
                <li {{{ (Request::is('admin/driver_list') ? 'class=active' : '') }}}
                    {{{ (Request::is('admin/deliverypeople_list') ? 'class=active' : '') }}}{{{ (Request::is('admin/add_new_driver') ? 'class=active' : '') }}} class="nav-item has-sub" @if(auth()->user()->role==3 && empty(auth()->user()->AccessPrivilages->driver_management)) style="display:none" @endif><a href="#"><i class="fa fa-truck"></i><span data-i18n="" class="menu-title">Driver Management</span></a>
                    <ul class="menu-content">
                        @php $driverAccess = explode(",",auth()->user()->AccessPrivilages->driver_management); @endphp
                        <li {{{ (Request::is('admin/driver_list') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(1,(array)$driverAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/driver_list" class="menu-item"> Delivery People List</a></li>
                       
                        <!-- <li {{{ (Request::is('admin/deliverypeople_list') ? 'class=active' : '') }}}><a href="{{URL('/')}}/admin/deliverypeople_list" class="menu-item">New Driver</a></li> -->
                            
                        <li {{{ (Request::is('admin/add_new_driver') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(2,(array)$driverAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/add_new_driver" class="menu-item">Add Delivery People</a></li>
                    </ul>
                </li>
                <li {{{ (Request::is('admin/document_list') ? 'class=active' : '') }}}
                    {{{ (Request::is('admin/add_document') ? 'class=active' : '') }}} class="nav-item has-sub" @if(auth()->user()->role==3 && empty(auth()->user()->AccessPrivilages->document)) style="display:none" @endif><a href="#"><i class="ft-book"></i><span data-i18n="" class="menu-title">Document Management</span></a>
                    <ul class="menu-content">
                       @php $documentAccess = explode(",",auth()->user()->AccessPrivilages->document); @endphp
                        <li {{{ (Request::is('admin/document_list') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(1,(array)$documentAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/document_list" class="menu-item">Document List</a></li>
                            
                        <li {{{ (Request::is('admin/add_document') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(2,(array)$documentAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/add_document" class="menu-item">Add Document</a></li>
                    </ul>
                </li>
                 <!-- <li class="nav-item has-sub"><a href="#"><i class="fa fa-gift"></i><span data-i18n="" class="menu-title">Coupon Management</span></a>
                    <ul class="menu-content">
                       
                        <li><a href="{{URL('/')}}/admin/coupon_list" class="menu-item">Coupon List</a></li>
                            
                        <li><a href="{{URL('/')}}/admin/add_coupon" class="menu-item">Add Coupon</a></li>
                    </ul>
                </li> -->
                 <li {{{ (Request::is('admin/reason_list') ? 'class=active' : '') }}}
                     {{{ (Request::is('admin/cancellation_reason_list') ? 'class=active' : '') }}} class="nav-item has-sub" @if(auth()->user()->role==3 && empty(auth()->user()->AccessPrivilages->cancel_reason)) style="display:none" @endif><a href="#"><i class="ft-delete"></i><span data-i18n="" class="menu-title">Cancellation Reasons</span></a>
                    <ul class="menu-content">
                        @php $cancelAccess = explode(",",auth()->user()->AccessPrivilages->cancel_reason); @endphp
                        <li {{{ (Request::is('admin/reason_list') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(1,(array)$cancelAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/reason_list" class="menu-item">Reason List</a></li>
                        <li {{{ (Request::is('admin/cancellation_reason_list') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(2,(array)$cancelAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/cancellation_reason_list" class="menu-item">Add Reasons</a></li>
                    </ul>
                </li>
                <!-- <li class="nav-item has-sub"><a href="#"><i class="ft-user-check"></i><span data-i18n="" class="menu-title">Delivery People</span></a>
                    <ul class="menu-content">
                        <li><a href="{{URL('/')}}/admin/deliverypeople_list" class="menu-item">Delivery People List</a></li>
                        <li><a href="{{URL('/')}}/admin/add_deliverypeople" class="menu-item">Add Delivery People</a></li>
                        <li><a href="{{URL('/')}}/admin/shift_delivery" class="menu-item">Shift Details</a></li>
                    </ul>
                </li> -->
                @if(Session::get('role') == 1)
                    <li {{{ (Request::is('admin/disp_managerlist') ? 'class=active' : '') }}}
                        {{{ (Request::is('admin/add_dispmanager') ? 'class=active' : '') }}}
                         class="nav-item has-sub"><a href="#"><i class="ft-user"></i><span data-i18n="" class="menu-title">Sub Admin Management</span></a>
                        <ul class="menu-content">
                            <li {{{ (Request::is('admin/disp_managerlist') ? 'class=active' : '') }}}><a href="{{URL('/')}}/admin/disp_managerlist" class="menu-item">Sub Admin List</a></li>
                            <li {{{ (Request::is('admin/add_dispmanager') ? 'class=active' : '') }}}><a href="{{URL('/')}}/admin/add_dispmanager" class="menu-item">Add Sub Admin</a></li>
                        </ul>
                    </li>
                @endif
                  
                <li {{{ (Request::is('admin/promocodes_list') ? 'class=active' : '') }}}
                    {{{ (Request::is('admin/add_promocode') ? 'class=active' : '') }}}
                    {{{ (Request::is('admin/custumpush') ? 'class=active' : '') }}} class="nav-item has-sub" @if(auth()->user()->role==3 && empty(auth()->user()->AccessPrivilages->promocode)) style="display:none" @endif><a href="#"><i class="ft-book"></i><span data-i18n="" class="menu-title">Promocodes</span></a>
                    <ul class="menu-content">
                        @php $promoAccess = explode(",",auth()->user()->AccessPrivilages->promocode); @endphp
                        <li {{{ (Request::is('admin/promocodes_list') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(1,(array)$promoAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/promocodes_list" class="menu-item">Promocodes List</a></li>
                        <li {{{ (Request::is('admin/add_promocode') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(2,(array)$promoAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/add_promocode" class="menu-item">Add Promocodes</a></li>
                        <li {{{ (Request::is('admin/custumpush') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(5,(array)$promoAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/custumpush" class="menu-item">{{ trans('constants.custom_push') }}</a></li>
                    </ul>
                </li>
                 <li {{{ (Request::is('admin/banner_list') ? 'class=active' : '') }}}{{{ (Request::is('admin/add_banner') ? 'class=active' : '') }}} class="nav-item has-sub" @if(auth()->user()->role==3 && empty(auth()->user()->AccessPrivilages->banner)) style="display:none" @endif><a href="#"><i class="ft-camera"></i><span data-i18n="" class="menu-title">Resturant Banner</span></a>
                    <ul class="menu-content">
                        @php $bannerAccess = explode(",",auth()->user()->AccessPrivilages->banner); @endphp
                        <li {{{ (Request::is('admin/banner_list') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(1,(array)$bannerAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/banner_list" class="menu-item">Resturant Banner List</a></li>
                        <li {{{ (Request::is('admin/add_banner') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(2,(array)$bannerAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/add_banner" class="menu-item">Add Resturant Banner</a></li>
                    </ul>
                </li>
                <li {{{ (Request::is('admin/popular_brand_list') ? 'class=active' : '') }}}{{{ (Request::is('admin/add_popular_brand') ? 'class=active' : '') }}} class="nav-item has-sub" @if(auth()->user()->role==3 && empty(auth()->user()->AccessPrivilages->popular_brands)) style="display:none" @endif><a href="#"><i class="ft-camera"></i><span data-i18n="" class="menu-title">Popular Brand</span></a>
                    <ul class="menu-content">
                        @php $popularAccess = explode(",",auth()->user()->AccessPrivilages->popular_brands); @endphp
                        <li {{{ (Request::is('admin/popular_brand_list') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(1,(array)$popularAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/popular_brand_list" class="menu-item">Popular Brand List</a></li>
                        <li {{{ (Request::is('admin/add_popular_brand') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(2,(array)$popularAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/add_popular_brand" class="menu-item">Add Popular Brand</a></li>
                    </ul>
                </li>
                <!-- <li class="nav-item has-sub"><a href="#"><i class="ft-book"></i><span data-i18n="" class="menu-title">Notice Board</span></a>
                    <ul class="menu-content">
                        <li><a href="{{URL('/')}}/admin/noticeboard_list" class="menu-item">Notice Board List</a></li>
                        <li><a href="{{URL('/')}}/admin/add_noticeboard" class="menu-item">Add Notice Board</a></li>
                        <li><a href="{{URL('/')}}/admin/custumpush" class="menu-item">Custom Push</a></li>
                    </ul>
                </li> -->
                <li {{{ (Request::is('admin/user_list') ? 'class=active' : '') }}}{{{ (Request::is('admin/user_credit') ? 'class=active' : '') }}} class="nav-item has-sub" @if(auth()->user()->role==3 && empty(auth()->user()->AccessPrivilages->users)) style="display:none" @endif>
                    <a href="#"><i class="ft-users"></i><span data-i18n="" class="menu-title">{{trans('constants.user')}} {{trans('constants.manage')}}</span></a>
                    <ul class="menu-content">
                        <li {{{ (Request::is('admin/user_list') ? 'class=active' : '') }}}><a href="{{URL('/')}}/admin/user_list" class="menu-item">{{trans('constants.user')}} {{trans('constants.list')}}</a></li>
                        <li {{{ (Request::is('admin/user_credit') ? 'class=active' : '') }}}><a href="{{URL('/')}}/admin/user_credit" class="menu-item">{{trans('constants.user')}} Credit</a></li>
                    </ul>
                </li>
          
              <!--   <li class="nav-item">
                    <a href="{{URL('/')}}/admin/deliveries"><i class="ft-message-square"></i><span data-i18n="" class="menu-title">Deliveries</span></a>
                </li>
               
                <li class=" nav-item">
                    <a href=" "><i class="ft-minimize-2"></i><span data-i18n="" class="menu-title">Translation</span></a>
                </li> -->

                 <li  {{{ (Request::is('admin/cuisines_list') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && empty(auth()->user()->AccessPrivilages->cuisines)) style="display:none" @endif>
                    <a href="{{URL('/')}}/admin/cuisines_list"><i class="ft-book"></i><span data-i18n="" class="menu-title">Cuisines List</span></a>
                </li>

                <li {{{ (Request::is('admin/addons_list') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && empty(auth()->user()->AccessPrivilages->addons)) style="display:none" @endif>
                    <a href="{{URL('/')}}/admin/addons_list"><i class="ft-user-check"></i><span data-i18n="" class="menu-title">{{trans('constants.addon')}} {{trans('constants.list')}}</span></a></li>
                </li>
                <li {{{ (Request::is('admin/payout/restaurant') ? 'class=active' : '') }}} {{{ (Request::is('admin/payout/driver') ? 'class=active' : '') }}}
                {{{ (Request::is('admin/payout_history/restaurant') ? 'class=active' : '') }}} {{{ (Request::is('admin/payout_history/driver') ? 'class=active' : '') }}} class="nav-item has-sub" @if(auth()->user()->role==3 && empty(auth()->user()->AccessPrivilages->payouts)) style="display:none" @endif><a href="#"><i class="ft-book"></i><span data-i18n="" class="menu-title">{{trans('constants.payout')}}</span></a>
                    <ul class="menu-content">
                    @php $payoutAccess = explode(",",auth()->user()->AccessPrivilages->payouts); @endphp
                      <li {{{ (Request::is('admin/payout/restaurant') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(1,(array)$payoutAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/payout/restaurant" class="menu-item">{{trans('constants.restaurant')}} {{trans('constants.payout')}} </a></li>    
                      <li {{{ (Request::is('admin/payout/driver') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(3,(array)$payoutAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/payout/driver" class="menu-item">{{trans('constants.driver')}} {{trans('constants.payout')}} </a></li>   
                      <li {{{ (Request::is('admin/payout_history/restaurant') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(5,(array)$payoutAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/payout_history/restaurant" class="menu-item">{{trans('constants.restaurant')}} {{trans('constants.transaction_history')}} </a></li>    
                      <li {{{ (Request::is('admin/payout_history/driver') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(6,(array)$payoutAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/payout_history/driver" class="menu-item">{{trans('constants.driver')}} {{trans('constants.transaction_history')}} </a></li>                    
                    </ul>
               </li>
                <li {{{ (Request::is('admin/food-quantity-list') ? 'class=active' : '') }}} {{{ (Request::is('admin/add-food-quantity') ? 'class=active' : '') }}} class="nav-item has-sub" @if(auth()->user()->role==3 && empty(auth()->user()->AccessPrivilages->food_quantity)) style="display:none" @endif><a href="#"><i class="ft-user-check"></i><span data-i18n="" class="menu-title">{{trans('constants.food_qty')}}</span></a>
                    <ul class="menu-content">
                        @php $qtyAccess = explode(",",auth()->user()->AccessPrivilages->food_quantity); @endphp
                        <li {{{ (Request::is('admin/food-quantity-list') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(1,(array)$qtyAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/food-quantity-list" class="menu-item">{{trans('constants.food_qty')}} {{trans('constants.list')}} </a></li>
                        <li {{{ (Request::is('admin/add-food-quantity') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(2,(array)$qtyAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/add-food-quantity" class="menu-item">{{trans('constants.add')}} {{trans('constants.food_qty')}}</a></li>
                    </ul>
                </li>

                <li {{{ (Request::is('admin/category_list') ? 'class=active' : '') }}} {{{ (Request::is('admin/add_category') ? 'class=active' : '') }}} class="nav-item has-sub" @if(auth()->user()->role==3 && empty(auth()->user()->AccessPrivilages->category)) style="display:none" @endif><a href="#"><i class="ft-file"></i><span data-i18n="" class="menu-title">Category</span></a>
                    <ul class="menu-content">
                        @php $categoryAccess = explode(",",auth()->user()->AccessPrivilages->category); @endphp
                        <li {{{ (Request::is('admin/category_list') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(1,(array)$categoryAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/category_list" class="menu-item">Category List</a></li>
                        <li {{{ (Request::is('admin/add_category') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(2,(array)$categoryAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/add_category" class="menu-item">Add Category</a></li>
                    </ul>
                </li>
                <li {{{ (Request::is('admin/restaurant_menu') ? 'class=active' : '') }}} class="nav-item" @if(auth()->user()->role==3 && empty(auth()->user()->AccessPrivilages->menu)) style="display:none" @endif>
                    <a href="{{URL('/')}}/admin/restaurant_menu"><i class="ft-book"></i><span data-i18n="" class="menu-title">Menu List</span></a>
                </li>
                @endif
                 @if(Session::get('role') == 2)
                 <li {{{ (Request::is('admin/restaurant_cuisines') ? 'class=active' : '') }}} class="nav-item">
                    <a href="{{URL('/')}}/admin/restaurant_cuisines"><i class="ft-book"></i><span data-i18n="" class="menu-title">Cuisines List</span></a>
                </li>

                <li {{{ (Request::is('admin/restaurant_menu') ? 'class=active' : '') }}} class="nav-item">
                    <a href="{{URL('/')}}/admin/restaurant_menu"><i class="ft-book"></i><span data-i18n="" class="menu-title">Menu List</span></a>
                </li>
                <li {{{ (Request::is('admin/addons_list') ? 'class=active' : '') }}} {{{ (Request::is('admin/add_addons') ? 'class=active' : '') }}} class="nav-item has-sub"><a href="#"><i class="ft-user-check"></i><span data-i18n="" class="menu-title">Addons</span></a>
                    <ul class="menu-content">
                        <li {{{ (Request::is('admin/addons_list') ? 'class=active' : '') }}}><a href="{{URL('/')}}/admin/addons_list" class="menu-item">{{trans('constants.addon')}} {{trans('constants.list')}}</a></li>
                        <li {{{ (Request::is('admin/add_addons') ? 'class=active' : '') }}}><a href="{{URL('/')}}/admin/add_addons" class="menu-item">{{trans('constants.add')}} {{trans('constants.addon')}}</a></li>
                    </ul>
                </li>
                <li {{{ (Request::is('admin/product_list') ? 'class=active' : '') }}} {{{ (Request::is('admin/add_product') ? 'class=active' : '') }}}class="nav-item has-sub"><a href="#"><i class="ft-search"></i><span data-i18n="" class="menu-title">Product</span></a>
                    <ul class="menu-content">
                        <li {{{ (Request::is('admin/product_list') ? 'class=active' : '') }}}><a href="{{URL('/')}}/admin/product_list" class="menu-item">Product List</a></li>
                        <li {{{ (Request::is('admin/add_product') ? 'class=active' : '') }}}><a href="{{URL('/')}}/admin/add_product" class="menu-item">Add Product</a></li>
                    </ul>
                </li>
                @endif

             

                 <!-- <li class=" nav-item">
                    <a href="{{URL('/')}}/admin/neworder_list"><i class="ft-menu"></i><span data-i18n="" class="menu-title">New Order List</span></a>
                </li> -->
                @if(Session::get('role') != 2)
                <li {{{ (Request::is('admin/page/about-us') ? 'class=active' : '') }}} {{{ (Request::is('admin/page/faq') ? 'class=active' : '') }}} {{{ (Request::is('admin/page/help') ? 'class=active' : '') }}} class="nav-item has-sub" @if(auth()->user()->role==3 && empty(auth()->user()->AccessPrivilages->cms)) style="display:none" @endif><a href="#"><i class="ft-book"></i><span data-i18n="" class="menu-title">CMS Management</span></a>
                    <ul class="menu-content">
                        @php $cmsAccess = explode(",",auth()->user()->AccessPrivilages->cms); @endphp
                        <li {{{ (Request::is('admin/page/about-us') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(1,(array)$cmsAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/page/about-us" class="menu-item">About us</a></li>
                        <li {{{ (Request::is('admin/page/faq') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(2,(array)$cmsAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/page/faq" class="menu-item">FAQ</a></li>
                        <!-- <li><a href=" " class="menu-item">Privacy</a></li>
                        <li><a href=" " class="menu-item">Contact Us</a></li>
                        <li><a href=" " class="menu-item">Terms and Condition</a></li>
                        <li><a href=" " class="menu-item">Cancellation and Refunds</a></li>
                        <li><a href=" " class="menu-item">Other Terms</a></li>
                        <li><a href=" " class="menu-item">General Queries</a></li> -->
                        <li {{{ (Request::is('admin/page/help') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(3,(array)$cmsAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/page/help" class="menu-item">Help</a></li>
                    </ul>
                </li>
                <li {{{ (Request::is('admin/settings/site') ? 'class=active' : '') }}} 
                    {{{ (Request::is('admin/settings/google') ? 'class=active' : '') }}}{{{ (Request::is('admin/settings/email') ? 'class=active' : '') }}}{{{ (Request::is('admin/email_template_list') ? 'class=active' : '') }}}class="nav-item has-sub" @if(auth()->user()->role==3 && empty(auth()->user()->AccessPrivilages->settings)) style="display:none" @endif><a href="#"><i class="ft-settings"></i><span data-i18n="" class="menu-title">{{trans('constants.setting')}}</span></a>
                    <ul class="menu-content">
                        @php $settingsAccess = explode(",",auth()->user()->AccessPrivilages->settings); @endphp
                      <li {{{ (Request::is('admin/settings/site') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(1,(array)$settingsAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/settings/site" class="menu-item">{{trans('constants.site_setting')}}</a></li>
                      <li {{{ (Request::is('admin/settings/google') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(2,(array)$settingsAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/settings/google" class="menu-item">{{trans('constants.google_setting')}}</a></li>                           
                      <li {{{ (Request::is('admin/settings/email') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(3,(array)$settingsAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/settings/email" class="menu-item">{{trans('constants.email_setting')}}</a></li>
                      <li {{{ (Request::is('admin/email_template_list') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(4,(array)$settingsAccess)) style="display:none" @endif><a href="{{URL('/')}}/admin/email_template_list" class="menu-item">{{trans('constants.email_template')}} {{trans('constants.list')}}</a></li>
                    </ul>
               </li>
               @endif
                <!-- <li class="nav-item has-sub"><a href="#"><i class="ft-user-check"></i><span data-i18n="" class="menu-title">Leads</span></a>
                    <ul class="menu-content">
                        <li><a href="{{URL('/')}}/admin/restuarant_leads" class="menu-item">Restaurant Leads</a></li>
                        <li><a href="{{URL('/')}}/admin/delivery_people" class="menu-item">Delivery People</a></li>
                        <li><a href="{{URL('/')}}/admin/news_letter" class="menu-item">Newsletter</a></li>
                    </ul>
                </li> -->
               
                @if(Session::get('role') != 2)
                <li {{{ (Request::is('admin/admin_restaurant_report') ? 'class=active' : '') }}}{{{ (Request::is('admin/delivery_boy_reports') ? 'class=active' : '') }}}{{{ (Request::is('admin/restaurant_report') ? 'class=active' : '') }}} class="nav-item has-sub" @if(auth()->user()->role==3 && empty(auth()->user()->AccessPrivilages->reports)) style="display:none" @endif><a href="#"><i class="ft-mail"></i><span data-i18n="" class="menu-title">Reports</span></a>
                    <ul class="menu-content">
                        @php $reportsAccess = explode(",",auth()->user()->AccessPrivilages->reports); @endphp
                        <li {{{ (Request::is('admin/admin_restaurant_report') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(1,(array)$reportsAccess)) style="display:none" @endif><a href="{{url('/')}}/admin/admin_restaurant_report" class="menu-item">Restaurant Report</a></li>
                       
                        <li {{{ (Request::is('admin/delivery_boy_reports') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(3,(array)$reportsAccess)) style="display:none" @endif><a href="{{url('/')}}/admin/delivery_boy_reports" class="menu-item">Delivery Boy Report</a></li>
                        <li {{{ (Request::is('admin/restaurant_report') ? 'class=active' : '') }}} @if(auth()->user()->role==3 && !in_array(5,(array)$reportsAccess)) style="display:none" @endif><a href="{{url('/')}}/admin/restaurant_report" class="menu-item"><span data-i18n="" class="menu-title">Order Reports</span></a></li>
                       
                    </ul>
                </li>
                @endif
                @if(Session::get('role') == 2)
                 <li {{{ (Request::is('admin/restaurant_report') ? 'class=active' : '') }}}><a href="{{url('/')}}/admin/restaurant_report" class="menu-item"><i class="ft-message-square"></i><span data-i18n="" class="menu-title">Reports</span></a></li>
                @endif
            </ul>
    </div>


  
  