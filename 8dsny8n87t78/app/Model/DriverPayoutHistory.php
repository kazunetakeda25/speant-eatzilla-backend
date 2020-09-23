<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DriverPayoutHistory extends Model
{
    //table_name
    protected $table = "driver_payout_history";


    /**
    * set relationship to delivery boy.
    *
    */
    public function Deliverypartners()
    {

        return $this->belongsTo('App\Model\Deliverypartners','delivery_boy_id','id');

    }


}
