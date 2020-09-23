<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Chat_message extends Model
{
    protected $table = 'chat_messages';
    //protected $with = ['Users'];

    public function Users(){
    	return $this->belongsTo('App\Model\Users','user_id','id');
    }
}
