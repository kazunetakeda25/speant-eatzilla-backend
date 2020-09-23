<?php

namespace App\Http\Controllers\admin;
                                    
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController;
use DB;

class UserController extends BaseController
{
	public function user_list(Request $request)
	{
		$user_detail = $this->users->get();

		// print_r($user_detail); exit;

		return view('user_list',['user_detail'=>$user_detail]);
	}
	
	public function Adduser(Request $request)
	{
		return view('add_user');
	}

	/**
	 * get pending user credit list
	 * 
	 * @param object $request
	 * 
	 * @return view page
	 */
	public function user_credit(Request $request)
	{
		$user_detail = $this->user_credit->with('users')->where('status',0)->get();
		//dd($user_detail);
		return view('user_credit_list',['user_detail'=>$user_detail]);
	}


	/**
	 * get details of user credit
	 * 
	 * @param object $request
	 * 
	 * @return view page
	 */
	public function view_credit_details(Request $request, $id)
	{
		$user_detail = $this->user_credit->with('users')->where('user_id',$id)->first();
		$asset_report_token = $user_detail->users->asset_report_token;
		$result = file_get_contents('http://'.$_SERVER['HTTP_HOST'].':3030/get_assetreport?asset_report_token='.$asset_report_token);
		$result = json_decode($result);
		if(isset($result->items->items[0]->accounts))
		{
			foreach($result->items->items[0]->accounts as $val)
			{
				if($val->account_id == $user_detail->users->account_id)
				{
					if(!empty($val->historical_balances))
					{
						$arr = (array)$val->historical_balances;
						$count = count($arr);						
						$sum_value = array_sum(array_map(function($item) { 
										return $item->current; 
									}, $arr));
						$average = DEFAULT_CURRENCY_SYMBOL." ".($sum_value/$count);
					}else
					{
						$average = "History balances not found";
					}
				}else
				{
					$average = "Account not found";
				}
			}
		}else
		{
			$average = "Data not found";
		}
		return view('view_credit_details',['user_detail'=>$user_detail, 'asset_status'=>$result->status,'average'=>$average]);
	}

	/**
	 * update approval for user credit
	 * 
	 * @param object $request
	 * 
	 * @return redirect view
	 */
	public function update_usercredit(Request $request)
	{
		$id = $request->id;
		$user_detail = $this->user_credit->find($id);
		if($user_detail)
		{
			$user_detail->amount = $request->amount;
			$user_detail->credit_amount = $request->amount;
			$user_detail->status = 1;
			$user_detail->save();
			return redirect('/admin/user_credit')->with('success', "Credit amount approved successfully!");
		}else
		{
			return back()->withInput()->with('error', 'Invalid credit details!');
		}
	}

	/**
	 * update decline for user credit
	 * 
	 * @param object $request
	 * 
	 * @return redirect view
	 */
	public function decline_usercredit(Request $request)
	{
		$id = $request->id;
		$user_detail = $this->user_credit->find($id);
		if($user_detail)
		{
			$user_detail->status = 2;
			$user_detail->save();
			return redirect('/admin/user_credit')->with('success', "Credit amount declined successfully!");
		}else
		{
			return back()->withInput()->with('error', 'Invalid credit details!');
		}
	}
}
