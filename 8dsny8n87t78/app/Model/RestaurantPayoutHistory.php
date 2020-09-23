<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RestaurantPayoutHistory extends Model
{
    //table_name
    protected $table = "restaurant_payout_history";


    /**
    * set relationship to Restaurants.
    *
    */
    public function Restaurants()
    {
        return $this->belongsTo('App\Model\Restaurants','restaurant_id','id');
    }
}
