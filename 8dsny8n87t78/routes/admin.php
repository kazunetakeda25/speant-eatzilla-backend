<?php

use Illuminate\Http\Request;

header('Access-Control-Allow-Origin: *');
header( 'Access-Control-Allow-Headers: Authorization, Content-Type' );
//date_default_timezone_set("Asia/Kolkata");

Route::group(['prefix' => 'admin'], function(){
Route::group(['namespace'=>'admin'],function(){

        Route::get('/', 'LoginController@index');
        Route::POST('/login','LoginController@login');

        Route::group(['middleware'=>'checkLogin'],function(){

            //web chat management
            Route::get('/web_chat/{type}/{request_id}','OrderController@web_chat');

            Route::get('/dashboard','DashboardController@index');
            Route::get('/logout','LoginController@logout');

            //Dispatcher
            Route::get('/dispatcher','RestaurantController@dispatcher');

            // Restaurant List
            Route::get('/restaurant_list','RestaurantController@restaurant_list');
            Route::get('/add_restaurant','RestaurantController@restaurant');
            Route::POST('/add_to_restaurants','RestaurantController@add_to_restaurants');
            Route::GET('/edit_restaurant/{id}','RestaurantController@edit_restaurant');
            Route::POST('/delete_restaurant/{id}','RestaurantController@delete_restaurant');
            Route::get('/restaurant_view/{id}','RestaurantController@restaurant_view');
            //enable/disable restaurant status
            Route::GET('/status_enable/{id}','RestaurantController@status_enable');
            Route::GET('/status_disable/{id}','RestaurantController@status_disable');
            //check restaurant address
            Route::post('/check_restaurant_address','RestaurantController@check_restaurant_address');


            // Delivery Peopple API
            Route::get('/deliverypeople_list','DeliverypeopleController@deliverypeople_list');
            Route::get('/add_deliverypeople','DeliverypeopleController@add_deliverypeople');
            Route::POST('/add_to_deliverypeople','DeliverypeopleController@add_to_deliverypeople');
            Route::GET('/edit_delivery_partner/{id}','DeliverypeopleController@edit_delivery_partner');
            Route::POST('/delete_delivery_partner','DeliverypeopleController@delete_delivery_partner');

            Route::get('/shift_delivery', function () {
            return view('shift_delivery');
            });

            // Dispute manager
            Route::get('/disp_managerlist','DispController@disp_managerlist');
            Route::get('/add_dispmanager','DispController@add_dispmanager');
            Route::post('/add_dispmanager','DispController@store_dispmanager');

            // Promocode
            Route::get('/promocodes_list','PromocodeController@promocodes_list');
            Route::get('/add_promocode','PromocodeController@add_promocode');
            Route::post('/add_to_promocode','PromocodeController@add_to_promocode');
            Route::GET('/edit_promocode/{id}','PromocodeController@edit_promocode');
            Route::POST('/delete_promocode/{id}','PromocodeController@delete_promocode');

            // Banners
            Route::get('/banner_list','BannerlistController@banner_list');
            Route::get('/add_banner','BannerlistController@add_banner');
            Route::post('/add_to_banners','BannerlistController@add_to_banners');
            Route::GET('/edit_banner/{id}','BannerlistController@edit_banner');
            Route::POST('/delete_banner','BannerlistController@delete_banner');

            //popular brands
            Route::get('/popular_brand_list','BannerlistController@popular_brand_list');
            Route::get('/add_popular_brand','BannerlistController@add_popular_brand');
            Route::post('/add_to_popular_brand','BannerlistController@add_to_popular_brand');
            Route::GET('/edit_popular_brand/{id}','BannerlistController@edit_popular_brand');
            Route::POST('/delete_popular_brand','BannerlistController@delete_popular_brand');

            // Note board
            Route::GET('/noticeboard_list','NoteboardController@noticeboard_list');
            Route::GET('/add_noticeboard','NoteboardController@add_noticeboard');
            Route::GET('/custumpush','NoteboardController@custumpush');
            Route::POST('/send_custumpush','NoteboardController@send_custumpush');

            //user management
            Route::get('/user_list','UserController@user_list');
            Route::get('/add_user','UserController@Adduser');
            Route::get('/user_credit','UserController@user_credit');
            Route::get('/view_credit_details/{id}', 'UserController@view_credit_details');
            Route::post('/update_usercredit', 'UserController@update_usercredit');
            Route::post('/decline_usercredit', 'UserController@decline_usercredit');


            Route::get('/restuarant_leads', function () {
                return view('restuarant_leads');   
            });

            Route::get('/delivery_people', function () {
             return view('delivery_people');   
            });

            Route::get('/news_letter', function () {
                return view('news_letter');   
            });

            Route::get('/deliveries', function () {
                return view('deliveries');   
            });


            // Cuisine List
            Route::get('/cuisines_list','ItemmasterController@get_cuisines_list');
            Route::get('/add_cuisines','ItemmasterController@add_cuisines');
            Route::POST('/add_to_cuisines','ItemmasterController@add_to_cuisines');
            Route::POST('/delete_cuisine','ItemmasterController@delete_cuisine');

            //Add-ons route
            Route::get('/addons_list', 'ItemmasterController@list_addons');
            Route::get('/add_addons', 'ItemmasterController@add_addons');
            Route::get('/edit_addons/{id}', 'ItemmasterController@edit_addons');
            Route::POST('/store_addons','ItemmasterController@store_addons');
            Route::post('/delete_add_ons/{id}','ItemmasterController@delete_add_ons');

            //Food quantity route
            Route::get('/food-quantity-list', 'ItemmasterController@list_food_quantity');
            Route::get('/add-food-quantity', 'ItemmasterController@add_food_quantity');
            Route::get('/edit-food-quantity/{id}', 'ItemmasterController@edit_food_quantity');
            Route::POST('/store-food-quantity','ItemmasterController@store_food_quantity');
            Route::post('delete_category','ItemmasterController@delete_category');

            // Category list
            Route::get('/category_list','ItemmasterController@get_category_list');
            Route::get('/add_category', 'ItemmasterController@index');
            Route::POST('/add_to_category','ItemmasterController@add_to_category');
            Route::GET('edit_category/{id}','ItemmasterController@edit_category');
            Route::post('delete_food_quantity','ItemmasterController@delete_food_quantity');

            // Product List
            Route::get('/product_list','RestaurantController@product_list');
            Route::get('/add_product', 'RestaurantController@add_product');
            Route::POST('/add_to_product', 'RestaurantController@add_to_product');
            Route::GET('edit_product_list/{id}', 'RestaurantController@edit_product_list');
            Route::POST('/update_product_list', 'RestaurantController@update_product_list');
            Route::post('/delete_product/{food_id}','RestaurantController@delete_product_list');
            Route::get('/getrestaurant_based_detail/{id}', 'RestaurantController@getrestaurant_based_detail');
            Route::GET('/food_status_enable/{id}','RestaurantController@food_status_enable');
            Route::GET('/food_status_disable/{id}','RestaurantController@food_status_disable');
            //update status for todays special for foodlist
            Route::GET('/food_special_enable/{id}','RestaurantController@food_special_enable');
            Route::GET('/food_special_disable/{id}','RestaurantController@food_special_disable');

            // Restaurant Cuisines
            Route::get('/restaurant_cuisines','RestaurantmasterController@restaurant_cuisines');
            Route::POST('/add_to_restaurant_cuisines','RestaurantmasterController@add_to_restaurant_cuisines');
            Route::POST('/delete_restaurant_cuisine','RestaurantmasterController@delete_restaurant_cuisine');

            // Restaurant Menu list
            Route::get('/restaurant_menu','RestaurantController@restaurant_menu');
            Route::post('/add_restaurant_menu','RestaurantController@add_restaurant_menu');
            Route::post('/update_restaurant_menu','RestaurantController@edit_restaurant_menu');
            Route::post('/delete_restaurant_menu/{id}','RestaurantController@del_restaurant_menu');

            //order managemnt
            Route::get('/orders/{type}','OrderController@order_list');
            //pickup and dining orders
            Route::get('/pickup-orders','OrderController@pickup_orders');
            Route::get('/dining-orders','OrderController@dining_orders');
            //complete the orders
            Route::get('/complete_request/{request_id}','OrderController@complete_request');
            //order dashboard
            Route::get('/order_dashboard','OrderController@order_dashboard');
            Route::get('/orderwise_report_pagination','RestaurantController@orderwise_report_pagination');

            Route::get('/neworder_list','OrderController@neworder_list');
            Route::get('/accept_request/{request_id}','OrderController@accept_request');
            Route::get('/cancel_request/{request_id}','OrderController@cancel_request');
            Route::get('/assign_request/{request_id}','OrderController@assign_request');
            Route::get('/view_order/{request_id}','OrderController@view_order');
            Route::get('/commission_settings','DashboardController@commission_settings');
            Route::POST('/update_commission_settings','DashboardController@update_commission_settings');
            //generate pdf for orders
            Route::get('/generate_pdf/{id}','OrderController@generate_pdf');
            //driver availability for orders in map view
            Route::get('/availability_map','OrderController@availability_map');
            //check order count for navbar
            Route::get('/get_orders_count','OrderController@get_orders_count');
            

            //Restaurant Reports
            Route::get('/restaurant_report','RestaurantController@restaurant_report');
            Route::post('/restaurant_report_filter','RestaurantController@restaurant_report_filter');

            //Admin Restaurant Report 
            Route::get('/admin_restaurant_report','RestaurantController@admin_restaurant_report');
            Route::get('/admin_report_view/{id}','RestaurantController@admin_report_view');
            Route::get('/delivery_boy_reports','RestaurantController@delivery_boy_report');
            Route::post('/delivery_boy_report_filter','RestaurantController@delivery_boy_report_filter');
            Route::get('/deliveryboy_report_pagination','RestaurantController@deliveryboy_report_pagination');
            Route::get('/restaurant_report_pagination','RestaurantController@restaurant_report_pagination');

            //City Management
            Route::get('add_city','RestaurantController@city_management');
            Route::post('/city_add','RestaurantController@add_city');
            Route::get('edit_city/{id}','RestaurantController@edit_city');
            Route::post('/update_city','RestaurantController@update_city');
            Route::get('city_list','RestaurantController@city_list');
            Route::post('/delete_city', 'NationController@delete_city');
            Route::get('add_areas/{id}','RestaurantController@area_setting');
            Route::get('edit_area/{id}','RestaurantController@edit_area');
            Route::post('/area_add','RestaurantController@add_area');
            Route::get('view_areas/{id}','RestaurantController@area_list');
            Route::post('/update_area_list','RestaurantController@update_area_list');
            Route::post('/delete_area_list/{id}','RestaurantController@delete_area_list');
            //get areas based on city
            Route::get('/getcity_area/{id}', 'RestaurantController@getcity_area');
            //get state and area based on country
            Route::get('/getprovience/{provienceid}/{id}', 'NationController@getprovience');
            //email and phone exist checking
            Route::get('/check_exists_details', 'RestaurantController@existchecking');
            //Document Management
            Route::get('add_document','RestaurantController@document_management');
            Route::post('/document_add','RestaurantController@document_add');
            Route::get('document_list','RestaurantController@document_list');
            Route::GET('update_document/{id}','RestaurantController@update_document');
            Route::post('/document_update','RestaurantController@document_update');

            //Vehicle Management
            Route::get('add_vehicle','RestaurantController@vehicle_management');
            Route::post('/vehicle_add','RestaurantController@vehicle_add');
            Route::get('/vehicle_edit/{id}','RestaurantController@editvehicle');
            Route::get('vehicle_list','RestaurantController@vehicle_list');

            //Cancellation Reasons
            Route::get('cancellation_reason_list','RestaurantController@cancellation_reason');
            Route::post('/add_reason','RestaurantController@add_reason');
            Route::get('reason_list','RestaurantController@reason_list');
            Route::post('delete_cancel_reason','RestaurantController@delete_cancel_reason');
            Route::get('update_cancellation_reason/{id}','RestaurantController@update_reason_list');
            Route::post('/update_cancellation_reason','RestaurantController@cancellation_update');

            //Driver Management
            Route::get('add_new_driver','RestaurantController@driver');
            Route::post('add_driver','RestaurantController@add_driver');
            Route::get('driver_list','RestaurantController@driver_list');
            Route::get('view_delivery_boy_order_details/{id}','RestaurantController@view_deliveryboy_order_details');
            Route::GET('/edit_delivery_boy_details/{id}','RestaurantController@edit_delivery_boy_details');
            //get driver track details
            Route::get('track_driver/{id}','DeliverypeopleController@track_driver');

            //Coupon Management
            Route::get('add_coupon','PromocodeController@coupon');
            Route::post('coupon_add','PromocodeController@coupon_add');
            Route::get('coupon_list','PromocodeController@coupon_list');
            Route::GET('/edit_coupon/{id}','PromocodeController@edit_coupon');
            Route::POST('/delete_coupon/{id}','PromocodeController@delete_coupon');

            //get payout based on type
            Route::GET('/payout/{type}', 'TransactionController@Getpayout');
            Route::GET('/add_payout/{type}/{amount}/{id}', 'TransactionController@Getaddpayment');
            Route::POST('/add_payout', 'TransactionController@addpayment');
            Route::GET('/payout_history/{type}', 'TransactionController@Getpayout_history');

            //get site setting
            Route::GET('/settings/{type}', 'SettingController@Getsettings');
            Route::POST('/update-setting', 'SettingController@Updatesetting');

            Route::GET('/add_email', 'SettingController@Getaddemail');
            Route::GET('/email_template_list', 'SettingController@Getemailtemplate');

            //get country list
            Route::GET('/country_list', 'NationController@Getcountrylist');
            Route::GET('/add_country', 'NationController@Addcountry');
            Route::GET('/edit_country/{id}', 'NationController@AddEditcountry');
            Route::POST('/save_country', 'NationController@Savecountry');
            Route::GET('/default_country/{id}', 'NationController@Defaultcountry');
            Route::post('/delete_country', 'NationController@delete_country');
            Route::GET('/state_list', 'NationController@Getstatelist');
            Route::GET('/add_state', 'NationController@Addstate');
            Route::GET('/edit_state/{id}', 'NationController@AddEditstate');
            Route::POST('/save_state', 'NationController@Savestate');
            Route::get('/get_state_ajax/{id}','NationController@get_state_ajax');
            Route::post('/delete_state', 'NationController@delete_state');

            //cms management
            Route::get('/page/{name}','SettingController@getcms_page');
            Route::post('/page/{name}','SettingController@updatecms_page');




        });  

    });  

});

