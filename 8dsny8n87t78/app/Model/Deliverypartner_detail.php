<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Deliverypartner_detail extends Model
{
    //
    protected $table = 'delivery_partner_details';
    
    protected $with = ['Citylist','Vehicle'];


    /**
    * set relationship to delivery boy.
    *
    */
    public function Deliverypartners()
    {
        return $this->belongsTo('App\Model\Deliverypartners','delivery_partners_id','id');
    }

       /**
    * set relationship to user.
    *
    */

     public function Vehicle()
    {
        return $this->belongsTo('App\Model\Vehicle','vehicle_name','id');
    }

    /**
    * set relationship to city.
    *
    */
    public function Citylist()
    {
        return $this->belongsTo('App\Model\Addcity','city','id');
    }

}

