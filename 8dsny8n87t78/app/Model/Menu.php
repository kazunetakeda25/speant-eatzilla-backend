<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $table = 'menu';

    /**
     * set relationship to foodlist.
     */
    public function Foodlist()
    {
        return $this->hasMany('App\Model\Foodlist','id','menu_id');
    }

    /**
     * set relationship to restaurant.
     */
    public function Restaurant()
    {
        return $this->belongsTo('App\Model\Restaurants','restaurant_id','id');
    }


}
