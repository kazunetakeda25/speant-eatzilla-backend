<?php

namespace App\Http\Controllers\admin;
                                    
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController;
use Carbon\Carbon;
use DB;
use PDF;

class OrderController extends BaseController
{
	public function neworder_list(Request $request)
	{
		$restaurant_id = $request->session()->get('userid');

		$role = $request->session()->get('role');

		if($role==2)

		{

			$data = DB::table('requests')->where('requests.restaurant_id',$restaurant_id)
									 ->join('users','users.id','=','requests.user_id')
									 ->select('requests.id as request_id','requests.status as order_status','users.name as user_name','requests.*','users.*')
									 ->orderBy('request_id','desc')
									 ->get();
									 // print_r($data); exit;
			$data1 = DB::table('requests')->where('requests.restaurant_id',$restaurant_id)
									 ->join('request_detail','request_detail.request_id','=','requests.id')
									 ->join('food_list','food_list.id','=','request_detail.food_id')
									 ->select('food_list.name as food_name','request_detail.*','food_list.*','requests.id')
									 ->get();
		}else
		{
			$data = DB::table('requests')->join('users','users.id','=','requests.user_id')
									 ->select('requests.id as request_id','requests.status as order_status','users.name as user_name','requests.*','users.*')
									 ->orderBy('request_id','desc')
									 ->get();
									 // print_r($data); exit;
			$data1 = DB::table('requests')->join('request_detail','request_detail.request_id','=','requests.id')
									 ->join('food_list','food_list.id','=','request_detail.food_id')
									 ->select('food_list.name as food_name','request_detail.*','food_list.*','requests.id')
									 ->get();
		}

		return view('neworder_list',['data'=>$data,'data1'=>$data1]);
	}

	public function accept_request($request_id,Request $request)
	{
		$restaurant_id = $request->session()->get('userid');

		$foodrequest = $this->foodrequest;
		$trackorderstatus = $this->trackorderstatus;

		$foodrequest->where('id',$request_id)->update(['status'=>1]);

		$trackorderstatus->request_id = $request_id;
		$trackorderstatus->status = 1;
		$trackorderstatus->detail = "Order Accepted by Restaurant";
		$trackorderstatus->save();

		//  $status_entry[] = array(
        //         'request_id'=>$request_id,
        //         'status'=>1,
        //         'detail'=>"Order Accepted by Restaurant"
        //     );
		//   $trackorderstatus->insert($status_entry);
		  
		  $user_data = $this->foodrequest->where('id',$request_id)->first();
		  if($user_data->delivery_type==1){
				// to insert into firebase
				$postdata = array();
				$postdata['request_id'] = $request_id;
				$postdata['user_id'] = $user_data->user_id;
				$postdata['status'] = 1;
				$postdata = json_encode($postdata);
				$this->update_firebase($postdata, 'current_request', $request_id);

		  }

		return back();

	}

	public function assign_request($request_id,Request $request)
	{
		$restaurant_id = $request->session()->get('userid');
		# code...
		$old_provider=0;

		$trackorderstatus = $this->trackorderstatus;
	

			$request_data = DB::table('requests')
							->where('id',$request_id)->first();
		$restaurant_id = $request_data->restaurant_id;

		$restuarant_detail = $this->restaurants->where('id',$restaurant_id)->first();

		$source_lat = $restuarant_detail->lat;
		$source_lng = $restuarant_detail->lng;
		

		$data = file_get_contents(FIREBASE_URL."/available_providers/.json");
		$data = json_decode($data);

		// var_dump($data); exit;
		$temp_driver = 0;
		$last_distance = 0;
		if($data != NULL && $data !="")
		{
			foreach ($data as $key => $value) {
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
				
				$check = $this->deliverypartners->where('id',$driver_id)->where('status',1)->first();
				$check_request = $this->foodrequest->where('delivery_boy_id',$driver_id)->whereNotIn('status',[7,9,10])->count();
				if(count($check)!=0 && $check_request==0)
				{
					if($old_provider==0){
						$old_provider = -1;
					}
					if($driver_id != $old_provider){
						if ($value != NULL && $value != ""){
							$driver_lat = $value->lat;
							$driver_lng = $value->lng;
							$updated_time = isset($value->updated_at)?$value->updated_at:date("Y-m-d H:i:s");
							$dt = new Carbon($updated_time);
							$last_updated_time = $dt->addMinutes(IDEAL_TIME); 
							$current_time = date("Y-m-d H:i:s");
							// if(strtotime($last_updated_time) >= strtotime($current_time))
							// {
								try 
								{
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
							// }
						}
					}
				}
			//print_r($value->lat); exit;
			}
		}
		
		if ($temp_driver != 0 ) {
			# code...
			$ins_data = array();
			$user_data = $this->foodrequest->find($request_id);
			$user_data->delivery_boy_id = $temp_driver;
			$user_data->status = 2;
			$user_data->save();

			//DB::table('requests')->where('id',$request_id)->update(['delivery_boy_id'=>$temp_driver,'status'=>2]);
		
			$check_status = $trackorderstatus->where('request_id',$request_id)->where('status',2)->count();
			if($check_status==0)
			{
				$trackorderstatus->request_id = $request_id;
				$trackorderstatus->status = 2;
				$trackorderstatus->detail = "Food is being prepared";
				$trackorderstatus->save();
			}
		// 	$status_entry[] = array(
        //         'request_id'=>$request_id,
        //         'status'=>2,
        //         'detail'=>"Food is being prepared"
        //     );

		//   $trackorderstatus->insert($status_entry);
		  
		  // to insert into firebase
			$postdata = array();
			$postdata['request_id'] = $request_id;
			$postdata['provider_id'] = (String)$temp_driver;
			$postdata['user_id'] = $user_data->user_id;
			$postdata['status'] = 2;
			$postdata = json_encode($postdata);
			$this->update_firebase($postdata, 'current_request', $request_id);  

			// sending request to driver
			$postdata = array();
			$postdata['request_id'] = $request_id;
			$postdata['user_id'] = $user_data->user_id;
			$postdata['status'] = 1;
			$postdata = json_encode($postdata);
			$this->update_firebase($postdata, 'new_request', $temp_driver); 

			//send push notification to user
			$provider = $this->deliverypartners->find($temp_driver);
			if(isset($provider->device_token) && $provider->device_token!='')
			{
				$title = $message = trans('constants.new_order');
				$data = array(
					'device_token' => $provider->device_token,
					'device_type' => $provider->device_type,
					'title' => $title,
					'message' => $message,
					'request_id' => $request_id,
					'delivery_type' => $request_data->delivery_type
				);
				$this->user_send_push_notification($data);
			}
			return back()->with('success','Providers assigned successfully');
		// }else
		// {
		// 	//update in firebase for restaurant notification
		// 	$postdata = array();
		// 	$postdata['status'] = 10;
		// 	$postdata = json_encode($postdata);
		// 	$this->update_firebase($postdata, 'restaurant_request/'.$restaurant_id, $request_id);

		// 	return back()->with('error','No Providers available');
		// }

			
		}else 
		{ 
			//update in firebase for restaurant notification
			$postdata = array();
			$postdata['status'] = 10;
			$postdata = json_encode($postdata);
			$this->update_firebase($postdata, 'restaurant_request/'.$restaurant_id, $request_id);
			
			$title = "No Providers available";
			return back()->with('error',$title);
		}
			
			# code...	
	}

	/** 
	* to get order list based on status
	*
	* @param object $request, string $type
	*
	* @return view page with details
	*/
	public function order_list(Request $request, $type)
	{
			$restaurant_id = $request->session()->get('userid');
			$role = $request->session()->get('role');
			if($type=='new') $status = [0];
			if($type=='processing') $status = [1,2];	
			if($type=='pickup') $status = [3,4,5];
			if($type=='delivered') $status = [6,7];	
			if($type=='cancelled') $status = [9,10];
			if($role==2)
			{
				$data = $this->foodrequest->whereIn('status',$status)->where('delivery_type',1)
							->where('restaurant_id',$restaurant_id)->orderBy('id','desc')->get();
			}else
			{
				$data = $this->foodrequest->whereIn('status',$status)->where('delivery_type',1)
							->orderBy('id','desc')->get();
			}
			foreach ($data as $key => $value) 
			{
				$value->chatcount = $this->chatmessage->where('request_id',$value->id)->where('provider_type',2)->where('is_read',0)->count();
				$value->res_chatcount = $this->chatmessage->where('request_id',$value->id)->where('provider_type',3)->where('is_read',0)->count();
				$value->driver_chatcount = $this->chatmessage->where('request_id',$value->id)->where('provider_type',4)->where('is_read',0)->count();
			}
			
			//dd($data);

			return view('orders_list',['data'=>$data,'title'=>$type]);
	}



	/**
	 * cancel the order request
	 * 
	 * @param int $request_id, object $request
	 * 
	 * @return return to blade page
	 */
	public function cancel_request($request_id,Request $request)
	{
			$role = $request->session()->get('role');

			$foodrequest = $this->foodrequest;
			$trackorderstatus = $this->trackorderstatus;
			if($role==1){
				$status = 9;
				$message = "Order Cancelled by Admin";
			}else{
				$status = 10;
				$message = "Order Cancelled by Restaurant";
			} 

			$foodrequest->where('id',$request_id)->update(['status'=>$status]);

			$trackorderstatus->request_id = $request_id;
			$trackorderstatus->status = $status;
			$trackorderstatus->detail = $message;
			$trackorderstatus->save();

			$data = $foodrequest->find($request_id);

		// to insert into firebase
		$postdata = array();
		$postdata['request_id'] = (String)$request_id;
		$postdata['provider_id'] = (String)$data->delivery_boy_id;
		$postdata['user_id'] = $data->user_id;
		$postdata['status'] = 10;
		$postdata = json_encode($postdata);
		$this->update_firebase($postdata, 'current_request', $request_id);  

		$header = array();
		$header[] = 'Content-Type: application/json';
		$ch = curl_init(FIREBASE_URL."/new_user_request/".$data->user_id."/".$request_id.".json");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
		$result = curl_exec($ch); 
		curl_close($ch); 
		
		$provider = $this->users->find($data->user_id);
		if(isset($provider->device_token) && $provider->device_token!='')
		{
			$title = $message = trans('constants.order_cancel');
			$data = array(
				'device_token' => $provider->device_token,
				'device_type' => $provider->device_type,
				'title' => $title,
				'message' => $message,
				'request_id' => $request_id,
				'delivery_type' => $data->delivery_type
			);
			$this->user_send_push_notification($data);
		}
		return redirect('/admin/orders/new');

	}


	public function order_dashboard(Request $request)
	{
		$today_orders = DB::table('requests')
		                ->whereDate('created_at', Carbon::today())
		                ->count();

		$today_completed_orders = DB::table('requests')
		                          ->whereDate('created_at', Carbon::today())
		                          ->where('status',7)
		                          ->count();

		$today_cancel_orders = DB::table('requests')
		                       ->whereDate('created_at', Carbon::today())
		                       ->where('status',10)
		                       ->count();

		$today_processing_orders = DB::table('requests')
		                       ->whereDate('created_at', Carbon::today())
		                       ->whereIn('status',[2,3,4,5,6])
		                       ->count();
           $restaurant_id = $request->session()->get('userid');
           $role = $request->session()->get('role');
		   $query = $this->foodrequest
                    ->orderby('id','desc')
                    ->limit(5);
           $query = $query->when(($role!=1),function($q)use($restaurant_id){
                    return $q->where('restaurant_id',$restaurant_id);
            });
                    
    $recent_orders = $query->get();

		// $recent_orders = DB::table('requests')
		//                      ->join('users','users.id','=','requests.user_id')
		//                      ->select('requests.*','users.name as name')
		//                      ->orderby('id','desc')
		//                      ->limit(5)
		//                      ->get();

		$area_wise_earnings = $this->foodrequest
		                      ->join('restaurants','restaurants.id','=','requests.restaurant_id')
		                      ->join('add_area','add_area.id','=','restaurants.area')
		                      
		                      ->groupBy('restaurants.area','requests.id','add_area.area')
		                      ->select('restaurants.area','requests.id','add_area.area as res_area')
                              ->get();

		$column=array();
        foreach ($area_wise_earnings as $key => $value) {
           
            $col['res_area']=isset($value->Restaurants->Area)?$value->Restaurants->Area->area:"";
            $col['id']=$value->id;
           
            array_push($column, $col);
        }

        $area_wise_earnings = $column;


        //print_r($area_wise_earnings);exit();

		//dd($area_wise_earnings[0]); 

		//print_r($area_wise_earnings);exit();

		return view('order_dashboard',['today_orders'=>$today_orders,'today_completed_orders'=>$today_completed_orders,'today_cancel_orders'=>$today_cancel_orders,'today_processing_orders'=>$today_processing_orders,'recent_orders'=>$recent_orders,'area_wise_earnings'=>$area_wise_earnings,]);                
	}

	/**
	 * View the order request
	 * 
	 * @param int $request_id, object $request
	 * 
	 * @return return to blade page
	 */
	public function view_order($request_id,Request $request)
	{
		$data = $this->foodrequest->where('id',$request_id)
								  ->with('Restaurants.city_list')
								  ->with('Restaurants.Area')
								  ->first();
		//dd($data);
		return view('view_order',compact('data'));
	}



	/** 
	* to get order list based on pickup
	*
	* @param object $request
	*
	* @return view page with details
	*/
	public function pickup_orders(Request $request)
	{
			$restaurant_id = $request->session()->get('userid');
			$role = $request->session()->get('role');
			if($role==2)
			{
				$data = $this->foodrequest->where('delivery_type',2)
								->where('restaurant_id',$restaurant_id)->orderBy('id','desc')->get();
			}else
			{
				$data = $this->foodrequest->where('delivery_type',2)->orderBy('id','desc')->get();
			}
			//dd($data);

			return view('pickup_orders',['data'=>$data,'title'=>__('constants.pickup')]);
	}



	/** 
	* to get order list based on dining
	*
	* @param object $request
	*
	* @return view page with details
	*/
	public function dining_orders(Request $request)
	{
			$restaurant_id = $request->session()->get('userid');
			$role = $request->session()->get('role');
			if($role==2)
			{
				$data = $this->foodrequest->where('delivery_type',3)
								->where('restaurant_id',$restaurant_id)->orderBy('id','desc')->get();
			}else
			{
				$data = $this->foodrequest->where('delivery_type',3)->orderBy('id','desc')->get();
			}
			//dd($data);

			return view('pickup_orders',['data'=>$data,'title'=>__('constants.dining')]);
	}



	/** 
	* to complete the order based on dining/pickup
	*
	* @param int $request_id, object $request
	*
	* @return view page with details
	*/
	public function complete_request($request_id,Request $request)
	{
		$restaurant_id = $request->session()->get('userid');

		$foodrequest = $this->foodrequest;
		$trackorderstatus = $this->trackorderstatus;

		$foodrequest->where('id',$request_id)->update(['status'=>7,'is_paid'=>1]);

		$trackorderstatus->request_id = $request_id;
		$trackorderstatus->status = 7;
		$trackorderstatus->detail = "Order Completed by Restaurant";
		$trackorderstatus->save();

		//  $status_entry[] = array(
        //         'request_id'=>$request_id,
        //         'status'=>7,
        //         'detail'=>"Order Completed by Restaurant"
        //     );

		// 	$trackorderstatus->insert($status_entry);
			

		return back();

	}


	/** 
	* to complete the order based on dining/pickup
	*
	* @param int $id, object $request
	*
	* @return view page with details
	*/
	public function generate_pdf($id,Request $request)
	{
		$restaurant_id = $request->session()->get('userid');

		$data = $this->foodrequest->with('Restaurants.Area')->find($id);
		$pdf = PDF::loadView('invoice.order_invoice', ['data'=>$data]);
		//$pdf->setPaper('A4','landscape');
		return $pdf->stream('Invoice-'.$data->order_id.'.pdf',array('Attachment'=>0));
		//return $pdf->download('customers.pdf');

	}


	/**
	* get driver and restaurant locations to map
	*
	*@param object $request
	*
	*@return view page
	*/
	public function availability_map(Request $request)
	{
		$result = file_get_contents(FIREBASE_URL."/prov_location/.json");
		$result = json_decode($result);
		$result = array_filter((array)$result, function($value) { return $value !== null; });
		//dd($result);
		$data = array();
		foreach($result as $key=>$value){
			$getdetails = $this->deliverypartners->select('name','phone','partner_id')->where('id',$key)->first();
			$getstatus = file_get_contents(FIREBASE_URL."/providers_status/".$key.".json");
			$getstatus = json_decode($getstatus);
			$data[] = (object)array(
				'id'=>$key,
				'name'=>isset($getdetails->name)?$getdetails->name:"",
				'partner_id'=>isset($getdetails->partner_id)?$getdetails->partner_id:"",
				'phone'=>isset($getdetails->phone)?$getdetails->phone:"",
				'lat'=>$value->lat,
				'lng'=>$value->lng,
				'is_available'=>isset($getstatus->status)?$getstatus->status:0
			);
		}
		
		$get_restaurant = $this->restaurants->where('status',1)->get();
		foreach($get_restaurant as $key=>$value){
			
			$data[] = (object)array(
				'id'=>$value->id,
				'name'=>$value->restaurant_name,
				'partner_id'=>"",
				'phone'=>$value->phone,
				'lat'=>$value->lat,
				'lng'=>$value->lng,
				'is_available'=>3
			);
		}
		//dd($data);
		return view('dashboard_map',['data'=>$data]);
	}





	/**
	 * To get orders count based on status
	 * 
	 * @param object $request
	 * 
	 * @param array $response 
	 */
	public function get_orders_count(Request $request)
	{
		$restaurant_id = $request->session()->get('userid');
        $role = $request->session()->get('role');
        if($role==1)
        {
            $new_orders = $this->foodrequest->where('status',0)->where('delivery_type',1)->count();
            $processing_orders = $this->foodrequest->whereIn('status',[1,2])->where('delivery_type',1)->count();
            $pickup_orders = $this->foodrequest->whereIn('status',[3,4,5])->where('delivery_type',1)->count();
            $delivered_orders = $this->foodrequest->whereIn('status',[6,7])->where('delivery_type',1)->count();
            $cancelled_orders = $this->foodrequest->whereIn('status',[9,10])->where('delivery_type',1)->count();
            $pickuporder = $this->foodrequest->where('status','!=',7)->where('delivery_type',2)->count();
            $diningorder = $this->foodrequest->where('status','!=',7)->where('delivery_type',3)->count();
        }else
        {
            $new_orders = $this->foodrequest->where('restaurant_id',$restaurant_id)->where('status',0)->where('delivery_type',1)->count();
            $processing_orders = $this->foodrequest->where('restaurant_id',$restaurant_id)->whereIn('status',[1,2])->where('delivery_type',1)->count();
            $pickup_orders = $this->foodrequest->where('restaurant_id',$restaurant_id)->whereIn('status',[3,4,5])->where('delivery_type',1)->count();
            $delivered_orders = $this->foodrequest->where('restaurant_id',$restaurant_id)->whereIn('status',[6,7])->where('delivery_type',1)->count();
            $cancelled_orders = $this->foodrequest->where('restaurant_id',$restaurant_id)->whereIn('status',[9,10])->where('delivery_type',1)->count();
            $pickuporder = $this->foodrequest->where('restaurant_id',$restaurant_id)->where('status','!=',7)->where('delivery_type',2)->count();
            $diningorder = $this->foodrequest->where('restaurant_id',$restaurant_id)->where('status','!=',7)->where('delivery_type',3)->count();
        }

		$data = array(
					'new_orders'=> $new_orders,
					'processing_orders'=> $processing_orders,
					'pickup_orders'=> $pickup_orders,
					'delivered_orders'=> $delivered_orders,
					'pickuporder'=> $pickuporder,
					'cancelled_orders'=> $cancelled_orders,
					'diningorder'=> $diningorder
				);
        return $data;
	}


	/**
	*
	* it redirect the page to the web_chat blade page.
	*
	* @param $request_id and 
	*/

	public function web_chat($type, $request_id, Request $request){
		$data=$this->chatmessage->with('Users')->groupBy('user_id')->get();
		$query=$this->chatmessage->with('Users')->where('request_id',$request_id)->where('provider_type',$type)->orderBy('id')->get();
		$order_id=$this->foodrequest->where('id',$request_id)->first();
		$chat=$this->chatmessage;
		if($type==2)
		{
			$order_id->chat_person = isset($order_id->Users->name)?$order_id->Users->name:"Guest";
			$order_id->chat_person_phone = isset($order_id->Users->phone)?$order_id->Users->phone:"";
		} 
		else if($type==3)
		{
			$order_id->chat_person = isset($order_id->Restaurants->restaurant_name)?$order_id->Restaurants->restaurant_name:"";
			$order_id->chat_person_phone = isset($order_id->Restaurants->phone)?$order_id->Restaurants->phone:"";
		}else
		{
			$order_id->chat_person = isset($order_id->Deliverypartners->name)?$order_id->Deliverypartners->name:"";
			$order_id->chat_person_phone = isset($order_id->Deliverypartners->phone)?$order_id->Deliverypartners->phone:"";
		}
		//dd($order_id);
		$chat->where('request_id',$request_id)->where('provider_type',$type)->update(['is_read'=>1]);
		return view('web_chat',['data'=>$data,'query'=>$query,'order_id'=>$order_id,'type'=>$type]);
	}



}