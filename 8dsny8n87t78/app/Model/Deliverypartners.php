<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Deliverypartners extends Model
{
    //
    protected $table = 'delivery_partners';

    protected $with = ['Deliverypartner_detail','Vehicle'];

    /**
    * set relationship to delivery boy.
    *
    */
    public function Foodrequest()
    {
        return $this->hasMany('App\Model\Foodrequest','delivery_boy_id','id');
    }

    /**
    * set relationship to delivery boy detail.
    *
    */
    public function Deliverypartner_detail()
    {

        return $this->hasOne('App\Model\Deliverypartner_detail','delivery_partners_id','id');

    }

    /**
    * set relationship to delivery boy detail.
    *
    */
    public function DriverPayoutHistory()
    {
        return $this->hasMany('App\Model\DriverPayoutHistory','delivery_boy_id','id');
    }

    /**
     * set relationship to Vehicle.
     */
    public function Vehicle()
    {
        return $this->hasOne('App\Model\Vehicle','delivery_partners_id','id');
    }
}
