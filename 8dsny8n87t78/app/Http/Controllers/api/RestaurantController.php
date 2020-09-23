<?php

namespace App\Http\Controllers\api;
                                    
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController;
use DB;
use App\Model\Requestdetail;
use App\Model\RequestdetailAddons;
use App\Library\Payment;
use App\Model\Cards;
use App\Model\Transactions;

class RestaurantController extends BaseController
{

    public function single_restaurant(Request $request)
    {

          $validator = Validator::make(
                $request->all(),
                array(
                    'restaurant_id' => 'required',
                    'veg_only' => 'required'
                ));

        if ($validator->fails())
        {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        }else
        {
            $restaurant_id = $request->restaurant_id;
            $veg_only = $request->veg_only;
            $restaurants = $this->restaurants;
            $foodlist = $this->foodlist;
            $menu = $this->menu;
            $cart = $this->cart;
             if($request->header('authId')!="")
            {
                $user_id = $request->header('authId');
            }else
            {
                $user_id = $request->authId;
            }
            // $user_id = $request->header('authId');

            // $restaurant_cuisines = DB::table('restaurant_cuisines')->join('cuisines','cuisines.id','=','restaurant_cuisines.cuisine_id')
            //                                                        ->join('restaurants','restaurants.id','=','restaurant_cuisines.restaurant_id')
            //                                                        ->select('restaurant_cuisines.restaurant_id as restaurant_id','cuisines.name as cuisine_name','restaurants.restaurant_name as restaurant_name')->get();
                                                                

            $data = $restaurants->with(['Cuisines','RestaurantTimer'])->where('id',$restaurant_id)->where('status',1)->first();

            $food_filter = $foodlist->where('restaurant_id',$restaurant_id)->get();
            
                    $restaurant_list = array();
                    $rcuisines = array();
                    $i=0;   
                    foreach($data->Cuisines as $r_cuisines)
                    {
                        
                        if($i<2) // To display only two cuisines
                        {
                        
                                $rcuisines[] = array(
                                   'name' => $r_cuisines->name
                                );

                              $i =$i+1;
                
                            
                        }

                    }

                    $foods = array();
                    $j=0;
                  
                    foreach($food_filter as $f)
                    {
                        $cart_count=$cart::where('user_id',$user_id)->where('food_id',$f->id)->first();  // For Cart item quantity

                        if(count($cart_count)!=0)
                        {
                            $count = $cart_count->quantity;
                        }else
                        {
                            $count=0;
                        }
                        //check food offer
                        $food_offer = $this->food_offer($f);

                        if($j<4)
                        {
                            if($veg_only==0)
                            {
                                $foods[] = array(
                                    'food_id'       => $f->id,
                                    'name'          => $f->name,
                                    'price'         => $f->price,
                                    'description'   => $f->description,
                                    'is_veg'        => $f->is_veg,
                                    'item_count'    => $count,
                                    'food_offer'    => $food_offer,
                                    'discount_type' => $f->discount_type,
                                    'target_amount' => $f->target_amount,
                                    'offer_amount'  => $f->offer_amount,
                                );
                                $j = $j+1;
                            }else
                            {
                                if($f->is_veg==1)
                                {
                                    $foods[] = array(
                                        'food_id'       => $f->id,
                                        'name'          => $f->name,
                                        'price'         => $f->price,
                                        'description'   => $f->description,
                                        'is_veg'        => $f->is_veg,
                                        'item_count'    => $count,
                                        'food_offer'    => $food_offer,
                                        'discount_type' => $f->discount_type,
                                        'target_amount' => $f->target_amount,
                                        'offer_amount'  => $f->offer_amount,
                                    );
                                    $j = $j+1;
                                }
                            }
                        }
                    }
                   
                   $check_favourite = DB::table('favourite_list')->where('user_id',$user_id)->where('restaurant_id',$data->id)->get();
                   if(count($check_favourite)!=0)
                   {
                        $is_favourite = 1;
                   }else
                   {
                        $is_favourite = 0;
                   }
                   //calculate restaurant open time
                    $is_open = $this->check_restaurant_open($data);

                   //check restaurant offer
                   $restaurant_offer = "";
                   if($data->offer_amount!='' && $data->offer_amount!=0){
                       if($data->discount_type==1){
                            $restaurant_offer = "Flat offer ".DEFAULT_CURRENCY_SYMBOL." ".$data->offer_amount;
                       }else{
                            $restaurant_offer = $data->offer_amount."% offer";
                       }
                       if($data->target_amount!=0){
                            $restaurant_offer = $restaurant_offer." on orders above ".DEFAULT_CURRENCY_SYMBOL." ".$data->target_amount;
                       }
                   }

                   //calculate ratings
                   $res_id = $data->id;
                   $rating = $this->order_ratings->with('Foodrequest')
                                    ->wherehas('Foodrequest',function($q) use($res_id){
                                        $q->where('restaurant_id', $res_id);
                                        })
                                    ->avg('restaurant_rating');

                   $restaurant_list[] = array(
                        'id'            => $data->id,
                        'name'          => $data->restaurant_name,
                        'image'         => RESTAURANT_UPLOADS_PATH.$data->image,
                        'address'       => $data->address,
                        'discount'      => $data->discount,
                        'rating'        => round($rating,1),
                        'is_open'       => $is_open,     // 1- Open , 0 - Close
                        'cuisines'      => $rcuisines,
                        'travel_time'   => $data->estimated_delivery_time,
                        'price'         => $restaurant_offer,
                        'discount_type' => $data->discount_type,
                        'target_amount' => $data->target_amount,
                        'offer_amount'  => $data->offer_amount,
                        'is_favourite'  => $is_favourite,
                        'delivery_type' => $data->delivery_type,
                        'shop_description' => $data->shop_description,
                        'fssai_license' => $data->fssai_license,
                        'credit_accept' => $data->credit_accept,
                        'food_list'     => $foods
                        );


                
                    $food_cart=array();

                    $check_for_cart = $cart::where('user_id',$user_id)->get();
                    $amount = 0;
                    $quantity = 0;
                    foreach ($check_for_cart as $key) {
                        
                      $food_detail = $foodlist::where('id',$key->food_id)->first();
                        $amount = $amount+($food_detail->price * $key->quantity);
                        $quantity = $quantity + $key->quantity;
                    }

                     $food_cart[] = array(
                            'amount'     => $amount,
                            'quantity'   => $quantity,
                        );
            

            $response_array = array('status'=>true,'restaurants'=>$restaurant_list,'cart'=>$food_cart);
        }
        $response = response()->json($response_array, 200);
        return $response;
    
    }

    public function add_to_cart(Request $request)
    {
          $validator = Validator::make(
                $request->all(),
                array(
                    'food_id' => 'required',
                    'quantity' => 'required',
                    'restaurant_id' => 'required',
                    'force_insert' => 'required'  // To Overwrite previous restaurant cart if exist - 1
                ));

        if ($validator->fails())
        {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        }else
        {
            $cart = $this->cart;
            $foodlist = $this->foodlist;
            $restaurants = $this->restaurants;
             if($request->header('authId')!="")
            {
                $user_id = $request->header('authId');
            }else
            {
                $user_id = $request->authId;
            }
            // $user_id = $request->header('authId');
            $food_id = $request->food_id;
            $quantity = $request->quantity;
            $force_insert = $request->force_insert;
            $restaurant_id = $request->restaurant_id;

            $check = $cart::where('user_id',$user_id)->where('food_id',$food_id)->first();

            if($force_insert == 0 )
            {
                if(count($check)!=0)
                {
                    $cart::where('id',$check->id)->update(['quantity'=>$quantity]);
                }else
                {
                    $last_data = $cart::where('user_id',$user_id)->first();
                    if(count($last_data)!=0)
                    {
                        $check_restaurant = $foodlist::where('id',$last_data->food_id)->first();

                        if($check_restaurant->restaurant_id == $restaurant_id)
                        {
                            $is_same_restaurant = 1;
                        }else
                        {
                            $existing_restaurant = $restaurants::where('id',$check_restaurant->restaurant_id)->first();
                            $new_restaurant = $restaurants::where('id',$restaurant_id)->first();

                            $message = 'Your cart contains dishes from '.$existing_restaurant->restaurant_name.' . Do you want to discard the selection and add dishes from '.$new_restaurant->restaurant_name .' ?';


                            $response_array = array('status'=>false,'error_code'=>102,'message'=>$message);
                             $response = response()->json($response_array, 200);

                            return $response;
                        }
                    }
                           
                            $insert_data=array();
                            $insert_data[] = array(
                                'user_id'=>$user_id,
                                'food_id'=>$food_id,
                                'quantity'=>$quantity
                            );

                            $cart::insert($insert_data);

                }
            }else
            {
                $cart::where('user_id',$user_id)->delete();

                    $insert_data=array();
                    $insert_data[] = array(
                        'user_id'=>$user_id,
                        'food_id'=>$food_id,
                        'quantity'=>$quantity
                    );

                    $cart::insert($insert_data);

            }

            $response_array = array('status'=>true,'message'=>'Item quantity added to cart');
        }

        $response = response()->json($response_array, 200);
        return $response;
    }

    public function reduce_from_cart(Request $request)
    {
         $validator = Validator::make(
                $request->all(),
                array(
                    'food_id' => 'required',
                    'quantity' => 'required'
                ));

        if ($validator->fails())
        {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        }else
        {
            $cart = $this->cart;
             if($request->header('authId')!="")
            {
                $user_id = $request->header('authId');
            }else
            {
                $user_id = $request->authId;
            }
            // $user_id = $request->header('authId');
            $food_id = $request->food_id;
            $quantity = $request->quantity;

            $check = $cart::where('user_id',$user_id)->where('food_id',$food_id)->first();
            if(count($check)!=0 && $quantity!=0)
            {
                $cart::where('id',$check->id)->update(['quantity'=>$quantity]);
            }elseif(count($check)!=0 && $quantity==0)
            {

                $cart::where('id',$check->id)->delete();                
            }
            $response_array = array('status'=>true,'message'=>'Item quantity removed from cart');
        }
        $response = response()->json($response_array, 200);
        return $response;
    }

    public function check_cart(Request $request)
    {

            $cart = $this->cart;
            $foodlist = $this->foodlist;
             if($request->header('authId')!="")
            {
                $user_id = $request->header('authId');
            }else
            {
                $user_id = $request->authId;
            }
            // $user_id = $request->header('authId');
            $user_table = $this->users::where('id',$user_id)->first();
            $restaurants = $this->restaurants;

            $food_cart=array();

            // if($user_table->device_type!=WEB)
            // {

            //         $check_for_cart = $cart::where('user_id',$user_id)->get();
            //         $amount = 0;
            //         $quantity = 0;
            //         foreach ($check_for_cart as $key) {
                        
            //           $food_detail = $foodlist::where('id',$key->food_id)->first();
                        
            //             $quantity = $quantity + $key->quantity;
            //             $amount = $amount+($food_detail->price* $key->quantity);
            //         }

            //          $food_cart[] = array(
            //                 'amount'     => $amount,
            //                 'quantity'   => $quantity,
            //             );

            //          $response_array = array('status'=>true,'cart'=>$food_cart);
            // }else
            // {

                 $check_for_cart = $cart::where('user_id',$user_id)->get();
                    $amount = 0;
                    $quantity = 0;
                     $item_list=array();
                    foreach ($check_for_cart as $key) {

                        $food_detail = $foodlist::where('id',$key->food_id)->where('status',1)->first();
                        
                        $quantity = $quantity + $key->quantity;
                        $amount = $amount+($food_detail->price* $key->quantity);
                        $item_list[] = array(
                            'item_id'=>$key->food_id,
                            'item_name'=>$food_detail->name,
                            'quantity'=>$key->quantity,
                            'price'=>$key->quantity*$food_detail->price
                        );

                        $restaurant_id = $food_detail->restaurant_id;
                        $order_on = $key->created_at;
                    }

                    if(isset($restaurant_id))
                    {
                         $restaurant_detail = $restaurants::where('id',$restaurant_id)->where('status',1)->first();
                         $restaurant_name = $restaurant_detail->restaurant_name;
                         $restaurant_image = $restaurant_detail->image;
                         $order_on = $order_on;
                         $restaurant_address = $restaurant_detail->address;
                    }else
                    {
                        $restaurant_name="";
                        $restaurant_image="";
                        $order_on="";
                        $restaurant_address="";
                    }
                   
                     $food_cart[] = array(
                            'item_list'  => $item_list,
                            'amount'     => $amount,
                            'quantity'   => $quantity,
                            'restaurant_name'=>$restaurant_name,
                            'restaurant_image'=>$restaurant_image,
                            'order_on'=>$order_on,
                            'restaurant_address'=>$restaurant_address
                        );

                     $response_array = array('status'=>true,'cart'=>$food_cart);

            // }

              $response = response()->json($response_array, 200);
            return $response;
    }

    public function get_category($restaurant_id,Request $request)
    {
        $foodlist = $this->foodlist;
        $category = $this->category;
        $menu = $this->menu;

        $category_list = $foodlist->where('restaurant_id',$restaurant_id)->where('status',1)
                 ->groupBy('category_id')
                 ->pluck('category_id');

        $data = $category->whereIn('id',$category_list)->where('status',1)->get();

        if(count($data)!=0)
        {
        
            $food_category = array();
            $i=1;
            foreach($data as $d)
            {
                $food_category[]=array(
                'category_id'   => $d->id,
                'name'          => $d->category_name,
                'position'      => $i
                );

                $i = $i+1;
            }

           

            $response_array = array('status'=>true,'category'=>$food_category);
        }else
        {
            $response_array = array('status'=>false,'message'=>'No Data Found');
        }

              $response = response()->json($response_array, 200);
            return $response;
      
    }

    public function get_food_list(Request $request)
    {
         $validator = Validator::make(
                $request->all(),
                array(
                    'restaurant_id' => 'required',
                    'is_veg'=>'required'
                ));


        if ($validator->fails())
        {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        }else
        {
            $restaurant_id = $request->restaurant_id;
            $foodlist = $this->foodlist;
            $category = $this->category;
            $cart = $this->cart;
            $restaurants = $this->restaurants;

             if($request->header('authId')!="")
            {
                $user_id = $request->header('authId');
            }else
            {
                $user_id = $request->authId;
            }
            // $user_id = $request->header('authId');
            $is_veg = $request->is_veg;


             $food_list = $foodlist::with('FoodQuantity')->where('restaurant_id',$restaurant_id)->where('status',1)->get();
             $category_list = $category::get();
//dd($food_list);
            $check_for_cart = $cart::where('user_id',$user_id)->get();

            $restaurant_detail = $restaurants::where('id',$restaurant_id)->where('status',1)->select('restaurant_name','image','address','discount_type','target_amount','offer_amount','tax')->first();
            $restaurant_detail->image = RESTAURANT_UPLOADS_PATH.$restaurant_detail->image;
            
            $get_food_list = array();
            foreach($category_list as $key)
            {
                $category_wise_food = array();

                foreach($food_list as $foods)
                {
                    $item_count = 0;
                    if($foods->category_id == $key->id)
                    {

                        if(count($check_for_cart)!=0)
                        {
                            foreach($check_for_cart as $check_for_item)
                            {
                                if($foods->id == $check_for_item->food_id)
                                {
                                    $item_count = $check_for_item->quantity;
                                }
                                // else
                                // {
                                //     $item_count =0;
                                // }
                            }
                        }else
                        {
                            $item_count=0;
                        }
                        //check food offer
                        $food_offer = $this->food_offer($foods);

                        if($is_veg!=1)
                        {
                            $category_wise_food[] = array(
                            'food_id'=>$foods->id,
                            'name'=>$foods->name,
                            'image'=>(!empty($foods->image))?FOOD_IMAGE_PATH.$foods->image:"",
                            'is_veg'=>$foods->is_veg,
                            'price'=>$foods->price,
                            'description'=>$foods->description,
                            'category_id'=>$foods->category_id,
                            'item_count'=>$item_count,
                            'food_offer' => $food_offer,
                            'discount_type'=>$foods->discount_type,
                            'target_amount'=>$foods->target_amount,
                            'offer_amount'=>$foods->offer_amount,
                            'item_tax'=>$restaurant_detail->tax,
                            'add_ons'=>$foods->Add_ons,
                            'food_quantity'=>$foods->FoodQuantity
                            ); 

                        }else
                        {
                            if($foods->is_veg == 1)
                            {
                                $category_wise_food[] = array(
                                'food_id'=>$foods->id,
                                'name'=>$foods->name,
                                'image'=>(!empty($foods->image))?FOOD_IMAGE_PATH.$foods->image:"",
                                'is_veg'=>$foods->is_veg,
                                'price'=>$foods->price,
                                'description'=>$foods->description,
                                'category_id'=>$foods->category_id,
                                'item_count'=>$item_count,
                                'food_offer' => $food_offer,
                                'discount_type'=>$foods->discount_type,
                                'target_amount'=>$foods->target_amount,
                                'offer_amount'=>$foods->offer_amount,
                                'item_tax'=>$restaurant_detail->tax,
                                'add_ons'=>$foods->Add_ons,
                                'food_quantity'=>$foods->FoodQuantity
                                ); 
                            }
                        }

                      
                    }

                }

                if($category_wise_food)
                {
                    $get_food_list[] = array(
                    'category_id'=>$key->id,
                    'category_name'=>$key->category_name,
                    'items'=>$category_wise_food
                    );
                }

              
            }
            
            if(count($get_food_list)!=0)
            {
                $response_array = array('status'=>true,'food_list'=>$get_food_list,'restaurant_detail'=>$restaurant_detail);
            }else
            {
                $response_array = array('status'=>false,'message'=>'No Data Found');
            }

        }

        $response = response()->json($response_array, 200);
            return $response;
    }

    public function get_category_wise_food_list(Request $request)
    {
         $validator = Validator::make(
                $request->all(),
                array(
                    'restaurant_id' => 'required',
                    'category_id' => 'required',
                    'veg_only'  => 'required'
                ));

        if ($validator->fails())
        {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        }else
        {
            $restaurant_id = $request->restaurant_id;
            $category_id = $request->category_id;
            $foodlist = $this->foodlist;
            $cart = $this->cart;
             if($request->header('authId')!="")
            {
                $user_id = $request->header('authId');
            }else
            {
                $user_id = $request->authId;
            }
            // $user_id = $request->header('authId');
            $veg_only = $request->veg_only;

            $food_list = $foodlist::where('restaurant_id',$restaurant_id)->where('category_id',$category_id)->where('status',1)->get();

            $check_food_for_null = 0;
            if(count($food_list)!=0)
            {
                  foreach($food_list as $f)
                    {
                        $cart_count=$cart::where('user_id',$user_id)->where('food_id',$f->id)->first();  // For Cart item quantity

                      if(count($cart_count)!=0)
                      {
                        $count = $cart_count->quantity;
                      }else
                      {
                        $count=0;
                      }
                          if($veg_only==0)
                            {
                                $check_food_for_null += 1;
                                $foods[] = array(
                                    'food_id'       => $f->id,
                                    'name'          => $f->name,
                                    'price'         => $f->price,
                                    'description'   => $f->description,
                                    'is_veg'        => $f->is_veg,
                                    'item_count'    => $count,
                                );
                             
                            }else
                            {
                                if($f->is_veg==1)
                                {
                                     $check_food_for_null += 1;

                                      $foods[] = array(
                                    'food_id'       => $f->id,
                                    'name'          => $f->name,
                                    'price'         => $f->price,
                                    'description'   => $f->description,
                                    'is_veg'        => $f->is_veg,
                                    'item_count'    => $count,
                                    );
                                }
                            }
                    }

                    $check_favourite = DB::table('favourite_list')->where('user_id',$user_id)->where('restaurant_id',$restaurant_id)->get();

                   if(count($check_favourite)!=0)
                   {
                        $is_favourite = 1;
                   }else
                   {
                        $is_favourite = 0;
                   }

                   if($check_food_for_null != 0)
                   {
                         $response_array = array('status'=>true,'food_list'=>$foods,'is_favourite'=>$is_favourite);
                   }else
                   {
                        $response_array = array('status'=>false,'message'=>'No Data Found');
                   }

               
            }else
            {
                 $response_array = array('status'=>false,'message'=>'No Data Found');
            }
        }
         $response = response()->json($response_array, 200);
            return $response;
    }

    // public function checkout(Request $request)
    // {
    //      if($request->header('authId')!="")
    //         {
    //             $user_id = $request->header('authId');
    //         }else
    //         {
    //             $user_id = $request->authId;
    //         }
    //     // $user_id = $request->header('authId');

    //     $cart = $this->cart;
    //     $foodlist = $this->foodlist;

    //     $restaurants = $this->restaurants;

    //     $check_cart = $cart::where('user_id',$user_id)->first();

    //     if(count($check_cart)!=0)
    //     {

    //             $check_food = $foodlist::where('id',$check_cart->food_id)->first();
    //             $restaurant = $restaurants::where('id',$check_food->restaurant_id)->first();

    //             $restaurant_detail = array();

    //             $restaurant_detail[] = array(
    //                 'restaurant_id'=>$restaurant->id,
    //                 'name'=>$restaurant->restaurant_name,
    //                 'image'=>$restaurant->image,
    //                 'address'=>$restaurant->address,
    //                 'estimated_delivery_time'=>$restaurant->estimated_delivery_time
    //             );



    //             $check_cart = $cart::where('user_id',$user_id)
    //                                 ->join('food_list','food_list.id','=','cart.food_id')
    //                                 ->select('food_list.name as name','food_list.price as price','food_list.is_veg as is_veg','cart.quantity as quantity','food_list.tax as tax','cart.food_id as food_id')
    //                                 ->get();

    //             $food_detail = array();
    //             $total_price = 0;
    //             $total_tax = 0;
    //             foreach($check_cart as $key)
    //             {
    //                 $total_tax = $total_tax + $key->tax;
    //                 $total_price = $total_price + ($key->price * $key->quantity);
    //                 $food_detail[] = array(
    //                     'food_id' => $key->food_id,
    //                     'name' => $key->name,
    //                     'price' => $key->price * $key->quantity,
    //                     'is_veg' => $key->is_veg,
    //                     'quantity' => $key->quantity,
    //                 );

    //             }


    //             $item_total = $total_price;

    //             // FOR COUPON CODE 
    //             if($request->coupon_code!="")
    //             {
    //                 $get_offer = DB::table('coupon_code')->where('code',$request->coupon_code)->first();
    //                 if(count($get_offer)!=0)
    //                 {   
    //                     $coupon_code = $request->coupon_code;
    //                     $offer_type = $get_offer->offer_type;
    //                     if($offer_type==0) // For % offer
    //                     {
    //                         $offer = $get_offer->value;

    //                         $coupon_discount = ($total_price/100)*$offer;
    //                     }else
    //                     {
    //                         // For price offer
    //                         $coupon_discount = $get_offer->value;

    //                     }
    //                 }else
    //                 {
    //                     $response_array = array('status'=>false,'message'=>'Invalid Coupon Code');
    //                     $response = response()->json($response_array, 200);
    //                     return $response;
    //                 }
    //             }else{
    //             $coupon_code = "NA";
    //             $coupon_discount = 0;
    //             }
    //             ////
    //             $offer_discount = $coupon_discount;
    //             $restaurant_packaging_charge = $restaurant->packaging_charge;
    //             $gst = $total_tax;
    //             $delivery_charge = 0;

    //             $bill_amount = $item_total + $restaurant_packaging_charge + $gst + $delivery_charge - $offer_discount;


    //             $invoice = array();

    //             $invoice[] = array(
    //                 'item_total' =>$total_price,
    //                 'offer_discount' => $offer_discount,
    //                 'restaurant_packaging_charge' => $restaurant_packaging_charge,
    //                 'gst' => $gst,
    //                 'delivery_charge' => $delivery_charge,
    //                 'bill_amount' => $bill_amount,
    //                 'coupon_code' => $coupon_code
    //             );

    //              $response_array = array('status'=>true,'restaurant_detail'=>$restaurant_detail,'food_detail'=>$food_detail,'invoice'=>$invoice);

    //     }else
    //     {
    //             $response_array = array('status'=>false,'message'=>'No Items in your cart');
    //     }

    //     $response = response()->json($response_array, 200);
    //         return $response;

    // }

    public function checkout(Request $request)
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
            
            $restaurants = $this->restaurants;
            $restaurant = $restaurants::with('RestaurantTimer')->where('id',$request->restaurant_id)->where('status',1)->first();
            if(empty($restaurant))
            {
                $response_array = array('status' => false, 'error_code' => 101, 'message' => "Restaurant not available");
                $response = response()->json($response_array, 200);
                return $response;
            }
            $restaurant_detail = array();

            $restaurant_detail[] = array(
                    'restaurant_id'=>$restaurant->id,
                    'name'=>$restaurant->restaurant_name,
                    'image'=>RESTAURANT_UPLOADS_PATH.$restaurant->image,
                    'address'=>$restaurant->address,
                    'delivery_type' =>  json_decode($restaurant->delivery_type),
                    'estimated_delivery_time'=>$restaurant->estimated_delivery_time,
                    'weekday_opening_time' => $restaurant->opening_time,
                    'weekday_closing_time' => $restaurant->closing_time,
                    'weekend_opening_time' => $restaurant->weekend_opening_time,
                    'weekend_closing_time' => $restaurant->weekend_closing_time,
                    'max_dining_count' => $restaurant->max_dining_count,
                    'restaurant_timing' => $restaurant->RestaurantTimer,
                    'credit_accept' => $restaurant->credit_accept
                );

                // FOR COUPON CODE 
                if($request->coupon_code!="")
                {
                    $get_offer = DB::table('coupon_code')->where('code',$request->coupon_code)->first();
                    if(count($get_offer)!=0)
                    {   
                        $coupon_code = $request->coupon_code;
                        $offer_type = $get_offer->offer_type;
                        if($offer_type==0) // For % offer
                        {
                            $offer = $get_offer->value;

                            // $coupon_discount = ($total_price/100)*$offer;
                            $coupon_discount = $offer;
                        }else
                        {
                            // For price offer
                            $coupon_discount = $get_offer->value;

                        }
                    }else
                    {
                        $response_array = array('status'=>false,'message'=>'Invalid Coupon Code');
                        $response = response()->json($response_array, 200);
                        return $response;
                    }
                }else{
                $coupon_code = "NA";
                $coupon_discount = 0;
                }
                
                $restaurant_packaging_charge = $restaurant->packaging_charge;
                $user_detail = $this->users->where('id',$user_id)->first();
                if($user_detail->device_type!=WEB)
                {
                    $data = file_get_contents(FIREBASE_URL."/current_address/$user_id.json");
                    $data = json_decode($data);
                    // print_r($data); exit;

                    $d_lat = isset($data->lat)?$data->lat:"";
                    $d_lng = isset($data->lng)?$data->lng:"";
                    $delivery_address = $data->current_address;
                    $city = isset($data->city)?$data->city:"Coimbatore";
                }else
                {
                    $delivery_address_detail = $this->deliveryaddress::where('user_id',$user_id)->where('is_default',1)->first();

                    $d_lat = $delivery_address_detail->lat;
                    $d_lng = $delivery_address_detail->lng;
                    $delivery_address = $delivery_address_detail->address;
                    $city = isset($data->city)?$data->city:"Coimbatore";
                }
                if($restaurant->restaurant_delivery_charge!=0)
                {
                    $restaurant->default_delivery_amount = $restaurant->restaurant_delivery_charge;
                    $source = $d_lat.','.$d_lng;
                    $destination = $restaurant->lat.','.$restaurant->lng;
                    $delivery_charge = $this->calculate_deliver_charge($restaurant, $source, $destination);
                
                }else
                {
                    //$delivery_charge_data = $this->addcity->where('city','like','%'.$city.'%')->first();
                    $radius = DEFAULT_RADIUS;
                    $delivery_charge_details = DB::table('add_city')
                                        ->select('add_city.*','city_geofencing.polygons', DB::raw("( 6371 * acos( cos( radians($d_lat) ) *
                                                            cos( radians( city_geofencing.latitude ) )
                                                            * cos( radians( city_geofencing.longitude ) - radians($d_lng)
                                                            ) + sin( radians($d_lat) ) *
                                                            sin( radians( city_geofencing.latitude ) ) )
                                                        ) AS distance"))
                                        ->leftJoin('city_geofencing', function($join)
                                        {
                                            $join->on('city_geofencing.city_id', '=', 'add_city.id');
                                        })
                                        ->orderBy('distance','asc')
                                       // ->having("distance", "<", $radius)
                                        ->get();
                        
                    // dd($delivery_charge_details);
                    $delivery_charge_data = "";
                    $source = $d_lat.','.$d_lng;
                    foreach($delivery_charge_details as $value)
                    {
                        $polygon = json_decode($value->polygons);
                        // dd($polygon[0]);
                        $ponits = array($d_lng,$d_lat);
                        $is_avail = $this->contains($ponits, $polygon[0]);
                        // echo $is_avail;
                        if($is_avail==1)
                        {
                            $delivery_charge_data = $value;
                            break;
                        }
                    }
                    
                    // if($delivery_charge_data=="")
                    // {
                    //     $response_array = array('status'=>false,'message'=>"Your location not in deliverable area");
                    //     $response = response()->json($response_array, 200);
                    //     return $response;
                    // }
                    if($delivery_charge_data!="")
                    {
                        $destination = $restaurant->lat.','.$restaurant->lng;
                        $delivery_charge = $this->calculate_deliver_charge($delivery_charge_data, $source, $destination);
                    }else
                    {
                        $delivery_charge = 0;
                    }
                }


                $invoice = array();

                $invoice[] = array(
                    'offer_discount' => $coupon_discount,
                    'restaurant_packaging_charge' => $restaurant_packaging_charge,
                    'delivery_charge' => (int)$delivery_charge,
                    'coupon_code' => $coupon_code
                );

                 $response_array = array('status'=>true,'restaurant_detail'=>$restaurant_detail,'invoice'=>$invoice);

        }

        $response = response()->json($response_array, 200);
            return $response;

    }

    public function paynow(Request $request)
    {
        $validator = Validator::make(
                $request->all(),
                array(
                    'restaurant_id' => 'required',
                    'item_total' => 'required',
                    'offer_discount'  => 'required',
                    'restaurant_packaging_charge'  => 'required',
                    'gst'  => 'required',
                    'delivery_charge'  => 'required',
                    'bill_amount'  => 'required',
                    'coupon_code'  => 'required',
                    'food_id'  => 'required',
                    'food_qty'  => 'required',
                    'paid_type' => 'required',
                    // 'delivery_address' => 'required'
                ));

        if ($validator->fails())
        {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        }else
        {            
            $foodrequest = $this->foodrequest;
            $cart = $this->cart;
            $trackorderstatus = $this->trackorderstatus;
            $settings = $this->settings;
             if($request->header('authId')!="")
            {
                $user_id = $request->header('authId');
            }else
            {
                $user_id = $request->authId;
            }
            if($request->paid_type==2 && $request->bill_amount!=0)
            {
                $get_card = Cards::where('user_id',$user_id)->where('is_default',1)->first();
                if(!$get_card)
                {
                    $response_array = array('status' => false, 'message' => "Card not found");
                    $response = response()->json($response_array, 200);
                    return $response;
                }
                $stripe_charge = Payment::stripeCreateCharge($request->bill_amount, $get_card);
                if($stripe_charge->success){
                    $stripe_transaction=new Transactions();
                    $stripe_transaction->user_id = $user_id;
                    $stripe_transaction->stripe_trans_id = $stripe_charge->id;
                    $stripe_transaction->amount = $request->bill_amount;
                    $stripe_transaction->status = 1;
                    $stripe_transaction->save();
                }else
                {
                    $response_array = array('status' => false, 'message' => "Stripe Payment Failed",'stripe_message' =>$stripe_charge->message);
                    $response = response()->json($response_array, 200);
                    return $response;
                }
            }

            // $user_id = $request->header('authId');
            $restaurant_id = $request->restaurant_id;
            $item_total = $request->item_total;
            $offer_discount = $request->offer_discount;
            $restaurant_packaging_charge = $request->restaurant_packaging_charge;
            $gst = $request->gst;
            $delivery_charge = $request->delivery_charge;
            $bill_amount = $request->bill_amount;
            $coupon_code = $request->coupon_code;
            $delivery_type = isset($request->delivery_type)?$request->delivery_type:1;
            $restaurant_discount = isset($request->restaurant_discount)?$request->restaurant_discount:0;

            $user_detail = $this->users->where('id',$user_id)->first();
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
            $paid_type = $request->paid_type;


            if($user_detail->device_type!=WEB)
            {

                $data = file_get_contents(FIREBASE_URL."/current_address/$user_id.json");
                $data = json_decode($data);

                // var_dump($data); 
                // echo $data->current_address; exit;
                $d_lat = isset($data->lat)?$data->lat:"";
                $d_lng = isset($data->lng)?$data->lng:"";
                $delivery_address = $data->current_address;
                $city = isset($data->city)?$data->city:"coimbatore";
            }else
            {
                $delivery_address_detail = $this->deliveryaddress::where('user_id',$user_id)->where('is_default',1)->first();

                $d_lat = $delivery_address_detail->lat;
                $d_lng = $delivery_address_detail->lng;
                $delivery_address = $delivery_address_detail->address;
                $city = isset($data->city)?$data->city:"coimbatore";
            }
                        

            $order_id =$this->generate_booking_id();
            $city_id = $distance = 0;
            //get restaurant based commission
            $restaurant_details = $this->restaurants->find($restaurant_id);
            if(!empty($restaurant_details->admin_commision))
            {
                $admin_commision_setting = $restaurant_details->admin_commision;
            }else
            {
                //$admin_commision_setting = $this->addcity->where('city','like','%'.$city.'%')->value('admin_commision');
                $admin_commision_details = DB::table('add_city')
                                    ->select('add_city.*','city_geofencing.polygons', DB::raw("( 6371 * acos( cos( radians($d_lat) ) *
                                                        cos( radians( city_geofencing.latitude ) )
                                                        * cos( radians( city_geofencing.longitude ) - radians($d_lng)
                                                        ) + sin( radians($d_lat) ) *
                                                        sin( radians( city_geofencing.latitude ) ) )
                                                    ) AS distance"))
                                    ->leftJoin('city_geofencing', function($join)
                                    {
                                        $join->on('city_geofencing.city_id', '=', 'add_city.id');
                                    })
                                    ->orderBy('distance','asc')
                                   // ->having("distance", "<", $radius)
                                    ->get();
                
                $admin_commision_setting = 0;
                $source = $d_lat.','.$d_lng;
                foreach($admin_commision_details as $value)
                {
                    $polygon = json_decode($value->polygons);
                    //dd($polygon[0]);
                    $ponits = array($d_lng,$d_lat);
                    $is_avail = $this->contains($ponits, $polygon[0]);
                    //echo $is_avail;exit;
                    if($is_avail==1)
                    {
                        $admin_commision_setting = $value->admin_commision;
                        $city_id = $value->id;
                        break;
                    }
                }
            }
            
            if(!empty($restaurant_details->driver_commision))
            {
                //$delivery_boy_commission = $restaurant_details->driver_commision;
                $source = $d_lat.','.$d_lng;
                $destination = $restaurant_details->lat.','.$restaurant_details->lng;
                $delivery_boy_commission_data = $this->calculate_driver_commission($restaurant_details, $source, $destination);
                $delivery_boy_commission = $delivery_boy_commission_data->delivery_boy_commission;
            }else
            {
                $source = $d_lat.','.$d_lng;
                $radius = DEFAULT_RADIUS;
                $delivery_boy_commision_details = DB::table('add_city')
                                    ->select('add_city.*','city_geofencing.polygons', DB::raw("( 6371 * acos( cos( radians($d_lat) ) *
                                                        cos( radians( city_geofencing.latitude ) )
                                                        * cos( radians( city_geofencing.longitude ) - radians($d_lng)
                                                        ) + sin( radians($d_lat) ) *
                                                        sin( radians( city_geofencing.latitude ) ) )
                                                    ) AS distance"))
                                    ->leftJoin('city_geofencing', function($join)
                                    {
                                        $join->on('city_geofencing.city_id', '=', 'add_city.id');
                                    })
                                   // ->having("distance", "<", $radius)
                                   ->orderBy('distance','asc')
                                    ->get();
                    
                //dd($delivery_boy_commision_details);
                $delivery_boy_commision_data =  0;
                $source = $d_lat.','.$d_lng;
                foreach($delivery_boy_commision_details as $value)
                {
                    $polygon = json_decode($value->polygons);
                    //dd($polygon[0]);
                    $ponits = array($d_lng,$d_lat);
                    $is_avail = $this->contains($ponits, $polygon[0]);
                    //echo $value->id."/".$is_avail."<br>";
                    if($is_avail==1)
                    {
                        $delivery_boy_commision_data = $value;
                        $city_id = $value->id;
                        break;
                    }
                }
                //exit;
                if(!empty($delivery_boy_commision_data))
                {
                    $destination = $restaurant_details->lat.','.$restaurant_details->lng;
                    $delivery_boy_commission_data = $this->calculate_driver_commission($delivery_boy_commision_data, $source, $destination);
                    $delivery_boy_commission = $delivery_boy_commission_data['delivery_boy_commission'];
                    $distance = $delivery_boy_commission_data['distance'];
                }else
                {
                    $delivery_boy_commission = 0;
                }
                
            }
            
            //check delivery type
            if($delivery_type!=1)
                $delivery_boy_commission = $delivery_charge = 0;
            
            $admin_calculation_amount = ($item_total + $gst + $restaurant_packaging_charge); 
            $admin_commission_total = ($admin_calculation_amount/100)*$admin_commision_setting; 
            $admin_commission = ($admin_commission_total+$delivery_charge)-$delivery_boy_commission - $offer_discount; 
            $restaurant_commission = (($item_total + $gst + $restaurant_packaging_charge)-$restaurant_discount) - $admin_commission_total; 
            $wallet_amount = 0;
            $wallet_balance = $user_detail->wallet_balance;
            if(isset($request->is_wallet) && $request->is_wallet=="1")
            {
                //$total_amount = ($item_total+$delivery_charge+$gst+$restaurant_packaging_charge)-$offer_discount-$restaurant_discount;
                if($bill_amount>$wallet_balance)
                {
                    $wallet_amount = $wallet_balance;
                }else
                {
                    $wallet_amount = $bill_amount;
                }
                $user_detail->wallet_balance = $wallet_balance - $wallet_amount;
                $user_detail->save();
            }
            $order_data = array();
            $order_data[] = array(
                'order_id'=>$order_id,
                'user_id'=>$user_id,
                'restaurant_id'=>$restaurant_id,
                'delivery_type' => $delivery_type,
                'total_members' => isset($request->total_members)?$request->total_members:0,
                'pickup_dining_time' => isset($request->pickup_dining_time)?date("Y-m-d H:i:s",strtotime($request->pickup_dining_time)):"",
                'item_total'=>$item_total,
                'offer_discount'=>$offer_discount,
                'restaurant_discount' => $restaurant_discount,
                'restaurant_packaging_charge'=>$restaurant_packaging_charge,
                'tax'=>$gst,
                'delivery_charge'=>$delivery_charge,
                'bill_amount'=>$bill_amount,
                'wallet_amount' => $wallet_amount,
                'admin_commision'=>$admin_commission,
                'restaurant_commision'=>$restaurant_commission,
                'delivery_boy_commision'=>$delivery_boy_commission,
                'coupon_code'=>$coupon_code,
                'is_confirmed'=>0,
                'is_paid'=>0,
                'paid_type'=>$paid_type,
                'delivery_address'=>$delivery_address,
                'd_lat'=>$d_lat,
                'd_lng'=>$d_lng,
                'distance' => $distance,
                'city_id' => $city_id,
                'credit_paid' => ($request->paid_type==3)?0:1,
                'ordered_time'=>date('Y-m-d H:i:s'),
            );
            $foodrequest::insert($order_data);

            $last_id = $foodrequest::where('user_id',$user_id)->where('restaurant_id',$restaurant_id)->orderBy('id','desc')->first();

            $request_id = $last_id->id;

            for($i=0;$i<$food_id_size;$i++)
            {   
                $request_detail = new Requestdetail;
                $request_detail->request_id = $last_id->id;
                $request_detail->restaurant_id = $restaurant_id;
                $request_detail->food_id = $food_id[$i];
                $request_detail->quantity = $food_qty[$i];
                $request_detail->addon_list = '0';
                $request_detail->food_quantity_price = $food_quantity_price[$i];
                $request_detail->food_quantity = $food_quantity[$i];
                $request_detail->save();

                $request_detail_id = $request_detail->id;
               if($request->add_ons[$i]!=''&&$request->add_ons[$i]!=0)
               {
                    $addon_ids = explode(',',$request->add_ons[$i]);
                    for($j=0;$j<count($addon_ids);$j++){
                        $add_ons = $this->add_ons->find($addon_ids[$j]);
                        $requestdetail_addons = new RequestdetailAddons;
                        $requestdetail_addons->requestdetail_id = $request_detail_id;
                        $requestdetail_addons->addons_id = $add_ons->id;
                        $requestdetail_addons->name = $add_ons->name;
                        $requestdetail_addons->price = $add_ons->price;
                        $requestdetail_addons->save();
                    }
               }

            }
            if($request->paid_type==2)
            {
                $stripe_transaction->request_id = $request_id;
                $stripe_transaction->save();
            }
            if($request->paid_type==3)
            {
                $credit_amount = $this->user_credit->where('user_id',$user_id)->where('status',1)->first();
                $credit_amount->amount = $credit_amount->amount - $bill_amount;
                $credit_amount->save();
            }

            //insert into firebase only when the delivery type is home delivery
            if($delivery_type==1){
                $header = array();
                $header[] = 'Content-Type: application/json';
                $postdata = array();
                // $postdata['id'] = $request_id;
                $postdata['user_id'] = $user_id;
                $postdata['request_id'] = $request_id;
                $postdata = json_encode($postdata);
                
                $ch = curl_init(FIREBASE_URL."/new_user_request/$user_id.json");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                $result = curl_exec($ch); 
                curl_close($ch); 
                

                $header = array();
                $header[] = 'Content-Type: application/json';
                $postdata = array();
                // $postdata['id'] = $request_id;
                $postdata['request_id'] = (string)$request_id;
                $postdata['user_id'] = (float)$user_id;
                $postdata['provider_id'] = "0";
                $postdata['status'] = 0;
                $postdata = json_encode($postdata);
                
                $ch = curl_init(FIREBASE_URL."/current_request/$request_id.json");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
                $result = curl_exec($ch); 
                curl_close($ch); 
            }

            //update in firebase for restaurant notification
            $postdata = array();
            $postdata['status'] = 0;
            $postdata = json_encode($postdata);
            $this->update_firebase($postdata, 'restaurant_request/'.$restaurant_id, $request_id);

            $cart::where('user_id',$user_id)->delete();

            // $status_entry[] = array(
            //     'request_id'=>$request_id,
            //     'status'=>0,
            //     'detail'=>"Order Placed"
            // );

            // $trackorderstatus::insert($status_entry);

            $trackorderstatus->request_id = $request_id;
            $trackorderstatus->status = 0;
            $trackorderstatus->detail = "Order Placed";
            $trackorderstatus->save();

            //send push notification to restaurant
			if(isset($restaurant_details->device_token) && $restaurant_details->device_token!='')
			{
				$title = $message = trans('constants.new_order');
				$data = array(
					'device_token' => $restaurant_details->device_token,
					'device_type' => $restaurant_details->device_type,
					'title' => $title,
					'message' => $message,
					'request_id' => $request_id,
					'delivery_type' => $delivery_type
				);
				$this->user_send_push_notification($data);
			}

            // file_get_contents('http://'.$_SERVER['HTTP_HOST'].':3030/new-request?id='.$restaurant_id);

            if(EMAIL_ENABLE==1)
            {
                $order_details = $foodrequest->find($request_id);
                $order_details->subject = 'New Order Received';
                $order_details->email = $user_detail->email;
                $order_details->name = 'User';
                $this->send_mail($order_details,'order_complete');
            }

            $response_array = array('status'=>true,'message'=>'Order Placed Successfully');

        }

        $response = response()->json($response_array, 200);
        return $response;
    }

    public function search_restaurants(Request $request)
    {

         $validator = Validator::make(
                $request->all(),
                array(
                    'key_word' => 'required',
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
            $key_word = $request->key_word;
            $source_lat = $request->lat;
            $source_lng = $request->lng;

            $data = $restaurants->with(['Cuisines','RestaurantTimer'])->where('status',1)
                    ->where('restaurant_name', 'like', '%' . $key_word . '%')
                    ->select('restaurants.*')
                    ->selectRaw("(6371 * acos(cos(radians(" . $source_lat . "))* cos(radians(`lat`)) 
                            * cos(radians(`lng`) - radians(" . $source_lng . ")) + sin(radians(" . $source_lat . ")) 
                            * sin(radians(`lat`)))) as distance")
                    ->having('distance','<=',DEFAULT_RADIUS)
                    ->orderBy('distance')
                    ->get();

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
                       $restaurant_list[] = array(
                            'id'        =>$d->id,
                            'name'      => $d->restaurant_name,
                            'image'     => RESTAURANT_UPLOADS_PATH.$d->image,
                            'discount'  => $d->discount,
                            'rating'    => $d->rating,
                            'is_open'   => $is_open,     // 1- Open , 0 - Close
                            'cuisines'  => $rcuisines,
                            'travel_time' => $d->estimated_delivery_time,
                            'price'     => $restaurant_offer,
                            'discount_type' => $d->discount_type,
                            'target_amount' => $d->target_amount,
                            'offer_amount'  => $d->offer_amount,
                            'is_favourite'=>$is_favourite,
                            'delivery_type' => $d->delivery_type,
                            'address'=>$d->address
                            );

                    $j++;
               
                // }
            }

            if(count($data)!=0)
            {
                $response_array = array('status'=>true,'restaurants'=>$restaurant_list);
            }else
            {
                $response_array = array('status'=>false,'message'=>'No Restaurants Found');
            }

        }

         $response = response()->json($response_array, 200);
            return $response;
    }


    /**
     * get dining restaurants
     * 
     * @param object $request
     * 
     * @return json $response
     */
    public function get_dining_restaurant(Request $request)
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

            $query = $restaurants->with(['Cuisines','RestaurantTimer'])->Where(function($q)
                    {
                        $q->where("status",1)->where("delivery_type",'["3"]');
                    })
                    ->orWhere(function($q)
                    {
                        $q->where("status",1)->where("delivery_type",'["1","2","3"]');
                    })
                    ->orWhere(function($q)
                    {
                        $q->where("status",1)->where("delivery_type",'[2","3"]');
                    })
                    ->orWhere(function($q)
                    {
                        $q->where("status",1)->where("delivery_type",'["1","3"]');
                    })
                    ->select('restaurants.*')
                    ->selectRaw("(6371 * acos(cos(radians(" . $source_lat . "))* cos(radians(`lat`)) 
                            * cos(radians(`lng`) - radians(" . $source_lng . ")) + sin(radians(" . $source_lat . ")) 
                            * sin(radians(`lat`)))) as distance")
                    ->having('distance','<=',DEFAULT_RADIUS)
                    ->orderBy('distance');
                
           
            $limit = PAGINATION;
            $page = isset($request->page)?$request->page:1;
            $offset = ($page - 1) * $limit;
            $query = $query->when(($limit!='-1' && isset($offset)), 
                        function($q) use($limit, $offset){
                            return $q->offset($offset)->limit($limit);
                        });
                    
            $data = $query->get();
//dd($data);
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

                if(sizeof($rcuisines)>0)
                {
                    $restaurant_list[] = array(
                        'id'        =>$d->id,
                        'name'      => $d->restaurant_name,
                        'image'     => RESTAURANT_UPLOADS_PATH.$d->image,
                        'discount'  => $d->discount,
                        'rating'    => $d->rating,
                        'is_open'   => $is_open,     // 1- Open , 0 - Close
                        'cuisines'  => $rcuisines,
                        'travel_time' => $d->estimated_delivery_time,
                        'price'     => $restaurant_offer,
                        'discount_type' => $d->discount_type,
                        'target_amount' => $d->target_amount,
                        'offer_amount'  => $d->offer_amount,
                        'is_favourite'=>$is_favourite,
                        'delivery_type' => $d->delivery_type,
                        'weekday_opening_time' => $d->opening_time,
                        'weekday_closing_time' => $d->closing_time,
                        'weekend_opening_time' => $d->weekend_opening_time,
                        'weekend_closing_time' => $d->weekend_closing_time,
                        'max_dining_count' => $d->max_dining_count,
                        'restaurant_timing' => $d->RestaurantTimer
                        );
                }

            }

            if(sizeof($restaurant_list)>0)
            {
                $response_array = array('status'=>true,'restaurants'=>$restaurant_list);
            }else
            {
                $response_array = array('status'=>false,'message'=>__('constants.no_data'));
            }
        }
        $response = response()->json($response_array, 200);
        return $response;
    }

    public function paynow_dining(Request $request)
    {
        $validator = Validator::make(
                $request->all(),
                array(
                    'restaurant_id' => 'required',
                    'total_members' => 'required',
                    'pickup_dining_time' => 'required'
                ));

        if ($validator->fails())
        {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        }else
        {

            $foodrequest = $this->foodrequest;
            $trackorderstatus = $this->trackorderstatus;
            $settings = $this->settings;
             if($request->header('authId')!="")
            {
                $user_id = $request->header('authId');
            }else
            {
                $user_id = $request->authId;
            }
            // $user_id = $request->header('authId');
            $restaurant_id = $request->restaurant_id;
            
            $delivery_type = isset($request->delivery_type)?$request->delivery_type:3;

            $user_detail = $this->users::where('id',$user_id)->first();

            $order_id =$this->generate_booking_id();

            $order_data = array();

            $order_data[] = array(
                'order_id'=>$order_id,
                'user_id'=>$user_id,
                'restaurant_id'=>$restaurant_id,
                'delivery_type' => $delivery_type,
                'total_members' => isset($request->total_members)?$request->total_members:0,
                'pickup_dining_time' => isset($request->pickup_dining_time)?date("Y-m-d H:i:s",strtotime($request->pickup_dining_time)):"0000-00-00 00:00:00",
                'is_confirmed'=>0,
                'is_paid'=>0,
                'ordered_time'=>date('Y-m-d H:i:s'),
            );
            $foodrequest::insert($order_data);
            $last_id = $foodrequest::where('user_id',$user_id)->where('restaurant_id',$restaurant_id)->orderBy('id','desc')->first();
            $request_id = $last_id->id;

            // $status_entry[] = array(
            //     'request_id'=>$request_id,
            //     'status'=>0,
            //     'detail'=>"Order Placed",
            // );

            // $trackorderstatus::insert($status_entry);

            $trackorderstatus->request_id = $request_id;
            $trackorderstatus->status = 0;
            $trackorderstatus->detail = "Order Placed";
            $trackorderstatus->save();

            //sesnd email to user
            if(EMAIL_ENABLE==1)
            {
                //$order_details = $foodrequest->find($request_id);
            }
            //send push notification to restaurant
            $restaurant_details = $this->restaurants->find($restaurant_id);
			if(isset($restaurant_details->device_token) && $restaurant_details->device_token!='')
			{
				$title = $message = trans('constants.new_order');
				$data = array(
					'device_token' => $restaurant_details->device_token,
					'device_type' => $restaurant_details->device_type,
					'title' => $title,
					'message' => $message,
					'request_id' => $request_id,
					'delivery_type' => $delivery_type
				);
				$this->user_send_push_notification($data);
			}

            $response_array = array('status'=>true,'message'=>__('constants.order_place'));
            file_get_contents("http://".$_SERVER['HTTP_HOST'].":3030/new-request?id=".$restaurant_id);

        }

        $response = response()->json($response_array, 200);
            return $response;
    }



    public function todays_special(Request $request)
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
            $source_lat = $request->lat;
            $source_lng = $request->lng;
            
            $food_list = $this->foodlist->leftJoin('restaurants','food_list.restaurant_id','=','restaurants.id')
                            ->select('food_list.*','restaurants.restaurant_name as name')
                            ->selectRaw("(6371 * acos(cos(radians(" . $source_lat . "))* cos(radians(`lat`)) 
                                    * cos(radians(`lng`) - radians(" . $source_lng . ")) + sin(radians(" . $source_lat . ")) 
                                    * sin(radians(`lat`)))) as distance")
                            ->having('distance','<=',DEFAULT_RADIUS)
                            ->orderBy('distance')->where('food_list.is_special',1)
                            ->where('food_list.status',1)->get();

                foreach ($food_list as $key=>$value ) 
                {
                    $value->image = FOOD_IMAGE_PATH.$value->image;

                    //calculate restaurant open time
                    $get_timings = $this->restaurants->with('RestaurantTimer')->where('id',$value->restaurant_id)->first();
                    $is_open = $this->check_restaurant_open($get_timings);
                    if($is_open==0){ 
                        $food_list = $food_list->reject(function ($value1, $key1) use($key){
                            return $key == $key1;
                        });
                        
                    }
                }

            $response_array = array('status'=>true,'food_list'=>$food_list);
        }

        $response = response()->json($response_array, 200);
        return $response;
    }
    

}