<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController;
use Validator;

class FoodController extends BaseController
{
    /**
     * get details and redirect to add food view
     * 
     * @return view pae with array data
     */
    public function add_food()
	{
		$restaurant = $this->restaurants->get();
        $category = $this->category->get();
        $add_ons = $this->add_ons->get();
		return view('add_food',['restaurant'=>$restaurant,'category'=>$category,'add_ons'=>$add_ons]);
	}
}
