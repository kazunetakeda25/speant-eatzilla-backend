<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class City_geofencing extends Model
{
    //table name
    protected $table = 'city_geofencing';

    //protected $with = ['city'];

    /**
     * set relationship to city model.
     */
    public function city()
    {
        return $this->belongsTo('App\Model\Addcity', 'city_id','id');
    }
}
