<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //table name
    protected $table = 'state';

    protected $with = ['City'];

    /**
     * set relationship to country.
     */
    public function Country()
    {
        return $this->belongsTo('App\Model\Country', 'country_id','id');
    }


    /**
     * set relationship to city.
     */
    public function City()
    {
        return $this->hasMany('App\Model\Addcity','state_id','id');
    }
}
