<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Add_ons extends Model
{
    //table name
    protected $table = 'add_ons';

    //protected $with = ['Restaurant'];

    /**
    * set relationship to product.
    *
    */
    public function Foodlist()
    {
        return $this->belongsToMany('App\Model\Foodlist', 'foodlist_addons', 'foodlist_id', 'addons_id');
    }


    /**
    * set relationship to Restaurant.
    *
    */
    public function Restaurant()
    {
        return $this->belongsTo('App\Model\Restaurants','restaurant_id','id');
    }

}
