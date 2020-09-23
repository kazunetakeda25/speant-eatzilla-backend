<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Foodrequest extends Model
{
    //
    protected $table = 'requests';

    protected $with = ['Requestdetail','Users','Restaurants','Deliverypartners','OrderRatings'];


    /**
    * set relationship to food request detail.
    *
    */
    public function Requestdetail()
    {
        return $this->hasMany('App\Model\Requestdetail','request_id','id');
    }


    /**
    * set relationship to user.
    *
    */
    public function Users()
    {
        return $this->belongsTo('App\Model\Users','user_id','id');
    }


    /**
    * set relationship to restaurant.
    *
    */
    public function Restaurants()
    {
        return $this->belongsTo('App\Model\Restaurants','restaurant_id','id');
    }


    /**
    * set relationship to delivery boy.
    *
    */
    public function Deliverypartners()
    {
        return $this->belongsTo('App\Model\Deliverypartners','delivery_boy_id','id');
    }


    /**
    * set relationship to order ratings.
    *
    */
    public function OrderRatings()
    {
        return $this->hasOne('App\Model\OrderRatings','request_id','id');
    }

}
