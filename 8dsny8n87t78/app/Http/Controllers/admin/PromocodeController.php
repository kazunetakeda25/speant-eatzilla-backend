<?php

namespace App\Http\Controllers\admin;
                                    
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController;
use DB;

class PromocodeController extends BaseController
{

	/**
	 * add promocode view page
	 * 
	 * @return view page
	 * 
	 */
	public function add_promocode()
	{
		return view('add_promocode');	
	}


	public function promocodes_list(Request $request)
	{
		$promocode_list = $this->promocode->where('status','!=',0)->get();

		// print_r($promocode_list); exit;
	return view('promocodes_list',['promocodes_list'=>$promocode_list]);
	}

	public function edit_promocode($id,Request $request)
	{
		$promocode = $this->promocode->where('id',$id)->first();

		return view('add_promocode',['data'=>$promocode]);
	}

	public function add_to_promocode(Request $request)
	{

		$validator = Validator::make($request->all(), [
                'promo_code' => 'required|max:50',
                // 'email' => 'required|email',
                'offer_type' => 'required',
                'discount' => 'required',
                'title' => 'required',
                'description' => 'required',
                'available_from' => 'required',
                'valid_till' => 'required',
                'use_per_customer' => 'required',
	            'total_use' => 'required',
	            'status' => 'required'
            ]);

		if($validator->fails()) {

            $error_messages = implode(',',$validator->messages()->all());
            return back()->with('error', $error_messages);

        }else
        {

				$id = $request->id;
				$promo_code = $request->promo_code;
				$title = $request->title;
				$description = $request->description;
				$offer_type = $request->offer_type;
				$value = $request->discount;
				$available_from = $request->available_from;
				$valid_till = $request->valid_till;
				$use_per_customer = $request->use_per_customer;
				$total_use = $request->total_use;
				$coupon_type = $request->coupon_type;
				$delivery_type = $request->delivery_type;
				$max_amount = (!empty($request->max_amount))?$request->max_amount:0;
				$coupon_value = (!empty($request->coupon_value))?$request->coupon_value:0;
				$status = $request->status;	
				$available_from_date = date("Y-m-d",strtotime($available_from));
				$valid_till_date =  date("Y-m-d",strtotime($valid_till));

					// echo date("Y-m-d",strtotime($available_from)); exit;

					if($id !="" || $id !=null)
					{
						$check = $this->promocode->where('id','!=',$request->id)
												 ->where('code',$promo_code)
												 ->get();
						$insert = $this->promocode->find($id);

					}else
					{
						$check = $this->promocode->where('code',$promo_code)->get();

						$insert = $this->promocode;
					}
					$insert->code = $promo_code;
					$insert->title = $title;
					$insert->description = $description;
					$insert->offer_type = $offer_type;
					$insert->value = $value;
					$insert->available_from = $available_from_date;
					$insert->max_amount = $max_amount;
					$insert->coupon_value = $coupon_value;
					$insert->coupon_type = $coupon_type;
					$insert->delivery_type = $delivery_type;
					$insert->valid_till = $valid_till_date;
					$insert->use_per_customer = $use_per_customer;
					$insert->total_use = $total_use;
					$insert->status = $status;
					$insert->save();

					if(count($check)!=0)
					{
						return back()->with('error', trans('constants.already_exist',['param'=>'Promo code is ']))->withInput();
					}
		}

		return redirect('/admin/promocodes_list')->with('success','Promocode Added');
	}

	public function delete_promocode($id,Request $request)
	{
		$promo_code = $this->promocode->find($id);
		$promo_code->status = 0;
		$promo_code->save();

		return redirect('/admin/promocodes_list')->with('success',trans('constants.promo_code'). " Deleted Successfully");
	}

	public function coupon_list()
	{
		$coupon_list=$this->coupon->get();
		return view('coupon_list',['coupon_list'=>$coupon_list]);
	}

	public function coupon()
	{
		return view('add_coupon');
	}
    
    public function coupon_add(Request $request)
	{

		$validator = Validator::make($request->all(), [
                'coupon_type' => 'required',
                // 'email' => 'required|email',
                'code' => 'required',
                'discount_type' => 'required',
                'amount' => 'required',
                'usage_limit_per_coupon' => 'required',
                'usage_limit_per_user' => 'required',
	            'valid_from' => 'required',
	            'status' => 'required'
            ]);

		if($validator->fails()) {

            $error_messages = implode(',',$validator->messages()->all());

            return back()->with('error', $error_messages);

        }else
        {

				$coupon_type = $request->coupon_type;
				$code = $request->code;
				$discount_type = $request->discount_type;
				$amount = $request->amount;
				$usage_limit_per_coupon = $request->usage_limit_per_coupon;
				$usage_limit_per_user = $request->usage_limit_per_user;
				$valid_from = $request->valid_from;
				$status = $request->status;	
				

				$coupon_management = $this->coupon;

					$data = array();

					// echo date("Y-m-d",strtotime($available_from)); exit;

					if($request->id)
					{
						$coupon_management->where('id',$request->id)->update([
												'coupon_type'=>$coupon_type,
												'code'=>$code,
												'discount_type'=>$discount_type,
												'amount'=>$amount,
												'usage_limit_per_coupon'=>$usage_limit_per_coupon,
												'usage_limit_per_user'=>$usage_limit_per_user,
												'valid_from'=>$valid_from,
												'status'=>$status
											]);
					}else
					{
						$check = $coupon_management->where('code',$code)->get();

						if(count($check)!=0)
						{
							return redirect('/admin/coupon_list')->with('error', $code.' already exists');
						}else
						{
							$data[] = array(
							'coupon_type'=>$coupon_type,
							'code'=>$code,
							'discount_type'=>$discount_type,
							'amount'=>$amount,
							'usage_limit_per_coupon'=>$usage_limit_per_coupon,
							'usage_limit_per_user'=>$usage_limit_per_user,
							'valid_from'=>$valid_from,
							'status'=>$status
							);

							$coupon_management->insert($data);

						}
					}
		}

		return redirect('/admin/coupon_list')->with('success','Coupon Added');
	}


	public function edit_coupon($id,Request $request)
	{
		$coupon= $this->coupon->where('id',$id)->first();

		return view('add_coupon',['data'=>$coupon]);
	}

	public function delete_coupon($id)
	{
		$delete = $this->coupon->where('id',$id)->delete();

		return back()->with('success','Coupon Deleted');
	}


}