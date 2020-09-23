<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FoodQuantity extends Model
{
    //table name
    protected $table = 'food_quantity';


    /**
    * set relationship to product.
    *
    */
    public function Foodlist()
    {
        return $this->belongsToMany('App\Model\Foodlist', 'foodlist_foodquantity', 'foodlist_id', 'foodquantity_id')->withPivot("price");
    }


    /**
    * set relationship to request details.
    *
    */
    public function Requestdetail()
    {
        return $this->hasMany('App\Model\Requestdetail','food_quantity','id');
    }

}
