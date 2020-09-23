<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //
    protected $table = 'document';


    /**
    * set relationship to food list.
    *
    */
    public function Restaurants()
    {
        return $this->belongsToMany('App\Model\Restaurants', 'restaurants_document', 'restaurants_id', 'document_id')->withPivot("document",'expiry_date');
    }

}
