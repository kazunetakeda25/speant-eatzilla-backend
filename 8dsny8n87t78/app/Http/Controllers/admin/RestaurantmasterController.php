<?php

namespace App\Http\Controllers\admin;
                                    
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController;
use DB;

class RestaurantmasterController extends BaseController
{
	public function restaurant_cuisines(Request $request)
	{
		$restaurant_id = $request->session()->get('userid');

		$restaurant_cuisines = DB::table('restaurant_cuisines')->where('restaurant_id',$restaurant_id)
								->join('cuisines','cuisines.id','=','restaurant_cuisines.cuisine_id')
								->select('restaurant_cuisines.id as cid','cuisines.name as cuisine_name','cuisines.cuisine_image')
								->get();

			$cuisines = $this->cuisines->where('status','!=',0)->get();

		return view('restaurant_cuisines',['restaurant_cuisines'=>$restaurant_cuisines,'cuisines'=>$cuisines]);

	}

	public function add_to_restaurant_cuisines(Request $request)
	{
		$validator = Validator::make($request->all(), [
                'cuisine_id' => 'required',
            ]);

        if($validator->fails()) {

            $error_messages = implode(',',$validator->messages()->all());

            return back()->with('error', $error_messages);

        }else
        {
        	$restaurant_id = $request->session()->get('userid');
        	$cuisine_id = $request->cuisine_id;

        	$restaurant_cuisines = $this->restaurantcuisines;

        	$data = array();

        	$data[] = array(
        		'restaurant_id'=>$restaurant_id,
        		'cuisine_id'=>$cuisine_id
        	);

        	$check = $restaurant_cuisines->where('restaurant_id',$restaurant_id)->where('cuisine_id',$cuisine_id)->count();

        	if($check==0)
        	{

        		$restaurant_cuisines->insert($data);
        	}else
        	{
        		 return redirect('/admin/restaurant_cuisines')->with('error','Cuisine already exist');
        	}

        }

        return redirect('/admin/restaurant_cuisines')->with('success','Cuisine added Successfully');
	}

	public function delete_restaurant_cuisine(Request $request)
	{
		$validator = Validator::make($request->all(), [
                'cuisine_id' => 'required',
            ]);

        if($validator->fails()) {

            $error_messages = implode(',',$validator->messages()->all());
            return back()->with('error', $error_messages);

        }else
        {
        	$cuisine_id = $request->cuisine_id;
			$this->restaurantcuisines->where('id',$cuisine_id)->delete();
			// $this->restaurantcuisines->where('id',$cuisine_id)->update(['status'=>0]);
			
			// $this->foodlist->wherehas('Restaurants.Cuisines', function($query) use ($cuisine_id){
			// 	$query->where('cuisines.id',$cuisine_id);
			// })
			// ->update(['restaurants.status'=>0, 'food_list.status'=>0]);
        }

        return redirect('/admin/restaurant_cuisines')->with('success','Cuisine Deleted Successfully');
	} 
}