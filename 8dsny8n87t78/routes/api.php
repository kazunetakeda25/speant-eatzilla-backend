<?php



header('Access-Control-Allow-Origin: *');
// header( 'Access-Control-Allow-Headers: Authorization, Content-Type' );
// header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
//date_default_timezone_set("Asia/Kolkata");


use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['namespace'=>'api'],function(){

	//chat history
	Route::GET('/get_chat_history/{id}/{provider_type}','OrderController@get_chat_history');
	Route::POST('/version_code_check','UserController@check_version');
	Route::POST('/register','LoginController@register');
	Route::POST('/login','LoginController@user_login');
	Route::POST('/send_otp','LoginController@send_otp_login');
	Route::POST('/forgot_password','LoginController@forgot_password');
	Route::POST('/reset_password','LoginController@reset_password');
	Route::POST('/update_profile','LoginController@update_profile');
	//get cms pages
	Route::GET('/get_cms_pages','LoginController@get_cms_pages');

	// Route::group(['middleware'=>'authCheck'],function(){

		Route::GET('get_default_address','UserController@get_default_address');
		Route::POST('set_delivery_address','UserController@set_delivery_address');
		Route::POST('track_order_detail','UserController@track_order_detail');
		Route::GET('/get_current_order_status','UserController@get_current_order_status');
		Route::GET('/get_delivery_address','UserController@get_delivery_address');
		Route::POST('/add_delivery_address','UserController@add_delivery_address');
		Route::GET('/get_profile','LoginController@get_profile');
		Route::GET('/get_filter_list/{filter_type}','UserController@get_filter_list');	// filter_type =1 - Cusines table else relevance table
		Route::POST('/get_relevance_restaurant','UserController@get_relevance_restaurant');
		Route::POST('/get_menu','UserController@get_menu');
		Route::POST('/get_nearby_restaurant','UserController@get_nearby_restaurant');
		Route::GET('/get_banners','UserController@get_banners');
		Route::GET('/get_popular_brands','UserController@get_popular_brands');
		Route::POST('/search_restaurants','RestaurantController@search_restaurants');
		// Route::GET('/get_restaurant_list','UserController@get_restaurant_list');
		Route::GET('/get_favourite_list','UserController@get_favourite_list');
		Route::POST('/update_favourite','UserController@update_favourite');
		Route::POST('/filter_relevance_restaurant','UserController@filter_relevance_restaurant');
		Route::POST('/single_restaurant','RestaurantController@single_restaurant');
		Route::POST('/add_to_cart','RestaurantController@add_to_cart');
		Route::POST('/reduce_from_cart','RestaurantController@reduce_from_cart');
		Route::GET('/check_cart','RestaurantController@check_cart');
		Route::GET('/get_category/{restaurant_id}','RestaurantController@get_category');
		Route::POST('/get_category_wise_food_list','RestaurantController@get_category_wise_food_list');
		Route::POST('/get_food_list','RestaurantController@get_food_list');
		Route::POST('/checkout','RestaurantController@checkout');
		Route::POST('/paynow','RestaurantController@paynow');
		Route::GET('/order_history','UserController@order_history');
		Route::GET('/get_order_status','UserController@get_order_status');
		Route::GET('/logout','LoginController@logout');

		//check restuarant during checkout
		Route::POST('/check_restaurant_availability','UserController@check_restaurant_availability');

		//get offers list
		Route::GET('/get_promo_list','UserController@get_promo_list');

		//update ratings for order
		Route::POST('/order_ratings','OrderController@order_ratings');
		//validate promocode
		Route::POST('/check_promocode','OrderController@check_promocode');

		//list dining restaurants
		Route::POST('/get_dining_restaurant','RestaurantController@get_dining_restaurant');

		//paynow api for dining type
		Route::POST('/paynow_dining','RestaurantController@paynow_dining');

		//get todays special food list
		Route::get('/todays_special','RestaurantController@todays_special');

		Route::GET('/get_password','LoginController@generate_password');

		//generate checksum for payumoney api
		Route::post('/generateChecksum','UserController@generateChecksum');
		Route::GET('/delete_delivery_address/{id}','UserController@delete_delivery_address');
		Route::post('/edit_delivery_address','UserController@edit_delivery_address');

		Route::get('/send_push','UserController@send_push');

		Route::get('/check_wallet','UserController@check_wallet');

		//stripe payment
		Route::get('/get_cards','StripeController@getCards');
		Route::get('/get_stripe_token','StripeController@get_stripe_token');
		Route::post('/add_card','StripeController@user_add_card_stripe');
		Route::post('/default_card','StripeController@default_card');
		Route::post('/delete_card','StripeController@delete_card');
		Route::post('/add_money_to_wallet','StripeController@add_money_to_wallet');
		Route::get('/get_balance','StripeController@get_balance');
		Route::post('/update_stripetoken','StripeController@update_stripetoken');
		Route::post('/update_credit_amount','StripeController@update_credit_amount');
		Route::get('/get_credit_amount','StripeController@get_credit_amount');

	// });


	Route::group(['prefix'=>'providerApi'],function(){

		
		Route::POST('/register','Provider_LoginController@register');
		Route::POST('/login','Provider_LoginController@provider_login');
		Route::POST('/send_otp','Provider_LoginController@send_otp_login');
		Route::POST('/forgot_password','Provider_LoginController@forgot_password');
		Route::POST('/reset_password','Provider_LoginController@reset_password');
		Route::GET('/get_provider_timeout','Provider_LoginController@get_provider_timeout');


		Route::group(['middleware'=>'authCheck'],function(){

			Route::GET('/get_profile','Provider_LoginController@get_profile');
			Route::POST('/update_profile','Provider_LoginController@update_profile');
			Route::POST('/get_address_detail','OrderController@get_address_detail');
			Route::POST('/update_request','OrderController@update_request');
			Route::POST('/cancel_request','OrderController@cancel_request');
			Route::GET('/get_order_status','OrderController@get_order_status');
			Route::GET('/order_history','OrderController@order_history');
			
			//earnings api
			Route::POST('/today_earnings','Provider_LoginController@today_earnings');
			Route::POST('/weekly_earnings','Provider_LoginController@weekly_earnings');
			Route::POST('/monthly_earnings','Provider_LoginController@monthly_earnings');

			//payout details api
			Route::GET('/payout_details','Provider_LoginController@payout_details');
			
			//chat history
			Route::GET('/get_chat_history/{id}/{provider_type}','OrderController@get_chat_history');

		});

	});


	//vendor apis
	Route::group(['prefix'=>'vendorApi'],function(){

		Route::POST('login','VendorController@vendor_login');

		//Route::group(['middleware'=>'authCheck'],function(){

			Route::GET('/get_profile','VendorController@get_profile');
			Route::POST('/update_profile','VendorController@update_profile');
			Route::post('/order_list','VendorController@order_list');
			Route::GET('/status_update/{id}/{status}','VendorController@status_update');
			Route::GET('/logout','VendorController@logout');

		//});

	});

	//cron apis
	Route::GET('/check_ideal_drivers','Provider_LoginController@check_ideal_drivers');
	Route::GET('/check_ideal_orders','Provider_LoginController@check_ideal_orders');



});



