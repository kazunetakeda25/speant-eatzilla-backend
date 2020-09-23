<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RestaurantBankDetails extends Model
{
    //table name
    protected $table = 'restaurant_bank_details';

    
    /**
    * set relationship to restaurant.
    *
    */
    public function Resturants()
    {
        return $this->belongsTo('App\Model\Resturants','restaurant_id','id');
    }

}
