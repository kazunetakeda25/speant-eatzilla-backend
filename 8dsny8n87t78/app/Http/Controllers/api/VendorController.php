<?php

namespace App\Http\Controllers\api;
                                    
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController;

class VendorController extends BaseController
{

    // Status code:
    // public static final String ORDER_CREATED = "0";
    // public static final String RESTAURANT_ACCEPTED = "1";
    // public static final String FOOD_PREPARED = "2";
    // public static final String DELIVERY_REQUEST_ACCEPTED = "3";
    // public static final String REACHED_RESTAURANT = "4";
    // public static final String FOOD_COLLECTED_ONWAY = "5";
    // public static final String FOOD_DELIVERED = "6";
    // public static final String ORDER_COMPLETE = "7";
    // public static final String ORDER_CANCELLED = "10";

    /** 
    * vendor login check
    *
    * @param object $request 
    *
    * @return json response
    */
    public function vendor_login(Request $request)
    {

           $validator = Validator::make(
                $request->all(),
                array(
                    'email' => 'required',
                    'password' => 'required',
                    'device_token' => 'required',
                    'device_type' =>'required|in:'.ANDROID.','.IOS.','.WEB,
                ));

        if ($validator->fails())
        {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        }else{

            $restaurants = $this->restaurants;
            $device_token = $request->device_token;
            $device_type = $request->device_type;
            $email = $request->email;

            //$password = $this->encrypt_password($request->password);
            $data = $restaurants::where('email',$email)->where('org_password',$request->password)->first();

            if(count($data)!=0)
            {

            $authId = $data->id;
            $image = $data->image?RESTAURANT_UPLOADS_PATH.$data->image:"";
            if($data->restaurant_name!=NULL)
            {
            $name = $data->restaurant_name;
            }else
            {
                $name="";
            } 

            $email = $data->email?$data->email:"";
            $phone = $data->phone;

            $authToken =$this->generateRandomString();

            $restaurants::where('id',$data->id)->update(['device_token'=>$device_token,'authToken'=>$authToken, 'device_type'=>$device_type, 'is_loggedin'=>1]);

            $response_array = array('status' => true,'message' => 'Logged in successfully','authId'=>$authId,'authToken'=>$authToken,'phone'=>$phone,'profile_image'=>$image,'email'=>$email,'name'=>$name);

            }else
            {
            $response_array = array('status' => false,'message' => 'Invalid Login');
            }
        }

        $response = response()->json($response_array, 200);
        return $response;
    }



    /** 
    * To get order list based on status
    *
    * @param object $request, int $type
    *
    * @return json $response
    */
    public function order_list(Request $request)
    {
        $restaurant_id = $request->header('authId') ?: $request->authId;

        if($request->type==1) $status = [0]; // New
        if($request->type==2) $status = [1,2,3,4,5,6]; // Inprogress   
        if($request->type==3) $status = [7]; // Delivered

        $query = $this->foodrequest->where('restaurant_id',$restaurant_id)
                                ->whereIn('status',$status);
        $limit = PAGINATION;
        $page = isset($request->page)?$request->page:1;
        $offset = ($page - 1) * $limit;
        $query = $query->when(($limit!='-1' && isset($offset)), 
                    function($q) use($limit, $offset){
                        return $q->offset($offset)->limit($limit);
                    });
        $data = $query->get();

        $order_list = array();
        //dd($data);
        foreach($data as $key) 
        {
            $order_list_detail=array();
            foreach($key->Requestdetail as $k)
            {
                $add_ons=array();
                if(!empty($k->Addons)){
                    foreach($k->Addons as $addon){
                        $add_ons[] = array(
                            'id' => $addon->id,
                            'restaurant_id' => $addon->restaurant_id,
                            'name' => $addon->name,
                            'price' => $addon->price,
                            'created_at' => date("Y-m-d H:i:s",strtotime($addon->created_at)),
                            'updated_at' => date("Y-m-d H:i:s",strtotime($addon->updated_at)),
                        );
                    }
                }
                $food_quantity=array();
                if(!empty($k->FoodQuantity)){
                    foreach($k->FoodQuantity as $qty){
                        $food_quantity[] = array(
                            'id' => isset($qty->id)?$qty->id:'',
                            'name' => (isset($qty->name)?$qty->name:''),
                            'price' => $k->food_quantity_price,
                            'created_at' => isset($qty->created_at)?date("Y-m-d H:i:s",strtotime($qty->created_at)):'',
                            'updated_at' => isset($qty->updated_at)?date("Y-m-d H:i:s",strtotime($qty->updated_at)):'',
                        );
                    }
                }
                $order_list_detail[] = array(
                    'food_id'=>(!empty($k->Foodlist)?$k->Foodlist->id:""),
                    'food_name'=>(!empty($k->Foodlist)?$k->Foodlist->name:""),
                    'food_quantity'=>$k->quantity,
                    'tax' => (!empty($k->Foodlist)?$k->Foodlist->tax:""),
                    'item_price'=>(!empty($k->Foodlist)?$k->Foodlist->price:0) * $k->quantity,
                    'is_veg'=>(!empty($k->Foodlist)?$k->Foodlist->is_veg:""),
                    'food_size'=>$food_quantity,
                    'add_ons' => $add_ons
                );
            }
            $order_list[] = array(
                'request_id'=>$key->id,
                'order_id'=>$key->order_id,
                'ordered_on'=>$key->ordered_time,
                'bill_amount'=>$key->bill_amount,
                'item_list'=>$order_list_detail,
                'item_total'=>$key->item_total,
                'offer_discount'=>$key->offer_discount,
                'restaurant_discount'=>$key->restaurant_discount,
                'restaurant_packaging_charge'=>$key->restaurant_packaging_charge,
                'tax'=>$key->tax,
                'status'=>$key->status,
                'delivery_charge'=>$key->delivery_charge,
                'delivery_address'=>$key->delivery_address,
                'delivery_type' => $key->delivery_type,
                'total_members' => $key->total_members,
                'pickup_dining_time' => $key->pickup_dining_time
            );

        }
        if(count($data)!=0)
        {
            $response_array = array('status' => true,'order_list'=>$order_list);
        }else
        {
            $response_array = array('status' => false,'message'=>'No Orders Placed');
        }

        $response = response()->json($response_array, 200);
        return $response;

    }



    /** 
    * Update status for orders
    *
    * @param int $id, int $status, object $request
    *
    * @return json $response
    */
    public function status_update($request_id,$status,Request $request)
    {
        //status = 1 => accept
        //status = 10 => cancel
        //status = 2 => assign

        if($request->header('authId')!="")
        {
            $restaurant_id = $request->header('authId');
        }else
        {
            $restaurant_id = $request->authId;
        }
        $trackorderstatus = $this->trackorderstatus;
        $orderdet = $this->foodrequest->find($request_id);
        if(empty($orderdet))
        {
            $response_array = array('status' => false,'message' => "Invalid request ID");
            $response = response()->json($response_array, 200);
            return $response;
        }
        if($status==1)
        {
            if($orderdet->status>=1)
            {
                $response_array = array('status' => false,'message' => "Request already accepted");
                $response = response()->json($response_array, 200);
                return $response;
            }
            $this->foodrequest->where('id',$request_id)->update(['status'=>1]);

            // $status_entry[] = array(
            //         'request_id'=>$request_id,
            //         'status'=>1,
            //         'detail'=>"Order Accepted by Restaurant"
            //     );
            // $trackorderstatus->insert($status_entry);

            $trackorderstatus->request_id = $request_id;
            $trackorderstatus->status = 1;
            $trackorderstatus->detail = "Order Accepted by Restaurant";
            $trackorderstatus->save();
            
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
            $message = "Request accepted successfully";
        }elseif($status == 2)
        {
            if($orderdet->status>2)
            {
                $response_array = array('status' => false,'message' => "Request already inprogress");
                $response = response()->json($response_array, 200);
                return $response;
            }
            $restuarant_detail = $this->restaurants->where('id',$restaurant_id)->first();
            $source_lat = $restuarant_detail->lat;
            $source_lng = $restuarant_detail->lng;

            $data = file_get_contents(FIREBASE_URL."/available_providers/.json");
            $data = json_decode($data);
            // var_dump($data); exit;
            $temp_driver = $last_distance = $old_provider = 0;
            if($data != NULL && $data !="")
            {
                foreach ($data as $key => $value) 
                {
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
                    if(count($check)!=0)
                    {
                        if($old_provider==0){
                            $old_provider = -1;
                        }
                        if($driver_id != $old_provider)
                        {
                            if ($value != NULL && $value != "")
                            {
                                $driver_lat = $value->lat;
                                $driver_lng = $value->lng;
                                try {
                                    $q = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$source_lat,$source_lng&destinations=$driver_lat,$driver_lng&mode=driving&sensor=false&key=".GOOGLE_API_KEY;
                                    $json = file_get_contents($q); 
                                    $details = json_decode($json, TRUE);

                                    // var_dump($details); exit;
                                    if(isset($details['rows'][0]['elements'][0]['status']) && $details['rows'][0]['elements'][0]['status'] != 'ZERO_RESULTS'){
                                        $current_distance_with_unit = $details['rows'][0]['elements'][0]['distance']['text'];
                                        $current_distance = (float)$details['rows'][0]['elements'][0]['distance']['text'];
                                        $unit =str_after($current_distance_with_unit, ' ');
                                        if($unit == 'm')
                                        {
                                            $current_distance = $current_distance/1000;
                                        }
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
                                }catch(Exception $e){
                                }
                            }
                        }
                    }
                }
            }
            
            if ($temp_driver != 0 ) {
                # code...
                $ins_data = array();
                $user_data = $this->foodrequest->where('id',$request_id)->first();

                $this->foodrequest->where('id',$request_id)->update(['delivery_boy_id'=>$temp_driver,'status'=>2]);
            
                $check_status = $trackorderstatus->where('request_id',$request_id)->where('status',2)->count();
                if($check_status==0)
                {
                    // $status_entry[] = array(
                    //     'request_id'=>$request_id,
                    //     'status'=>2,
                    //     'detail'=>"Food is being prepared"
                    // );

                    // $trackorderstatus->insert($status_entry);

                    $trackorderstatus->request_id = $request_id;
                    $trackorderstatus->status = 2;
                    $trackorderstatus->detail = "Food is being prepared";
                    $trackorderstatus->save();
            
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
                    $message = "Request assigned successfully";
                }else
                {
                    $message = "No Providers Available";
                }
            }else
            {
                $message = "No Providers Available";
            }
        }elseif($status == 7)
        {
            if($orderdet->status==7)
            {
                $response_array = array('status' => false,'message' => "Request already completed");
                $response = response()->json($response_array, 200);
                return $response;
            }
            $this->foodrequest->where('id',$request_id)->update(['status'=>7,'is_paid'=>1]);
		    // $status_entry[] = array(
            //     'request_id'=>$request_id,
            //     'status'=>7,
            //     'detail'=>"Order Completed by Restaurant"
            // );
            // $this->trackorderstatus->insert($status_entry);

            $trackorderstatus->request_id = $request_id;
            $trackorderstatus->status = 7;
            $trackorderstatus->detail = "Order Completed by Restaurant";
            $trackorderstatus->save();
        }else
        {
            if($orderdet->status==10)
            {
                $response_array = array('status' => false,'message' => "Request already cancelled");
                $response = response()->json($response_array, 200);
                return $response;
            }elseif($orderdet->status>=2)
            {
                $response_array = array('status' => false,'message' => "Request already assigned");
                $response = response()->json($response_array, 200);
                return $response;
            }
            $this->foodrequest->where('id',$request_id)->update(['status'=>$status]);
            $message = "Order Cancelled by Restaurant";
			// $status_entry[] = array(
			// 						'request_id' => $request_id,
			// 						'status' => $status,
			// 						'detail' => $message
			// 				);

            // $trackorderstatus->insert($status_entry);
            
            $trackorderstatus->request_id = $request_id;
            $trackorderstatus->status = $status;
            $trackorderstatus->detail = $message;
            $trackorderstatus->save();

            $message = "Request rejected successfully";
        }
        

        $response_array = array('status' => true,'message' => $message);

        $response = response()->json($response_array, 200);
        return $response;
    }


    /**
     * Logout from vendor app
     * 
     * @param object $request
     * 
     * @return json $response
     */
    public function logout(Request $request)
    {
        if($request->header('authId')!="")
        {
            $restaurant_id = $request->header('authId');
        }else
        {
            $restaurant_id = $request->authId;
        }
        $restaurantdet = $this->restaurants->find($restaurant_id);
        if(empty($restaurantdet))
        {
            $response_array = array('status' => false,'message' => "Invalid authid");
            $response = response()->json($response_array, 200);
            return $response;
        }
        $restaurantdet->device_type='';
        $restaurantdet->device_token='';
        $restaurantdet->is_loggedin=0;
        $restaurantdet->authToken='';
        $restaurantdet->save();

        $response_array = array('status' => true,'message' => 'Logout successfully');
        $response = response()->json($response_array, 200);
        return $response;
    }


}