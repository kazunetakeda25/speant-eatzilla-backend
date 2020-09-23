<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderRatings extends Model
{
    //table name
    protected $table = 'order_ratings';


    
    /**
    * set relationship to food request detail.
    *
    */
    public function Foodrequest()
    {
        return $this->belongsTo('App\Model\Foodrequest','request_id','id');
    }
}
