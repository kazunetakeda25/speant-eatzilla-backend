<?php

namespace App\Http\Controllers\admin;
                                    
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController;
use DB;

class BannerlistController extends BaseController
{
	public function banner_list(Request $request)
	{

		$base_url = BASE_URL;

		$data = DB::table('offers_banner')
				->join('restaurants','restaurants.id','=','offers_banner.restaurant_id')
				->select('restaurants.restaurant_name as restaurant_name','offers_banner.image as banner_image','offers_banner.position as banner_position','offers_banner.status as banner_status','offers_banner.is_suffle as banner_suffle','offers_banner.id as banner_id')
				->get();

				foreach($data as $d)
				{
					$d->banner_image = BASE_URL.UPLOADS_PATH.$d->banner_image;
				}

			
		return view('banner_list',['banner_list'=>$data]);
	}

	public function add_banner(Request $request)
	{
		$restaurant_list = $this->restaurants;
		$data = $restaurant_list->get();

		return view('add_banner',['restaurant_list'=>$data]);
	}

	public function add_to_banners(Request $request)
	{

			$validator = Validator::make($request->all(), [
                'restaurant_id' => 'required',
                'status' => 'required',
    			'banner_image' => 'required|mimes:jpeg,jpg,bmp,png',
            ]);
		

        if($validator->fails()) {

            $error_messages = implode(',',$validator->messages()->all());

            return back()->with('error', $error_messages);

        }else
        {
        	$banner_list = $this->banner;
        	$custom = $this->custom;
        	$restaurant_id = $request->restaurant_id;
        	$status = $request->status;
        	$image = $custom->upload_image($request,'banner_image');
			 $image = $image;
        	if($request->id)
        	{
        		
        		$banner_list->where('id',$request->id)->update([
        			'restaurant_id'=>$restaurant_id,
        			'image'=>$image,
     				'status'=>$status
        		]);
        	}else
        	{
        		$data = array();

        		$data[]=array(
        			'restaurant_id'=>$restaurant_id,
        			'image'=>$image,
        			'status'=>$status,
        		);

        		$banner_list->insert($data);
        	}
        }

        return redirect('/admin/banner_list')->with('success','Banner added Successfully');
	}

	public function edit_banner($banner_id)
	{
		$restaurant_list = $this->restaurants;
		$restaurants = $restaurant_list->get();

		$banner = $this->banner;
		$data = $banner::where('id',$banner_id)->first();
		$data->image = BASE_URL. UPLOADS_PATH .$data->image;

		return view('add_banner',['data'=>$data,'restaurant_list'=>$restaurants]);
	}

	public function delete_banner(Request $request)
	{
		$banner_list = $this->banner;

		$banner_id = $request->banner_id;
		$banner = $banner_list->find($banner_id);
		if($banner->image!='')
		{
			if(file_exists(DOCROOT.UPLOADS_PATH.$banner->image))
				unlink(DOCROOT.UPLOADS_PATH.$banner->image);
		}
		$banner_list->where('id',$banner_id)->delete();

		return redirect('/admin/banner_list')->with('success','Banner Deleted Successfully');
	}


	/**
	 * get popular brands
	 * 
	 * @param object $request
	 * 
	 * @return view page
	 */
	public function popular_brand_list(Request $request)
	{

		$data = $this->popularbrands->with('Restaurants')->where('status','!=',0)->get();

		return view('popular_brand_list',['data'=>$data]);
	}


	/**
	 * add popular brands based on restaurant
	 * 
	 * @param object $request
	 * 
	 * @return array $resturant_list to view page
	 */
	public function add_popular_brand(Request $request)
	{
		$data = $this->restaurants->get();

		return view('add_popular_brand',['restaurant_list'=>$data]);
	}



	/**
	 * Store or update data in popular brands
	 * 
	 * @param object $request
	 * 
	 * @return redirect to view page
	 */
	public function add_to_popular_brand(Request $request)
	{

			$validator = Validator::make($request->all(), [
                'restaurant_id' => 'required',
                'status' => 'required',
    			'image' => 'required|mimes:jpeg,jpg,bmp,png',
            ]);
		

		if($validator->fails()) 
		{
            $error_messages = implode(',',$validator->messages()->all());
            return back()->with('error', $error_messages);
        }else
        {
        	$custom = $this->custom;
        	$restaurant_id = $request->restaurant_id;
        	$status = $request->status;
        	$image = $custom->upload_image($request,'image');
        	if($request->id)
        	{
        		$popular_brand = $this->popularbrands->find($request->id);
        		$popular_brand->name = $restaurant_id;
        		$popular_brand->image = $image;
     			$popular_brand->status = $status;
				$popular_brand->save();
        	}else
        	{
        		$this->popularbrands->name = $restaurant_id;
        		$this->popularbrands->image = $image;
        		$this->popularbrands->status = $status;
        		$this->popularbrands->save();
        	}
        }

        return redirect('/admin/popular_brand_list')->with('success','Banner added Successfully');
	}



	/**
	 * edit popular brand page
	 * 
	 * @param int $id
	 * 
	 * @return view page
	 */
	public function edit_popular_brand($id)
	{
		$restaurants = $this->restaurants->get();
		$data = $this->popularbrands->find($id);

		return view('add_popular_brand',['data'=>$data,'restaurant_list'=>$restaurants]);
	}


	/**
	 * edit popular brand page
	 * 
	 * @param int $id
	 * 
	 * @return view page
	 */
	public function delete_popular_brand(Request $request)
	{
		$id = $request->id;
		$popular_brands = $this->popularbrands->find($id);
		if($popular_brands->image!='')
		{
			if(file_exists(DOCROOT.UPLOADS_PATH.$popular_brands->image))
				unlink(DOCROOT.UPLOADS_PATH.$popular_brands->image);
		}
		$this->popularbrands->where('id',$id)->delete();

		return redirect('/admin/popular_brand_list')->with('success','Popular Brand Deleted Successfully');
	}
}