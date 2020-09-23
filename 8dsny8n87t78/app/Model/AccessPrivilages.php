<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AccessPrivilages extends Model
{
    //table name
    protected $table = 'access_privilages';


    /**
     * set relationship to admin model.
     */
    public function Admin()
    {
        return $this->belongsTo('App\Model\Admin', 'admin_id','id');
    }


    
}
