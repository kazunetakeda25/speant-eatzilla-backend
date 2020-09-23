<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //
    protected $table = 'vehicle';



    /**
     * set relationship to Deliverypartner_detail.
     */
    public function Deliverypartner_detail()
    {
        return $this->belongsTo('App\Model\Deliverypartner_detail','delivery_partners_id','id');
    }

}
