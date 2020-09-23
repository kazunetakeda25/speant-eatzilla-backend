<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Addcity extends Model
{
    //
    protected $table = 'add_city';

    protected $with = ['city_geofencing', 'Restaurants'];

    /**
     * set relationship to city_geofencing.
     */
    public function city_geofencing()
    {
        return $this->hasOne('App\Model\City_geofencing','city_id','id');
    }

    /**
     * set relationship to area.
     */
    public function Area()
    {
        return $this->hasMany('App\Model\Addarea','add_city_id','id');
    }

    /**
     * set relationship to city.
     */
    public function Restaurants()
    {
        return $this->hasMany('App\Model\Restaurants','id','city');
    }



    /**
     * set relationship to city.
     */
    public function Deliverypartner_detail()
    {
        return $this->hasMany('App\Model\Deliverypartner_detail','city','id');
    }


    /**
     * set relationship to Country.
     */
    public function Country()
    {
        return $this->belongsTo('App\Model\Country', 'country_id','id');
    }

    /**
     * set relationship to state.
     */
    public function State()
    {
        return $this->belongsTo('App\Model\State', 'state_id','id');
    }
    
}
