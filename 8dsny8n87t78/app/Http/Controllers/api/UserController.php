<?php

namespace App\Http\Controllers\api;
                                    
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController;
use DB;
use Carbon\Carbon;

class UserController extends BaseController
{

    public function check_version(Request $request)
    {
          $android_version = isset($request->android_version)?$request->android_version:"";
            if($android_version=="" || ($android_version < USER_ANDROID_VERSION))
            {
                return response()->json(['status'=>false,'message'=>'A new app version is available in Playstore. Kindly download it to access the app']);
            }else
            {
            return response()->json(['status'=>true,'message'=>'A new app version is available in Playstore. Kindly download it to access the app']);
            }
    }

    public function get_default_address(Request $request)
    {
         if($request->header('authId')!="")
        {
            $user_id = $request->header('authId');
        }else
        {
            $user_id = $request->authId;
        }
        // $user_id = $request->header('authId');
        $delivery_address = $this->deliveryaddress;

        $data = $delivery_address::where('user_id',$user_id)->where('is_default',1)->first();

        if(count($data)!=0)
        {
            $response_array = array('status' => true, 'data' => $data);
        }else
        {
            $response_array = array('status' => false, 'message' => 'No address found');
        }        

        $response = response()->json($response_array, 200);
        return $response;
    }

    public function set_delivery_address(Request $request)
    {
         if($request->header('authId')!="")
        {
            $user_id = $request->header('authId');
        }else
        {
            $user_id = $request->authId;
        }
        // $user_id = $request->header('authId');
        $delivery_address = $this->deliveryaddress;

        if($request->current_address)
        {
            $current_address = $request->current_address;
            $lat = $request->lat;
            $lng = $request->lng;

            $data1 =  $delivery_address::where('user_id',$user_id)->where('address','like','%'.$current_address.'%')->first();

            if(count($data1)!=0)
            {
                // $delivery_address::where('user_id',$user_id)->where('address','like','%'.$current_address.'%')->delete();
                $delivery_address::where('user_id',$user_id)->where('is_default',1)->update(['is_default'=>0]);
                $delivery_address::where('id',$data1->id)->update(['is_default'=>1]);
            }else
            {
                $delivery_address::where('user_id',$user_id)->where('is_default',1)->update(['is_default'=>0]);

                $data = array();

                    $data[] = array(
                        'user_id'=>$user_id,
                        'address'=>$current_address,
                        'lat'=>$lat,
                        'lng'=>$lng,
                        'is_default'=>1,
                        'type'=>1
                    );

                    $delivery_address::insert($data);
            }

            

            $current_delivery_address = $delivery_address::where('user_id',$user_id)->where('is_default',1)->first();

        }else
        {
            $current_delivery_address = $delivery_address::where('user_id',$user_id)->where('is_default',1)->first();
        }

        if(count($current_delivery_address)!=0)
        {
            $response_array = array('status' => true, 'data' => $current_delivery_address);
        }else
        {
            $response_array = array('status' => false, 'message' => 'No address found');
        }

        $response = response()->json($response_array, 200);
        return $response;

    }

    public function get_delivery_address(Request $request)
    {
         if($request->header('authId')!="")
        {
            $user_id = $request->header('authId');
        }else
        {
            $user_id = $request->authId;
        }
        // $user_id = $request->header('authId');
        $delivery_address = $this->deliveryaddress;
        $data = $delivery_address::where('user_id',$user_id)->get();

        if(count($data)!=0)
        {
            return response()->json(['status'=>true,'data'=>$data]);    // type - 1 home, 2 work, 3 others
        }else
        {
            return response()->json(['status'=>false,'message'=>'No address found']);
        }


    }

    public function add_delivery_address(Request $request)
    {
           $validator = Validator::make(
                $request->all(),
                array(
                    'address' => 'required',
                    'lat' => 'required',
                    'lng' => 'required',
                    'type' => 'required',        // Type -1 Home, 2- Office, 3 -Others  
                    'landmark' => 'required',
                    'flat_no' => 'required'        
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
            // $user_id = $request->header('authId');
            $address = $request->address;
            $lat = $request->lat;
            $lng = $request->lng;
            $type = $request->type;
            $flat_no = $request->flat_no;
            $landmark = $request->landmark;
            $delivery_address = $this->deliveryaddress;

            $check_for_default_address = $delivery_address::where('user_id',$user_id)->where('is_default',1)->get();

            if(count($check_for_default_address)!=0)
            {
                $is_default = 0;
            }else
            {
                $is_default = 1;
            }

            $insert_data = array();

            $insert_data[] = array(
                'user_id'=>$user_id,
                'address'=>$address,
                'lat'=>$lat,
                'lng'=>$lng,
                'type'=>$type,
                'flat_no'=>$flat_no,
                'landmark'=>$landmark,
                'is_default'=>$is_default
            );

            $delivery_address::insert($insert_data);

            $response_array = array('status' => true, 'message' => 'Address added successfully');

        }

         $response = response()->json($response_array, 200);
        return $response;
    }

    public function get_filter_list($filter_type)
    {
        if($filter_type ==1)    // filter_type =1 - Cusines table else relevance table
        {
            $cuisines = $this->cuisines;
            $data = $cuisines::get();
        }else
        {
            $data = DB::table('relevance')->get();
        } 

        if(count($data)!=0)
        {
            return response()->json(['status'=>true,'data'=>$data]);
        }else
        {
            return response()->json(['status'=>false,'message'=>'No data found']);
        }  
    }

    public function get_banners(Request $request)
    {
        $data = DB::table('offers_banner')->where('status',1)->orderBy('position','asc')->get();

        if(count($data)!=0)
        {
            foreach($data as $d){
                //calculate ratings
                $res_id = $d->id;
                $rating = $this->order_ratings->with('Foodrequest')
                             ->wherehas('Foodrequest',function($q) use($res_id){
                                 $q->where('restaurant_id', $res_id);
                                 })
                             ->avg('restaurant_rating');
                $d->rating = round($rating,1);
            }
            return response()->json(['status'=>true,'data'=>$data, 'base_url'=>UPLOADS_PATH]);
         }else
         {
            return response()->json(['status'=>false,'message'=>'No data found']);
         }
    }

     public function get_relevance_restaurant(Request $request)
    {

        $validator = Validator::make(
                $request->all(),
                array(
                    'is_pureveg' => 'required',
                    'is_offer' => 'required',
                    'lat' => 'required',
                    'lng' => 'required'
                   
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
            $restaurants = $this->restaurants;
           
            $size_cuisines = sizeof($request->cuisines);
            // echo $size_cuisines; exit;
                                                                
            $source_lat = $request->lat;
            $source_lng = $request->lng;
            $cuisines = $request->cuisines;

            $query = $restaurants->with(['Cuisines','RestaurantTimer'])->where('status',1)
                    ->select('restaurants.*')
                    ->selectRaw("(6371 * acos(cos(radians(" . $source_lat . "))* cos(radians(`lat`)) 
                            * cos(radians(`lng`) - radians(" . $source_lng . ")) + sin(radians(" . $source_lat . ")) 
                            * sin(radians(`lat`)))) as distance")
                    ->having('distance','<=',DEFAULT_RADIUS)
                    ->orderBy('distance');
                
            $query = $query->when(($request->is_offer==1),
                        function($q){
                            return $q->where('offer_amount','!=',0);
                        });

            $query = $query->when(($size_cuisines!=0),
                        function($q) use($cuisines){
                            $q->wherehas('Cuisines',function($q) use($cuisines){
                                return $q->whereIn('cuisines.id', $cuisines);
                            });
                        });
                        
            $limit = PAGINATION;
            $page = isset($request->page)?$request->page:1;
            $offset = ($page - 1) * $limit;
            $query = $query->when(($limit!='-1' && isset($offset)), 
                        function($q) use($limit, $offset){
                            return $q->offset($offset)->limit($limit);
                        });
            // $query = $query->when(($request->is_pureveg==1),
            //             function($q){
            //                 return $q->where('offer_amount','!=',0);
            //             });
                    
            $data = $query->get();

            $restaurant_list = array();
            foreach($data as $d)
            {
              
                $rcuisines = array();
                $i=0;
                foreach($d->Cuisines as $r_cuisines)
                {
                    if($i<2)
                    {
                        $rcuisines[] = array(
                            'name' => $r_cuisines->name
                        );  
                        $i =$i+1;
                    }
                }
                   
                $check_favourite = DB::table('favourite_list')->where('user_id',$user_id)->where('restaurant_id',$d->id)->get();
                if(count($check_favourite)!=0)
                {
                    $is_favourite = 1;
                }else
                {
                    $is_favourite = 0;
                }
                //calculate restaurant open time
                $is_open = $this->check_restaurant_open($d);

                //check restaurant offer
                $restaurant_offer = "";
                if($d->offer_amount!='' && $d->offer_amount!=0){
                    if($d->discount_type==1){
                            $restaurant_offer = "Flat offer ".DEFAULT_CURRENCY_SYMBOL." ".$d->offer_amount;
                    }else{
                            $restaurant_offer = $d->offer_amount."% offer";
                    }
                    if($d->target_amount!=0){
                            $restaurant_offer = $restaurant_offer." on orders above ".DEFAULT_CURRENCY_SYMBOL." ".$d->target_amount;
                    }
                }
                $res_id = $d->id;
                $rating = $this->order_ratings->with('Foodrequest')
                            ->wherehas('Foodrequest',function($q) use($res_id){
                                $q->where('restaurant_id', $res_id);
                                })
                            ->avg('restaurant_rating');
                if(sizeof($rcuisines)>0)
                {
                    $restaurant_list[] = array(
                        'id'        =>$d->id,
                        'name'      => $d->restaurant_name,
                        'image'     => RESTAURANT_UPLOADS_PATH.$d->image,
                        'discount'  => $d->discount,
                        'rating'    => round($rating,1),
                        'is_open'   => $is_open,     // 1- Open , 0 - Close
                        'cuisines'  => $rcuisines,
                        'travel_time' => $d->estimated_delivery_time,
                        'price'     => $restaurant_offer,
                        'discount_type' => $d->discount_type,
                        'target_amount' => $d->target_amount,
                        'offer_amount'  => $d->offer_amount,
                        'is_favourite'=>$is_favourite,
                        'delivery_type' => $d->delivery_type,
                        'credit_accept' => $d->credit_accept
                        );
                }

            }

            if(sizeof($restaurant_list)>0)
            {

                $response_array = array('status'=>true,'restaurants'=>$restaurant_list);
            }else
            {
                $response_array = array('status'=>false,'message'=>'No Data Found');
            }
        }

        $response = response()->json($response_array, 200);
        return $response;

    }

    public function get_menu(Request $request)
    {
        $validator = Validator::make(
                $request->all(),
                array(
                    'restaurant_id' => 'required'
                ));

        if ($validator->fails())
        {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        }else
        {
            $menu = $this->menu;
            $foodlist = $this->foodlist;
            $restaurant_id = $request->restaurant_id;
               $menu_list=array();

                   $check = $menu::where('restaurant_id',$restaurant_id)->where('status',1)->get();

                    foreach($check as $c)
                    {
                        $food_count = $foodlist::where('menu_id',$c->id)->where('status',1)->count();

                        $menu_list[] = array(
                            'menu_id'   => $c->id,
                            'menu_name' => $c->menu_name,
                            'food_count'=>$food_count,
                        );
                    }

                    $response_array = array('status'=>true,'menus'=>$menu_list);
        }

          $response = response()->json($response_array, 200);
        return $response;
    }

      public function get_nearby_restaurant(Request $request)
    {
         $validator = Validator::make(
                $request->all(),
                array(
                    'lat' => 'required',
                    'lng' => 'required'
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

            $source_lat = $request->lat;
            $source_lng = $request->lng;

            $restaurants = $this->restaurants;

            $size_cuisines = isset($request->cuisines)?sizeof($request->cuisines):0;
            $cuisines = isset($request->cuisines)?$request->cuisines:'';
                                                               
            //geofencing for restaurant
            $query = $restaurants->with(['Cuisines','RestaurantTimer'])->where('status',1)
                    ->select('restaurants.*')
                    ->selectRaw("(6371 * acos(cos(radians(" . $source_lat . "))* cos(radians(`lat`)) 
                            * cos(radians(`lng`) - radians(" . $source_lng . ")) + sin(radians(" . $source_lat . ")) 
                            * sin(radians(`lat`)))) as distance")
                    ->having('distance','<=',DEFAULT_RADIUS)
                    ->orderBy('distance');

            $query = $query->when(($request->is_offer==1),
                        function($q){
                            return $q->where('offer_amount','!=',0);
                        });

            $query = $query->when(($size_cuisines!=0),
                        function($q) use($cuisines){
                            $q->wherehas('Cuisines',function($q) use($cuisines){
                                return $q->whereIn('cuisines.id', $cuisines);
                            });
                        });

            $limit = PAGINATION;
            $page = isset($request->page)?$request->page:1;
            $offset = ($page - 1) * $limit;
            $query = $query->when(($limit!='-1' && isset($offset)), 
                        function($q) use($limit, $offset){
                            return $q->offset($offset)->limit($limit);
                        });

            $data = $query->get();

            $restaurant_list = array();
            $j=0;  
            foreach($data as $d)
            {
                // if($j<2)  // To display only two restaurants
                // {
                        $rcuisines = array();
                        $i=0;   
                        foreach($d->Cuisines as $r_cuisines)
                        {
                            if($i<2) // To display only two cuisines
                            {
                                $rcuisines[] = array(
                                    'name' => $r_cuisines->name
                                );
                                $i =$i+1;
                            }
                        }
                       
                       $check_favourite = DB::table('favourite_list')->where('user_id',$user_id)->where('restaurant_id',$d->id)->get();
                       if(count($check_favourite)!=0)
                       {
                            $is_favourite = 1;
                       }else
                       {
                            $is_favourite = 0;
                       }

                       //calculate restaurant open time
                    $is_open = $this->check_restaurant_open($d);

                       //check restaurant offer
                        $restaurant_offer = "";
                        if($d->offer_amount!='' && $d->offer_amount!=0){
                            if($d->discount_type==1){
                                    $restaurant_offer = "Flat offer ".DEFAULT_CURRENCY_SYMBOL." ".$d->offer_amount;
                            }else{
                                    $restaurant_offer = $d->offer_amount."% offer";
                            }
                            if($d->target_amount!=0){
                                    $restaurant_offer = $restaurant_offer." on orders above ".DEFAULT_CURRENCY_SYMBOL." ".$d->target_amount;
                            }
                        }
                        $res_id = $d->id;
                        $rating = $this->order_ratings->with('Foodrequest')
                                    ->wherehas('Foodrequest',function($q) use($res_id){
                                        $q->where('restaurant_id', $res_id);
                                        })
                                    ->avg('restaurant_rating');
                       $restaurant_list[] = array(
                            'id'        =>$d->id,
                            'name'      => $d->restaurant_name,
                            'image'     => RESTAURANT_UPLOADS_PATH.$d->image,
                            'discount'  => $d->discount,
                            'rating'    => round($rating,1),
                            'is_open'   => $is_open,     // 1- Open , 0 - Close
                            'cuisines'  => $rcuisines,
                            'travel_time' => $d->estimated_delivery_time,
                            'price'     => $restaurant_offer,
                            'discount_type' => $d->discount_type,
                            'target_amount' => $d->target_amount,
                            'offer_amount'  => $d->offer_amount,
                            'is_favourite'=>$is_favourite,
                            'delivery_type' => $d->delivery_type,
                            'address'=>$d->address,
                            'credit_accept' => $d->credit_accept
                        );
                    $j++;
               
                // }
            }

            if(count($restaurant_list)!=0)
            {
                $response_array = array('status'=>true,'restaurants'=>$restaurant_list);
            }else
            {
                $response_array = array('status'=>false,'message'=>__('constants.no_restaurant'));
            }


        }

        $response = response()->json($response_array, 200);
        return $response;

    }


    public function get_popular_brands(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            array(
                'lat' => 'required',
                'lng' => 'required'
            ));

        if ($validator->fails())
        {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        }else
        {
            $popularbrands = $this->popularbrands;

            //$data = $popularbrands::get();
            $source_lat = $request->lat;
            $source_lng = $request->lng;                                              
            //geofencing for restaurant
            $data = $popularbrands->leftJoin('restaurants','popular_brands_list.name','=','restaurants.id')
                    ->where('popular_brands_list.status',1)
                    ->select('popular_brands_list.*','restaurants.restaurant_name as name')
                    ->selectRaw("(6371 * acos(cos(radians(" . $source_lat . "))* cos(radians(`lat`)) 
                            * cos(radians(`lng`) - radians(" . $source_lng . ")) + sin(radians(" . $source_lat . ")) 
                            * sin(radians(`lat`)))) as distance")
                    ->having('distance','<=',DEFAULT_RADIUS)
                    ->orderBy('distance')
                    ->get();

            if(count($data)!=0)
            {
                foreach($data as $d){
                    //calculate ratings
                    $res_id = $d->id;
                    $rating = $this->order_ratings->with('Foodrequest')
                                 ->wherehas('Foodrequest',function($q) use($res_id){
                                     $q->where('restaurant_id', $res_id);
                                     })
                                 ->avg('restaurant_rating');
                    $d->rating = round($rating,1);
                }
                $response_array = array('status'=>true,'data'=>$data, 'base_url'=>UPLOADS_PATH);
            }else
            {
                $response_array = array('status'=>false,'message'=>'No Data Found');
            }
        }

        $response = response()->json($response_array, 200);
        return $response;
    }

    public function get_favourite_list(Request $request)
    {
         if($request->header('authId')!="")
            {
                $user_id = $request->header('authId');
            }else
            {
                $user_id = $request->authId;
            }
        // $user_id = $request->header('authId');
        $favouritelist = $this->favouritelist;
        $restaurants = $this->restaurants;
        $data = $favouritelist::where('user_id',$user_id)->get();
        $restaurant_list=array();
        if(count($data)!=0)
        {
            foreach($data as $key)
            {

                $restaurant_detail = $restaurants::with(['Cuisines','RestaurantTimer'])->where('id',$key->restaurant_id)->where('status',1)->first();

               $restaurant_cuisines = DB::table('restaurant_cuisines')->join('cuisines','cuisines.id','=','restaurant_cuisines.cuisine_id')
                                                           ->join('restaurants','restaurants.id','=','restaurant_cuisines.restaurant_id')
                                                           ->select('restaurant_cuisines.restaurant_id as restaurant_id','cuisines.name as cuisine_name','restaurants.restaurant_name as restaurant_name')
                                                           ->where('restaurants.id','=',$key->restaurant_id)
                                                           ->get();

                          $rcuisines = array();
                        $i=0;   
                        foreach($restaurant_cuisines as $r_cuisines)
                        {
                            
                            if($restaurant_detail->restaurant_name == $r_cuisines->restaurant_name && $i<2) // To display only two cuisines
                            {
                            
                                    $rcuisines[] = array(
                                       'name' => $r_cuisines->cuisine_name
                                    );

                                  $i =$i+1;
                           
                            }

                        }
                
                if(isset($restaurant_detail->id)){
                    //calculate restaurant open time
                    $is_open = $this->check_restaurant_open($restaurant_detail);

                    //check restaurant offer
                    $restaurant_offer = "";
                    if($restaurant_detail->offer_amount!='' && $restaurant_detail->offer_amount!=0){
                        if($restaurant_detail->discount_type==1){
                                $restaurant_offer = "Flat offer ".DEFAULT_CURRENCY_SYMBOL." ".$restaurant_detail->offer_amount;
                        }else{
                                $restaurant_offer = $restaurant_detail->offer_amount."% offer";
                        }
                        if($restaurant_detail->target_amount!=0){
                                $restaurant_offer = $restaurant_offer." on orders above ".DEFAULT_CURRENCY_SYMBOL." ".$restaurant_detail->target_amount;
                        }
                    }
                    $restaurant_list[] = array(
                            'restaurant_id' => $key->restaurant_id,
                            'name'      => $restaurant_detail->restaurant_name,
                            'image'     => RESTAURANT_UPLOADS_PATH.$restaurant_detail->image,
                            'discount'  => $restaurant_detail->discount,
                            'rating'    => $restaurant_detail->rating,
                            'is_open'   => $is_open,     // 1- Open , 0 - Close
                            'travel_time' => $restaurant_detail->estimated_delivery_time,
                            'price'     => $restaurant_offer,
                            'discount_type' => $restaurant_detail->discount_type,
                            'target_amount' => $restaurant_detail->target_amount,
                            'offer_amount'  => $restaurant_detail->offer_amount,
                            'address'   => $restaurant_detail->address,
                            'is_favourite' => 1,
                            'delivery_type' => $restaurant_detail->delivery_type,
                            'cuisines'  => $rcuisines
                            );
                }
            }

             $response_array = array('status' => true,'favourite_list'=>$restaurant_list);

        }else
        {
            $response_array = array('status' => false,'message'=>'No favourite restaurants found');
        }
        
        $response = response()->json($response_array, 200);
        return $response;
    }

    public function update_favourite(Request $request)
    {
         if($request->header('authId')!="")
            {
                $user_id = $request->header('authId');
            }else
            {
                $user_id = $request->authId;
            }
        // $user_id = $request->header('authId');

          $validator = Validator::make(
                $request->all(),
                array(
                    'restaurant_id' => 'required'
                ));

        if ($validator->fails())
        {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);

        }else
        {
            $restaurant_id = $request->restaurant_id;

            $favouritelist = $this->favouritelist;

            $check = $favouritelist::where('user_id',$user_id)->where('restaurant_id',$restaurant_id)->first();

            if(count($check)!=0)
            {
                $favouritelist::where('id',$check->id)->delete();

                $response_array = array('status' => true,'message'=>'Removed from Favourites');
            }else
            {
                $data = array();
                $data['user_id'] = $user_id;
                $data['restaurant_id'] = $restaurant_id;
                $favouritelist::insert($data);

                $response_array = array('status' => true,'message'=>'Added to Favourites');
            }

        }

                 $response = response()->json($response_array, 200);
                return $response;

    }

    public function get_current_order_status(Request $request)
    {
         if($request->header('authId')!="")
            {
                $user_id = $request->header('authId');
            }else
            {
                $user_id = $request->authId;
            }
        // $user_id = $request->header('authId');

        $check_request = $this->foodrequest::where('user_id',$user_id)->where('status','!=',10)->where('is_rated','=',0)->orderBy('id','desc')->get();

        if(count($check_request)!=0)
        {
            $order_status = array();
            foreach($check_request as $key)
            {

                $restaurant_detail = $this->restaurants::where('id',$key->restaurant_id)->where('status',1)->first();

                if(count($restaurant_detail)!=0)
                {
                           $item_list = DB::table('request_detail')->where('request_id',$key->id)->get();


                            $item_count = 0;

                        if($key->delivery_boy_id!=0)
                        {
                            $delivery_boy_id = $key->delivery_boy_id;
                            // echo $delivery_boy_id; exit;
                            $delivery_boy_detail = DB::table('delivery_partners')->where('id',$delivery_boy_id)->first();

                            $delivery_boy_name = $delivery_boy_detail->name;

                            $delivery_boy_image = $delivery_boy_detail->profile_pic;

                            $delivery_boy_phone = $delivery_boy_detail->phone;
                        }else
                        {
                            $delivery_boy_id = 0;
                            $delivery_boy_name="";
                            $delivery_boy_image="";
                            $delivery_boy_phone="";
                        }

                        $get_item_lists = array();
                        // print_r($item_list); exit;
                        foreach ($item_list as $list) {

                            $item_count = $item_count + $list->quantity;
                            $food_detail = DB::table('food_list')->where('id',$list->food_id)->where('status',1)->first();
                            $get_item_lists[]=array(
                                'item_name'=>(!empty($food_detail))?$food_detail->name:"",
                                'item_quantity'=>$list->quantity,
                                'price'=>((!empty($food_detail))?$food_detail->price:0) * $list->quantity
                            );

                        }

                        $order_status[] = array(
                            'request_id'=>$key->id,
                            'order_id'=>$key->order_id,
                            'ordered_time'=>$key->ordered_time,
                            'restaurant_name'=>$restaurant_detail->restaurant_name,
                            'restaurant_image'=>$restaurant_detail->image,
                            'item_count'=>$item_count,
                            'bill_amount'=>$key->bill_amount,
                            'offer_discount'=>$key->offer_discount,
                            'restaurant_discount'=>$key->restaurant_discount,
                            'status'=>$key->status,
                            'delivery_boy_id'=>$delivery_boy_id,
                            'delivery_boy_image'=>$delivery_boy_image,
                            'delivery_boy_phone'=>$delivery_boy_phone,
                            'item_list'=>$get_item_lists,
                            'delivery_type' => $key->delivery_type,
                            'total_members' => $key->total_members,
                            'pickup_dining_time' => $key->pickup_dining_time,

                        );
                }
            }

            $response_array = array('status' => true,'order_status'=>$order_status);

        }else
        {
            $response_array = array('status' => false,'message'=>'No orders in processing');
        }

        $response = response()->json($response_array, 200);
                return $response;
    }

    public function track_order_detail(Request $request)
    {
        //  if($request->header('authId')!="")
        //     {
        //         $user_id = $request->header('authId');
        //     }else
        //     {
        //         $user_id = $request->authId;
        //     }
            $user_id = $request->header('authId') ?: $request->authId;


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
            $trackorderstatus = $this->trackorderstatus;

            $check_request = $this->foodrequest::where('user_id',$user_id)->where('id',$request_id)->first();
            $restaurant_detail= DB::table('restaurants')->where('id',$check_request->restaurant_id)->where('status',1)->first();

            $order_status = array();

                   $item_list = DB::table('request_detail')->where('request_id',$request_id)->get();


                    $item_count = 0;

                if($check_request->delivery_boy_id!=0)
                {
                    $delivery_boy_id = $check_request->delivery_boy_id;

                    $delivery_boy_detail = DB::table('delivery_partners')->where('id',$delivery_boy_id)->first();

                    $delivery_boy_name = $delivery_boy_detail->name;

                    $delivery_boy_image = $delivery_boy_detail->profile_pic;

                    $delivery_boy_phone = $delivery_boy_detail->phone;
                }else
                {
                    $delivery_boy_id = 0;
                    $delivery_boy_name="";
                    $delivery_boy_image="";
                    $delivery_boy_phone="";
                }

                foreach ($item_list as $list) {
                    $item_count = $item_count + $list->quantity;
                }

                $order_status[] = array(
                    'request_id'=>$request_id,
                    'order_id'=>$check_request->order_id,
                    'ordered_time'=>$check_request->ordered_time,
                    'restaurant_name'=>$restaurant_detail->restaurant_name,
                    'restaurant_image'=>RESTAURANT_UPLOADS_PATH.$restaurant_detail->image,
                    'item_count'=>$item_count,
                    'item_total'=>$check_request->item_total,
                    'offer_discount'=>$check_request->offer_discount,
                    'restaurant_packaging_charge'=>$check_request->restaurant_packaging_charge,
                    'tax'=>$check_request->tax,
                    'delivery_charge'=>$check_request->delivery_charge,
                    'bill_amount'=>$check_request->bill_amount,
                    'restaurant_discount'=>$check_request->restaurant_discount,
                    'status'=>$check_request->status,
                    'delivery_boy_id'=>$delivery_boy_id,
                    'delivery_boy_name'=>$delivery_boy_name,
                    'delivery_boy_image'=>$delivery_boy_image,
                    'delivery_boy_phone'=>$delivery_boy_phone,
                    'restaurant_lat'=>$restaurant_detail->lat,
                    'restaurant_lng'=>$restaurant_detail->lng,
                    'restaurant_address'=>$restaurant_detail->address,
                    'restaurant_phone'=>$restaurant_detail->phone,
                    'user_lat'=>$check_request->d_lat,
                    'user_lng'=>$check_request->d_lng,
                    'delivery_type' => $check_request->delivery_type,
                    'total_members' => $check_request->total_members,
                    'pickup_dining_time' => $check_request->pickup_dining_time,


                );

                $tracking_detail = $trackorderstatus::where('request_id',$request_id)->get();
    

            $response_array = array('status' => true,'order_status'=>$order_status,'tracking_detail'=>$tracking_detail);

        }

        $response = response()->json($response_array, 200);
                return $response;

    }

    public function order_history(Request $request)
    {
         if($request->header('authId')!="")
            {
                $user_id = $request->header('authId');
            }else
            {
                $user_id = $request->authId;
            }
        // $user_id = $request->header('authId');

        $orders = DB::table('requests')->where('requests.user_id',$user_id)->whereIn('requests.status',[7,10])->latest()->limit(10)->get();

        $order_list = array();
        
                foreach($orders as $key)
                {
                    $order_detail = $this->requestdetail->where('request_id',$key->id)->get();
                    //dd($order_detail);
                    $order_list_detail = array();
                    foreach($order_detail as $k)
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
                                    'name' => isset($qty->name)?$qty->name:'',
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

                    $restaurant_detail = DB::table('restaurants')->where('id',$key->restaurant_id)->where('status',1)->first();
                    //if (isset($request_detail->id)) {
                        $order_list[] = array(
                            'request_id'=>$key->id,
                            'order_id'=>$key->order_id,
                            'restaurant_id'=>isset($restaurant_detail->id)?$restaurant_detail->id:$key->restaurant_id,
                            'restaurant_name'=>isset($restaurant_detail->restaurant_name)?$restaurant_detail->restaurant_name:"",
                            'restaurant_image'=>isset($restaurant_detail->image)?RESTAURANT_UPLOADS_PATH.$restaurant_detail->image:"",
                            'ordered_on'=>$key->ordered_time,
                            'bill_amount'=>$key->bill_amount,
                            'item_list'=>$order_list_detail,
                            'item_total'=>$key->item_total,
                            'offer_discount'=>$key->offer_discount,
                            'restaurant_discount'=>$key->restaurant_discount,
                            'restaurant_packaging_charge'=>$key->restaurant_packaging_charge,
                            'tax'=>$key->tax,
                            'is_rated'=>$key->is_rated,
                            'status'=>$key->status,
                            'delivery_charge'=>$key->delivery_charge,
                            'delivery_address'=>$key->delivery_address,
                            'restaurant_address'=>isset($restaurant_detail->address)?$restaurant_detail->address:"",
                            'delivery_type' => $key->delivery_type,
                            'total_members' => $key->total_members,
                            'pickup_dining_time' => $key->pickup_dining_time
                        );
                    //}
                    

                }

        $upcoming_orders = DB::table('requests')->where('requests.user_id',$user_id)->where('requests.status','!=',10)->where('requests.status','!=',7)->latest()->limit(5)->get();

        $upcoming_order_list = array();
        
                foreach($upcoming_orders as $key)
                {
                    $upcoming_order_detail = $this->requestdetail->where('request_id',$key->id)->get();
                    $upcoming_order_list_detail = array();
                    foreach($upcoming_order_detail as $k)
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
                                    'name' => isset($qty->name)?$qty->name:'',
                                    'price' => $k->food_quantity_price,
                                    'created_at' => isset($qty->created_at)?date("Y-m-d H:i:s",strtotime($qty->created_at)):'',
                                    'updated_at' => isset($qty->updated_at)?date("Y-m-d H:i:s",strtotime($qty->updated_at)):'',
                                );
                            }
                        }
                        $upcoming_order_list_detail[] = array(
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

                    $restaurant_details = DB::table('restaurants')->where('id',$key->restaurant_id)->where('status',1)->first();
                    //dd($restaurant_details->restaurant_name);
                    if (isset($restaurant_details->id)) {
                        $upcoming_order_list[] = array(
                            'request_id'=>$key->id,
                            'order_id'=>$key->order_id,
                            'restaurant_id'=>isset($restaurant_details->id)?$restaurant_details->id:$key->restaurant_id,
                            'restaurant_name'=>isset($restaurant_details->restaurant_name)?$restaurant_details->restaurant_name:"",
                            'restaurant_image'=>isset($restaurant_details->image)?RESTAURANT_UPLOADS_PATH.$restaurant_details->image:"",
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
                            'restaurant_address'=>isset($restaurant_details->address)?$restaurant_details->address:"",
                            'delivery_type' => $key->delivery_type,
                            'total_members' => $key->total_members,
                            'pickup_dining_time' => $key->pickup_dining_time
                        );
                    }
                    

                }

            
        if(count($upcoming_order_list)!=0||count($order_list)!=0)
        {
            $response_array = array('status' => true,'past_orders'=>$order_list,'upcoming_orders'=>$upcoming_order_list);
        }
        else
        {

            $response_array = array('status' => false,'message'=>__('constants.no_orders'));

        }
 

        $response = response()->json($response_array, 200);
                return $response;
    }



    public function get_order_status(Request $request)
    {

        // $request_id = $request->request_id;

         if($request->header('authId')!="")
            {
                $user_id = $request->header('authId');
            }else
            {
                $user_id = $request->authId;
            }

        // $user_id = $request->header('authId');

        $request_detail = DB::table('requests')->where('user_id',$user_id)
                                               ->where('status','!=',10)
                                               ->where('status','!=',7)
                                               ->first();

         if(count($request_detail)!=0)
        {

            $order_id = $request_detail->order_id;

            $request_id = $request_detail->id;

            $ordered_time = $request_detail->ordered_time;

            $restaurant_detail = $this->restaurants::where('id',$request_detail->restaurant_id)->where('status',1)->first();

       

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
                        'restaurant_discount'=>$request_detail->restaurant_discount,
                        'packaging_charge'=>$request_detail->restaurant_packaging_charge,
                        'tax'=>$request_detail->tax,
                        'delivery_charge'=>$request_detail->delivery_charge,
                        'bill_amount'=>$request_detail->bill_amount
                    );

                    $response_array = array('status'=>true,'request_id'=>$request_id,'ordered_time'=>$ordered_time,'order_id'=>$order_id,'restaurant_detail'=>$restaurant_detail,'user_detail'=>$user_detail,'address_detail'=>$address_detail,'bill_detail'=>$bill_detail,'food_detail'=>$food_detail,'request_status'=>$request_status);

        }else
        {
            $response_array = array('status'=>true,'message'=>'No Orders Available');
        }

         $response = response()->json($response_array, 200);
        return $response;
    }



    /**
     * to list all promocode details
     * 
     * @param object $request
     * 
     * @return json $response
     */
    public function get_promo_list(Request $request)
    {
        if($request->header('authId')!="")
        {
            $user_id = $request->header('authId');
        }else
        {
            $user_id = $request->authId;
        }
        
        //get promo list
        $get_promo = $this->promocode->where('status',1)
                                ->whereDate('available_from','<=',Carbon::now())
                                ->whereDate('valid_till','>=',Carbon::now())
                                ->get();

        $response_array = array('status'=>true,'promo_list'=>$get_promo);
        $response = response()->json($response_array, 200);
        return $response;
    }


    /**
    * to check the availability of restaurant during checkout
    *
    * @param ogject $request
    * 
    * @return json $response
    */
    public function check_restaurant_availability(Request $request)
    {
        $validator = Validator::make(
                $request->all(),
                array(
                    'restaurant_id' => 'required',
                    'lat' => 'required',
                    'lng' => 'required'
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

            //check app version
            $android_version = isset($request->android_version)?$request->android_version:"";
            if($android_version=="" || ($android_version < USER_ANDROID_VERSION))
            {
               return response()->json(['status'=>false,'message'=>'A new app version is available in Playstore. Kindly download it to access the app']);
            }
            
            $restaurant_id = $request->restaurant_id;
            $source_lat = $request->lat;
            $source_lng = $request->lng;

            $data = $this->restaurants->where('status',1)
                    ->where('id', $restaurant_id)
                    ->select('restaurants.*')
                    ->selectRaw("(6371 * acos(cos(radians(" . $source_lat . "))* cos(radians(`lat`)) 
                            * cos(radians(`lng`) - radians(" . $source_lng . ")) + sin(radians(" . $source_lat . ")) 
                            * sin(radians(`lat`)))) as distance")
                    ->having('distance','<=',DEFAULT_RADIUS)
                    ->orderBy('distance')
                    ->first();
            
            //check location availability
            $radius = DEFAULT_RADIUS;
            $delivery_charge_details = DB::table('add_city')
                                ->select('add_city.*','city_geofencing.polygons', DB::raw("( 6371 * acos( cos( radians($source_lat) ) *
                                                    cos( radians( city_geofencing.latitude ) )
                                                    * cos( radians( city_geofencing.longitude ) - radians($source_lng)
                                                    ) + sin( radians($source_lat) ) *
                                                    sin( radians( city_geofencing.latitude ) ) )
                                                ) AS distance"))
                                ->leftJoin('city_geofencing', function($join)
                                {
                                    $join->on('city_geofencing.city_id', '=', 'add_city.id');
                                })
                                // ->having("distance", "<", $radius)
                                ->get();
                
            // dd($delivery_charge_details);
            $delivery_charge_data = "";
            foreach($delivery_charge_details as $value)
            {
                $polygon = json_decode($value->polygons);
                // dd($polygon[0]);
                $ponits = array($source_lng, $source_lat);
                $is_avail = $this->contains($ponits, $polygon[0]);
                // echo $is_avail;
                if($is_avail==1)
                {
                    $delivery_charge_data = $value;
                    break;
                }
            }
            if($delivery_charge_data=="")
            {
                $response_array = array('status'=>false,'message'=>"Your location not in deliverable area");
                $response = response()->json($response_array, 200);
                return $response;
            }

            if($data)
            {
                $response_array = array('status'=>true,'restaurant'=>$data);
            }else
            {
                $response_array = array('status'=>false,'message'=>__('constants.no_data'));
            }
            $response = response()->json($response_array, 200);
            return $response;
        }
    }


    /**
     * delete address of user
     * 
     * @param object $request, int $id
     * 
     * @return json $response
     */
    public function delete_delivery_address(Request $request, $id)
    {
        if($request->header('authId')!="")
        {
            $user_id = $request->header('authId');
        }else
        {
            $user_id = $request->authId;
        }
        
        $this->deliveryaddress->where('id',$id)->delete();

        $response_array = array('status'=>true,'message'=>"Address deleted successfully");
        $response = response()->json($response_array, 200);
        return $response;
    }


    /**
     * delete address of user
     * 
     * @param object $request, int $id
     * 
     * @return json $response
     */
    public function edit_delivery_address(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            array(
                'address' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'type' => 'required',        // Type -1 Home, 2- Office, 3 -Others  
                'landmark' => 'required',
                'flat_no' => 'required',
                'id' => 'required'      
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
            
            $this->deliveryaddress->where('id',$request->id)->update(['address'=>$request->address, 'lat'=>$request->lat, 'lng'=>$request->lng,'type'=>$request->type, 'flat_no'=>$request->flat_no,'landmark'=>$request->landmark]);
            $response_array = array('status'=>true,'message'=>"Address updated successfully");
        }
        $response = response()->json($response_array, 200);
        return $response;
    }


    public function send_push(Request $request)
    {
        $data = $this->deliverypartners->find(8);
        if($data)
        {
            if($data->device_token!='')
            {
				$url = 'https://fcm.googleapis.com/fcm/send';
                $fields=array();
				$fields = array(
                    'to' => $data->device_token,
                    'notification' => array(
                            "title" => 'test push',
                            "text" => 'test push',
                            'request_id' => 1,
                            'delivery_type' => 1,
                            'image' => "",
                    ),
                    'data'=>array(
                        'request_id' => 1
                    ),
                );
                $fields = json_encode($fields);
                print_r($fields);
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

                print_r($result);
                curl_close($ch);
            }else
            {
                echo "device token not found";
            }
        }else
        {
            echo "no data found";
        }
    }


    public function check_wallet(Request $request)
    {
        return view('plaid');
    }
}