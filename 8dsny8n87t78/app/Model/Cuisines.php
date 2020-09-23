<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cuisines extends Model
{
    //
    protected $table = 'cuisines';

    /**
    * set relationship to restaurants.
    *
    */
    public function Restaurants()
    {
        return $this->belongsToMany('App\Model\Restaurants', 'restaurant_cuisines', 'restaurant_id', 'cuisine_id');
    }
}
