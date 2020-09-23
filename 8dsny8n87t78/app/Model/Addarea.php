<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Addarea extends Model
{
    //
    protected $table = 'add_area';

    /**
     * set relationship to city model.
     */
    public function city()
    {
        return $this->belongsTo('App\Model\Addcity', 'add_city_id','id');
    }


    /**
     * set relationship to restaurant.
     */
    public function Restaurants()
    {
        return $this->hasMany('App\Model\Restaurants','id','area');
    }
    
}
