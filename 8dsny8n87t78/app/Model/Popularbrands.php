<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Popularbrands extends Model
{
    //
    protected $table = 'popular_brands_list';


    /**
    * set relationship to Restaurants.
    *
    */
    public function Restaurants()
    {
        return $this->belongsTo('App\Model\Restaurants','name','id');
    }
}
