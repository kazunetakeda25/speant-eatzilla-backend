<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Requestdetail extends Model
{
    //
    protected $table = 'request_detail';

    protected $with = ['Foodlist','FoodQuantity','RequestdetailAddons','Addons'];

    /**
    * set relationship to food request.
    *
    */
    public function Foodrequest()
    {
        return $this->belongsTo('App\Model\Foodrequest','request_id','id');
    }


    /**
    * set relationship to food list.
    *
    */
    public function Foodlist()
    {
        return $this->belongsTo('App\Model\Foodlist','food_id','id');
    }


    /**
    * set relationship to food quantity.
    *
    */
    public function FoodQuantity()
    {
        return $this->belongsTo('App\Model\FoodQuantity','food_quantity','id');
    }


    /**
    * set relationship to requset detail addons.
    *
    */
    public function RequestdetailAddons()
    {
        return $this->hasMany('App\Model\RequestdetailAddons','requestdetail_id','id');
    }

    /**
    * set relationship to addons.
    *
    */
    public function Addons()
    {
        return $this->belongsToMany('App\Model\Add_ons','requestdetail_addons','requestdetail_id','addons_id');
    }

}
