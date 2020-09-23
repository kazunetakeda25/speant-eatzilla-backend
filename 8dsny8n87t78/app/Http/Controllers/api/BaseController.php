<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Users;
use App\Model\UserCredit;
use App\Model\Admin;
use App\Model\Deliverypartners;
use App\Model\Cuisines;
use App\Model\Restaurantcuisines;
use App\Model\Deliveryaddress;
use App\Model\Restaurants;
use App\Model\Favouritelist;
use App\Model\Popularbrands;
use App\Model\Foodlist;
use App\Model\Foodrequest;
use App\Model\Requestdetail;
use App\Model\Trackorderstatus;
use App\Model\Cart;
use App\Model\Category;
use App\Model\Menu;
use App\Model\Banner;
use App\Model\Promocode;
use App\Model\Settings;
use App\Model\Addcity;
use App\Model\Addarea;
use App\Model\Document;
use App\Model\Vehicle;
use App\Model\CancellationReason;
use App\Model\DriverList;
use App\Model\Coupon;
use App\Model\Food;
use App\Model\Add_ons;
use App\Model\FoodQuantity;
use App\Model\Chat_message;
use App\Model\RequestdetailAddons;
use App\Model\RestaurantBankDetails;
use App\Model\DriverPayoutHistory;
use App\Model\RestaurantPayoutHistory;
use App\Model\OrderRatings;
use App\Model\Country;
use App\Model\State;
use App\Model\Deliverypartner_detail;
use App\Model\Foodlist_Addons;
use App\Model\Cms;
use App\Model\RestaurantTimer;
use App\Model\AccessPrivilages;
use App\Library\Custom;
use App\Library\Validators;
use Twilio\Rest\Client;
use App\Library\pointLocation;
use URL;
use Mail;
use View;
use Log;

if (!defined('BASE_URL')) define('BASE_URL',URL::to('/').'/');
if (!defined('BASE_AWS')) define('BASE_AWS','https://boxfood-imageupload.s3.ap-south-1.amazonaws.com/');
if (!defined('PROFILE_ICON')) define('PROFILE_ICON','profile_icon.png');
//if (!defined('RESTAURANT_UPLOADS_PATH')) define('RESTAURANT_UPLOADS_PATH','public/restaurant_uploads/');
if (!defined('RESTAURANT_UPLOADS_PATH')) define('RESTAURANT_UPLOADS_PATH',BASE_AWS.'restaurant_uploads/');
//if (!defined('VEHICLE_UPLOADS_PATH')) define('VEHICLE_UPLOADS_PATH','public/vehicles/');
if (!defined('VEHICLE_UPLOADS_PATH')) define('VEHICLE_UPLOADS_PATH',BASE_AWS.'vehicles/');
if (!defined('UPLOADS_PATH')) define('UPLOADS_PATH',BASE_AWS.'uploads/');
if (!defined('UPLOADS_EMAIL_PATH')) define('UPLOADS_EMAIL_PATH','public/email/');
//if (!defined('UPLOADS_PATH')) define('UPLOADS_PATH','public/uploads/');
//if (!defined('DRIVER_IMAGE_PATH')) define('DRIVER_IMAGE_PATH','public/uploads/Profile/');
//if (!defined('FOOD_IMAGE_PATH')) define('FOOD_IMAGE_PATH','public/uploads/product/');
if (!defined('DRIVER_IMAGE_PATH')) define('DRIVER_IMAGE_PATH',BASE_AWS.'uploads/Profile/');
if (!defined('FOOD_IMAGE_PATH')) define('FOOD_IMAGE_PATH',BASE_AWS.'uploads/product/');
if (!defined('PROMO_IMAGE_PATH')) define('PROMO_IMAGE_PATH','public/promo_images/');
if (!defined('WEB')) define('WEB',   'web');
if (!defined('ANDROID')) define('ANDROID',   'android');
if (!defined('IOS')) define('IOS',   'ios');
if (!defined('PAGINATION')) define('PAGINATION',   10);

class BaseController extends Controller
{

	 public function __construct(UserCredit $user_credit, Request $request, Admin $admin, Users $users,Custom $custom,Cuisines $cuisines,Deliveryaddress $deliveryaddress,Restaurants $restaurants,Favouritelist $favouritelist,Popularbrands $popularbrands,Foodlist $foodlist,Category $category,Menu $menu,Cart $cart,Foodrequest $foodrequest,Requestdetail $requestdetail,Deliverypartners $deliverypartners,Trackorderstatus $trackorderstatus,Promocode $promocode,Banner $banner,Settings $settings,Restaurantcuisines $restaurantcuisines,Addcity $addcity,Addarea $addarea,Document $document,Vehicle $vehicle,CancellationReason $cancellation_reason,DriverList $driver_list,Coupon $coupon,Food $food, Add_ons $add_ons, FoodQuantity $food_quantity, RequestdetailAddons $requestdetail_addons, RestaurantBankDetails $restaurant_bank_details, DriverPayoutHistory $driver_payout_history, RestaurantPayoutHistory $restaurant_payout_history, OrderRatings $order_ratings, Validators $validators,Country $country,State $state,Deliverypartner_detail $delivery_partner_details, Foodlist_Addons $foodlist_addons, Cms $cms, RestaurantTimer $restaurant_timer, AccessPrivilages $access_privilages,Chat_message $chatmessage)
    {
        // $this->validateArrays = $ValidateArrays;
        $this->admin = $admin;
        $this->users = $users;
        $this->user_credit = $user_credit;
        $this->custom = $custom;
        $this->cuisines = $cuisines;
        $this->deliveryaddress = $deliveryaddress;
        $this->restaurants = $restaurants;
        $this->favouritelist = $favouritelist;
        $this->popularbrands = $popularbrands;
        $this->foodlist = $foodlist;
        $this->category = $category;
        $this->menu = $menu;
        $this->cart = $cart;
        $this->banner = $banner;
        $this->promocode = $promocode;
        $this->foodrequest = $foodrequest;
        $this->requestdetail = $requestdetail;
        $this->deliverypartners = $deliverypartners;
        $this->trackorderstatus = $trackorderstatus;
        $this->settings = $settings;
        $this->restaurantcuisines = $restaurantcuisines;
        $this->addcity = $addcity;
        $this->addarea = $addarea;
        $this->document = $document;
        $this->vehicle = $vehicle;
        $this->cancellation_reason = $cancellation_reason;
        $this->driver_partner_details = $driver_list;
        $this->coupon = $coupon;
        $this->food = $food;
        $this->add_ons = $add_ons;
        $this->food_quantity = $food_quantity;
        $this->requestdetail_addons = $requestdetail_addons;
        $this->restaurant_bank_details = $restaurant_bank_details;
        $this->driver_payout_history = $driver_payout_history;
        $this->restaurant_payout_history = $restaurant_payout_history;
        $this->order_ratings = $order_ratings;
        $this->validators = $validators;
        $this->country = $country;
        $this->state = $state;
        $this->delivery_partner_details = $delivery_partner_details;
        $this->foodlist_addons = $foodlist_addons;
        $this->cms = $cms;
        $this->restaurant_timer = $restaurant_timer;
        $this->access_privilages = $access_privilages;
        $this->chatmessage = $chatmessage;
        //get site info
        $site_info = $this->settings->get();
        //dd($site_info);
       
    }

        public static function generate_booking_id()
    {
        $booking = Foodrequest::orderBy('id','DESC')->first();
        if (!$booking) {
            $booking_code = ORDER_ID_PREFIX.str_pad(1, 3, "0", STR_PAD_LEFT);
        } else {
            $new_id = $booking->id + 1;
            $booking_code = ORDER_ID_PREFIX.str_pad($new_id, 3, "0", STR_PAD_LEFT);
        }
        return $booking_code;
    }

           public static function generate_partner_id()
    {
        $booking =Deliverypartners::orderBy('id','DESC')->first();
        if (!$booking) {
            $booking_code = 'PAT'.str_pad(1, 5, "0", STR_PAD_LEFT);
        } else {
            $new_id = $booking->id + 1;
            $booking_code = 'PAT'.str_pad($new_id, 5, "0", STR_PAD_LEFT);
        }
        return $booking_code;
    }

    public static function send_otp($NUMBER,$OTP)
    {
        // $NUMBER = substr($NUMBER, 2);
        // // $NAME = "User ";
        // //    $API_KEY = "d37cc8c6-18f7-11e7-9462-00163ef91450";
        // //    $SENDER_ID = "SPRKOT";

        // // $data = "module=TRANS_SMS&apikey=" . $API_KEY . "&to=" . $NUMBER . "&from=" . $SENDER_ID . "&templatename=" . $SENDER_ID . "&var1=" . $NAME . "&var2=" . $OTP;
        // $ch = curl_init('http://roundsms.com/api/sendhttp.php?authkey=YzQ3NGVkZmQ2NDA&mobiles='.$NUMBER.'&message='.$OTP.'&sender=ROUSMS&type=1&route=2');
        // // curl_setopt($ch, CURLOPT_POST, true);
        // // // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $result = curl_exec($ch); // This is the result from the API
        // // //print_r($result);
        // curl_close($ch);
        // return $result;

           $phone = '+'.$NUMBER;

           try
       {

           $sid = "AC8cd4dc54bb17967ad08a98717a3463c3";
           $token = "90b93e46ad1ea5a2656c35564e0009eb";
           $client = new Client($sid, $token);

           $client->messages->create(
               $phone,
               array(
                   'from' => '+16572270050',
                   'body' => $OTP
               )
           );
       }
       catch(\Exception $e)
       {
           Log::error('Twilio SMS:: ' . $e->getMessage());
       }
        return true;
    }

    public static function check_null($data)
    {
        # code...
        array_walk_recursive($data, function (&$item, $key) {
            $item = null === $item ? '' : $item;
        });
        return $data;
    }

    public static function is_near($pickup_lat,$pickup_lng,$user_id)
    {
        $user = Users::where('id',$user_id)->first();
        $distance = Common::get_distance($pickup_lat,$pickup_lng,$user->lat,$user->lng);
        if ($distance < Common::$radius) {
            return $distance;
        } else {
            return false;
        }
        
    }

    public function generateRandomString($length = 16) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	 public function generateRandomString_referral($length = 8) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

      public function str_replace_first($from, $to, $content)
    {
        $from = '/'.preg_quote($from, '/').'/';
        return preg_replace($from, $to, $content, 1);
    }

    public function encrypt_password($password) {

        $key = hash('sha256', 'sparkout');
        $iv = substr(hash('sha256', 'developer'), 0, 16);
        $output = openssl_encrypt($password, "AES-256-CBC", $key, 0, $iv);
        $output2 = base64_encode($output);
        return $output2;
    }

    public function decrypt_password($encrypted_password) {

        $key = hash('sha256', 'sparkout');
        $iv = substr(hash('sha256', 'developer'), 0, 16);
        $output1 = openssl_decrypt(base64_decode($encrypted_password), "AES-256-CBC", $key, 0, $iv);
        return $output1;
    }

    /**
     * to send push notifications
     * 
     * @param array $params
     * 
     */
    public function user_send_push_notification($params) 
    {
        // $device_token = "f_ZXeVPxK5k:APA91bE3FxmrPDQAeTc17j17CHyliLQ3D0iOhnQfsQz4coqyBfeHPYF6zMeJKDfX1wrwLWzp6bAkGCYRQ3Z_VUv0Z6xyUBKurpfXAT4-vJLO_X6PtlIyHE4UtKdZwdsy1ua8c_3V4zRZ";
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields=array();
        if($params['device_type'] == 'android'){
            $fields = array(
                'registration_ids' => array(
                    $params['device_token']
                ),
                'data' => array(
                    "title" => isset($params['title'])?$params['title']:"",
                    "message" => isset($params['message'])?$params['message']:"",
                    'request_id' => isset($params['request_id'])?$params['request_id']:"",
                    'delivery_type' => isset($params['delivery_type'])?$params['delivery_type']:"",
                    'image' => isset($params['image'])?$params['image']:"",
                )
            );
        }
        if($params['device_type'] == 'ios'){
            $fields = array(
                'to' => $params['device_token'],
                'notification' => array(
                        "title" => isset($params['title'])?$params['title']:"",
                        "text" => isset($params['message'])?$params['message']:"",
                        'request_id' => isset($params['request_id'])?$params['request_id']:"",
                        'delivery_type' => isset($params['delivery_type'])?$params['delivery_type']:"",
                        'image' => isset($params['image'])?$params['image']:"",
                ),
                'data'=>array(
                    'request_id' => isset($params['request_id'])?$params['request_id']:""
                ),
            );
        }
        // var_dump($fields);
        $fields = json_encode($fields);
        $headers = array(
            'Authorization: key= '.USER_NOTIFICATION_KEY,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        $result = curl_exec($ch);

        //print_r($result); exit;
        curl_close($ch);

    }

   
    /**
     * to update firebase db in common
     * 
     * @param array $postdata, string $node, string $key
     * 
     */
    public function update_firebase($postdata, $node, $key)
    {
        $header = array();
        $header[] = 'Content-Type: application/json';

        $ch = curl_init(FIREBASE_URL."/".$node."/$key.json");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        $result = curl_exec($ch); 
        curl_close($ch); 

    }


    /**
     * check whether the given date is weekend or not
     * 
     * @param string $date
     * 
     * @return boolean 
     */
    public function isWeekend($date) {
        return (date('N', strtotime($date)) >= 6);
    }


    /**
    * send email notification
    *
    * @param object $requestdata
    *
    */
    public function send_mail($requestdata, $type='')
    {
        $sender_email = isset($requestdata->email)?$requestdata->email:"";
        $sender_name = isset($requestdata->name)?$requestdata->name:"";
        $subject = isset($requestdata->subject)?$requestdata->subject:"";
            
        if($sender_email!=''){
            Mail::send('email.'.$type, array('data'=>$requestdata), function($message) use($sender_email, $subject, $sender_name){
                $message->to($sender_email, $sender_name)->subject
                    ($subject);
                $message->from(EMAIL_USER_NAME,APP_NAME);
            });
        }
    }

    

    /**
     * generate random string
     * 
     * @return string
     */
    public function generate_random_string()
    {
        return rand(11111111,99999999);
    }



    /**
     * Check food offer based on food item
     * 
     * @param object $data
     * 
     * @return string $food_offer
     */
    public function food_offer($data)
    {
        //check food offer
        $food_offer = "";
        if($data->offer_amount!='' && $data->offer_amount!=0){
            if($data->discount_type==1){
                 $food_offer = "Flat offer ".DEFAULT_CURRENCY_SYMBOL." ".$data->offer_amount;
            }else{
                 $food_offer = $data->offer_amount."% offer";
            }
            if($data->target_amount!=0){
                 $food_offer = $food_offer." on orders above ".DEFAULT_CURRENCY_SYMBOL." ".$data->target_amount;
            }
        }
        return $food_offer;
    }



    /**
     * check whether the restaurant opend or closed
     * 
     * @param object $data
     * 
     * @return boolean 
     */
    public function check_restaurant_open($data)
    {
        $is_open = 0;
        $current_time = date('Y-m-d H:i:s');
        $date = date("Y-m-d");
        $is_weekend = $this->isWeekend($date);
        if(!empty($data->RestaurantTimer))
        {
            foreach($data->RestaurantTimer as $value)
            {
                if($is_weekend==true){ 
                    if($value->is_weekend==1)
                    {
                        $opening_time = date("Y-m-d ".$value->opening_time);
                        $closing_time = date("Y-m-d ".$value->closing_time);
                        if(strtotime($value->opening_time) > strtotime($value->closing_time))
                        {        
                            $closing_time = date("Y-m-d ".$value->closing_time);    
                            $closing_time = date("Y-m-d H:i:s", strtotime($closing_time. ' +1 day'));
                        }
                        if((strtotime($opening_time)<=strtotime($current_time)) && (strtotime($closing_time)>=strtotime($current_time))){
                         $is_open = 1;
                        }
                    }  
                   
                }else{ 
                    if($value->is_weekend==0)
                    {
                        $opening_time = date("Y-m-d ".$value->opening_time); 
                        $closing_time = date("Y-m-d ".$value->closing_time);
                        if(strtotime($value->opening_time) > strtotime($value->closing_time))
                        {
                            $closing_time = date("Y-m-d ".$value->closing_time);
                            $closing_time = date("Y-m-d H:i:s", strtotime($closing_time. ' +1 day'));
                        }
                        if((strtotime($opening_time)<=strtotime($current_time)) && (strtotime($closing_time)>=strtotime($current_time))){
                            $is_open = 1;  
                        }
                    }
                }
            }
        }
        return $is_open;
    }



    /**
     * get distance and time based on user source and restaurant
     * 
     * @param string $source, string $destination
     * 
     * @return array $getdata
     */
    public function getGoogleDistance($source, $destination,$type=0)
    {
        $key = GOOGLE_API_KEY;
        
        // $start = implode(',', $start);
        // $finish = implode(',', $finish);
        # API hit function
        $url = "https://maps.googleapis.com/maps/api/directions/json?origin=".$source."&destination=".$destination."&sensor=false&mode=driving&alternatives=true&language=null&key=".$key;
            
        $file = file_get_contents($url);
        $arr_conversion = json_decode($file);

        if(isset($arr_conversion->status) && $arr_conversion->status=='OK'){
            $data = $arr_conversion->routes[0]->legs[0];
            //$data[0] = round(($data->distance->value)/1000, 2);
            if($type==1){
                $getdata[0] = round(($data->distance->value)/1000, 2);
                $getdata[1] = $data->duration->value;
            }else{
                $getdata[0] = $data->distance->text;
                $getdata[1] = $data->duration->text;
            }
        }else{
            $distance = $this->find_Haversine($source, $destination);
            if($type==1)
                $getdata[0] = $distance;
            else
                $getdata[0] = $distance." km";

            $getdata[1]="";
        }
        return $getdata;
    }
    
    
    /**
     * calculate driver commission
     * 
     * @param object $data, string $source, string $destination
     * 
     * @return array $result
     */
    public function calculate_driver_commission($data, $source, $destination)
    {
        if(isset($data) && $data->driver_base_price!=0)
        {
            $base_price = $data->driver_base_price;
            $base_distance = $data->min_dist_base_price;
            $extra_fee = $data->extra_fee_amount;
            //get distance based on goole api
            $getdistance = $this->getGoogleDistance($source, $destination,1);
            $distance = $getdistance[0];
            $extra_charge=0;
            if($distance!='' && $distance>$base_distance){
                $extra_charge = ($distance-$base_distance)*$extra_fee;
            }
            $delivery_boy_commission = $base_price + $extra_charge;
        }else
        {
            $delivery_boy_commission = 0;
            $distance = 0;
        }
        $result = array(
                'distance' => $distance,
                'delivery_boy_commission' => $delivery_boy_commission
            );
        return $result;
    }


    /**
     * calculate delivery charge
     * 
     * @param object $data, string $source, string $destination
     * 
     * @return float $delivery_boy_commission
     */
    public function calculate_deliver_charge($data, $source, $destination)
    {
        if(isset($data) && $data->default_delivery_amount!=0)
        {
            $base_price = $data->default_delivery_amount;
            $base_distance = $data->min_dist_delivery_price;
            $extra_fee = $data->extra_fee_deliveryamount;
            //get distance based on goole api
            $distance = $this->getGoogleDistance($source, $destination,1);
            $extra_charge=0;
            if($distance[0]!='' && $distance[0]>$base_distance){
                $extra_charge = ($distance[0]-$base_distance)*$extra_fee;
            }
            $delivery_charge = $base_price + $extra_charge;
        }else
        {
            $delivery_charge = 0;
        }
        return $delivery_charge;
    }


    /**
     * Find distance from source and destination based on havesine method
     * 
     * @param string $source, string $destination
     * 
     * @return decimal $distance
     */
    public function find_Haversine($source, $destination)
    {
        $start = explode(',',$source);
        $finish = explode(',',$destination);
        $theta    = $start[1] - $finish[1];
        $distance = (sin(deg2rad($start[0])) * sin(deg2rad($finish[0]))) + (cos(deg2rad($start[0])) * cos(deg2rad($finish[0])) * cos(deg2rad($theta)));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515;
        return round($distance, 2);
    }


    public function generateChecksum(Request $request)
    {
        if($request->header('authId')!="")
        {
            $user_id = $request->header('authId');
        }else
        {
            $user_id = $request->authId;
        }

        $user_detail = $this->users::where('id',$user_id)->first();

        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $amount = $request->amount;

        if(isset($user_detail) && $user_detail->device_type==WEB)
        {
            $food_id = array();
            $food_qty = $food_quantity = $food_quantity_price = array();
            $food_ids = str_replace('"','', (string) $request->food_id);
            $food_id = explode(',', $food_ids);
            $food_qtys = str_replace('"','', (string) $request->food_qty);
            $food_qty = explode(',', $food_qtys);
            $food_quantitys = str_replace('"','', (string) $request->food_quantity);
            $food_quantity = explode(',', $food_quantitys);
            $food_quantity_prices = str_replace('"','', (string) $request->food_quantity_price);
            $food_quantity_price = explode(',', $food_quantity_prices);
        }else
        {
            $food_id = $request->food_id;
            $food_qty = $request->food_qty;
            $food_quantity = $request->food_quantity;
            $food_quantity_price = $request->food_quantity_price;
        }
        $food_id_size = sizeof($food_id);
        $food_qty_size = sizeof($food_qty);
        for($i=0;$i<$food_id_size;$i++)
        {   
            $prouct[] = '{"id":'.$food_id[$i].',"qty":'.$food_qty[$i].',"food_size":'.$food_quantity[$i].',"food_size_price":'.$food_quantity_price[$i].'}';
            
            if($request->add_ons[$i]!=''&&$request->add_ons[$i]!=0)
            {
                $prouct['addon_ids'] = $request->add_ons[$i];
            }

        }
        $productinfo = json_encode($prouct);

        $firstname = $user_detail->name;
        $email = $user_detail->email;
        $hashSequence = env('MERCHANT_KEY').'|'.$txnid.'|'.$amount.'|'.$productinfo.'|'.$firstname.'|'.$email.'|||||||||||'.env('MERCHANT_SALT');
        //$hash=hash('sha512', $data->key.'|'.$data->txnid.'|'.$data->amount.'|'.$data->pinfo.'|'.$data->fname.'|'.$data->email.'|||||'.$data->udf5.'||||||'.$data->salt);
        $hash = hash("sha512", $hashSequence);

        $response_array = array('status'=>true,'hash_key'=> $hash);
        $response = response()->json($response_array, 200);
        return $response;
    }


    public function contains($point, $polygon)
    {
        $pointLocation = new pointLocation();
        $is_avail = 0;
        // The last point's coordinates must be the same as the first one's, to "close the loop"
        
        $is_avail = $pointLocation->pointInPolygon($point, $polygon[0]);
        

        return $is_avail;

    }



    /**
     * delete node in firebase
     * 
     * @param string $node, int $id
     * 
     * @return json $result
     */
    public function delete_firebase_node($node, $id)
    {
        
        $ch = curl_init(FIREBASE_URL."/".$node."/".$id.".json");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        $result = curl_exec($ch); 
        print_r("firebase:".$result);
        curl_close($ch);
        return $result;
    }
}