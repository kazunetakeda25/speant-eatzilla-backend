<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserCredit extends Model
{
    //
    protected $table = 'user_credit';


    /**
    *
    * set relationship to user credit. 
    *
    */
    public function Users()
    {
        return $this->belongsTo('App\Model\Users','user_id','id');
    }

}
