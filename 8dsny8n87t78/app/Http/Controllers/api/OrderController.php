<?php

namespace App\Http\Controllers\api;
                                    
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController;
use DB;
use Carbon\Carbon;

class OrderController extends BaseController
{
	public function get_address_detail(Request $request)
	{

		  $validator = Validator::make(
                $request->all(),
                array(
                    'request_id' => 'required'
                ));

        if ($validator->fails())
        {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        }else
        {
		$request_id = $request->request_id;

		$request_detail = DB::table('requests')->where('id',$request_id)->first();

		$order_id = $request_detail->order_id;

		$ordered_time = $request_detail->ordered_time;

		$restaurant_detail = $this->restaurants::where('id',$request_detail->restaurant_id)->first();

		$user_detail = $this->users::where('id',$request_detail->user_id)->first();

		$address_detail = array();

		$request_status = $request_detail->status;

		$address_detail [] = array(
			'd_address'=>$request_detail->delivery_address,
			's_address'=>$restaurant_detail->address,
			'd_lat'=>$request_detail->d_lat,
			'd_lng'=>$request_detail->d_lng,
			's_lat'=>$restaurant_detail->lat,
			's_lng'=>$restaurant_detail->lng
		);

		$food_detail = array();
		$bill_detail = array();

		$data = DB::table('request_detail')->where('request_detail.request_id',$request_id)
											->join('food_list','food_list.id','=','request_detail.food_id')
											->select('request_detail.quantity as quantity','food_list.name as food','food_list.price as price_per_quantity','food_list.is_veg as is_veg')
											->get();

				foreach($data as $d)
				{
					$food_detail[] = array(
						'name'=>$d->food,
						'quantity'=>$d->quantity,
						'price'=>$d->quantity * $d->price_per_quantity,
						'is_veg'=>$d->is_veg
					);
				}

		$bill_detail[] = array(
			'item_total'=>$request_detail->item_total,
			'offer_discount'=>$request_detail->offer_discount,
			'restaurant_discount'=>$request_detail->restaurant_discount,
			'packaging_charge'=>$request_detail->restaurant_packaging_charge,
			'tax'=>$request_detail->tax,
			'delivery_charge'=>$request_detail->delivery_charge,
			'bill_amount'=>$request_detail->bill_amount,
			'paid_type' => $request_detail->paid_type
		);

		$response_array = array('status'=>true,'request_id'=>$request_id,'ordered_time'=>$ordered_time,'order_id'=>$order_id,'restaurant_detail'=>$restaurant_detail,'user_detail'=>$user_detail,'address_detail'=>$address_detail,'bill_detail'=>$bill_detail,'food_detail'=>$food_detail,'request_status'=>$request_status);
		}

		 $response = response()->json($response_array, 200);
        return $response;
	}


		public function get_order_status(Request $request)
	{

		// $request_id = $request->request_id;

		$delivery_boy_id = $request->header('authId');

		$request_detail = DB::table('requests')->where('delivery_boy_id',$delivery_boy_id)
											   ->where('status','!=',10)
											   ->where('status','!=',7)
											   ->first();

		if(count($request_detail)!=0)
		{
				$order_id = $request_detail->order_id;

				$request_id = $request_detail->id;

				$ordered_time = $request_detail->ordered_time;

				$restaurant_detail = $this->restaurants::where('id',$request_detail->restaurant_id)->first();
				if(isset($restaurant_detail->image)) $restaurant_detail->image = RESTAURANT_UPLOADS_PATH.$restaurant_detail->image;
		


					$user_detail = DB::table('users')->where('id',$request_detail->user_id)->first();

					$address_detail = array();

					$request_status = $request_detail->status;

					$address_detail [] = array(
						'd_address'=>$request_detail->delivery_address,
						's_address'=>$restaurant_detail->address,
						'd_lat'=>$request_detail->d_lat,
						'd_lng'=>$request_detail->d_lng,
						's_lat'=>$restaurant_detail->lat,
						's_lng'=>$restaurant_detail->lng
					);

					$food_detail = array();
					$bill_detail = array();

					$data = DB::table('request_detail')->where('request_detail.request_id',$request_id)
														->join('food_list','food_list.id','=','request_detail.food_id')
														->select('request_detail.quantity as quantity','food_list.name as food','food_list.price as price_per_quantity','food_list.is_veg as is_veg')
														->get();

							foreach($data as $d)
							{
								$food_detail[] = array(
									'name'=>$d->food,
									'quantity'=>$d->quantity,
									'price'=>$d->quantity * $d->price_per_quantity,
									'is_veg'=>$d->is_veg
								);
							}

					$bill_detail[] = array(
						'item_total'=>$request_detail->item_total,
						'offer_discount'=>$request_detail->offer_discount,
						'packaging_charge'=>$request_detail->restaurant_packaging_charge,
						'tax'=>$request_detail->tax,
						'delivery_charge'=>$request_detail->delivery_charge,
						'bill_amount'=>$request_detail->bill_amount,
						'paid_type' => $request_detail->paid_type
					);

					$response_array = array('status'=>true,'request_id'=>$request_id,'ordered_time'=>$ordered_time,'order_id'=>$order_id,'restaurant_detail'=>$restaurant_detail,'user_detail'=>$user_detail,'address_detail'=>$address_detail,'bill_detail'=>$bill_detail,'food_detail'=>$food_detail,'request_status'=>$request_status,'assigned_time'=>$request_detail->updated_at, 'notification_time'=>NOTIFICATION_TIME);

		}else
		{
			$response_array = array('status'=>false,'message'=>'No orders available');
		}

		 $response = response()->json($response_array, 200);
        return $response;
	}

	public function update_request(Request $request)
	{
		  $validator = Validator::make(
                $request->all(),
                array(
                    'request_id' => 'required',
                    'status' => 'required'
                ));

        if ($validator->fails())
        {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        }else
        {
        	$request_id = $request->request_id;
        	$status = $request->status;
        	$trackorderstatus = $this->trackorderstatus;
        	$deliverypartners = $this->deliverypartners;
        	$partner_id = $request->header('authId');

        	$request_detail = $this->foodrequest->find($request_id);

        	DB::table('requests')->where('id',$request_id)->update(['status'=>$status,'is_confirmed'=>1]);

        	/*
					
					Started towards Restarent -> 3 -> (On the way)
					Reached restarent -> 4 -> (Food received)
					Started towards Customer -> 5 -> (On the way)
					Food delivered -> 6 -> (delivered)
					cash received - >  7 ->(order completed)
					cancelled - > 10 -> (Order canceled)
        	*/

        	if($status==3)
        	{
        		$message = "Delivery Boy Started towards Restaurant";
        	}elseif($status==4)
        	{
        		$message = "Delivery Boy Reached restaurant";
        	}elseif($status==5)
        	{
        		$message = "Started towards Customer";
        	}elseif($status==6)
        	{
        		$message = "Food delivered";

        		$partner_detail = $deliverypartners::where('id',$partner_id)->first();
        		$partner_earnings = $partner_detail->total_earnings + $request_detail->delivery_boy_commision;
				$partner_detail->total_earnings = $partner_earnings;
				$partner_detail->pending_payout = $partner_detail->pending_payout + $request_detail->delivery_boy_commision;
				$partner_detail->save();
				
				//commission update in admin 
				$this->admin->find(1)->increment('total_earnings', $request_detail->admin_commision );

				//earnings update in restaurant
				$this->restaurants->find($request_detail->restaurant_id)->increment('total_earnings', $request_detail->restaurant_commision );
				$this->restaurants->find($request_detail->restaurant_id)->increment('pending_payout', $request_detail->restaurant_commision );

        	}

        	if($status==7)
        	{
        		DB::table('requests')->where('id',$request_id)->update(['is_paid'=>1]);

        		$message = "Cash Received. Order Completed";

        			// delete request to driver 
        			$temp_driver = $request_detail->delivery_boy_id;
					$header = array();
					$header[] = 'Content-Type: application/json';
					$postdata = array();
					$postdata['request_id'] = $request_id;
					$postdata['user_id'] = $request_detail->user_id;
					$postdata['status'] = 1;
					$postdata = json_encode($postdata);
					
					$ch = curl_init(FIREBASE_URL."/new_request/$temp_driver.json");
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
					curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
					$result = curl_exec($ch); 
					curl_close($ch); 

					//sesnd email to user
					if(EMAIL_ENABLE==1)
    	            {
	   					$order_details = $this->foodrequest->with('Restaurants.Area')->find($request_id);
	   					$order_details->email = isset($order_details->Users)?$order_details->Users->email:"";
	   					$order_details->name = isset($order_details->Users)?$order_details->Users->name:"";
	   					$order_details->subject = "Order Completed!";
	   	                $this->send_mail($order_details,'order_complete');
    	            }
        	}

        	$status_entry = array();

        	// $status_entry[] = array(
        	// 	'request_id'=>$request_id,
        	// 	'status'=>$status,
        	// 	'detail'=>$message
        	// );

        	$check_trackorder_status = $trackorderstatus::where('request_id',$request_id)->where('status',$status)->count();

        	if($check_trackorder_status==0)
        	{
				$trackorderstatus->request_id = $request_id;
				$trackorderstatus->status = $status;
				$trackorderstatus->detail = $message;
				$trackorderstatus->save();	

        		//$trackorderstatus::insert($status_entry);
        	}
        	
			//send push notification to user
			if(isset($request_detail->Users->device_token) && $request_detail->Users->device_token!='')
			{
				$title = trans('constants.order_status_update');
				$data = array(
					'device_token' => $request_detail->Users->device_token,
					'device_type' => $request_detail->Users->device_type,
					'title' => $title,
					'message' => $message,
					'request_id' => $request_id,
					'delivery_type' => $request_detail->delivery_type
				);
				$this->user_send_push_notification($data);
			}

        	$response_array = array('status'=>true,'request_id'=>$request_id,'order_id'=>$request_detail->order_id,'message'=>$message);
        }

         $response = response()->json($response_array, 200);
        return $response;
	}

	public function cancel_request(Request $request)
	{
		  $validator = Validator::make(
                $request->all(),
                array(
                    'request_id' => 'required'
                ));

        if ($validator->fails())
        {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        }else
        {
			$request_id = $request->request_id;
			$provider_id = $request->header('authId');
			$old_provider=0;

			$request_data = DB::table('requests')
								->where('id',$request_id)->first();

			// delete request to driver 
			$temp_driver = $provider_id;
			$header = array();
			$header[] = 'Content-Type: application/json';
			$postdata = array();
			$postdata['request_id'] = $request_id;
			$postdata['user_id'] = $request_data->user_id;
			$postdata['status'] = 1;
			$postdata = json_encode($postdata);
					
			$ch = curl_init(FIREBASE_URL."/new_request/$temp_driver.json");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
			$result = curl_exec($ch); 
			curl_close($ch); 
				
			//update reject drivers
			$current_request = file_get_contents(FIREBASE_URL."/current_request/".$request_id.".json");
			$current_request = json_decode($current_request);
			if(isset($current_request->reject_drivers) && !empty($current_request->reject_drivers)) 
			{
				$reject_drivers = explode(',',$current_request->reject_drivers);
			}
			$reject_drivers[] = $provider_id;
			$postdata = array();
			$postdata['reject_drivers'] = implode(',',$reject_drivers);
			$postdata = json_encode($postdata);
			$this->update_firebase($postdata, 'current_request', $request_id);

			$restuarant_detail = $this->restaurants::where('id',$request_data->restaurant_id)->first();

			$source_lat = $restuarant_detail->lat;
			$source_lng = $restuarant_detail->lng;
			

			$data = file_get_contents(FIREBASE_URL."/available_providers/.json");
			$data = json_decode($data);

			$temp_driver = 0;
			$last_distance = 0;
			if($data != NULL && $data !="")
			{
				foreach ($data as $key => $value) 
				{
					# code...
					$driver_id = $key;

					//check previous rejected drivers    
					$current_request = file_get_contents(FIREBASE_URL."/current_request/".$request_id.".json");
					$current_request = json_decode($current_request);
					if(isset($current_request->reject_drivers) && !empty($current_request->reject_drivers)) 
					{
						$reject_drivers = explode(',',$current_request->reject_drivers);
						if(in_array($driver_id, $reject_drivers))
						{
							continue;
						}
					}
					$check = $this->deliverypartners::where('id',$driver_id)->where('status',1)->first();
					$check_request = $this->foodrequest->where('delivery_boy_id',$driver_id)->whereNotIn('status',[7,9,10])->count();
					if(count($check)!=0 && $check_request==0)
					{
						if($old_provider==0){
							$old_provider = -1;
						}
						if($driver_id != $old_provider && $driver_id!=$provider_id)
						{
							if ($value != NULL && $value != "")
							{
							$driver_lat = $value->lat;
							$driver_lng = $value->lng;
							$updated_time = isset($value->updated_at)?$value->updated_at:date("Y-m-d H:i:s");
							$dt = new Carbon($updated_time);
							$last_updated_time = $dt->addMinutes(IDEAL_TIME); 
							$current_time = date("Y-m-d H:i:s");
							if(strtotime($last_updated_time) >= strtotime($current_time))
							{

								try 
								{
									// $q = "http://maps.googleapis.com/maps/api/distancematrix/json?origins=$source_lat,$source_lng&destinations=$driver_lat,$driver_lng&mode=driving&sensor=false";
									$q = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$source_lat,$source_lng&destinations=$driver_lat,$driver_lng&mode=driving&sensor=false&key=".GOOGLE_API_KEY;
									$json = file_get_contents($q); 
									$details = json_decode($json, TRUE);

									// var_dump($details); exit;
									if(isset($details['rows'][0]['elements'][0]['status']) && $details['rows'][0]['elements'][0]['status'] != 'ZERO_RESULTS'){
										$current_distance_with_unit = $details['rows'][0]['elements'][0]['distance']['text'];
										$current_distance = (float)$details['rows'][0]['elements'][0]['distance']['value'];
										$unit =str_after($current_distance_with_unit, ' ');
										// if($unit == 'm')
										// {
										// 	$current_distance = $current_distance/1000;
										// }
										$current_distance = $current_distance/1000;
										if($current_distance<=DEFAULT_RADIUS){
											if($temp_driver == 0){
												$temp_driver = $driver_id;
												$last_distance = $current_distance;
											}else{
												if($current_distance < $last_distance){
													$temp_driver = $driver_id;
													$last_distance = $current_distance;
												}
											}
										}
									}

									} catch (Exception $e) {
										
									}
								}
							}
						}
					}
					//print_r($value->lat); exit;
				}
			}
				
				if ($temp_driver != 0 ) {
					# code...
					$user_data = $this->foodrequest->find($request_id);
					$user_data->delivery_boy_id = $temp_driver;
					$user_data->status = 2;
					$user_data->save();

					//DB::table('requests')->where('id',$request_id)->update(['delivery_boy_id'=>$temp_driver,'status'=>2]);
				
					// to insert into firebase
					$header = array();
					$header[] = 'Content-Type: application/json';
					$postdata = array();
					// $postdata['id'] = $request_id;
					$postdata['request_id'] = $request_id;
					$postdata['provider_id'] = (String)$temp_driver;
					$postdata['user_id'] = $user_data->user_id;
					$postdata['reject_drivers'] = implode(',',$reject_drivers);
					$postdata['status'] = 2;
					$postdata = json_encode($postdata);
					
					$ch = curl_init(FIREBASE_URL."/current_request/$request_id.json");
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
					curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
					$result = curl_exec($ch); 
					curl_close($ch); 

					// sending request to driver 
					$header = array();
					$header[] = 'Content-Type: application/json';
					$postdata = array();
					$postdata['request_id'] = $request_id;
					$postdata['user_id'] = $user_data->user_id;
					$postdata['status'] = 1;
					$postdata = json_encode($postdata);
					
					$ch = curl_init(FIREBASE_URL."/new_request/$temp_driver.json");
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
					curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
					$result = curl_exec($ch); 
					curl_close($ch); 

					  //  $title = "New Request Recieved";
		     //         $message = array();
				   // $message['title'] = "Taxi Request.4";
		     //        $message['body'] = "New Request Received";

		     //        $provider=4;
		     //            $this->send_provider_push_notification($temp_driver, $title, $message,$provider);
		            

				
				} else {
						# code...
					$title = "No Providers available";

					$user_data = DB::table('requests')
								->where('id',$request_id)
								->first();

					DB::table('requests')->where('id',$request_id)->update(['delivery_boy_id'=>0,'status'=>1]);

					//delete in track order status table
					$this->trackorderstatus->where('request_id',$request_id)->where('status',2)->delete();

					// to insert into firebase
					$header = array();
					$header[] = 'Content-Type: application/json';
					$postdata = array();
					// $postdata['id'] = $request_id;
					$postdata['request_id'] = $request_id;
					$postdata['provider_id'] = (String)0;
					$postdata['user_id'] = $user_data->user_id;
					$postdata['status'] = 1;
					$postdata = json_encode($postdata);
					
					$ch = curl_init(FIREBASE_URL."/current_request/$request_id.json");
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
					curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
					$result = curl_exec($ch); 
					curl_close($ch); 
					
					//update in firebase for restaurant notification
					$postdata = array();
					$postdata['status'] = 10;
					$postdata = json_encode($postdata);
					$this->update_firebase($postdata, 'restaurant_request/'.$request_data->restaurant_id, $request_id);

			     //         $message = array();
					   // $message['title'] = "Taxi Request";
			     //        $message['body'] = "No Providers available";


		      //           $this->send_push_notification($request->header('authId'), $title, $message);

					}

				$response_array = array('status'=>true,'message'=>'Request Cancelled Successfully');

        }

        $response = response()->json($response_array, 200);
        return $response;
	}

	    public function order_history(Request $request)
    {
        $delivery_boy_id = $request->header('authId');

        $orders = DB::table('requests')->where('requests.delivery_boy_id',$delivery_boy_id)->where('requests.is_paid',1)->latest()->limit(15)->get();

        $order_list = array();
        
                foreach($orders as $key)
                {
					$order_detail = $this->requestdetail->where('request_id',$key->id)->get();
					
					$order_list_detail = array();
                    foreach($order_detail as $k)
                    {
						if(isset($k->FoodQuantity)) $k->FoodQuantity->price = $k->food_quantity_price;
                        $order_list_detail[] = array(
							'food_id'=>(!empty($k->Foodlist)?$k->Foodlist->id:""),
							'food_name'=>(!empty($k->Foodlist)?$k->Foodlist->name:""),
							'food_quantity'=>$k->quantity,
							'tax' => (!empty($k->Foodlist)?$k->Foodlist->tax:""),
                            'item_price'=>(!empty($k->Foodlist)?$k->Foodlist->price:0) * $k->quantity,
                            'is_veg'=>(!empty($k->Foodlist)?$k->Foodlist->is_veg:""),
                            'food_size'=>$k->FoodQuantity,
                            'add_ons' => $k->Addons
                        );
                    }

                    $restaurant_detail = DB::table('restaurants')->where('id',$key->restaurant_id)->first();
                    if(count($restaurant_detail)!=0)
                    {

	                    $order_list[] = array(
	                        'request_id'=>$key->id,
							'order_id'=>$key->order_id,
							'restaurant_id'=>$restaurant_detail->id,
	                        'restaurant_name'=>$restaurant_detail->restaurant_name,
	                        'restaurant_image'=>RESTAURANT_UPLOADS_PATH.$restaurant_detail->image,
	                        'ordered_on'=>$key->ordered_time,
	                        'bill_amount'=>$key->bill_amount,
	                        'item_list'=>$order_list_detail,
	                        'item_total'=>$key->item_total,
							'offer_discount'=>$key->offer_discount,
							'restaurant_discount'=>$key->restaurant_discount,
	                        'restaurant_packaging_charge'=>$key->restaurant_packaging_charge,
	                        'tax'=>$key->tax,
	                        'delivery_charge'=>$key->delivery_charge,
	                        'delivery_address'=>$key->delivery_address,
	                        'restaurant_address'=>$restaurant_detail->address
	                    );
	                }

                }

        $upcoming_orders = DB::table('requests')->where('requests.delivery_boy_id',$delivery_boy_id)->where('requests.status','!=',10)->where('requests.status','!=',7)->orderBy('requests.id','desc')->get();

        $upcoming_order_list = array();
        
                foreach($upcoming_orders as $key)
                {
                    $upcoming_order_detail = $this->requestdetail->where('request_id',$key->id)->get();
                    $upcoming_order_list_detail = array();
                    foreach($upcoming_order_detail as $k)
                    {
						if(isset($k->FoodQuantity)) $k->FoodQuantity->price = $k->food_quantity_price;
                        $upcoming_order_list_detail[] = array(
							'food_id'=>(!empty($k->Foodlist)?$k->Foodlist->id:""),
                            'food_name'=>(!empty($k->Foodlist)?$k->Foodlist->name:""),
							'food_quantity'=>$k->quantity,
							'tax' => (!empty($k->Foodlist)?$k->Foodlist->tax:""),
                            'item_price'=>(!empty($k->Foodlist)?$k->Foodlist->price:0) * $k->quantity,
                            'is_veg'=>(!empty($k->Foodlist)?$k->Foodlist->is_veg:""),
                            'food_size'=>$k->FoodQuantity,
                            'add_ons' => $k->Addons
                        );
                    }

                    $restaurant_details = DB::table('restaurants')->where('id',$key->restaurant_id)->first();

                    if(count($restaurant_details)!=0)
                    {

		                    $upcoming_order_list[] = array(
		                        'request_id'=>$key->id,
								'order_id'=>$key->order_id,
								'restaurant_id'=>$restaurant_details->id,
		                        'restaurant_name'=>$restaurant_details->restaurant_name,
		                        'restaurant_image'=>RESTAURANT_UPLOADS_PATH.$restaurant_details->image,
		                        'ordered_on'=>$key->ordered_time,
		                        'bill_amount'=>$key->bill_amount,
		                        'item_list'=>$upcoming_order_list_detail,
		                        'item_total'=>$key->item_total,
								'offer_discount'=>$key->offer_discount,
								'restaurant_discount'=>$key->restaurant_discount,
		                        'restaurant_packaging_charge'=>$key->restaurant_packaging_charge,
		                        'tax'=>$key->tax,
		                        'delivery_charge'=>$key->delivery_charge,
		                        'delivery_address'=>$key->delivery_address,
		                        'restaurant_address'=>$restaurant_details->address
		                    );
		             }

                }

            
        if(count($upcoming_order_list)!=0||count($order_list)!=0)
        {
            $response_array = array('status' => true,'past_orders'=>$order_list,'upcoming_orders'=>$upcoming_order_list);
        }
        else
        {

            $response_array = array('status' => false,'message'=>"No Orders Received");

        }
 

        $response = response()->json($response_array, 200);
                return $response;
	}
	

	/**
	 * update order ratings from user
	 * 
	 * @param object $request
	 * 
	 * @return json $response
	 */
	public function order_ratings(Request $request)
	{
		$validator = Validator::make(
			$request->all(),
			array(
				'request_id' => 'required',
				'restaurant_rating' => 'required|not_in:0',
				'delivery_boy_rating' => 'required',
			));

		if ($validator->fails())
		{
			$error_messages = implode(',', $validator->messages()->all());
			$response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
		}else
		{
			$order_det = $this->foodrequest->find($request->request_id);
			if(!empty($order_det)){
				if($order_det->status==7){
					$feedback = (isset($request->restaurant_feedback)?$request->restaurant_feedback:"");

					//insert ratings into table
					$this->order_ratings->request_id = $request->request_id;
					$this->order_ratings->restaurant_rating = $request->restaurant_rating;
					$this->order_ratings->restaurant_feedback = $feedback;
					$this->order_ratings->delivery_boy_rating = $request->delivery_boy_rating;
					$this->order_ratings->save();

					$order_det->is_rated = 1;
					$order_det->save();

					$response_array = array('status' => true,'message'=>trans('constants.rate_msg'));
				}else
				{
					$response_array = array('status' => false, 'error_code' => 101, 'message' => trans('constants.order_not_complete'));	
				}
			}else
			{
				$response_array = array('status' => false, 'error_code' => 101, 'message' => trans('constants.invalid_order'));
			}
		}
		$response = response()->json($response_array, 200);
		return $response;
	}


	/**
	 * validate promocode
	 * 
	 * @param object $request
	 * 
	 * @return json $response
	 * 
	 */
	public function check_promocode(Request $request)
	{ 
		//dd($request->all());
		$validator = Validator::make(
			$request->all(),
			array(
				'bill_amount' => 'required',
				'promocode' => 'required',
			));

			
		if ($validator->fails())
		{
			$error_messages = implode(',', $validator->messages()->all());
			$response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
		}else
		{
			if($request->header('authId')!="")
			{
				$user_id = $request->header('authId');
			}else
			{
				$user_id = $request->authId;
			}
			$delivery_type = isset($request->delivery_type)?$request->delivery_type:0;
			$get_promocode = $this->promocode->where('code',$request->promocode)
								->where('status',1)
								->whereDate('available_from','<=',Carbon::now())
								->whereDate('valid_till','>=',Carbon::now())->first();

			if(!empty($get_promocode))
			{
				//check total usage of promocode
				$total_usage = $this->foodrequest->where('coupon_code',$request->promocode)->where('status','!=',10)
													->count();

				//check the promocode usage by user
				$user_usage = $this->foodrequest->where('coupon_code',$request->promocode)
											->where('status','!=',10)->where('user_id',$user_id)
											->count();

				if($total_usage>=$get_promocode->total_use)
				{
					$response_array = array('status' => false, 'error_code' => 101, 'message' => trans('constants.promocode_used'));
				}
				elseif($get_promocode->coupon_type==2 && $get_promocode->coupon_value>$request->bill_amount)
				{
					$response_array = array('status' => false, 'error_code' => 101, 'message' => trans('constants.min_order_val',['param'=>$get_promocode->coupon_value]));
				}
				elseif($user_usage>=$get_promocode->use_per_customer)
				{
					$response_array = array('status' => false, 'error_code' => 101, 'message' => trans('constants.promocode_used'));
				}
				elseif($get_promocode->delivery_type!=0 && ($get_promocode->delivery_type!=$delivery_type))
				{
					$response_array = array('status' => false, 'error_code' => 101, 'message' => trans('constants.deliverytype_notsupports'));
				}
				else
				{
					if($get_promocode->offer_type==1)
					{
						$offer_amount = $get_promocode->value;
					}else
					{
						$offer_amount = $request->bill_amount * ($get_promocode->value/100);
						if(isset($get_promocode->max_amount) && ($offer_amount > $get_promocode->max_amount))
						{
							$offer_amount = $get_promocode->max_amount;
						}

					}
					$response_array = array('status' => true,'offer_amount'=>$offer_amount);
				}
			}else
			{
				$response_array = array('status' => false, 'error_code' => 101, 'message' => trans('constants.invalid_promo'));
			}
			$response = response()->json($response_array, 200);
			return $response;
		}
	}

	/**
	* get chat history
	*
	* @param object $request_id
	*
	* @return json $response
	*/

	public function get_chat_history($request_id,$provider_type){
		$query = $this->chatmessage->where('request_id',$request_id)->where('provider_type',$provider_type)->get();
		return response()->json(['data'=>$query]);
	}
}