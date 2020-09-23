<?php

namespace App\Http\Controllers\admin;
                                    
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController;
use DB;
use Hash;

class DispController extends BaseController
{

	public function disp_managerlist()
	{
		$data = $this->admin->where('role',3)->get();
		return view('disp_managerlist',compact('data'));
	}
	public function add_dispmanager()
	{
		return view('add_dispmanager');
	}


	/**
	 * Store sub admin details
	 * 
	 * @param object $request
	 * 
	 * @return view page
	 */
	public function store_dispmanager(Request $request)
	{
		//dd($request->all());
		$rules = array(
            'name' => 'required|max:50',
            'password' => 'required',
        );
        if($request->id!='')
        {
            $rules['email'] = 'required|unique:admin,email,'.$request->id;
            $rules['phone'] = 'required|numeric|unique:admin,phone,'.$request->id;
        }else
        {
            $rules['email'] = 'required|unique:admin,email';
            $rules['phone'] = 'required|numeric|unique:admin,phone';
        }
        $validator = Validator::make($request->all(), $rules);
		if($validator->fails()) 
		{
            $error_messages = implode(',',$validator->messages()->all());
            return back()->with('error', $error_messages);

        }else
        {
			if($request->id)
			{
				$admin = $this->admin->find($request->id);
				$admin->name = $request->name;
				$admin->email = $request->email;
				$admin->phone = $request->phone;
				$admin->org_password = $request->password;
				$admin->password = Hash::make($request->password);
				$admin->save();

				$access_privilages = $this->access_privilages->where('admin_id',$request->id)->first();
				if(empty($access_privilages)) $access_privilages = $this->access_privilages;
				
				$access_privilages->dashboard = (!empty($request->main_dashboard))?implode(',',$request->main_dashboard):"";
				$access_privilages->availability_map = (!empty($request->availability_map))?implode(',',$request->availability_map):"";
				$access_privilages->order_management = (!empty($request->order_dashboard))?implode(',',$request->order_dashboard):"";
				$access_privilages->restaurant = (!empty($request->restaurant))?implode(',',$request->restaurant):"";
				$access_privilages->city_management = (!empty($request->city))?implode(',',$request->city):"";
				$access_privilages->food_management = (!empty($request->food))?implode(',',$request->food):"";
				$access_privilages->driver_management = (!empty($request->driver))?implode(',',$request->driver):"";
				$access_privilages->document = (!empty($request->document))?implode(',',$request->document):"";
				$access_privilages->cancel_reason = (!empty($request->resaon))?implode(',',$request->resaon):"";
				$access_privilages->promocode = (!empty($request->promocode))?implode(',',$request->promocode):"";
				$access_privilages->banner = (!empty($request->banner))?implode(',',$request->banner):"";
				$access_privilages->popular_brands = (!empty($request->popular_brand))?implode(',',$request->popular_brand):"";
				$access_privilages->users = (!empty($request->users))?implode(',',$request->users):"";
				$access_privilages->cuisines = (!empty($request->cuisines))?implode(',',$request->cuisines):"";
				$access_privilages->addons = (!empty($request->addons))?implode(',',$request->addons):"";
				$access_privilages->payouts = (!empty($request->payout))?implode(',',$request->payout):"";
				$access_privilages->food_quantity = (!empty($request->food_quantity))?implode(',',$request->food_quantity):"";
				$access_privilages->category = (!empty($request->category))?implode(',',$request->category):"";
				$access_privilages->cms = (!empty($request->cms))?implode(',',$request->cms):"";
				$access_privilages->settings = (!empty($request->settings))?implode(',',$request->settings):"";
				$access_privilages->reports = (!empty($request->report))?implode(',',$request->report):"";
				$admin->AccessPrivilages()->save($access_privilages);

				$msg = "update_success_msg";
			}else{
				$this->admin->name = $request->name;
				$this->admin->email = $request->email;
				$this->admin->phone = $request->phone;
				$this->admin->org_password = $request->password;
				$this->admin->password = Hash::make($request->password);
				$this->admin->role = 3;
				$this->admin->save();

				$this->access_privilages->admin_id = $this->admin->id;
				$this->access_privilages->dashboard = (!empty($request->main_dashboard))?implode(',',$request->main_dashboard):"";
				$this->access_privilages->availability_map = (!empty($request->availability_map))?implode(',',$request->availability_map):"";
				$this->access_privilages->order_management = (!empty($request->order_dashboard))?implode(',',$request->order_dashboard):"";
				$this->access_privilages->restaurant = (!empty($request->restaurant))?implode(',',$request->restaurant):"";
				$this->access_privilages->city_management = (!empty($request->city))?implode(',',$request->city):"";
				$this->access_privilages->food_management = (!empty($request->food))?implode(',',$request->food):"";
				$this->access_privilages->driver_management = (!empty($request->driver))?implode(',',$request->driver):"";
				$this->access_privilages->document = (!empty($request->document))?implode(',',$request->document):"";
				$this->access_privilages->cancel_reason = (!empty($request->resaon))?implode(',',$request->resaon):"";
				$this->access_privilages->promocode = (!empty($request->promocode))?implode(',',$request->promocode):"";
				$this->access_privilages->banner = (!empty($request->banner))?implode(',',$request->banner):"";
				$this->access_privilages->popular_brands = (!empty($request->popular_brand))?implode(',',$request->popular_brand):"";
				$this->access_privilages->users = (!empty($request->users))?implode(',',$request->users):"";
				$this->access_privilages->cuisines = (!empty($request->cuisines))?implode(',',$request->cuisines):"";
				$this->access_privilages->addons = (!empty($request->addons))?implode(',',$request->addons):"";
				$this->access_privilages->payouts = (!empty($request->payout))?implode(',',$request->payout):"";
				$this->access_privilages->food_quantity = (!empty($request->food_quantity))?implode(',',$request->food_quantity):"";
				$this->access_privilages->category = (!empty($request->category))?implode(',',$request->category):"";
				$this->access_privilages->cms = (!empty($request->cms))?implode(',',$request->cms):"";
				$this->access_privilages->settings = (!empty($request->settings))?implode(',',$request->settings):"";
				$this->access_privilages->reports = (!empty($request->report))?implode(',',$request->report):"";
				$this->access_privilages->save();
				$msg = "add_success_msg";
			}
			return redirect('/admin/disp_managerlist')->with('success',trans('constants.'.$msg,['param'=>'Subadmin']));
		}
	}

}