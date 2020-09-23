<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RequestdetailAddons extends Model
{
    //table name
    protected $table = 'requestdetail_addons';


    /**
    * set relationship to requset detail addons.
    *
    */
    public function Requestdetail()
    {
        return $this->belongsTo('App\Model\Requestdetail','requestdetail_id','id');
    }
}
