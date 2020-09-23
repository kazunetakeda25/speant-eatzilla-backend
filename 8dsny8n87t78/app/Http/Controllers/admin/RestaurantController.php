<?php

namespace App\Http\Controllers\admin;
                                    
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController;
use Carbon\Carbon;
use App\Model\Deliverypartners;
use App\Model\DriverList;
use App\Model\City_geofencing;
use DB;
use Hash;
use Illuminate\Support\Facades\Storage;


class RestaurantController extends BaseController
{

	public function restaurant_list(Request $request)
	{
        $data = $this->restaurants->with('Foodrequest')->get();
       //dd($data[0]->Foodrequest[0]);
		return view('restaurant_list',['data'=>$data]);
	}

	public function restaurant()
	{
		$city = $this->addcity->get();
        $area = $this->addarea->get();
        $cuisines = $this->cuisines->where('status',1)->get();
        $document = $this->document->where('document_for',2)->where('status',1)->get();
        $title = "ADD RESTAURANT";

		return view('/add_restaurant',['city'=>$city,'area'=>$area,'title'=>$title,'cuisines'=>$cuisines,'document'=>$document]);
	}

	public function edit_restaurant($id,Request $request)
	{

		$city = $this->addcity->get();
        $area = $this->addarea->get();
        $cuisines = $this->cuisines->where('status',1)->get();
        $title = "EDIT RESTAURANT";
		$restaurants = $this->restaurants;
        $restaurant_detail = $restaurants->where('id',$id)->with(['Cuisines','Document','RestaurantBankDetails'])->first();
        $document = $this->document->where('document_for',2)->where('status',1)->get();
        //dd($restaurant_detail->document);
        $weekdays = $this->restaurant_timer->where('restaurant_id',$id)
                                           ->where('is_weekend',0)
                                           ->get();
        $weekenddays = $this->restaurant_timer->where('restaurant_id',$id)
                                              ->where('is_weekend',1)
                                              ->get();

        $cuisine_ids = array();
        if(isset($restaurant_detail->Cuisines))
        {
            foreach($restaurant_detail->Cuisines as $val){
                $cuisine_ids[] = $val->id;
            }
        }
        
		return view('add_restaurant',['cuisine_ids'=>$cuisine_ids,'data'=>$restaurant_detail,'city'=>$city,'area'=>$area,'title'=>$title,'cuisines'=>$cuisines,'document'=>$document,'weekdays'=>$weekdays,'weekenddays'=>$weekenddays]);
	}

	public function add_to_restaurants(Request $request)
	{
     //dd($request->all());
        $rules = array(
            'name' => 'required|max:50',
            'password' => 'required',
            'city' => 'required',
            'area' => 'required',
            //'status' => 'required',
            //'opening_time' => 'required',
            //'closing_time' => 'required',
            //'weekend_opening_time' => 'required',
            //'weekend_closing_time' => 'required',
            'weekdays' => 'required',
            'weekenddays' => 'required',
            'estimated_delivery_time' => 'required',
            'fssai_license' => 'required',
            'address' => 'required',
            'packaging_charge' => 'required',
            'tax' => 'required',
            'delivery_type' => 'required|array',
            'cuisines' => 'required|array',
            'account_name' => 'required',
            'account_address' => 'required',
            'account_no' => 'required',
            'bank_name' => 'required',
            'branch_name' => 'required',
            'branch_address' => 'required',
        );
        if($request->id!='')
        {
            $rules['email'] = 'required|unique:restaurants,email,'.$request->id;
            $rules['phone'] = 'required|numeric|unique:restaurants,phone,'.$request->id;
        }else
        {
            $rules['image'] = 'required|max:2048|mimes:jpeg,jpg,bmp,png';
            $rules['email'] = 'required|unique:restaurants,email';
            $rules['phone'] = 'required|numeric|unique:restaurants,phone';
            //$rules['status'] = 'required';
        }
        // foreach($request->document as $key=>$value){
        //     $rules['document.document.*'] = 'max:2048';
        // }
       // dd($rules);
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {

            $error_messages = implode(',',$validator->messages()->all());
            
            return back()->withInput()->with('error', $error_messages);

        }else
        {
            //dd($request->document);
				$restaurants = $this->restaurants;
				$custom = $this->custom;
				$name = $request->name;
				$email = $request->email;
				$phone = $request->phone;
                $city = $request->city;
                $tax = $request->tax;
				$area = $request->area;
				$discount_type = $request->discount_type;
				$target_amount = $request->target_amount;
				$offer_amount = $request->offer_amount;
                $admin_commision =  $request->admin_commision;
                $dining_count = isset($request->dining_count)?$request->dining_count:0;
                $min_dist_delivery_price = $request->min_dist_delivery_price;
                $extra_fee_deliveryamount = $request->extra_fee_deliveryamount;
                $driver_base_price = $request->driver_base_price;
                $min_dist_base_price = $request->min_dist_base_price;
                $extra_fee_amount = $request->extra_fee_amount;
				 if(isset($request->status))
                {
                 $status = $request->status;
                }
                else
                {
                $status=2;
                }


                $opening_time = 0;
                $closing_time = 0;
                $weekend_opening_time = 0;
                $weekend_closing_time = 0;
                $image = "";
				if($request->image)
				{
                    $image = $custom->restaurant_upload_image($request,'image');
                    //$url = 'https://s3.eu-west-2.amazonaws.com/boxfood-imageupload/';
                }
                else
				{
					$image=PROFILE_ICON;
				}
				$packaging_charge = $request->packaging_charge;
				//$offer_percentage = $request->offer_percentage;
				if($request->shop_description)
				{
				$shop_description = $request->shop_description;
				}else
				{
					$shop_description = "";
				}
				$estimated_delivery_time = $request->estimated_delivery_time;
				$address = $request->address;

				if($request->id)
				{

                    $restaurants_det = $restaurants->find($request->id);
					if(!$request->image)
					{
					    $image = $restaurants_det->image;
					}
																
                    $restaurants_det->restaurant_name = $name;
                    $restaurants_det->image = $image;
                    $restaurants_det->email = $email;
                    $restaurants_det->org_password = $request->password;
                    $restaurants_det->password = Hash::make($request->password);
                    $restaurants_det->phone = $phone;
                    $restaurants_det->city = $city;
                    $restaurants_det->max_dining_count = $dining_count;
                    $restaurants_det->area = $area;
                    $restaurants_det->tax = $tax;
                    $restaurants_det->discount_type = $discount_type;
                    $restaurants_det->target_amount = $target_amount;
                    $restaurants_det->offer_amount = $offer_amount;
                    $restaurants_det->admin_commision = $admin_commision;
                    $restaurants_det->restaurant_delivery_charge = $request->restaurant_delivery_charge;
                    $restaurants_det->min_dist_delivery_price = $min_dist_delivery_price;
                    $restaurants_det->extra_fee_deliveryamount = $extra_fee_deliveryamount;
                    $restaurants_det->driver_commision = 0;
                    $restaurants_det->driver_base_price = $driver_base_price;
                    $restaurants_det->min_dist_base_price = $min_dist_base_price;
                    $restaurants_det->extra_fee_amount = $extra_fee_amount;
                    //$restaurants_det->discount = $offer_percentage;
                    $restaurants_det->shop_description = $shop_description;
                    $restaurants_det->is_open = 0;
                    $restaurants_det->lat = $request->latitude;
                    $restaurants_det->lng = $request->longitude;
                    $restaurants_det->estimated_delivery_time = $estimated_delivery_time;
                    $restaurants_det->packaging_charge = $packaging_charge;
                    $restaurants_det->address = $address;
                    $restaurants_det->opening_time = $opening_time;
                    $restaurants_det->closing_time = $closing_time;
                    $restaurants_det->weekend_opening_time = $weekend_opening_time;
                    $restaurants_det->weekend_closing_time = $weekend_closing_time;
                    $restaurants_det->status = $status;
                    $restaurants_det->credit_accept = isset($request->credit_accept)?$request->credit_accept:0;
                    $restaurants_det->fssai_license = $request->fssai_license;
                    $restaurants_det->delivery_type = json_encode($request->delivery_type);
                    $restaurants_det->save();

                    $this->restaurant_timer->where('restaurant_id',$request->id)->delete();

                    for ($i=0; $i < count($request->weekdays['opening_time']); $i++) { 
                        # code...
                        if($request->weekdays['opening_time'][$i]!='00:00' || $request->weekdays['closing_time'][$i]!='00:00')
                        {
                            $restaurant_timer                 = new $this->restaurant_timer;
                            $restaurant_timer->restaurant_id  = $request->id;
                            $restaurant_timer->opening_time   = date("H:i:s",strtotime($request->weekdays['opening_time'][$i]));
                            $restaurant_timer->closing_time   = date("H:i:s",strtotime($request->weekdays['closing_time'][$i]));
                            $restaurant_timer->save(); 
                        }
                      
                    }
                 
                
                    for ($j=0; $j < count($request->weekenddays['opening_time']); $j++) { 
                        if($request->weekenddays['opening_time'][$j]!='00:00' || $request->weekenddays['closing_time'][$j]!='00:00')
                        {
                            $restaurant_timer1                 = new $this->restaurant_timer;
                            $restaurant_timer1->restaurant_id  = $request->id;
                            $restaurant_timer1->opening_time   = date("H:i:s",strtotime($request->weekenddays['opening_time'][$j]));
                            $restaurant_timer1->closing_time   = date("H:i:s",strtotime($request->weekenddays['closing_time'][$j]));
                            $restaurant_timer1->is_weekend     = 1; 
                            //dd($restaurant_timer1);
                            $restaurant_timer1->save();
                        }
                    }
                                
                    $cuisines = $this->cuisines->find($request->cuisines);
                    //update many to many relationship data
                    $restaurants_det->Cuisines()->sync($cuisines);

                    //data insert into document many to many
                    $sync_data=array();
                    if(!empty($request->document)){
                        foreach($request->document as $key=>$value){
                            if($_FILES['document']['name'][$key]['document']!='')
                            {
                                $expiry_date='';
                                if(isset($value['date']) && $value['date']!=null) $expiry_date=date("Y-m-d",strtotime($value['date']));

                                $filename = strtotime(date("Y-m-d")).basename($_FILES['document']['name'][$key]['document']);
                                move_uploaded_file($_FILES["document"]["tmp_name"][$key]['document'], 'public/uploads/Restaurant Document/'.$filename);                                
                                
                                $sync_data[$key] = ['document' => $filename,'expiry_date'=>$expiry_date];

                                // if($expiry_date!='' && $_FILES['document']['name'][$key]['document']!='')
                                //     $sync_data[$key] = ['document' => $filename,'expiry_date'=>$expiry_date];
                                // elseif($expiry_date==''  && $_FILES['document']['name'][$key]['document']!='')
                                //     $sync_data[$key] = ['document' => $filename, ,'expiry_date'=>$expiry_date];
                                // elseif($expiry_date!=''  && $_FILES['document']['name'][$key]['document']=='')
                                //     $sync_data[$key] = ['expiry_date'=>$expiry_date];
                            }
                        }
                        $restaurants_det->Document()->sync($sync_data);
                    }
                    $restaurant_bank_details = $this->restaurant_bank_details->where('restaurant_id',$request->id)->first();
                    if(empty($restaurant_bank_details)) $restaurant_bank_details = $this->restaurant_bank_details;
                    $restaurant_bank_details->account_name = $request->account_name;
                    $restaurant_bank_details->account_address = $request->account_address;
                    $restaurant_bank_details->account_no = $request->account_no;
                    $restaurant_bank_details->bank_name = $request->bank_name;
                    $restaurant_bank_details->branch_name = $request->branch_name;
                    $restaurant_bank_details->branch_address = $request->branch_address;
                    $restaurant_bank_details->swift_code = $request->swift_code;
                    $restaurant_bank_details->routing_no = $request->routing_no;
                    $restaurants_det->RestaurantBankDetails()->save($restaurant_bank_details);
                    $msg = "update_success_msg";

				}else
				{

                    $check_email_phone = $restaurants->where('email',$request->email)->orwhere('phone',$request->phone)->first();
                    if($check_email_phone){
                        return back()->with('error', 'Email/Phone already exists');
                    }
                    $restaurants->restaurant_name = $name;
                    $restaurants->image = $image;
                    $restaurants->email = $email;
                    $restaurants->org_password = $request->password;
                    $restaurants->password = Hash::make($request->password);
                    $restaurants->phone = $phone;
                    $restaurants->city = $city;
                    $restaurants->max_dining_count = $dining_count;
                    $restaurants->area = $area;
                    $restaurants->tax = $tax;
                    $restaurants->discount_type = $discount_type;
                    $restaurants->target_amount = $target_amount;
                    $restaurants->offer_amount = $offer_amount;
                    $restaurants->admin_commision = $admin_commision;
                    $restaurants->restaurant_delivery_charge = $request->restaurant_delivery_charge;
                    $restaurants->min_dist_delivery_price = $min_dist_delivery_price;
                    $restaurants->extra_fee_deliveryamount = $extra_fee_deliveryamount;
                    $restaurants->driver_commision = $request->driver_commision;
                    //$restaurants->discount = $offer_percentage;
                    $restaurants->shop_description = $shop_description;
                    $restaurants->is_open = 0;
                    $restaurants->estimated_delivery_time = $estimated_delivery_time;
                    $restaurants->packaging_charge = $packaging_charge;
                    $restaurants->address = $address;
                    $restaurants->lat = $request->latitude;
                    $restaurants->lng = $request->longitude;
                    $restaurants->opening_time = $opening_time;
                    $restaurants->closing_time = $closing_time;
                    $restaurants->weekend_opening_time = $weekend_opening_time;
                    $restaurants->weekend_closing_time = $weekend_closing_time;
                    $restaurants->status = $status;
                    $restaurants->credit_accept = isset($request->credit_accept)?$request->credit_accept:0;
                    $restaurants->fssai_license = $request->fssai_license;
                    $restaurants->delivery_type = json_encode($request->delivery_type);
                    $restaurants->save();

                   // dd($request->weekdays['closing_time']);

                    for ($i=0; $i < count($request->weekdays['opening_time']); $i++) { 
                        if($request->weekdays['opening_time'][$i]!='00:00' || $request->weekdays['closing_time'][$i]!='00:00')
                        {
                            $restaurant_timer                 = new $this->restaurant_timer;
                            $restaurant_timer->restaurant_id  = $restaurants->id;
                            $restaurant_timer->opening_time   = date("H:i:s",strtotime($request->weekdays['opening_time'][$i]));
                            $restaurant_timer->closing_time   = date("H:i:s",strtotime($request->weekdays['closing_time'][$i]));
                            $restaurant_timer->save(); 
                        }
                   }
                 
                
                    for ($j=0; $j < count($request->weekenddays['opening_time']); $j++) { 
                        if($request->weekenddays['opening_time'][$j]!='00:00' || $request->weekenddays['closing_time'][$j]!='00:00')
                        {
                            $restaurant_timer1                 = new $this->restaurant_timer;
                            $restaurant_timer1->restaurant_id  = $restaurants->id;
                            $restaurant_timer1->opening_time   = date("H:i:s",strtotime($request->weekenddays['opening_time'][$j]));
                            $restaurant_timer1->closing_time   = date("H:i:s",strtotime($request->weekenddays['closing_time'][$j]));
                            $restaurant_timer1->is_weekend     = 1; 
                            $restaurant_timer1->save();
                        }
                    }
                 
                    //$opening_time = date("H:i:s",strtotime($request->opening_time));
                    //$closing_time = date("H:i:s",strtotime($request->closing_time));
                    //$weekend_opening_time = date("H:i:s",strtotime($request->weekend_opening_time));
                    //$weekend_closing_time = date("H:i:s",strtotime($request->weekend_closing_time));
                  
                    
                    $cuisines = $this->cuisines->find($request->cuisines);
                    $restaurants->Cuisines()->attach($cuisines);

                    //$food_quantity = $this->document->find($request->food_quantity);
                    $sync_data=array();
                    if(!empty($request->document)){
                        foreach($request->document as $key=>$value){
                            if($_FILES['document']['name'][$key]['document']!='')
                            {
                                $expiry_date='';
                                if(isset($value['date'])) $expiry_date=date("Y-m-d",strtotime($value['date']));

                                $filename = strtotime(date("Y-m-d")).basename($_FILES['document']['name'][$key]['document']);
                                move_uploaded_file($_FILES["document"]["tmp_name"][$key]['document'], 'public/uploads/Restaurant Document/'.$filename);
                                // $filename = $this->base_image_upload($request,'document','Restaurant Documents');
                                
                                $sync_data[$key] = ['document' => $filename,'expiry_date'=>$expiry_date];

                                // if($expiry_date=='')
                                //     $sync_data[$key] = ['document' => $filename];
                                // else
                                //     $sync_data[$key] = ['document' => $filename,'expiry_date'=>$expiry_date];
                            }
                        }
                        //dd($sync_data);
                        $restaurants->Document()->attach($sync_data);
                    }

                    $this->restaurant_bank_details->account_name = $request->account_name;
                    $this->restaurant_bank_details->account_address = $request->account_address;
                    $this->restaurant_bank_details->account_no = $request->account_no;
                    $this->restaurant_bank_details->bank_name = $request->bank_name;
                    $this->restaurant_bank_details->branch_name = $request->branch_name;
                    $this->restaurant_bank_details->branch_address = $request->branch_address;
                    $this->restaurant_bank_details->swift_code = $request->swift_code;
                    $this->restaurant_bank_details->routing_no = $request->routing_no;
                    $restaurants->RestaurantBankDetails()->save($this->restaurant_bank_details);

                    $msg = "add_success_msg";

                    //sesnd email to user
                    if(EMAIL_ENABLE==1)
                    {
                        $restaurants->name = isset($restaurants->restaurant_name)?$restaurants->restaurant_name:"";
                        $restaurants->subject = "Welcome to ".APP_NAME;
                        $this->send_mail($restaurants,'restaurant_welcome');
                   }
				}                  
		}

		return redirect('/admin/restaurant_list')->with('success',trans('constants.'.$msg,['param'=>'Restaurant']));

	}

    public function status_enable(Request $request)
    {
        $approve=$this->restaurants->where('id',$request->id)->update(['status'=>1]);
        return back()->with('success','Restaurant Enabled');
    }

    public function status_disable(Request $request)
    {
        $approve=$this->restaurants->where('id',$request->id)->update(['status'=>2]);
        return back()->with('success','Restaurant Disabled');
    }


    /**
     * change food today special status to active
     * 
     * @param int $id
     */
    public function food_special_enable($id, Request $request)
    {
        $restaurant_id = $request->session()->get('userid');
        $checkdata = $this->foodlist->where('is_special',1)->where('restaurant_id',$restaurant_id)->count();
        if($checkdata>0)
        {
            return back()->with('error','There is already special food available. You can enable only one special food.');
        }else
        {
            $approve=$this->foodlist->where('id',$id)->update(['is_special'=>1]);
            return back()->with('success','Todays Special Enabled');
        } 
    }

    public function food_special_disable($id)
    {
        $approve=$this->foodlist->where('id',$id)->update(['is_special'=>2]);
        return back()->with('success','Todays Special Disabled');
    }


	public function delete_restaurant($id,Request $request)
	{
		$validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);

        if($validator->fails()) {

            $error_messages = implode(',',$validator->messages()->all());

            return back()->with('error', $error_messages);

        }else
        {
        	$id = $request->id;
        	$restaurants = $this->restaurants;
        	$foodlist = $this->foodlist;
        	$banner = $this->banner;

        	$restaurants->where('id',$id)->update(['status'=>0]);
        	$foodlist->where('restaurant_id',$id)->update(['status'=>0]);
        	$banner->where('restaurant_id',$id)->delete();

        	return redirect('/admin/restaurant_list')->with('success','Restaurant Removed');
        }
	}

	public function restaurant_view($id)
	{
		$restaurant_view = $this->restaurants->with(['city_list','Area','RestaurantTimer'])->find($id);
        //dd($restaurant_view);
		return view('restaurant_view',['restaurant'=>$restaurant_view]);
	}

	public function product_list(Request $request)
	{
        $a = $this->foodlist->get();

        if($request->session()->get('role')!=1){
            $restaurant_id = $request->session()->get('userid');
            $data = $this->foodlist->with('Restaurants')->where('status','!=',0)->where('restaurant_id',$restaurant_id)->get();
        }else{
            $data = $this->foodlist->with('Restaurants')->where('status','!=',0)->get();
        }

		return view('product_list',['data'=>$data]);
	}

	public function add_product(Request $request)
	{
        if($request->session()->get('role')==1){
            $restaurant = $this->restaurants->get();
            $menu_list = $this->menu->get();
        }else{
            $restaurant = array();
            $restaurant_id = $request->session()->get('userid');
            $menu_list = $this->menu->where('restaurant_id',$restaurant_id)->get();
        }
		$category_list = $this->category->get();
        $add_ons = $this->add_ons->get();
        $food_quantity = $this->food_quantity->get();

		return view('add_product',['category'=>$category_list,'menu'=>$menu_list, 'add_ons'=>$add_ons,'restaurant'=>$restaurant,'food_quantity'=>$food_quantity]);
	}

     public function base_image_upload_product($request,$key)    
    {        
        $imageName = $request->file($key)->getClientOriginalName();       
        $ext = $request->file($key)->getClientOriginalExtension();
        $imageName = self::generate_random_string().'.'.$ext;        
        //$request->file($key)->move('public/uploads/product/',$imageName);       
        $filePath = "uploads/product/".$imageName;
        $filetype = Storage::disk('s3')->getDriver()->getAdapter()->getClient()->putObject(array(
            'Bucket'        => env('AWS_BUCKET'),
            'Key'           => $filePath,
            'Body'          => file_get_contents($request->$key),
            'ACL'           => 'public-read',
            'Expires'       => '',
            'CacheControl'  => 'max-age'
        ));
        return $imageName;
    }

	public function add_to_product(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'description' => 'required|max:100',
            'category' => 'required',
            'menu' => 'required',
            'price' => 'required',
            
            //'tax' => 'required',
            'packaging_charge' => 'required',
        ]);

		if($validator->fails()) {

            $error_messages = implode(',',$validator->messages()->all());
            return back()->with('error', $error_messages)->withInput();
        }else
        {
            if($request->session()->get('role')==1){
                $restaurant_id = $request->restaurant_name;
            }else{
                $restaurant_id = $request->session()->get('userid');
            }
            if(!empty($request->food_quantity_price))
                $food_quantity_price = array_filter($request->food_quantity_price, function($value) { return $value !== ''; });

            
            //dd($request->food_quantity_default);
			$name = $request->name;
			$description = $request->description;
			$category = $request->category;
			$menu = $request->menu;
            if(isset($request->status))
            {
			    $status = $request->status;
            }
            else
            {
                $status=0;
            }
			$price = $request->price;
			$tax = 0;
			$packaging_charge = $request->packaging_charge;
            $food_type = (int)$request->food_type;
            $discount_type = $request->discount_type;
            $target_amount = $request->target_amount;
            $offer_amount = $request->offer_amount;
               
           //print_r($image);exit();			
			if($request->id)
			{
                $foodlist = $this->foodlist->find($request->id);

                if($request->hasFile('image'))
                {
                    $image = self::base_image_upload_product($request,'image');
                    $foodlist->image = $image;
                }

                $foodlist->restaurant_id = $restaurant_id;
                $foodlist->name = $name;
                $foodlist->description = $description;
                $foodlist->category_id = $category;
                $foodlist->menu_id = $menu;
                $foodlist->status = $status;
                $foodlist->price = $price;
                $foodlist->tax = $tax;
                $foodlist->packaging_charge = $packaging_charge;
                $foodlist->is_veg = $food_type;
                $foodlist->discount_type = $discount_type;
                $foodlist->target_amount = $target_amount;
                $foodlist->offer_amount = $offer_amount;
                $foodlist->save();

                $add_ons = $this->add_ons->find($request->add_ons);
                //update many to many relationship data
                $foodlist->Add_ons()->sync($add_ons);

                $food_quantity = $this->food_quantity->find($request->food_quantity);
                $sync_data=array();
                for($i = 0; $i < count($food_quantity); $i++){
                    $default=0;
                    //get default based on the id passed from the default key in view
                    if((int)$request->food_quantity_default==$food_quantity[$i]->id) $default=1;
                    
                    if($food_quantity_price[$food_quantity[$i]->id]!=''){
                        $sync_data[$food_quantity[$i]->id] = ['price' => $food_quantity_price[$food_quantity[$i]->id],'is_default'=>$default];
                    }
                }
                $foodlist->FoodQuantity()->sync($sync_data);

                $trans_msg = "update_success_msg";

			}else
			{
                if($request->hasFile('image'))
                {
                    $image = self::base_image_upload_product($request,'image');
                    $this->foodlist->image = $image;
                }
                $this->foodlist->restaurant_id = $restaurant_id;
                $this->foodlist->name = $name;
                $this->foodlist->description = $description;
                $this->foodlist->category_id = $category;
                $this->foodlist->menu_id = $menu;
                $this->foodlist->status = $status;
                $this->foodlist->price = $price;
                $this->foodlist->tax = $tax;
                $this->foodlist->packaging_charge = $packaging_charge;
                $this->foodlist->is_veg = $food_type;
                $this->foodlist->discount_type = $discount_type;
                $this->foodlist->target_amount = $target_amount;
                $this->foodlist->offer_amount = $offer_amount;
                
                $this->foodlist->save();

                $add_ons = $this->add_ons->find($request->add_ons);
                $this->foodlist->Add_ons()->attach($add_ons);   

                $food_quantity = $this->food_quantity->find($request->food_quantity);
                $sync_data=array();
                for($i = 0; $i < count((array)$food_quantity); $i++){
                    $default=0;
                    if((int)$request->food_quantity_default==$food_quantity[$i]->id) $default=1;
                    $sync_data[$food_quantity[$i]->id] = ['price' => $food_quantity_price[$food_quantity[$i]->id],'is_default'=>$default];
                }
                //dd($sync_data);
                $this->foodlist->FoodQuantity()->attach($sync_data);
                
                $trans_msg = "add_success_msg";
			}
			return redirect('/admin/product_list')->with('success',trans('constants.'.$trans_msg,[ 'param' => 'Product']));
		}
	}

     public function food_status_enable(Request $request)
    {
   
    $approve=$this->foodlist->where('id',$request->id)->update(['status'=>1]);

    return back()->with('success','Food Enabled');

    }

        public function food_status_disable(Request $request)
    {
   
    $approve=$this->foodlist->where('id',$request->id)->update(['status'=>2]);

    return back()->with('success','Food Disabled');

    }



    /**
     * edit product page with neccessity data
     * 
     * @param array $request, int $id
     * 
     * @return view page with array
     */
	public function edit_product_list(Request $request, $id)
	{
        $product_list = $this->foodlist->with('Add_ons','FoodQuantity')->find($id);
        //dd($product_list);
        $category = $this->category->get();
        if($request->session()->get('role')==1){
            $menu = $this->menu->where('restaurant_id',$product_list->restaurant_id)->get();
            $add_ons = $this->add_ons->where('restaurant_id',$product_list->restaurant_id)->get();
            $restaurant = $this->restaurants->get();
        }else{
            $restaurant = array();
            $menu = $this->menu->where('restaurant_id',$request->session()->get('userid'))->get();
            $add_ons = $this->add_ons->where('restaurant_id',$request->session()->get('userid'))->get();
        }
        $food_quantity = $this->food_quantity->get();
        $addon_ids = $foodquantity_ids = array();
        foreach($product_list->Add_ons as $val){
            $addon_ids[] = $val->id;
        }
        foreach($product_list->FoodQuantity as $val){
            $foodquantity_ids[] = $val->id;
        }

        return view('/edit_product_list',['product_list'=>$product_list,'category'=>$category,'menu'=> $menu, 'add_ons'=>$add_ons,'addon_ids'=>$addon_ids,'restaurant'=>$restaurant,'food_quantity'=>$food_quantity,'foodquantity_ids'=>$foodquantity_ids]);
	}

	 public function update_product_list(Request $request)
       {
    
         
          $update =  $this->foodlist->find($request->id);
          $update->name = $request->name;
		  $update->description = $request->description;
		  $update->category_id = $request->category;
		  $update->menu_id = $request->menu;
		  $update->status = $request->status;
		  $update->price = $request->price;
		  $update->tax = $request->tax;
          $update->image = $image;
		  $update->packaging_charge = $request->packaging_charge;
          $update->save();

         

          return redirect('/admin/edit_product_list')->with('success','Product Updated Successfully');  

       }

    public function delete_product_list($food_id)
    {
        $delete =  $this->foodlist->where('id',$food_id)->update(['status'=>0]);
        return back()->with('success','Product Deleted Successfully');  
    }

	public function restaurant_menu(Request $request)
	{
        $restaurant_id = $request->session()->get('userid');
        $role = $request->session()->get('role');
		$query = $this->menu->with('Restaurant')->where('status','!=',0);
        $query = $query->when(($role!=1), 
                    function($q) use($restaurant_id){
                        return $q->where('restaurant_id',$restaurant_id);
                    });
        $data = $query->get();
        //dd($data);
        $restaurant = $this->restaurants->get();
		return view('restaurant_menu',['data'=>$data,'restaurant'=>$restaurant]);
	}

	public function add_restaurant_menu(Request $request)
	{
		$validator = Validator::make($request->all(), [
                'menu_name' => 'required',
            ]);

        if($validator->fails()) {

            $error_messages = implode(',',$validator->messages()->all());

            return back()->with('error', $error_messages);

        }else
        {
             $restaurant_id = $request->restaurant_id;
        	$menu_name = $request->menu_name;

        	$restaurant_menu = $this->menu;

        	$data = array();

        	$data[] = array(
        		'restaurant_id'=>$restaurant_id,
        		'menu_name'=>$menu_name
        	);

        	$check = $restaurant_menu->where('restaurant_id',$restaurant_id)->where('menu_name',$menu_name)->count();

        	if($check==0)
        	{

        		$restaurant_menu->insert($data);
        	}else
        	{
        		 return redirect('/admin/restaurant_menu')->with('error','Menu already exist');
        	}

        }

        return redirect('/admin/restaurant_menu')->with('success','Menu added Successfully');
} 

       public function edit_restaurant_menu(Request $request)
       {
          $update = $this->menu->find($request->id);
          $update->menu_name = $request->menu_name;
          $update->restaurant_id = $request->restaurant_id;
          $update->save();
          return redirect('/admin/restaurant_menu')->with('success','Menu Updated Successfully');  

       }

    public function del_restaurant_menu($id)
    {
        $delete =  $this->menu->where('id',$id)->update(['status'=>0]);
        $this->foodlist->where('menu_id',$id)->update(['status'=>0]);
        return back()->with('success','Menu Deleted Successfully');  
    }

    public function dispatcher(Request $request)
    {

    	$restaurant_id = $request->session()->get('userid');
    	$pending_orders = DB::table('requests')
    	->where('requests.restaurant_id',$restaurant_id)
    	->where('status',0)
        ->join('users','users.id','=','requests.user_id')
        ->select('users.name as customer_name','users.phone as phone','requests.id as request_id','users.*','requests.*')
    	->get();

    	$accepted_orders = DB::table('requests')
    	->where('requests.restaurant_id',$restaurant_id)
    	->where('status',1)
        ->join('users','users.id','=','requests.user_id')
        ->select('users.name as customer_name','users.phone as phone','users.*','requests.*')
    	->get();

    	$ongoing_orders = DB::table('requests')
    	->where('requests.restaurant_id',$restaurant_id)
    	->whereIn('status',[2,3,4,5])
        ->join('users','users.id','=','requests.user_id')
        ->select('users.name as customer_name','users.phone as phone','users.*','requests.*')
    	->get();

    	$completed_orders = DB::table('requests')
    	->where('requests.restaurant_id',$restaurant_id)
    	->where('status',7)
        ->join('users','users.id','=','requests.user_id')
        ->select('users.name as customer_name','users.phone as phone','users.*','requests.*')
    	->get();

    	$data1 = DB::table('requests')->where('requests.restaurant_id',$restaurant_id)
									 ->join('request_detail','request_detail.request_id','=','requests.id')
									 ->join('food_list','food_list.id','=','request_detail.food_id')
									 ->select('food_list.name as food_name','request_detail.*','food_list.*','requests.id as request_id')
									 ->get();

    	return view('/dispatcher',['pending_orders'=>$pending_orders,'accepted_orders'=>$accepted_orders,'ongoing_orders'=>$ongoing_orders,'completed_orders'=>$completed_orders,'data1'=>$data1]);
    } 

    public function restaurant_report(Request $request) 
    {
       $restaurant_id = $request->session()->get('userid');
       if($restaurant_id != Null)
       {

         $restaurant_details = DB::table('requests')
       ->where('requests.restaurant_id',$restaurant_id)
       ->join('users','users.id','=','requests.user_id')
       ->join('delivery_partners','delivery_partners.id','=','requests.delivery_boy_id')
       ->select('users.name as customer_name','users.phone as phone','delivery_partners.name as delivery_boy_name','requests.id as request_id','users.*','requests.*','delivery_partners.*')
       ->get();

       }else{

         $restaurant_details = DB::table('requests')
       
       ->join('users','users.id','=','requests.user_id')
       ->join('delivery_partners','delivery_partners.id','=','requests.delivery_boy_id')
       ->select('users.name as customer_name','users.phone as phone','delivery_partners.name as delivery_boy_name','requests.id as request_id','users.*','requests.*','delivery_partners.*')
       ->get();
       }

      

       $month=date('m');
         $prev_month=date('m',strtotime("-1 month"));

        $current_month=DB::table('requests')
        ->where('requests.restaurant_id',$restaurant_id)
        ->whereMonth('requests.created_at', '=', $month)
        ->select('restaurant_commision')->sum('restaurant_commision');
         //print_r($current_month);exit();
         $last_month=DB::table('requests')
         ->where('requests.restaurant_id',$restaurant_id)
         ->whereMonth('requests.created_at', '=', $prev_month)
         ->select('restaurant_commision')->sum('restaurant_commision');

         $current_week=DB::table('requests')
         ->where('requests.restaurant_id',$restaurant_id)
         ->whereBetween('requests.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
         ->select('restaurant_commision')->sum('restaurant_commision');

         $previous_week = strtotime("-1 week +1 day");

        $start_week = strtotime("last sunday midnight",$previous_week);
        $end_week = strtotime("next saturday",$start_week);
        $last_week_start=date('Y-m-d',$start_week)." 00:00:00";
        $last_week_end=date('Y-m-d',$end_week)." 23:59:59";

        $last_week=DB::table('requests')
        ->where('requests.restaurant_id',$restaurant_id)
        ->whereBetween('requests.created_at', [$last_week_start, $last_week_end])
        ->select('restaurant_commision')->sum('restaurant_commision');

        $year=date('Y');
        $prev_year1=date('Y',strtotime("-1 month"));
        $prev_year2=date('Y',strtotime("-1 year"));

        $current_year=DB::table('requests')
        ->where('requests.restaurant_id',$restaurant_id)
        ->whereYear('requests.created_at', '=', $year)
        ->select('restaurant_commision')->sum('restaurant_commision');

        $last_year=DB::table('requests')
        ->where('requests.restaurant_id',$restaurant_id)
        ->whereYear('requests.created_at', '=', $prev_year2)
        ->select('restaurant_commision')->sum('restaurant_commision');

    	return view('/restaurant_report',['restaurant_details'=>$restaurant_details,'current_month'=>$current_month,'last_month'=>$last_month,'current_week'=>$current_week,'last_week'=>$last_week,'current_year'=>$current_year,'last_year'=>$last_year]);
    } 

     public function orderwise_report_pagination(Request $request)
    {        
        $restaurant_id = $request->session()->get('userid');
        $role = $request->session()->get('role');

        $query = $this->foodrequest->query();
        $query = $query->when(($role!=1), 
                    function($q) use($restaurant_id){
                        return $q->where('restaurant_id',$restaurant_id);
                    });

        $limit = $request->iDisplayLength;
        $offset = $request->iDisplayStart;
        //check limit and offset
        $query = $query->when(($limit!='-1' && isset($offset)), 
                            function($q) use($limit, $offset){
                                return $q->offset($offset)->limit($limit);
                            });

        
        $orderwise_details = $query->orderBy('id','desc')->get();

        $query1 =$this->foodrequest->query();
        $query1 = $query1->when(($role!=1), 
                    function($q) use($restaurant_id){
                        return $q->where('restaurant_id',$restaurant_id);
                    });
        $total_orders = $query1->get();

        $column=array();
        $data=array();
        foreach ($orderwise_details as $key => $value) {
            switch ((int) $value->status) {
              case 0:
                $status = 'New Order';
              break;
              case 1:
                $status = 'Order Accepted';
              break;
              case 2:
                $status = 'Delivery boy assigned';
              break;
              case 3:
                $status = 'Food delivered to Delivery boy';
              break;
              case 4:
                $status = 'Towards Customer';
              break;
              case 5:
                $status = 'Reached Customer';
              break;
              case 6:
                $status = 'Delivered to Customer';
              break;
              case 7:
                $status = 'Completed';
              break;
              
              default:
                $status = ' Cancelled';
                break;
            }
            
            $col['id']=$offset+1;
            $col['order_id']=$value->order_id;
            $col['customer_name']=isset($value->Users)?$value->Users->name:"";
            $col['customer_phone']=isset($value->Users)?$value->Users->phone:"";
            $col['delivery_boy_name']=isset($value->Deliverypartners)?$value->Deliverypartners->name:"";
            $col['delivery_boy_phone']=isset($value->Deliverypartners)?$value->Deliverypartners->phone:"";
            $col['restaurant_name']=isset($value->Restaurants)?$value->Restaurants->restaurant_name:"";
            $col['item_total']=DEFAULT_CURRENCY_SYMBOL." ".$value->item_total;
            $col['delivery_charge']=DEFAULT_CURRENCY_SYMBOL." ".$value->delivery_charge;
            $col['restaurant_packaging_charge']=DEFAULT_CURRENCY_SYMBOL." ".$value->restaurant_packaging_charge;
            $col['tax']=DEFAULT_CURRENCY_SYMBOL." ".$value->tax;
            $col['offer_discount']=DEFAULT_CURRENCY_SYMBOL." ".$value->offer_discount;
            $col['restaurant_discount']=DEFAULT_CURRENCY_SYMBOL." ".$value->restaurant_discount;
            $col['admin_commision'] = DEFAULT_CURRENCY_SYMBOL." ".$value->admin_commision;
            $col['delivery_boy_commision'] =DEFAULT_CURRENCY_SYMBOL." ".$value->delivery_boy_commision;
            $col['restaurant_commision']=DEFAULT_CURRENCY_SYMBOL." ".$value->restaurant_commision;
            $col['payment_type']=($value->paid_type==1)?"Cash":"Card";
            $col['status']=$status;

            array_push($column, $col);
            $offset++;
        }
        $orderwise_details['sEcho']=$request->sEcho;
        $orderwise_details['aaData']=$column;
        $orderwise_details['iTotalRecords']=count($total_orders);
        $orderwise_details['iTotalDisplayRecords']=count($total_orders);

        return json_encode($orderwise_details);

    }

     public function restaurant_report_filter(Request $request) 
    {

         $start = $request->start .' 00:00:00';
         $end =   $request->end  .' 23:59:59';
       $restaurant_id = $request->session()->get('userid');
       if($restaurant_id != Null)
       {

         $restaurant_details = DB::table('requests')
       ->where('requests.restaurant_id',$restaurant_id)
       ->join('users','users.id','=','requests.user_id')
       ->join('delivery_partners','delivery_partners.id','=','requests.delivery_boy_id')
       ->select('users.name as customer_name','users.phone as phone','delivery_partners.name as delivery_boy_name','requests.id as request_id','users.*','requests.*','delivery_partners.*')
       ->whereBetween('requests.created_at',[$start,$end])
       ->get();

       }else{

         $restaurant_details = DB::table('requests')
       
       ->join('users','users.id','=','requests.user_id')
       ->join('delivery_partners','delivery_partners.id','=','requests.delivery_boy_id')
       ->select('users.name as customer_name','users.phone as phone','delivery_partners.name as delivery_boy_name','requests.id as request_id','users.*','requests.*','delivery_partners.*')
       ->whereBetween('requests.created_at',[$start,$end])
       ->get();
       }

      

       $month=date('m');
         $prev_month=date('m',strtotime("-1 month"));

        $current_month=DB::table('requests')
        ->where('requests.restaurant_id',$restaurant_id)
        ->whereMonth('requests.created_at', '=', $month)
        ->select('restaurant_commision')->sum('restaurant_commision');
         //print_r($current_month);exit();
         $last_month=DB::table('requests')
         ->where('requests.restaurant_id',$restaurant_id)
         ->whereMonth('requests.created_at', '=', $prev_month)
         ->select('restaurant_commision')->sum('restaurant_commision');

         $current_week=DB::table('requests')
         ->where('requests.restaurant_id',$restaurant_id)
         ->whereBetween('requests.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
         ->select('restaurant_commision')->sum('restaurant_commision');

         $previous_week = strtotime("-1 week +1 day");

        $start_week = strtotime("last sunday midnight",$previous_week);
        $end_week = strtotime("next saturday",$start_week);
        $last_week_start=date('Y-m-d',$start_week)." 00:00:00";
        $last_week_end=date('Y-m-d',$end_week)." 23:59:59";

        $last_week=DB::table('requests')
        ->where('requests.restaurant_id',$restaurant_id)
        ->whereBetween('requests.created_at', [$last_week_start, $last_week_end])
        ->select('restaurant_commision')->sum('restaurant_commision');

        $year=date('Y');
        $prev_year1=date('Y',strtotime("-1 month"));
        $prev_year2=date('Y',strtotime("-1 year"));

        $current_year=DB::table('requests')
        ->where('requests.restaurant_id',$restaurant_id)
        ->whereYear('requests.created_at', '=', $year)
        ->select('restaurant_commision')->sum('restaurant_commision');

        $last_year=DB::table('requests')
        ->where('requests.restaurant_id',$restaurant_id)
        ->whereYear('requests.created_at', '=', $prev_year2)
        ->select('restaurant_commision')->sum('restaurant_commision');

        return view('/restaurant_report',['restaurant_details'=>$restaurant_details,'current_month'=>$current_month,'last_month'=>$last_month,'current_week'=>$current_week,'last_week'=>$last_week,'current_year'=>$current_year,'last_year'=>$last_year]);
    } 
     

    public function admin_restaurant_report(Request $request) 
    {
       
        
        $restaurant_details = $this->restaurants
                               ->join('add_city','add_city.id','=','restaurants.city')
                               ->join('add_area','add_area.id','=','restaurants.area')
                               ->select('restaurants.*','add_city.city as city','add_area.area as area')
                              ->get();
       
       // ->join('restaurants','restaurants.id','=','requests.restaurant_id')
       
       // ->select('requests.*','restaurants.*','restaurants.restaurant_name as restaurant_name','restaurants.id as res_id')

      
       // ->get();

      //  $restaurant_details = DB::table('restaurants')->select('restaurant_name as restaurant_name','id')->get();
       

       foreach ($restaurant_details as $key => $value) {
        $value->restaurant_commision = DB::table('requests')->where('restaurant_id',$value->id)->sum('restaurant_commision');
        $value->admin_commision = DB::table('requests')->where('restaurant_id',$value->id)->sum('admin_commision');

        //print_r($value->delivery_boy);exit();
        	
      }

        // $tempArray = array();
        // $result = array();
        // foreach ($restaurant_details as $key => $value) {
        //     if (!in_array($value->restaurant_id, $tempArray))
        //     {
        //       array_push($tempArray,$value->restaurant_id);
        //       array_push($result,$value);
        //     }
        // }
        // $restaurant_details = $result;

       $month=date('m');
         $prev_month=date('m',strtotime("-1 month"));

        $current_month=DB::table('requests')
        
        ->whereMonth('requests.created_at', '=', $month)
        ->select('admin_commision')->sum('admin_commision');
         //print_r($current_month);exit();
         $last_month=DB::table('requests')
         
         ->whereMonth('requests.created_at', '=', $prev_month)
         ->select('admin_commision')->sum('admin_commision');

         $current_week=DB::table('requests')
         
         ->whereBetween('requests.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
         ->select('admin_commision')->sum('admin_commision');

         $previous_week = strtotime("-1 week +1 day");

        $start_week = strtotime("last sunday midnight",$previous_week);
        $end_week = strtotime("next saturday",$start_week);
        $last_week_start=date('Y-m-d',$start_week)." 00:00:00";
        $last_week_end=date('Y-m-d',$end_week)." 23:59:59";

        $last_week=DB::table('requests')
        
        ->whereBetween('requests.created_at', [$last_week_start, $last_week_end])
        ->select('admin_commision')->sum('admin_commision');

        $year=date('Y');
        $prev_year1=date('Y',strtotime("-1 month"));
        $prev_year2=date('Y',strtotime("-1 year"));

        $current_year=DB::table('requests')
        
        ->whereYear('requests.created_at', '=', $year)
        ->select('admin_commision')->sum('admin_commision');

        $last_year=DB::table('requests')
        
        ->whereYear('requests.created_at', '=', $prev_year2)
        ->select('admin_commision')->sum('admin_commision');

    	return view('/admin_restaurant_report',['restaurant_details'=>$restaurant_details,'current_month'=>$current_month,'last_month'=>$last_month,'current_week'=>$current_week,'last_week'=>$last_week,'current_year'=>$current_year,'last_year'=>$last_year]);
    } 

    public function admin_report_view($res_id)
    {
       $admin_view = DB::table('restaurants')->where('id',$res_id)->get();
       
        $restaurant_total_earnings=DB::table('requests')
        ->where('restaurant_id',$res_id)
        ->where('status','=',7)
        ->select('restaurant_commision')->sum('restaurant_commision');
        
         //print_r($vendor_total_earnings);exit();
        $restaurant_pending_payouts=DB::table('requests')
         ->where('restaurant_id',$res_id)
        ->whereIn('status',[0,1,2,3,4,5])
        ->select('restaurant_commision')->sum('restaurant_commision');

        $restaurant_admin_earnings=DB::table('requests')
         ->where('restaurant_id',$res_id)
        ->select('admin_commision')->sum('admin_commision');
        

       

    	return view('/admin_report_view',['admin_view'=>$admin_view,'restaurant_total_earnings'=>$restaurant_total_earnings,'restaurant_pending_payouts'=>$restaurant_pending_payouts,'restaurant_admin_earnings'=>$restaurant_admin_earnings]);
    }

    public function delivery_boy_report(Request $request)
    {

         $delivery_boy_details =DB::table('delivery_partners')
                               ->join('delivery_partner_details','delivery_partner_details.delivery_partners_id','=','delivery_partners.id')
                               ->join('add_city','add_city.id','=','delivery_partner_details.city')
                              
                                ->join('vehicle','vehicle.id','=','delivery_partner_details.vehicle_name')
                               ->select('delivery_partners.*','vehicle.*','add_city.city as city','vehicle.vehicle_name as vehicle_name','delivery_partner_details.*')
                              ->get();

                              //
                              //print_r($delivery_boy_details);exit();
       

 		// $delivery_boy_details = DB::table('delivery_partners')->select('name as delivery_boy_name','id')->get();
       

      //  foreach ($delivery_boy_details as $key => $value) {
      //   $value->delivery_boy_commision = DB::table('requests')->where('delivery_boy_id',$value->id)->sum('delivery_boy_commision');
      //   $value->admin_commision = DB::table('requests')->where('delivery_boy_id',$value->id)->sum('admin_commision');

      //   //print_r($value->delivery_boy);exit();
        	
      // }

      

      

       $month=date('m');
         $prev_month=date('m',strtotime("-1 month"));

        $current_month=DB::table('requests')
        
        ->whereMonth('requests.created_at', '=', $month)
        ->select('delivery_boy_commision')->sum('delivery_boy_commision');
         //print_r($current_month);exit();
         $last_month=DB::table('requests')
        
         ->whereMonth('requests.created_at', '=', $prev_month)
         ->select('delivery_boy_commision')->sum('delivery_boy_commision');

         $current_week=DB::table('requests')
         
         ->whereBetween('requests.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
         ->select('delivery_boy_commision')->sum('delivery_boy_commision');

         $previous_week = strtotime("-1 week +1 day");

        $start_week = strtotime("last sunday midnight",$previous_week);
        $end_week = strtotime("next saturday",$start_week);
        $last_week_start=date('Y-m-d',$start_week)." 00:00:00";
        $last_week_end=date('Y-m-d',$end_week)." 23:59:59";

        $last_week=DB::table('requests')
       
        ->whereBetween('requests.created_at', [$last_week_start, $last_week_end])
        ->select('delivery_boy_commision')->sum('delivery_boy_commision');

        $year=date('Y');
        $prev_year1=date('Y',strtotime("-1 month"));
        $prev_year2=date('Y',strtotime("-1 year"));

        $current_year=DB::table('requests')
        
        ->whereYear('requests.created_at', '=', $year)
        ->select('delivery_boy_commision')->sum('delivery_boy_commision');

        $last_year=DB::table('requests')
        
        ->whereYear('requests.created_at', '=', $prev_year2)
        ->select('delivery_boy_commision')->sum('delivery_boy_commision');

    	return view('/delivery_boy_reports',['delivery_boy_details'=>$delivery_boy_details,'current_month'=>$current_month,'last_month'=>$last_month,'current_week'=>$current_week,'last_week'=>$last_week,'current_year'=>$current_year,'last_year'=>$last_year]);
    }

     public function deliveryboy_report_pagination(Request $request)
    {        
        //   $restaurant_details = $this->restaurants
        //                        ->join('add_city','add_city.id','=','restaurants.city')
        //                        ->join('add_area','add_area.id','=','restaurants.area')
        //                        ->select('restaurants.*','add_city.city as city','add_area.area as area')
        //                       ->get();
        //dd($request->all());

        $query = $this->deliverypartners->query();
        $limit = $request->iDisplayLength;
        $offset = $request->iDisplayStart;
        //print_r($offset);exit();
        //check limit and offset
        $query = $query->when(($limit!='-1' && isset($offset)), 
                            function($q) use($limit, $offset){
                                return $q->offset($offset)->limit($limit);
                            });

        
        $deliveryboy_report_details = $query->get();
//dd($deliveryboy_report_details);
        $total_deliveryboys =$this->deliverypartners->get();

        $column=array();
        $data=array();
        foreach ($deliveryboy_report_details as $key => $value) {

            $res_id = $value->id;
            $total_orders = $this->foodrequest->where('delivery_boy_id', $res_id)->count();
            $ratings = $this->order_ratings->with('Foodrequest')
                                ->wherehas('Foodrequest',function($q) use($res_id){
                                    $q->where('delivery_boy_id', $res_id);
                                    })
                                ->avg('restaurant_rating');
            $payout_done = $this->driver_payout_history->where('delivery_boy_id', $res_id)->sum('payout_amount');

            $col['id']=$value->id;
            $col['name']=$value->name;
            $col['email']=$value->email;
            $col['phone']=$value->phone;
            //if(isset($value->Deliverypartner_detail->Citylist)) print_r($value->Deliverypartner_detail->Citylist);
            $col['city']=isset($value->Deliverypartner_detail->Citylist)?$value->Deliverypartner_detail->Citylist->city:"";
            $col['vehicle_name']=isset($value->Deliverypartner_detail->Vehicle)?$value->Deliverypartner_detail->Vehicle->vehicle_name:"";
            $col['address_line_1'] = isset($value->Deliverypartner_detail->address_line_1)?$value->Deliverypartner_detail->address_line_1:"";
            $col['ratings'] = $ratings;
           $col['total_orders']=$total_orders;
           $col['total_earnings'] = DEFAULT_CURRENCY_SYMBOL.round($value->total_earnings,2);
           $col['pending_payout']=DEFAULT_CURRENCY_SYMBOL.$value->pending_payout;
           $col['payout_done']=DEFAULT_CURRENCY_SYMBOL.$payout_done;

            array_push($column, $col);
        }
        $deliveryboy_report_details['sEcho']=$request->sEcho;
        $deliveryboy_report_details['aaData']=$column;
        $deliveryboy_report_details['iTotalRecords']=count($total_deliveryboys);
        $deliveryboy_report_details['iTotalDisplayRecords']=count($total_deliveryboys);

        return json_encode($deliveryboy_report_details);

    }

     public function delivery_boy_report_filter(Request $request)
    {
        $start = $request->start .' 00:00:00';
         $end =   $request->end  .' 23:59:59';

         $delivery_boy_details =DB::table('delivery_partners')
                               ->join('delivery_partner_details','delivery_partner_details.delivery_partners_id','=','delivery_partners.id')
                               ->join('add_city','add_city.id','=','delivery_partner_details.city')
                              
                                ->join('vehicle','vehicle.id','=','delivery_partner_details.vehicle_name')
                               ->select('delivery_partners.*','vehicle.*','add_city.city as city','vehicle.vehicle_name as vehicle_name','delivery_partner_details.*')
                               ->whereBetween('delivery_partners.created_at',[$start,$end])
                              ->get();

                              //
                              //print_r($delivery_boy_details);exit();
       

        // $delivery_boy_details = DB::table('delivery_partners')->select('name as delivery_boy_name','id')->get();
       

      //  foreach ($delivery_boy_details as $key => $value) {
      //   $value->delivery_boy_commision = DB::table('requests')->where('delivery_boy_id',$value->id)->sum('delivery_boy_commision');
      //   $value->admin_commision = DB::table('requests')->where('delivery_boy_id',$value->id)->sum('admin_commision');

      //   //print_r($value->delivery_boy);exit();
            
      // }

      

      

       $month=date('m');
         $prev_month=date('m',strtotime("-1 month"));

        $current_month=DB::table('requests')
        
        ->whereMonth('requests.created_at', '=', $month)
        ->select('delivery_boy_commision')->sum('delivery_boy_commision');
         //print_r($current_month);exit();
         $last_month=DB::table('requests')
        
         ->whereMonth('requests.created_at', '=', $prev_month)
         ->select('delivery_boy_commision')->sum('delivery_boy_commision');

         $current_week=DB::table('requests')
         
         ->whereBetween('requests.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
         ->select('delivery_boy_commision')->sum('delivery_boy_commision');

         $previous_week = strtotime("-1 week +1 day");

        $start_week = strtotime("last sunday midnight",$previous_week);
        $end_week = strtotime("next saturday",$start_week);
        $last_week_start=date('Y-m-d',$start_week)." 00:00:00";
        $last_week_end=date('Y-m-d',$end_week)." 23:59:59";

        $last_week=DB::table('requests')
       
        ->whereBetween('requests.created_at', [$last_week_start, $last_week_end])
        ->select('delivery_boy_commision')->sum('delivery_boy_commision');

        $year=date('Y');
        $prev_year1=date('Y',strtotime("-1 month"));
        $prev_year2=date('Y',strtotime("-1 year"));

        $current_year=DB::table('requests')
        
        ->whereYear('requests.created_at', '=', $year)
        ->select('delivery_boy_commision')->sum('delivery_boy_commision');

        $last_year=DB::table('requests')
        
        ->whereYear('requests.created_at', '=', $prev_year2)
        ->select('delivery_boy_commision')->sum('delivery_boy_commision');

        return view('/delivery_boy_reports',['delivery_boy_details'=>$delivery_boy_details,'current_month'=>$current_month,'last_month'=>$last_month,'current_week'=>$current_week,'last_week'=>$last_week,'current_year'=>$current_year,'last_year'=>$last_year]);
    }

    public function restaurant_report_pagination(Request $request)
    {        
        //   $restaurant_details = $this->restaurants
        //                        ->join('add_city','add_city.id','=','restaurants.city')
        //                        ->join('add_area','add_area.id','=','restaurants.area')
        //                        ->select('restaurants.*','add_city.city as city','add_area.area as area')
        //                       ->get();
        //dd($request->all());

        $query = $this->restaurants->with(['city_list','Area']);
        $limit = $request->iDisplayLength;
        $offset = $request->iDisplayStart;
        //check limit and offset
        $query = $query->when(($limit!='-1' && isset($offset)), 
                            function($q) use($limit, $offset){
                                return $q->offset($offset)->limit($limit);
                            });
        if($request->sSearch!='')
         {
             $keyword = $request->sSearch;
             $query = $query->when($keyword!='', 
                     function($q) use($keyword){
                         return $q->where('restaurant_name','like','%'.$keyword.'%');
                     });
         }
 
        
        $restaurant_details = $query->get();

        $total_restaurant = $this->restaurants->get();

         foreach ($restaurant_details as $key => $value) {
        $value->restaurant_commision = DB::table('requests')->where('restaurant_id',$value->id)->sum('restaurant_commision');
        $value->admin_commision = DB::table('requests')->where('restaurant_id',$value->id)->sum('admin_commision');
    }

        $column=array();
        $data=array();
        foreach ($restaurant_details as $key => $value) {
            $res_id = $value->id;
            $total_orders = $this->foodrequest->where('restaurant_id', $res_id)->count();
            $ratings = $this->order_ratings->with('Foodrequest')
                                ->wherehas('Foodrequest',function($q) use($res_id){
                                    $q->where('restaurant_id', $res_id);
                                    })
                                ->avg('restaurant_rating');
            $payout_done = $this->restaurant_payout_history->where('restaurant_id', $value->id)->sum('payout_amount');
            $col['id']=$value->id;
            $col['restaurant_name']=$value->restaurant_name;
            $col['email']=$value->email;
            $col['phone']=$value->phone;
            $col['rating']=$ratings;
            $col['address']=$value->address;
            $col['city'] = isset($value->city_list)?$value->city_list->city:"";
            $col['area'] = isset($value->Area)?$value->Area->area:"";
            $col['total_orders']=$total_orders;
            $col['restaurant_commision']= DEFAULT_CURRENCY_SYMBOL.round($value->restaurant_commision,2);
            $col['pending_payout']=DEFAULT_CURRENCY_SYMBOL.$value->pending_payout;
            $col['payout_done']=DEFAULT_CURRENCY_SYMBOL.$payout_done;

            array_push($column, $col);
        }
        $restaurant_details['sEcho']=$request->sEcho;
        $restaurant_details['aaData']=$column;
        $restaurant_details['iTotalRecords']=count($total_restaurant);
        $restaurant_details['iTotalDisplayRecords']=count($total_restaurant);

        return json_encode($restaurant_details);

    }



    public function city_management(Request $request)
    {
        $country = $this->country->get();
      
      return view('/add_city',compact('country'));
    }

   

    public function add_city(Request $request)
	{
		$validator = Validator::make($request->all(), [
                
                'city' => 'required',
                'admin_commision' => 'required',
                'country' => 'required',
                'state' => 'required',
                'status' => 'required',
                'geofence_latlng' => 'required',
                'admin_commision' => 'required',
                'default_delivery_amount'=> 'required',
                'min_dist_delivery_price' => 'required',
                'extra_fee_deliveryamount' => 'required'
            ]);

        if($validator->fails()) {

            $error_messages = implode(',',$validator->messages()->all());
            //print_r($validator->messages()); exit;
            //return back()->with('error', $error_messages);
            return back()->withErrors($validator)->withInput();

        }else
        {
           
            /*if(!empty($request->geofence_latlng))
            {
                $source_polygon = explode(',',$request->geofence_latlng);
                $j = $k =0;
                for ($i=0; $i <= count($source_polygon)-1 && $k <= count($source_polygon)-1; $i++) {
                        $source_coordinates[$j][0] = $source_polygon[$k++];
                        $source_coordinates[$j][0] = (double)trim($source_coordinates[$j][0],'[ ');
                        $source_coordinates[$j][1] = $source_polygon[$k];
                        $source_coordinates[$j][1] = (double)trim($source_coordinates[$j][1],' ]');

                        $temp = $source_coordinates[$j][0];
                        $source_coordinates[$j][0] = $source_coordinates[$j][1];
                        $source_coordinates[$j][1] = $temp;
                        $k++;$j++;
                }
            } else {
                $source_coordinates = array();
            }*/
            //echo "<pre>";print_r( $source_coordinates);
            // $first_cordinate = current($source_coordinates);
            // $a = end($source_coordinates);
            // $key = key($source_coordinates); 
            // $source_coordinates[$key+1] = $first_cordinate;
            //echo "<pre>";print_r( $source_coordinates);exit;
        $check = DB::table('add_city')->where('city','=',$request->city)->first();
        if(isset($check)==0)
        {
            $city = $request->city;
            $country_id = $request->country;
            $state_id = $request->state;
            $admin_commision = $request->admin_commision;
            $default_delivery_amount = $request->default_delivery_amount;
            $target_amount = 0;
            $min_dist_delivery_price = $request->min_dist_delivery_price;
            $extra_fee_deliveryamount = $request->extra_fee_deliveryamount;
            $driver_base_price = $request->driver_base_price;
            $min_dist_base_price = $request->min_dist_base_price;
            $extra_fee_amount = $request->extra_fee_amount;
            $extra_fee_amount_each = $request->extra_fee_amount_each;
            $night_fare_amount = $request->night_fare_amount;
            $night_driver_share = $request->night_driver_share;
            $surge_fare_amount = $request->surge_fare_amount;
            $surge_driver_share = $request->surge_driver_share;
            $status = $request->status;
        	$add_city = $this->addcity;

        	$data = array();

        	// $data[] = array(
        		
        	// 	'city'=>$city,
        	// 	'admin_commision'=>$admin_commision,
        	// 	'default_delivery_amount'=>$default_delivery_amount,
        	// 	'target_amount'=>$target_amount,
        	// 	'driver_base_price'=>$driver_base_price,
        	// 	'min_dist_base_price'=>$min_dist_base_price,
        	// 	'extra_fee_amount'=>$extra_fee_amount,
        	// 	'extra_fee_amount_each'=>$extra_fee_amount_each,
        	// 	'night_fare_amount'=>$night_fare_amount,
        	// 	'night_driver_share'=>$night_driver_share,
        	// 	'surge_fare_amount'=>$surge_fare_amount,
        	// 	'surge_driver_share'=>$surge_driver_share,
        	// 	'status'=>$status,

            // );
            $add_city->city = $city;
            $add_city->country_id = $country_id;
            $add_city->state_id = $state_id;
            $add_city->admin_commision = $admin_commision;
            $add_city->default_delivery_amount = $default_delivery_amount;
            $add_city->target_amount = $target_amount;
            $add_city->driver_base_price = $driver_base_price;
            $add_city->min_dist_base_price = $min_dist_base_price;
            $add_city->extra_fee_amount = $extra_fee_amount;
            $add_city->extra_fee_amount_each = $extra_fee_amount_each;
            $add_city->night_fare_amount = $night_fare_amount;
            $add_city->night_driver_share = $night_driver_share;
            $add_city->surge_fare_amount = $surge_fare_amount;
            $add_city->surge_driver_share = $surge_driver_share;
            $add_city->min_dist_delivery_price = $min_dist_delivery_price;
            $add_city->extra_fee_deliveryamount = $extra_fee_deliveryamount;
            $add_city->status = $status;
            $city_data = $add_city->save();
            
            //add data in city_geofencing table
            $geofencing = new City_geofencing();
            $geofencing->city_id = $add_city->id;
            $geofencing->latitude = $request->latitude;
            $geofencing->longitude = $request->longitude;
            $geofencing->polygons = $request->geofence_latlng;
            //$geofencing->save();
            $geofencing->save();
            //$data = $city_id->city_geofencing()->create($geofencing);
        }
         else
        {

            return back()->with('error','This City was Already Registered!');
          }
        }

        return redirect('/admin/city_list')->with('success','City  Added Successfully');
} 

    public function city_list()
    {
      $city_list=DB::table('add_city')->get();
      //$city_list = $this->addcity->with('Restaurants')->get();
      //dd($city_list);
      //echo "<pre>"; print_r($city_list);exit();
      
      return view('/city_list',['city_list'=>$city_list]);
    }


    /**
    * add area view page
    *
    * @param int $id
    *
    * @return view page with array $area, int $id
    */
    public function area_setting($id)
    {
        $area=DB::table('add_city')->where('id',$id)->first();
        //print_r($area);exit();
        return view('/add_areas',['area'=>$area,'city_id'=>$id]);
    }


    /**
    * edit area view page
    *
    * @param int $id
    *
    * @return view page with array $area
    */
    public function edit_area($id)
    {
        $area = $this->addarea->find($id);
        //print_r($area);exit();
        return view('/edit_areas',['area'=>$area]);
    }


    /**
    * store area and return to view page
    *
    * @param object $request
    *
    * @return view page
    */
    public function add_area(Request $request)
	{
		$validator = Validator::make($request->all(), [
                'area' => 'required',
                'status' => 'required',
                'geofence_latlng' => 'required'
            ]);

        if($validator->fails()) 
        {

            $error_messages = implode(',',$validator->messages()->all());
            return back()->with('error', $error_messages)->withInput();
        }else
        {
            $check = $this->addarea->where('area','=',$request->area)->first();
        if(isset($check)==0)
        {
            $add_city_id = $request->id;
            $area = $request->area;
            $status = $request->status;
        	$add_area = $this->addarea;
        	$data = array();

        	$data[] = array(
        		
        		'area'=>$area,
        		'status'=>$status,
        		'add_city_id'=>$add_city_id,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'polygons' => $request->geofence_latlng,

        	);
        	$add_area->insert($data);
             }
         else
        {

            return back()->with('error','This Area was Already Registered!');
          }
        	
        }
        return redirect('admin/view_areas/'.$request->id)->with('success',trans('constants.add_success_msg',['param'=>'Area']));
    } 
    
    /**
    * get area list and return to view page
    *
    * @param int $id
    *
    * @return view page with array $area_list, int $id
    */
    public function area_list($id)
    {
        $area_list=DB::table('add_area')->where('add_city_id',$id)->get();
        return view('/view_areas',['area_list'=>$area_list,'city_id'=>$id]);
    }


    /**
    * update area list
    *
    * @param object $request
    *
    * @return view page
    */
    public function update_area_list(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'area' => 'required',
                'status' => 'required',
                'geofence_latlng' => 'required'
            ]);

        if($validator->fails()) 
        {

            $error_messages = implode(',',$validator->messages()->all());
            return back()->with('error', $error_messages)->withInput();
        }else
        {
            $area =  $this->addarea->find($request->id);
            $area->area = $request->area;
            $area->status = $request->status;
            $area->latitude = $request->latitude;
            $area->longitude = $request->longitude;
            $area->polygons = $request->geofence_latlng;
            $area->save();
            return redirect('/admin/view_areas/'.$area->add_city_id)->with('success',trans('constants.update_success_msg',['param'=>'Area']));  
        }
    }


    public function delete_area_list($id)
    {
        //$delete =  $this->addarea->where('id',$id)->delete();
        DB::delete('delete add_area,restaurants,restaurants_document,restaurant_bank_details,restaurant_cuisines,restaurant_timer,restaurant_payout_history,
                    favourite_list,offers_banner,popular_brands_list,food_list,foodlist_foodquantity,foodlist_addons,requests,request_detail,requestdetail_addons,track_order_status,order_ratings,chat_messages
                    from add_area left join restaurants on add_area.id = restaurants.area 
                    left join restaurants_document on restaurants.id = restaurants_document.restaurants_id 
                    left join restaurant_bank_details on restaurants.id = restaurant_bank_details.restaurant_id 
                    left join restaurant_cuisines on restaurants.id = restaurant_cuisines.restaurant_id 
                    left join restaurant_timer on restaurants.id = restaurant_timer.restaurant_id 
                    left join restaurant_payout_history on restaurants.id = restaurant_payout_history.restaurant_id 
                    left join offers_banner on restaurants.id = offers_banner.restaurant_id
                    left join popular_brands_list on restaurants.id = popular_brands_list.name 
                    left join favourite_list on restaurants.id = favourite_list.restaurant_id
                    left join food_list on restaurants.id = food_list.restaurant_id
                    left join foodlist_foodquantity on food_list.id = foodlist_foodquantity.foodlist_id
                    left join foodlist_addons on food_list.id = foodlist_addons.foodlist_id
                    left join requests on restaurants.id = requests.restaurant_id 
                    left join request_detail on requests.id = request_detail.request_id 
                    left join requestdetail_addons on request_detail.id = requestdetail_addons.requestdetail_id 
                    left join track_order_status on requests.id = track_order_status.request_id 
                    left join order_ratings on requests.id = order_ratings.request_id
                    left join chat_messages on requests.id = chat_messages.request_id 
                    where add_area.id='.$id);

        DB::delete('delete delivery_partners,delivery_partner_details,vehicle,driver_payout_history,requests,request_detail,requestdetail_addons,track_order_status,order_ratings,chat_messages
                    from delivery_partners left join delivery_partner_details on delivery_partners.id = delivery_partner_details.delivery_partners_id 
                    left join vehicle on delivery_partners.id = vehicle.delivery_partners_id 
                    left join driver_payout_history on delivery_partners.id = driver_payout_history.delivery_boy_id 
                    left join requests on delivery_partners.id = requests.delivery_boy_id 
                    left join request_detail on requests.id = request_detail.request_id 
                    left join requestdetail_addons on request_detail.id = requestdetail_addons.requestdetail_id 
                    left join track_order_status on requests.id = track_order_status.request_id 
                    left join order_ratings on requests.id = order_ratings.request_id
                    left join chat_messages on requests.id = chat_messages.request_id 
                    where delivery_partner_details.area='.$id);

        return back()->with('success','Area Deleted Successfully');  
    }

   public function document_management() 
   {

   	return view('add_document');
   }   
   

   public function document_add(Request $request)
	{
		$validator = Validator::make($request->all(), [
                'document_for' => 'required',
                'document_name' => 'required',
                'expiry_date_needed' => 'required',
                'status' => 'required',
            ]);

        if($validator->fails()) {

            $error_messages = implode(',',$validator->messages()->all());

            return back()->with('error', $error_messages);

        }else
        {
            $document_for = $request->document_for;
        	$document_name = $request->document_name;
            $expiry_date_needed = $request->expiry_date_needed;
            
            $status = $request->status;
        	$add_document = $this->document;

        	$data = array();

        	$data[] = array(
        		'document_for'=>$document_for,
        		'document_name'=>$document_name,
        		'expiry_date_needed'=>$expiry_date_needed,
        		'status'=>$status,
        		

        	);

        	

        
        		$add_document->insert($data);
        	
        	

        }

        return back()->with('success','Document Added Successfully');
} 

    public function document_list()
    {
    	$document_list = $this->document->get();
    	return view('document_list',['document_list'=>$document_list]);
    }

     public function vehicle_management() 
   {

   	return view('add_vehicle');
   }   
  
  public function vehicle_add(Request $request)
    {


        $rules = array();

        if(!$request->id){
            $rules['insurance_image'] = 'required|max:2048';
            $rules['rc_image'] = 'required|max:2048';
        }
            $rules['vehicle_name'] = 'required';
            $rules['vehicle_no'] = 'required';
            $rules['insurance_no'] = 'required';
            $rules['insurance_expiry_date'] = 'required';
            $rules['rc_no'] = 'required';
            $rules['rc_expiry_date'] = 'required';
            $rules['status'] = 'required';

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {

            $error_messages = implode(',',$validator->messages()->all());

            return back()->with('error', $error_messages);

        }else
        {
            $vehicle_name = $request->vehicle_name;
            $vehicle_no = $request->vehicle_no;
            $insurance_no = $request->insurance_no;
            $insurance_expiry_date = date("Y-m-d",strtotime($request->insurance_expiry_date));
            $rc_no = $request->rc_no;
            $rc_expiry_date = date("Y-m-d",strtotime($request->rc_expiry_date));
            $path = 'public/vehicles/';
           

            $status = $request->status;
            if($request->id != ""){             
                $add_vehicle = $this->vehicle->find($request->id);           
            }else{ 
                $add_vehicle = new $this->vehicle; 
            }
             $add_vehicle->vehicle_name = $vehicle_name;
             $add_vehicle->vehicle_no = $vehicle_no;
             $add_vehicle->insurance_no = $insurance_no;
             $add_vehicle->insurance_expiry_date = $insurance_expiry_date;
             $add_vehicle->rc_no = $rc_no;
             $add_vehicle->rc_expiry_date = $rc_expiry_date;
             $add_vehicle->status = $status;
            if($request->insurance_image !="" || $request->insurance_image != null){
                $add_vehicle->insurance_image = $this->custom->common_upload_images($request,'insurance_image',$path);
            }
            if($request->rc_image !="" || $request->rc_image != null){
                $add_vehicle->rc_image = $this->custom->common_upload_images($request,'rc_image',$path);
            }
            if($request->vehicle_image !="" || $request->vehicle_image != null){
                $add_vehicle->vehicle_image = $this->custom->common_upload_images($request,'vehicle_image',$path);
            }
               $add_vehicle->save();

        }

        return redirect('admin/vehicle_list')->with('success','Vehicle Added Successfully');
} 

    public function editvehicle($id)
    {
        $data = $this->vehicle->find($id);
        return view('add_vehicle',compact('data'));
    }
    
    public function vehicle_list()
    {
    	$vehicle_list = $this->vehicle->get();
    	return view('vehicle_list',['vehicle_list'=>$vehicle_list]);
    }

    public function cancellation_reason()
    {

    	return view('cancellation_reason_list');
    }

    public function add_reason(Request $request)
	{
		$validator = Validator::make($request->all(), [
                'reason' => 'required',
                'cancellation_for' => 'required',
                'status' => 'required',
            ]);

        if($validator->fails()) {

            $error_messages = implode(',',$validator->messages()->all());

            return back()->with('error', $error_messages);

        }else
        {
            $reason = $request->reason;
        	$cancellation_for = $request->cancellation_for;
            $status = $request->status;
        	$add_reason = $this->cancellation_reason;

        	$data = array();

        	$data[] = array(
        		'reason'=>$reason,
        		'cancellation_for'=>$cancellation_for,
        		'status'=>$status,
        		

        	);

        		$add_reason->insert($data);
        	
        }

        return redirect('admin/reason_list')->with('success','Cancellation Reason Added Successfully');
} 

   public function reason_list()
    {
    	$reason_list = $this->cancellation_reason->where('status','!=',0)->get();
    	return view('reason_list',['reason_list'=>$reason_list]);
    }

    public function driver()
    {
        $country=$this->country->get();
    	$vehicle=$this->vehicle->get();

    	return view('add_new_driver',['country'=>$country,'vehicle'=>$vehicle]);
    }

     public function generate_random_string()
    {
        return rand(11111111,99999999);
    }

    public function base_image_upload_license($request,$key)    
    {        
        $imageName = $request->file($key)->getClientOriginalName();       
        $ext = $request->file($key)->getClientOriginalExtension();
        $imageName = self::generate_random_string().'.'.$ext;        
         //$request->file($key)->move('public/uploads/License/',$imageName);   
        $filePath = "uploads/License/".$imageName;
        $filetype = Storage::disk('s3')->getDriver()->getAdapter()->getClient()->putObject(array(
            'Bucket'        => env('AWS_BUCKET'),
            'Key'           => $filePath,
            'Body'          => file_get_contents($request->$key),
            'ACL'           => 'public-read',
            'Expires'       => '',
            'CacheControl'  => 'max-age'
        ));    
        return $imageName;
    }



    public function base_image_upload_profile($request,$key)    
    {        
        $imageName = $request->file($key)->getClientOriginalName();       
        $ext = $request->file($key)->getClientOriginalExtension();
        $imageName = self::generate_random_string().'.'.$ext;        
         //$request->file($key)->move('public/uploads/Profile/',$imageName);       
        $filePath = "uploads/Profile/".$imageName;
        $filetype = Storage::disk('s3')->getDriver()->getAdapter()->getClient()->putObject(array(
            'Bucket'        => env('AWS_BUCKET'),
            'Key'           => $filePath,
            'Body'          => file_get_contents($request->$key),
            'ACL'           => 'public-read',
            'Expires'       => '',
            'CacheControl'  => 'max-age'
        ));
        return $imageName;
    }

    public function add_driver(Request $request)
	{
        if(!$request->id){
            $rules['profile_pic'] = 'required|max:2048';
            $rules['license'] = 'required|max:2048';
            $rules['password'] = 'required';
            $rules['insurance_image'] = 'required';
            $rules['rc_image'] = 'required';
        }
            $rules['city'] = 'required';
            $rules['area'] = 'required';
            $rules['driver_name'] = 'required';
            $rules['vehicle_name'] = 'required';
            $rules['phone_no'] = 'required';
            $rules['address_line_1'] = 'required';
            $rules['state_province'] = 'required';
            $rules['status'] = 'required';
            $rules['zip_code'] = 'required';
            $rules['country'] = 'required';
            $rules['license_expiry'] = 'required';
            $rules['account_name'] = 'required';
            $rules['account_address'] = 'required';
            $rules['account_no'] = 'required';
            $rules['bank_name'] = 'required';
            $rules['branch_name'] = 'required';
            $rules['branch_address'] = 'required';
            $rules['rc_expiry_date'] = 'required';
            $rules['insurance_expiry_date'] = 'required';
            $rules['rc_no'] = 'required';
            $rules['insurance_no'] = 'required';
            $rules['vehicle_no'] = 'required';
            $rules['vehicle_name'] = 'required';

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {

            $error_messages = implode(',',$validator->messages()->all());

            return back()->with('error', $error_messages)->withInput();

        }else
        {
        	
        	if($request->id){
                $insert1 = Deliverypartners::find($request->id);
                $msg = "update_success_msg";
        	}else{
                $insert1 = new Deliverypartners();
                $insert1->password=$this->encrypt_password($request->password);
                $msg = "add_success_msg";
                
        	}
            
            if($request->license){
                $license = self::base_image_upload_license($request,'license');
                $insert1->license=$license;
            }
            if($request->license){
                $profile_picture = self::base_image_upload_profile($request,'profile_pic');
                $insert1->profile_pic=$profile_picture;
            }
	        
            if(!$request->id){
                $insert1->partner_id=$this->generate_partner_id();
            }
            $insert1->name=$request->driver_name;
            $insert1->email=$request->email;
            $insert1->phone=$request->phone_no;
            $insert1->expiry_date=date("Y-m-d",strtotime($request->license_expiry));
            $insert1->status=$request->status;
            $insert1->save();

           	$partner_id = $insert1->id;
            
            if($request->id){
                $insert = $this->delivery_partner_details->where('delivery_partners_id',$request->id)->first();
                if(empty($insert)) $insert = $this->delivery_partner_details;
            }else{
	            $insert = $this->delivery_partner_details;
	        }

            $insert->delivery_partners_id=$partner_id;
            $insert->city=$request->city;
            $insert->area=$request->area;
            $insert->vehicle_name=$request->vehicle_name;
            $insert->address_line_1=$request->address_line_1;
            $insert->address_line_2=$request->address_line_2;
            $insert->address_city=$request->address_city;
            $insert->state_province=$request->state_province;
            $insert->country=$request->country;
            $insert->zip_code=$request->zip_code;
            $insert->about=$request->about;
            $insert->account_name=$request->account_name;
            $insert->account_address=$request->account_address;
            $insert->account_no=$request->account_no;
            $insert->bank_name=$request->bank_name;
            $insert->branch_name= $request->branch_name;
            $insert->branch_address=$request->branch_address;
            $insert->swift_code=$request->swift_code;
            $insert->routing_no=$request->routing_no;
            $insert->save();


            if($request->id){
                $vehicle = $this->vehicle->where('delivery_partners_id',$request->id)->first();
                if(empty($vehicle)) $vehicle = $this->vehicle;
            }else{
	            $vehicle = $this->vehicle;
            }
            if($request->insurance_image){
                $insurance_image = self::base_image_upload_profile($request,'insurance_image');
                $vehicle->insurance_image=$insurance_image;
            }
            if($request->rc_image){
                $rc_image = self::base_image_upload_profile($request,'rc_image');
                $vehicle->rc_image=$rc_image;
            }
            $vehicle->delivery_partners_id=$partner_id;
            $vehicle->vehicle_name=$request->vehicle_name;
            $vehicle->vehicle_no=$request->vehicle_no;
            $vehicle->insurance_no=$request->insurance_no;
            $vehicle->rc_no=$request->rc_no;
            $vehicle->insurance_expiry_date=date("Y-m-d",strtotime($request->insurance_expiry_date));
            $vehicle->rc_expiry_date=date("Y-m-d",strtotime($request->rc_expiry_date));
            $vehicle->save();

            if(!$request->id){
                //send email to user
                if(EMAIL_ENABLE==1)
                {
                    $insert1->subject = "Welcome to ".APP_NAME;
                    $this->send_mail($insert1,'driver_welcome');
                }
            }
        }


        return redirect('admin/driver_list')->with('success',trans('constants.'.$msg,['param'=>'Driver']));
} 

    public function edit_delivery_boy_details($id,Request $request)
	{
		$deliverypartners = $this->deliverypartners;

		$delivery_partner_detail = $deliverypartners->find($id);
		$profile_pic = BASE_URL.$delivery_partner_detail->profile_pic;
        if($delivery_partner_detail->expiry_date!='') $delivery_partner_detail->expiry_date = date("d F, Y",strtotime($delivery_partner_detail->expiry_date));
        if(isset($delivery_partner_detail->Vehicle->insurance_expiry_date)) $delivery_partner_detail->Vehicle->insurance_expiry_date = date("d F, Y",strtotime($delivery_partner_detail->Vehicle->insurance_expiry_date));
        if(isset($delivery_partner_detail->Vehicle->rc_expiry_date)) $delivery_partner_detail->Vehicle->rc_expiry_date = date("d F, Y",strtotime($delivery_partner_detail->Vehicle->rc_expiry_date));
		
        if(isset($delivery_partner_detail->Deliverypartner_detail->city))
            $city=$this->addcity->find($delivery_partner_detail->Deliverypartner_detail->city);
        else
            $city=array();

        if(isset($delivery_partner_detail->Deliverypartner_detail->state_province))
            $state=$this->state->find($delivery_partner_detail->Deliverypartner_detail->state_province);
        else
            $state=array();

        if(isset($delivery_partner_detail->Deliverypartner_detail->area))
            $area=$this->addarea->find($delivery_partner_detail->Deliverypartner_detail->area);
        else
            $area=array();

        $vehicle=$this->vehicle->get();
        $country=$this->country->get();

		return view('add_new_driver',['insert1'=>$delivery_partner_detail,'country'=>$country,'state'=>$state,'city'=>$city,'area'=>$area,'vehicle'=>$vehicle])->with('delivery_partner_commision',$delivery_partner_detail->partner_commision)->with('profile_icon',$profile_pic);

	}

	public function delete_delivery_boy($id)
       {
        $delete =  $this->deliverypartners->where('id',$id)->delete();

        $delete1 = DB::table('delivery_partner_details')->where('delivery_partners_id',$id)->delete();

        return back()->with('success','Delivery Partner Deleted Successfully');  
       }


   

    public function driver_list()
    {

        $data=$this->deliverypartners->with('Foodrequest')->where('status','!=',0)->get();
//dd($data[0]->Deliverypartner_detail->Citylist->city);
        $all_drivers=$this->deliverypartners->count('id');

        $active_drivers=DB::table('requests')->whereIn('status',[2,3,4,5,6])->count();

        $in_active_drivers=DB::table('requests')->whereIn('status',[0,1])->count();
      
        return view('driver_list',['data'=>$data,'all_drivers'=>$all_drivers,'active_drivers'=>$active_drivers,'in_active_drivers'=>$in_active_drivers]);
    }

     public function view_deliveryboy_order_details($id)
    {
      $delivery_boy_details=DB::table('requests')
      ->where('delivery_boy_id',$id)
      ->join('users','users.id','=','requests.user_id')
      ->join('delivery_partners','delivery_partners.id','=','requests.delivery_boy_id')
      ->join('restaurants','restaurants.id','=','requests.restaurant_id')
      ->select('users.name as customer_name','users.phone as phone','delivery_partners.name as driver_name','restaurants.restaurant_name as restaurant_name','users.*','requests.*','delivery_partners.*','restaurants.*','requests.status as status')
      ->get();
      
      return view('/view_delivery_boy_order_details',['delivery_boy_details'=>$delivery_boy_details]);
    }

    /**
     * function to get city data 
     * @param int $id
     * @return array to blade file
     */
    public function edit_city($id)
    {
      
        $country = $this->country->get();
        //get city data based on id
        $city_data = $this->addcity->where('id',$id)->with(['Country','State'])->first();
        //dd($data);

        return view('/edit_city',compact('city_data','country'));
    }

    public function update_city(Request $request)
	{
		$validator = Validator::make($request->all(), [
                
                'city' => 'required',
                'country' => 'required',
                'state' => 'required',
                'admin_commision' => 'required',
                'status' => 'required',
                'geofence_latlng' => 'required'
            ]);

        if($validator->fails()) {

            $error_messages = implode(',',$validator->messages()->all());
            //print_r($validator->messages()); exit;
            //return back()->with('error', $error_messages);
            return back()->withErrors($validator)->withInput();

        }else
        {
            /*if(!empty($request->geofence_latlng))
            {
                $source_polygon = explode(',',$request->geofence_latlng);
                $j = $k =0;
                for ($i=0; $i <= count($source_polygon)-1 && $k <= count($source_polygon)-1; $i++) {
                        $source_coordinates[$j][0] = $source_polygon[$k++];
                        $source_coordinates[$j][0] = (double)trim($source_coordinates[$j][0],'[ ');
                        $source_coordinates[$j][1] = $source_polygon[$k];
                        $source_coordinates[$j][1] = (double)trim($source_coordinates[$j][1],' ]');

                        $temp = $source_coordinates[$j][0];
                        $source_coordinates[$j][0] = $source_coordinates[$j][1];
                        $source_coordinates[$j][1] = $temp;
                        $k++;$j++;
                }
            } else {
                $source_coordinates = array();
            }*/
            //echo "<pre>";print_r( $source_coordinates);
            // $first_cordinate = current($source_coordinates);
            // $a = end($source_coordinates);
            // $key = key($source_coordinates); 
            // $source_coordinates[$key+1] = $first_cordinate;
            //echo "<pre>";print_r( $source_coordinates);exit;
        	
            $city = $request->city;
            $country_id = $request->country;
            $state_id = $request->state;
            $admin_commision = $request->admin_commision;
            $default_delivery_amount = $request->default_delivery_amount;
            $target_amount = $request->target_amount;
            $driver_base_price = $request->driver_base_price;
            $min_dist_base_price = $request->min_dist_base_price;
            $extra_fee_amount = $request->extra_fee_amount;
            $extra_fee_amount_each = $request->extra_fee_amount_each;
            $night_fare_amount = $request->night_fare_amount;
            $night_driver_share = $request->night_driver_share;
            $surge_fare_amount = $request->surge_fare_amount;
            $surge_driver_share = $request->surge_driver_share;
            $min_dist_delivery_price = $request->min_dist_delivery_price;
            $extra_fee_deliveryamount = $request->extra_fee_deliveryamount;
            $status = $request->status;

        	$data = array();

            $citydata = $this->addcity->find($request->id);
            $citydata->city = $city;
            $citydata->country_id = $country_id;
            $citydata->state_id = $state_id;
            $citydata->admin_commision = $admin_commision;
            $citydata->default_delivery_amount = $default_delivery_amount;
            $citydata->target_amount = $target_amount;
            $citydata->driver_base_price = $driver_base_price;
            $citydata->min_dist_base_price = $min_dist_base_price;
            $citydata->extra_fee_amount = $extra_fee_amount;
            $citydata->extra_fee_amount_each = $extra_fee_amount_each;
            $citydata->night_fare_amount = $night_fare_amount;
            $citydata->night_driver_share = $night_driver_share;
            $citydata->surge_fare_amount = $surge_fare_amount;
            $citydata->surge_driver_share = $surge_driver_share;
            $citydata->min_dist_delivery_price = $min_dist_delivery_price;
            $citydata->extra_fee_deliveryamount = $extra_fee_deliveryamount;
            $citydata->status = $status;
            $citydata->save();
            
            //add data in city_geofencing table
            $geofencing = new City_geofencing();
            $geofencingdata = $geofencing->where('city_id',$citydata->id)->first();
            if(empty($geofencingdata)) $geofencingdata = $geofencing;
            $geofencingdata->city_id = $citydata->id;
            $geofencingdata->latitude = !empty($request->latitude)?$request->latitude:env('DEFAULT_LAT');
            $geofencingdata->longitude = !empty($request->longitude)?$request->longitude:env('DEFAULT_LNG');
            $geofencingdata->polygons = $request->geofence_latlng;
            //$geofencing->save();
            $geofencingdata->save();
            //$data = $city_id->city_geofencing()->create($geofencing);
        }

        return redirect('/admin/city_list')->with('success','City  Added Successfully');
    } 

    /**
     * get add_ons, menu based on restaurant
     * 
     * @param int $id
     * 
     * @return json $data
     */
    public function getrestaurant_based_detail($id)
    {
        $data = $this->restaurants->with(['Add_ons','Menu'])->find($id);
        //dd($data);
        return $data;
    }


    /**
     * get area based on city
     * 
     * @param int $id
     * 
     * @return json $data
     */
    public function getcity_area($id)
    {
        $data = $this->addcity->with(['Area'])->find($id);
        //dd($data);
        return $data;
    }


    /**
     * check restaurant address based on area
     * 
     * @param object $request
     * 
     * @return array $data
     */
    public function check_restaurant_address(Request $request)
    {
        $area_id = $request->area_id;
        $source_lat = $request->lat;
        $source_lng = $request->lng;

        $data = $this->addarea->where('id',$area_id)
                    ->selectRaw("(6371 * acos(cos(radians(" . $source_lat . "))* cos(radians(`latitude`)) 
                            * cos(radians(`longitude`) - radians(" . $source_lng . ")) + sin(radians(" . $source_lat . ")) 
                            * sin(radians(`latitude`)))) as distance")
                    ->having('distance','<=',DEFAULT_RADIUS)
                    ->orderBy('distance')
                    ->first();

        return $data;
    }


    /**
     * delete cancel reasons
     * 
     * @param object $request
     * 
     * @return view page
     */
    public function delete_cancel_reason(Request $request)
    {
        $this->cancellation_reason->where('id',$request->id)->update(['status'=>0]);
        return back()->with('success','Reason Deleted Successfully');  
    }


    /**
    * document_update
    *
    * @param object $request
    *
    * @return view page
    */
    public function document_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'document_for' => 'required',
                'status' => 'required',
                'document_name' => 'required',
                'expiry_date_needed' => 'required'
            ]);

        if($validator->fails()) 
        {

            $error_messages = implode(',',$validator->messages()->all());
            return back()->with('error', $error_messages)->withInput();
        }else
        {
            $document =  $this->document->find($request->id);
            $document->document_for = $request->document_for;
            $document->expiry_date_needed = $request->expiry_date_needed;
            $document->status = $request->status;
            $document->document_name = $request->document_name;
            
            $document->save();
            return redirect('/admin/document_list')->with('success',trans('constants.update_success_msg',['param'=>'Document']));  
        }
    }


    /**
    * cancellation_update
    *
    * @param object $request
    *
    * @return view page
    */
    public function cancellation_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'reason' => 'required',
                'status' => 'required',
                'cancellation_for' => 'required',
                
            ]);

        if($validator->fails()) 
        {

            $error_messages = implode(',',$validator->messages()->all());
            return back()->with('error', $error_messages)->withInput();
        }else
        {
            $cancellation =  $this->cancellation_reason->find($request->id);
            $cancellation->reason = $request->reason;
            $cancellation->cancellation_for = $request->cancellation_for;
            $cancellation->status = $request->status;
            
            $cancellation->save();
            return redirect('/admin/reason_list')->with('success',trans('constants.update_success_msg',['param'=>'Cancel Reason']));  
        }
    }


    /**
     * Edit page for cancel reason
     * 
     * @param int $id
     * 
     * @return view page with array $reason_list
     */
    public function update_reason_list($id)
    {
        $reason_list = $this->cancellation_reason->where('id',$id)->get();

        return view('update_cancellation_reason',['reason_list'=>$reason_list]);
    }



    /**
     * Edit page for document
     * 
     * @param int $id
     * 
     * @return view page with array $update_document
     */
    public function update_document($id)
    {
        $update_document = $this->document->where('id',$id)->get();

        return view('update_document',['update_document'=>$update_document]);
    }

    
    /**
    * To check the email and phone number exist
    *
    * @param $request
    *
    * @return $msg
    */

    public function existchecking(Request $request)
    {
        $email = $request->email;
        $phone = $request->phone;
        if(isset($request->phone)){
            $phone_data = $this->restaurants->where('phone',$phone)->count();
            if($phone_data==0)
                return 0;
            else
                return 1;
        }
        if(isset($request->email)){
            $email_data = $this->restaurants->where('email',$email)->count();
            if($email_data==0)
                return 0;
            else
                return 1;
        }        
    }

} 