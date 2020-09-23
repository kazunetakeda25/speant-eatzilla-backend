<?php 
namespace App\Library;
use Illuminate\Http\Request;
use DB;
use File;
use Validator;

class Validators{

    public function country($request){

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'amount' => 'required|numeric',
            'type' => 'required',

        ]);

       return $validator;

    }

    


}