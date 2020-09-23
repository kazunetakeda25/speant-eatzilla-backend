<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    protected $table = 'users';

    /**
    * set relationship to food request.
    *
    */
    public function Foodrequest()
    {
        return $this->hasMany('App\Model\Foodrequest','user_id','id');
    }
    /**
    *
    * set relationship to chat message. 
    *
    */
    public function Chat_message()
    {
        return $this->hasMany('App\Model\Chat_message','user_id','id');
    }

    /**
    *
    * set relationship to user credit. 
    *
    */
    public function UserCredit()
    {
        return $this->hasOne('App\Model\UserCredit','user_id','id');
    }
}
