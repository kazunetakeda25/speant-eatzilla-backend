<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'category';

    protected $fillable = ['category_name', 'status', 'created_at', 'updated_at' ];

    /**
     * set relationship to foodlist.
     */
    public function Foodlist()
    {
        return $this->hasMany('App\Model\Foodlist','id','category_id');
    }
}
