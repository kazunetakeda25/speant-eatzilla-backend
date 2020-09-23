<?php

namespace App\Http\Controllers\admin;
                                    
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController;
use DB;
use Illuminate\Validation\Rule;


class ItemmasterController extends BaseController
{


	/**
	 * get add category page
	 * 
	 * @return view page
	 * 
	 */
	public function index()
	{
		return view('add_category');
	}


	public function get_category_list(Request $request)
	{
	
		$data = DB::table('category')->where('status','!=',0)->get();

		// print_r($data); exit;
		
		return view('category_list',['data'=>$data]);
	}

	public function add_to_category(Request $request)
	{

		$validator = Validator::make($request->all(), [
                'category_name' => 'required',
                'status' => 'required'
            ]);

        if($validator->fails()) {

            $error_messages = implode(',',$validator->messages()->all());

            return back()->with('error', $error_messages);

        }else
        {
			$category_name = $request->category_name;
			$status = $request->status;
			$category_list = $this->category;
			if($request->id)
			{
					$category_list->where('id',$request->id)->update([
						'category_name'=>$category_name,
						'status'=>$status
					]);
			}else
			{
					$data = array();

					$data[] = array(
					'category_name'=>$category_name,
					'status'=>$status
					);

					$category_list->insert($data);
			}

		}

		return redirect('/admin/category_list')->with('success','Category added Successfully');
	}

	public function edit_category($category_id)
	{
		$category_list = $this->category;

		$data = $category_list->where('id',$category_id)->first();

		return view('add_category',['data'=>$data]);
	}



	/**
	 * Soft delete the category and related food items
	 * 
	 * @param object $request
	 * 
	 * @return view page
	 */
	public function delete_category(Request $request)
	{
		$category_id = $request->id;
		$category = $this->category->find($category_id);
		$category->status = 0;
		$category->save();

		$foodlist = $this->foodlist->where('category_id',$category_id)->update(['status'=>0]);
		

		return redirect('/admin/category_list')->with('success','Category Deleted Successfully');
	}

	public function get_cuisines_list(Request $request)
	{
		$data = DB::table('cuisines')->where('status','!=',0)->get();

		return view('cuisines_list',['data'=>$data]);
	}

		public function add_cuisines(Request $request)
	{

		return view('add_cuisines');

	}

		public function add_to_cuisines(Request $request)
	{

		$validator = Validator::make($request->all(), [
            'cuisine_name' => 'required|max:30',
        ]);

		if($validator->fails()) {

            $error_messages = implode(',',$validator->messages()->all());

            return back()->with('error', $error_messages);

        }else
        {
			$cuisine_name = $request->cuisine_name;
			
			if($request->id)
			{
				$this->cuisines->where('id',$request->id)->update(['name'=>$cuisine_name]);
			}else
			{
					$data = array();

					$data[] = array(
					'name'=>$cuisine_name
					);

					$this->cuisines->insert($data);
			}


			return redirect('/admin/cuisines_list')->with('success','Cusine Added');
		}
	}

	public function delete_cuisine(Request $request)
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
        	$cuisines = $this->cuisines;

			$cuisines->where('id',$id)->update(['status'=>0]);
			$restaurants = $this->restaurants->wherehas('Cuisines', function($query) use ($id){
				$query->where('cuisines.id',$id);
			})
			->pluck('id');

			$this->restaurants->whereIn('id',$restaurants)->update(['status'=>0]);
			$this->foodlist->whereIn('restaurant_id',$restaurants)->update(['status'=>0]);

        	return redirect('/admin/cuisines_list')->with('success','Cuisine Deleted Successfully');
        }
	}


	/**
	 * Store or update add-ons data in db
	 * 
	 * @param array $request
	 * 
	 * @return view page
	 */
	public function store_addons(Request $request)
	{
		if($request->session()->get('role')==1){
			$restaurant_id = $request->restaurant_name;
		}else{
			$restaurant_id = $request->session()->get('userid');
		}
		$name = $request->name;
		$id = $request->id;
		if($request->id){
			$validator = Validator::make($request->all(), [
                'name' => [
						'required',
						Rule::unique('add_ons')->where(function ($query) use($id,$name,$restaurant_id) {
							return $query->where('restaurant_id', $restaurant_id)
							->where('name', $name)
							->where('id','!=',$id);
						}),
					],
                'price' => 'required'
			]);
		}else{
			$validator = Validator::make($request->all(), [
                'name' => [
					'required',
					Rule::unique('add_ons')->where(function ($query) use($name,$restaurant_id) {
						return $query->where('restaurant_id', $restaurant_id)
						->where('name', $name);
					}),
				],
                'price' => 'required'
			]);
		}

		if($validator->fails()) 
		{
            $error_messages = implode(',',$validator->messages()->all());
            return back()->with('error', $error_messages);

        }else
        {
			if($request->id)
			{
					$addons = $this->add_ons->find($request->id);
					$addons->restaurant_id = $restaurant_id;
					$addons->name = $request->name;
					$addons->price = $request->price;
					$addons->save();
					$trans_msg = "update_success_msg";
			}else
			{
				$this->add_ons->restaurant_id = $restaurant_id;
				$this->add_ons->name = $request->name;
				$this->add_ons->price = $request->price;
				$this->add_ons->save();
				$trans_msg = "add_success_msg";
			}

		}
		return redirect('/admin/addons_list')->with('success',trans('constants.'.$trans_msg,[ 'param' => 'Add-ons']));
	}


	/**
	 * add view of add_ons
	 * 
	 * @param object $request
	 * 
	 * @return add view page
	 */
	public function add_addons(Request $request)
	{
		$restaurant = $this->restaurants->get();
		// print_r($data); exit;
		return view('add_addons',['restaurant'=>$restaurant]);
	}


	/**
	 * List view of add_ons
	 * 
	 * @return list view page
	 */
	public function list_addons(Request $request)
	{
		if($request->session()->get('role')==1){
			$data = $this->add_ons->with('Restaurant')->where('status',1)->get();
		}else{
			$restaurant_id = $request->session()->get('userid');
			$data = $this->add_ons->with('Restaurant')->where('status',1)->where('restaurant_id',$restaurant_id)->get();
		}
		
		 //dd($data); 
		return view('addons_list',['addons_list'=>$data]);
	}


	/**
	 * edit view of add_ons
	 * 
	 * @param int $id
	 * 
	 * @return edit view page
	 */
	public function edit_addons($id)
	{
		$data = $this->add_ons->with('Restaurant')->find($id);
		$restaurant = $this->restaurants->get();
		// print_r($data); exit;
		return view('add_addons',['data'=>$data,'restaurant'=>$restaurant]);
	}

	/**
	 * List view of food_quantity
	 * 
	 * @return list view page
	 */
	public function list_food_quantity()
	{
		$data = $this->food_quantity->where('status','!=',0)->get();
		 //dd($data); 
		return view('food_quantity_list',['food_quantity_list'=>$data]);
	}


	/**
	 * edit view of food_quantity
	 * 
	 * @param int $id
	 * 
	 * @return edit view page
	 */
	public function edit_food_quantity($id)
	{
		$data = $this->food_quantity->find($id);
		// print_r($data); exit;
		return view('add_food_quantity',['data'=>$data]);
	}


	/**
	 * add view of food_quantity
	 * 
	 * @param object $request
	 * 
	 * @return add view page
	 */
	public function add_food_quantity(Request $request)
	{
		return view('add_food_quantity');
	}


	/**
	 * Store or update add-ons data in db
	 * 
	 * @param array $request
	 * 
	 * @return view page
	 */
	public function store_food_quantity(Request $request)
	{
		if($request->id){
			$validator = Validator::make($request->all(), [
                'name' => 'required|unique:food_quantity,name,'.$request->id,
			]);
		}else{
			$validator = Validator::make($request->all(), [
                'name' => 'required|unique:food_quantity,name',
			]);
		}

		if($validator->fails()) 
		{
            $error_messages = implode(',',$validator->messages()->all());
            return back()->with('error', $error_messages);

        }else
        {
			if($request->id)
			{
					$food_quantity = $this->food_quantity->find($request->id);
					$food_quantity->name = $request->name;
					$food_quantity->save();
					$trans_msg = "update_success_msg";
			}else
			{
				$this->food_quantity->name = $request->name;
				$this->food_quantity->save();
				$trans_msg = "add_success_msg";
			}

		}
		return redirect('/admin/food-quantity-list')->with('success',trans('constants.'.$trans_msg,[ 'param' => 'Food Quantity']));
	}


	/**
	 * Soft delete food_quantity with food items
	 * 
	 * @param object $request
	 * 
	 * @return view page
	 */
	public function delete_food_quantity(Request $request)
	{
		$id = $request->id;
		$food_quantity = $this->food_quantity->find($id);
		$food_quantity->status = 0;
		$food_quantity->save();

		$foodlist = $this->foodlist->wherehas('FoodQuantity', function($query) use ($id){
									$query->where('food_quantity.id',$id);
								})
								->update(['status'=>0]);

		return redirect('/admin/food-quantity-list')->with('success','Category Deleted Successfully');
	}


	/**
	 * Soft delete the addons and related food items
	 * 
	 * @param object $request
	 * 
	 * @return view page
	 */
	public function delete_add_ons(Request $request)
	{
		$id = $request->id;
		$category = $this->add_ons->find($id);
		$category->status = 0;
		$category->save();

		$foodlist = $this->foodlist_addons->where('addons_id',$id)->delete();

		return redirect('/admin/addons_list')->with('success','Category Deleted Successfully');
	}
}