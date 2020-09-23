<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    //table name
    protected $table = 'admin';

    protected $with = ['AccessPrivilages'];

    //unset remember_token column for authentication
    protected $rememberTokenName = false;


    /**
     * set relationship to access privilages model.
     */
    public function AccessPrivilages()
    {
        return $this->hasOne('App\Model\AccessPrivilages', 'admin_id','id');
    }
}
