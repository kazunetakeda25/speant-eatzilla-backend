<?php

namespace App\Http\Controllers\admin;
                                    
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController;
use DB;

class DeliverypeopleController extends BaseController
{
	public function deliverypeople_list(Request $request)
	{
		// echo $request->ip(); exit;
		$data = DB::table('delivery_partners')->where('status','!=',0)->get();
		//$delete =  $this->driver_partner_details::get();

		foreach($data as $d)
		{	
			$driver_id =$this->driver_partner_details->where('delivery_partners_id',$d->id)->first();
			if(isset($driver_id)){
				$d->driver_id = $driver_id->id;
			}else{
				$d->driver_id = 0;
			} 
			$d->profile_pic = BASE_URL.$d->profile_pic;
		}

		return view('deliverypeople_list',['data'=>$data]);
	}

	public function add_deliverypeople()
	{
		$settings = $this->settings;

		$delivery_partner_commision = $settings->where('key_word','delivery_boy_commission')->first();

		$profile_icon = BASE_URL.PROFILE_ICON;

		return view('add_deliverypeople')->with('delivery_partner_commision',$delivery_partner_commision->value)->with('profile_icon',$profile_icon);
	}

	public function edit_delivery_partner($id,Request $request)
	{
		$deliverypartners = $this->deliverypartners;

		$delivery_partner_detail = $deliverypartners->find($id);
		$profile_pic = BASE_URL.$delivery_partner_detail->profile_pic;

		return view('add_deliverypeople',['delivery_partner'=>$delivery_partner_detail])->with('delivery_partner_commision',$delivery_partner_detail->partner_commision)->with('profile_icon',$profile_pic);

	}

	public function add_to_deliverypeople(Request $request)
	{


		if($request->id)
		{
			$validator = Validator::make($request->all(), [
                'name' => 'required|max:50',
                // 'email' => 'required|email',
                'commision' => 'required',
                'address' => 'required',
                'driving_license_no' => 'required',
                'service_zone' => 'required',
                'bank_name' => 'required',
	            'acc_no' => 'required',
	            'ifsc_code' => 'required'
            ]);
		}else
		{

			 $validator = Validator::make($request->all(), [
	                'name' => 'required|max:50',
	                'phone' => 'required|numeric|digits_between:6,13',
	                'country_code' => 'required|numeric',
	                // 'email' => 'required|email',
	                'commision' => 'required',
	                'address' => 'required',
	                'driving_license_no' => 'required',
	                'service_zone' => 'required',
	                'bank_name' => 'required',
	                'acc_no' => 'required',
	                'ifsc_code' => 'required',
	                'profile_pic' =>'required|mimes:jpeg,jpg,bmp,png|max:2048'
	            ]);
		}

        if($validator->fails()) {

            $error_messages = implode(',',$validator->messages()->all());

            return back()->with('error', $error_messages);

        }else
        {

			$deliverypartners = $this->deliverypartners;
			$custom = $this->custom;
			$name = $request->name;
			$phone = $request->phone;
			$country_code = $request->country_code;
			$service_zone = $request->service_zone;
			$bank_name = $request->bank_name;
			$acc_no = $request->acc_no;
			$ifsc_code = $request->ifsc_code;
			$driving_license_no = $request->driving_license_no;
			$email = $request->email?$request->email:"";
			$password = $this->encrypt_password($request->password);
			$authToken = "";
			$commision = $request->commision;
			$address = $request->address;
			if($request->profile_pic)
			{
			$profile_pic = $custom->restaurant_upload_image($request,'profile_pic');
			}
			// else
			// {

			// 	$profile_pic=PROFILE_ICON;
				
			// }



			$data = array();

			if($request->id)
			{
				if(!$request->profile_pic)
				{
					$check = $deliverypartners->where('id',$request->id)->first();
					$profile_pic = $check->profile_pic;
				}

				$deliverypartners->where('id',$request->id)->update([
										'name'=>$name,'email'=>$email,
										'address'=>$address,
										'profile_pic'=>$profile_pic,
										'partner_commision'=>$commision,
										'service_zone'=>$service_zone,
										'driving_license_no'=>$driving_license_no,
										'bank_name'=>$bank_name,
										'acc_no'=>$acc_no,
										'ifsc_code'=>$ifsc_code
										]);

			}else
			{

				$data[] = array(
					'partner_id'=>$this->generate_partner_id(),
					'name'=>$name,
					'phone'=>$country_code.$phone,
					'email'=>$email,
					'password'=>$password,
					'address'=>$address,
					'profile_pic'=>$profile_pic,
					'partner_commision'=>$commision,
					'service_zone'=>$service_zone,
					'driving_license_no'=>$driving_license_no,
					'bank_name'=>$bank_name,
					'acc_no'=>$acc_no,
					'ifsc_code'=>$ifsc_code
				);

				$deliverypartners->insert($data);
			}

			return redirect('/admin/deliverypeople_list')->with('success','Delivery Boy Added');
		}

	}



	/**
	 * Delete delivery partner based on current status
	 * 
	 * @param object $request
	 * 
	 * @return return to view page
	 */
	public function delete_delivery_partner(Request $request)
	{
		$validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);

		if($validator->fails()) 
		{
            $error_messages = implode(',',$validator->messages()->all());
            return back()->with('error', $error_messages);
        }else
        {
        	$id = $request->id;
			$data = file_get_contents(FIREBASE_URL."/providers_status/".$id.".json");
			$data = json_decode($data);
			if($data!="null")
			{
				$status = isset($data->status)?$data->status:"";
				if($status==2)
				{
					return redirect('/admin/driver_list')->with('error','In Ride. Could not delete Delivery Partner!');
				}else
				{
					$this->deliverypartners->where('id',$id)->update(['status'=>0]);
					return redirect('/admin/driver_list')->with('success','Delivery Partner Removed');
				}
			}else
			{
				$this->deliverypartners->where('id',$id)->update(['status'=>0]);
				return redirect('/admin/driver_list')->with('success','Delivery Partner Removed');
			}
        }
	}


	/**
	* Get driver location and plot it in map
	* @param object $request
	*
	* @return view page
	*/
	public function track_driver(Request $request, $id)
	{
		$result = file_get_contents(FIREBASE_URL."/prov_location/".$id.".json");
		$result = json_decode($result);
		//dd($result);
		$getdetails = $this->deliverypartners->select('name','phone','partner_id')->where('id',$id)->first();
		$getstatus = file_get_contents(FIREBASE_URL."/providers_status/".$id.".json");
		$getstatus = json_decode($getstatus);
		$data=array();
		if(!empty($result))
		{
			$data[] = (object)array(
				'id'=>$id,
				'name'=>isset($getdetails->name)?$getdetails->name:"",
				'partner_id'=>isset($getdetails->partner_id)?$getdetails->partner_id:"",
				'phone'=>isset($getdetails->phone)?$getdetails->phone:"",
				'lat'=>$result->lat,
				'lng'=>$result->lng,
				'is_available'=>isset($getstatus->status)?$getstatus->status:0
			);
		}
		//dd($data);
		return view('dashboard_map',['data'=>$data]);
	}
}