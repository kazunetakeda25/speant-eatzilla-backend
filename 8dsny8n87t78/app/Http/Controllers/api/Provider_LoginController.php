<?php

namespace App\Http\Controllers\api;
                                    
use Validator;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController;
use Log;

class Provider_LoginController extends BaseController
{
	    public function get_profile(Request $request)
    {
        # code...
        $partner_id = $request->header('authId');
         $data = $this->deliverypartners->where('id',$partner_id)->first();
        // echo $data->Deliverypartner_detail->address_line_1; exit;
        // print_r($data); exit;
        $ratings = $this->order_ratings->with('Foodrequest')
                        ->wherehas('Foodrequest',function($q) use($partner_id){
                            $q->where('delivery_boy_id', $partner_id);
                            })
                        ->avg('restaurant_rating');
        $partner_rating = round($ratings,1);
        $response_array = array(
            'status'=>true,
            'id'=>$data->id,
            'partner_id'=>$data->partner_id,
            'name'=>$data->name,
            'phone'=>$data->phone,
            'address'=>isset($data->Deliverypartner_detail)?$data->Deliverypartner_detail->address_line_1:"",
            'profile_pic'=>DRIVER_IMAGE_PATH.$data->profile_pic,
            'driving_license_no'=>$data->driving_license_no,
            'service_zone'=>isset($data->Deliverypartner_detail->Citylist)?$data->Deliverypartner_detail->Citylist->city:"",
            'is_approved'=>$data->status,
            'joining_date'=>date("d-m-Y",strtotime($data->created_at)),
            'bank_name'=>isset($data->Deliverypartner_detail)?$data->Deliverypartner_detail->bank_name:"",
            "acc_no"=>isset($data->Deliverypartner_detail)?$data->Deliverypartner_detail->account_no:"",
            "ifsc_code"=>isset($data->Deliverypartner_detail)?$data->Deliverypartner_detail->ifsc_code:"",
            'rating'=>$partner_rating,
            'city'=>isset($data->Deliverypartner_detail->Citylist)?$data->Deliverypartner_detail->Citylist->city:"",
            'earnings'=>1500.00
        );
   
       // $response_array = array('status'=>true,'data'=>$provider);
       $response = response()->json($response_array, 200);
        return $response;
    }

    public function send_otp_login(Request $request)
    {
        $phone = (string) $request->phone;
                $otp = rand(10000,99999);
                $message = 'OTP to verify '.APP_NAME.' Application : '.$otp;
                $sendSms = $this->send_otp($phone,$otp);

        $response_array = array('status'=>true,'message'=>'OTP sent successfully','otp'=>$otp);

        $response = response()->json($response_array, 200);
        return $response;
    }

    	public function provider_login(Request $request)
    {

           $validator = Validator::make(
                $request->all(),
                array(
                    'device_token' => 'required',
                    'phone' => 'required',
                    'password' => 'required'
                ));

        if ($validator->fails())
        {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        }else
        {
            $deliverypartners = $this->deliverypartners;
            $device_token = $request->device_token;
            $device_type = $request->device_type;
            
                $phone = $request->phone;
                $password = $this->encrypt_password($request->password);
                // $phone = $this->str_replace_first("+1","",$phone);
                // $phone = $this->str_replace_first("1","",$phone);
           

                 $data = $deliverypartners::where('phone',$phone)->where('password',$password)->first();

                  if(count($data)!=0)
                  {

                    $authId = $data->id;
                    $profile_image = $data->profile_image;
                    if($profile_image==NULL || $profile_image=="")
                    {
                    	$profile_image = BASE_URL.PROFILE_ICON;
                    }
                    if($data->name!=NULL)
                    {
                    $name = $data->name;
                    }else
                    {
                        $name="";
                    } 

                    $authToken =$this->generateRandomString();

                    $partner_id = $data->partner_id;

                    $deliverypartners::where('id',$data->id)->update(['device_type'=>$device_type, 'device_token'=>$device_token,'authToken'=>$authToken]);

                    $response_array = array('status' => true,'message' => 'Logged in successfully','authId'=>$authId,'authToken'=>$authToken,'phone'=>$phone,'profile_image'=>$profile_image,'email'=>"",'user_name'=>$name,'partner_id'=>$partner_id);

                  }else
                  {
                    $response_array = array('status' => false,'message' => 'Invalid Login');
                  }
            
        }

        $response = response()->json($response_array, 200);
        return $response;
    }
    

    public function update_profile(Request $request)
    {
        # code... profile_update

        $deliverypartners = $this->deliverypartners;
        $custom = $this->custom;
        $update = array();
        $data = $deliverypartners::where('id',$request->id)->first();

        if ($request->name) {
            $update['name'] = $request->name;
        }
        if ($request->email) {
            $update['email'] = $request->email;
        }
        if($request->password)
        {
            $update['password'] = $this->encrypt_password($request->password);
        }
        // if ($request->address) {
        //     $update['lat'] = $request->lat;
        // }
        // if ($request->address) {
        //     $update['lng'] = $request->lng;
        // }
        // if ($request->address) {
        //     $update['address'] = $request->address;
        // }
        // if ($request->city) {
        //     $update['city'] = $request->city;
        // }


        // if ($request->profile_image) {
        //     if ($data->profile_image != "") {
        //         $custom::delete_image($data->profile_image);
        //     }
        //    $profile_pic = $custom::upload_image($request,'profile_image');
        //     $update['profile_image'] = BASE_URL.$profile_pic;
        // }
        
        $deliverypartners::where('id',$request->id)->update($update);
        
        $data = $deliverypartners::where('id',$request->id)->first();
        // $data = $this->check_null($data)->toArray();
        $response_array = array('status'=>true,'message'=>'Profile updated successfully','data'=>$data);
        $response = response()->json($response_array, 200);
        return $response;
    }

    public function forgot_password(Request $request)
    {
         $validator = Validator::make(
                $request->all(),
                array(
                    'phone' => 'required'
                ));

        if ($validator->fails())
        {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        }else
        {
            $phone = $request->phone;

            $deliverypartners = $this->deliverypartners;

            Log::info('forgot password'.$phone);
            $check_user = $deliverypartners::where('phone',$phone)->first();

            if(count($check_user)!=0)
            {
                $phone = (string) $request->phone;
                $otp = rand(10000,99999);
                $message = 'OTP to verify '.APP_NAME.' Application : '.$otp;
                $sendSms = $this->send_otp($phone,$otp);

            $response_array = array('status'=>true,'message'=>'OTP sent successfully','otp'=>$otp);
            }else
            {
                $response_array = array('status'=>false,'message'=>'Mobile number not registered');
            }
        }

         $response = response()->json($response_array, 200);
        return $response;

    }

    public function reset_password(Request $request)
    {

         $validator = Validator::make(
                $request->all(),
                array(
                    'password' => 'required',
                    'phone' => 'required'
                ));

        if ($validator->fails())
        {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        }else
        {
            $password = $this->encrypt_password($request->password);
            $phone = $request->phone;
            $deliverypartners = $this->deliverypartners;
             $phone = $this->str_replace_first("+1","",$phone);
             $phone = $this->str_replace_first("1","",$phone);

            $get_user = $deliverypartners::where('phone','like','%'.$phone.'%')->first();

            $deliverypartners::where('phone','like','%'.$phone.'%')->update(['password'=>$password]);

            $response_array = array('status'=>true,'message'=>'Password Reset Successfull');
        }

        $response = response()->json($response_array, 200);
        return $response;

    }


    /**
     * API for earnings based on daily
     * 
     * @param object $request
     * 
     * @return json $response
     */
    public function today_earnings(Request $request)
    {
        $user_id = $request->header('authId');
        $foodrequest = $this->foodrequest;
        $today_date = new \DateTime();
        $date = ((isset($request->filter_date) && $request->filter_date!='')) ? new \DateTime($request->filter_date) : $today_date;
        
        //get daily total earnings        
        $today_earnings = $foodrequest::where('delivery_boy_id',$user_id)
                            ->whereBetween('ordered_time',[$date->format('Y-m-d')." 00:00:00", $date->format('Y-m-d')." 23:59:59"])
                            ->where('is_paid',1)
                            ->sum('bill_amount');
        $today_incentives = $foodrequest::where('delivery_boy_id',$user_id)
                            ->whereBetween('ordered_time',[$date->format('Y-m-d')." 00:00:00", $date->format('Y-m-d')." 23:59:59"])
                            ->where('is_paid',1)
                            ->sum('delivery_boy_commision'); 

        $response_array = array('status'=>true,'today_earnings'=>$today_earnings,'today_incentives'=>
                            $today_incentives);
        $response = response()->json($response_array, 200);
        return $response;
    }



    /**
     * API for weekly earnings
     * 
     * @param object $request
     * 
     * @return json $response
     */
    public function weekly_earnings(Request $request)
    {
        $user_id = $request->header('authId');
        $foodrequest = $this->foodrequest;
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        $date = ((isset($request->filter_date) && $request->filter_date!='')) ? $request->filter_date : Carbon::now();

        //get weekly earnings
        $weekly_earnings  = $foodrequest->where('delivery_boy_id',$user_id)->where('is_paid',1)
                                    ->whereBetween('ordered_time',[Carbon::parse($date)->startOfWeek(),Carbon::parse($date)->endOfWeek()])
                                    ->sum('bill_amount');
        $weekly_incentives  = $foodrequest->where('delivery_boy_id',$user_id)->where('is_paid',1)
                                    ->whereBetween('ordered_time',[Carbon::parse($date)->startOfWeek(),Carbon::parse($date)->endOfWeek()])
                                    ->sum('delivery_boy_commision');
        $graph_data = $foodrequest->where('delivery_boy_id',$user_id)->where('is_paid',1)
                            ->whereBetween('ordered_time',[Carbon::parse($date)->startOfWeek(),Carbon::parse($date)->endOfWeek()])
                            ->select(array(DB::Raw('sum(bill_amount) as total_amount'),DB::Raw('count(id) as total_orders'),DB::Raw('DATE(ordered_time) day')))
                            ->groupBy('day')
                            ->get();
        $response_array = array('status'=>true,'weekly_earnings'=>round($weekly_earnings,2),'weekly_incentives'=>
                            round($weekly_incentives,2),'graph_data'=>$graph_data);

        $response = response()->json($response_array, 200);
        return $response;
    }


    /**
     * API for monthly earnings
     * 
     * @param object $request
     * 
     * @return json $response
     */
    public function monthly_earnings(Request $request)
    {
        $user_id = $request->header('authId');
        $foodrequest = $this->foodrequest;
        $date = ((isset($request->filter_date) && $request->filter_date!='')) ? $request->filter_date : Carbon::now();

        //get weekly earnings
        $monthly_earnings  = $foodrequest->where('delivery_boy_id',$user_id)->where('is_paid',1)
                                    ->whereBetween('ordered_time',[Carbon::parse($date)->startOfMonth(),Carbon::parse($date)->endOfMonth()])
                                    ->sum('bill_amount');
        $monthly_incentives  = $foodrequest->where('delivery_boy_id',$user_id)->where('is_paid',1)
                                    ->whereBetween('ordered_time',[Carbon::parse($date)->startOfMonth(),Carbon::parse($date)->endOfMonth()])
                                    ->sum('delivery_boy_commision');
        $graph_data = $foodrequest->where('delivery_boy_id',$user_id)->where('is_paid',1)
                            ->whereBetween('ordered_time',[Carbon::parse($date)->startOfMonth(),Carbon::parse($date)->endOfMonth()])
                            ->select(array(DB::Raw('sum(bill_amount) as total_amount'),DB::Raw('count(id) as total_orders'),DB::Raw('DATE(ordered_time) day')))
                            ->groupBy('day')
                            ->get();
        $response_array = array('status'=>true,'monthly_earnings'=>round($monthly_earnings,2),'monthly_incentives'=>
                            round($monthly_incentives,2),'graph_data'=>$graph_data);

        $response = response()->json($response_array, 200);
        return $response;
    }


    /**
     * delivery boy logout
     * 
     * @param object $request
     * 
     * @return json $response
     */
    public function logout(Request $request)
    {
        $user_id = $request->header('authId');
        $deliverypartners = $this->deliverypartners;
        $deliverypartners::where('id','=',$user_id)->update(['authToken'=>0]);

        $response_array = array('status'=>true,'message'=>'Logged Out Successfully');
        $response = response()->json($response_array, 200);
        return $response;
    }


    /**
     * API for driver payout
     * 
     * @param object $request
     * 
     * @return json $response
     */
    public function payout_details(Request $request)
    {
        $user_id = $request->header('authId');

        if($user_id=='')
        {
            $error_messages = "AuthID should not be empty";
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        }
        //get payout history
        $payout_history  = $this->driver_payout_history->where('delivery_boy_id', $user_id)
                                        ->orderBy('created_at','desc')->limit(5)->get();
                            
         $pending_amount = $this->deliverypartners->where('id', $user_id)
                                   ->first();

        $response_array = array('status'=>true,'pending_payout'=> round($pending_amount->pending_payout,2),'payout_history'=>$payout_history);
        $response = response()->json($response_array, 200);
        return $response;
    }

    public function get_provider_timeout()
    {
        $settings = $this->settings;

        $check =  $settings->where('key_word','provider_timeout')->first();

        $response_array = array('status'=>true,'provider_timeout'=> $check->value);
        $response = response()->json($response_array, 200);
        return $response;

    }


    /** check provider ideal time and make then offline
     * 
     */
    public function check_ideal_drivers()
    {
        $data = file_get_contents(FIREBASE_URL."/available_providers/.json");
        $data = json_decode($data);
        print_r($data);
        if($data != NULL && $data !="")
        {
            foreach ($data as $key => $value) 
            {
                $driver_id = $key;
                $check = $this->deliverypartners::where('id',$driver_id)->where('status',1)->count();
                $check_request = $this->foodrequest->where('delivery_boy_id',$driver_id)->whereNotIn('status',[7,9,10])->count();
                if($check!=0)
                { 
                    if($check_request!=0)
                    { 
                        $result = $this->delete_firebase_node('available_providers',$driver_id);
                        $postdata = array();
                        $postdata['status'] = 0;
                        $postdata = json_encode($postdata);
                        $this->update_firebase($postdata, 'providers_status', $driver_id);
                    }else
                    {
                        $updated_time = isset($value->updated_at)?$value->updated_at:date("Y-m-d H:i:s");
                        $dt = new Carbon($updated_time);
                        $last_updated_time = $dt->addMinutes(IDEAL_TIME); 
                        $current_time = date("Y-m-d H:i:s");
                        if(strtotime($last_updated_time) < strtotime($current_time))
                        {
                            $result = $this->delete_firebase_node('available_providers',$driver_id);
                            $postdata = array();
                            $postdata['status'] = 0;
                            $postdata = json_encode($postdata);
                            $this->update_firebase($postdata, 'providers_status', $driver_id);
                        }
                    }
                }else
                {
                    $result = $this->delete_firebase_node('available_providers',$driver_id);
                    $postdata = array();
                    $postdata['status'] = 0;
                    $postdata = json_encode($postdata);
                    $this->update_firebase($postdata, 'providers_status', $driver_id);
                }
            }
        }

    }


    /**
     * check orders that driver not updated the status above notification time
     */
    public function check_ideal_orders()
    {
        $dt = Carbon::now();
        echo $last_updated_time = $dt->subSeconds(NOTIFICATION_TIME);
        $check_request = $this->foodrequest->where('status',2)->where('updated_at','<',$last_updated_time)->get();
        //print_r($check_request);
        if(count($check_request)!=0)
        {
            foreach($check_request as $value)
            {
                // delete request to driver 
                $temp_driver = $provider_id = $value->delivery_boy_id;
                echo "request:".$request_id = $value->id;
                $restaurant_id = $value->restaurant_id;
                $header = array();
                $header[] = 'Content-Type: application/json';
                $postdata = array();
                $postdata['request_id'] = $request_id;
                $postdata['user_id'] = $value->user_id;
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

                $restuarant_detail = $this->restaurants::where('id',$restaurant_id)->first();
                $source_lat = $restuarant_detail->lat;
                $source_lng = $restuarant_detail->lng;
                
                $data = file_get_contents(FIREBASE_URL."/available_providers/.json");
                $data = json_decode($data);
                print_r($data);
                $temp_driver = $old_provider = 0;
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
                                            $q = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$source_lat,$source_lng&destinations=$driver_lat,$driver_lng&mode=driving&sensor=false&key=AIzaSyCGX6aGjOeMptlBNc0WF3vhm0SPMl1vNBE";
                                            $json = file_get_contents($q); 
                                            $details = json_decode($json, TRUE);

                                            // var_dump($details); exit;
                                            if($details['rows'][0]['elements'][0]['status'] != 'ZERO_RESULTS'){
                                                $current_distance = (float) $details['rows'][0]['elements'][0]['distance']['text'];

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
                                        } catch (Exception $e) {
                                            
                                        }
                                    }
                                }
                            }
                        }
                        //print_r($value->lat); exit;
                    }
                }
                //end if and forloop
                
                //check driver and send request
                echo "driver:".$temp_driver;
                if ($temp_driver != 0 ) 
                {
					$user_data = $this->foodrequest->find($request_id);
					$user_data->delivery_boy_id = $temp_driver;
					$user_data->status = 2;
					$user_data->save();
				
					// to insert into firebase
					$header = array();
					$header[] = 'Content-Type: application/json';
					$postdata = array();
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

                } else 
                {
					$title = "No Providers available";

					$user_data = DB::table('requests')
								->where('id',$request_id)
								->first();

					DB::table('requests')->where('id',$request_id)->update(['delivery_boy_id'=>0,'status'=>1]);

					// to insert into firebase
					$header = array();
					$header[] = 'Content-Type: application/json';
					$postdata = array();
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
					$this->update_firebase($postdata, 'restaurant_request/'.$restaurant_id, $request_id);

                }
                //end condition
            }
        }
    }

	
}