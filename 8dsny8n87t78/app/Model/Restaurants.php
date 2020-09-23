<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Restaurants extends Authenticatable
{
    //
    protected $table = 'restaurants';

    protected $with = ['city_list'];

    /**
    * set relationship to city.
    *
    */
    public function city_list()
    {
        return $this->belongsTo('App\Model\Addcity','city','id');
    }


    /**
    * set relationship to area.
    *
    */
    public function Area()
    {
        return $this->belongsTo('App\Model\Addarea','area','id');
    }


    /**
    * set relationship to cuisines.
    *
    */
    public function Cuisines()
    {
        return $this->belongsToMany('App\Model\Cuisines','restaurant_cuisines', 'restaurant_id', 'cuisine_id');
    }

    /**
     * set relationship to add_ons.
     */
    public function Add_ons()
    {
        return $this->hasMany('App\Model\Add_ons','restaurant_id','id');
    }

    /**
    * set relationship to menu.
    *
    */
    public function Menu()
    {
        return $this->hasMany('App\Model\Menu','restaurant_id','id');
    }


    /**
    * set relationship to Document.
    *
    */
    public function Document()
    {
        return $this->belongsToMany('App\Model\Document', 'restaurants_document', 'restaurants_id', 'document_id')->withPivot("document",'expiry_date');
    }


    /**
    * set relationship to food request.
    *
    */
    public function Foodrequest()
    {
        return $this->hasMany('App\Model\Foodrequest','restaurant_id','id');
    }


    /**
    * set relationship to RestaurantBankDetails.
    *
    */
    public function RestaurantBankDetails()
    {
        return $this->hasOne('App\Model\RestaurantBankDetails','restaurant_id','id');
    }

    /**
    * set relationship to RestaurantPayoutHistory.
    *
    */
    public function RestaurantPayoutHistory()
    {
        return $this->hasMany('App\Model\RestaurantPayoutHistory','restaurant_id','id');
    }


    /**
    * set relationship to popularbrands.
    *
    */
    public function Popularbrands()
    {
        return $this->hasOne('App\Model\Popularbrands','name','id');
    }


    /**
    * set relationship to food list.
    *
    */
    public function Foodlist()
    {
        return $this->hasMany('App\Model\Foodlist','restaurant_id','id');
    }

    /**
    * set relationship to restaurant timer.
    *
    */
    public function RestaurantTimer()
    {
        return $this->hasMany('App\Model\RestaurantTimer','restaurant_id','id');
    }

}
