<?php

namespace App\Http\Controllers\admin;
          
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\api\BaseController;
use DB;

class TransactionController extends BaseController
{
    /**
     * Get Driver (or) Restaurant Payouts.
     *
     * @param $type Restaurant (or) driver
     *
     * @return response to blade file
     */
    public function Getpayout($type,Request $request)
    {
        if($type=='restaurant'){

            $data = $this->restaurants->with('Foodrequest')
                         ->withcount('Foodrequest')
                        //  ->whereHas('Foodrequest', function ($query1) {
                        //       $query1->where('status',7)
                        //             ->where('restaurant_settlement_status',0);
                        //  })
                        ->where('pending_payout','!=','0')
                        ->get();
          
        }elseif($type=='driver'){
            $data = $this->deliverypartners->with('Foodrequest')
                         ->withcount('Foodrequest')
                        //  ->whereHas('Foodrequest', function ($query) {
                        //       $query->where('status',7)
                        //             ->where('driver_settlement_status',0);
                        //  })
                        ->where('pending_payout','!=','0')
                        ->get();
        }
       
        return view('payout',compact('type','data'));
    }

     /**
     * Get Driver (or) Restaurant Payout history.
     *
     * @param $type Restaurant (or) driver
     *
     * @return response to blade file
     */
    public function Getpayout_history($type,Request $request)
    {

        if($type=='restaurant'){            
            $data = $this->restaurant_payout_history->with('Restaurants')->orderBy('id','desc')->get();
        }elseif($type=='driver'){
            $data = $this->driver_payout_history->with('Deliverypartners')->orderBy('id','desc')->get(); 
          
        }
       
        return view('payout-history',compact('type','data'));
    }

     /**
     * Display add-payout Blade file.
     *
     * @param $type, $id
     *
     * @return response view blade file
     */
    public function Getaddpayment($type,$amount,$id,Request $request)
    {
        return view('add-payout',compact('type','amount','id'));
    }

     /**
     * Post payout to driver or restaurant based on type.
     *
     * @param $type, $id
     *
     * @return response view blade file
     */
    public function addpayment(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'amount' => 'required|numeric',
            'type' => 'required',

        ]);

        $transaction_id = 'Trans-'.$this->generate_random_string();

        if($validator->fails()) {

            $error_messages = implode(',',$validator->messages()->all());

            return back()->with('error', $error_messages);

        }
        $type = $request->type;

        if($type=='restaurant'){ 
           // $requestdetails = $this->foodrequest->where('restaurant_id',$request->id)->update(['restaurant_settlement_status'=>1]);
            $this->restaurants->find($request->id)->decrement('pending_payout', $request->amount );
            $insert = $this->restaurant_payout_history;
            $insert->restaurant_id = $request->id;
        }elseif($type=='driver'){
            //$requestdetails = $this->foodrequest->where('delivery_boy_id',$request->id)->update(['driver_settlement_status'=>1]);
            $this->deliverypartners->find($request->id)->decrement('pending_payout', $request->amount );
            $insert = $this->driver_payout_history;
            $insert->delivery_boy_id = $request->id;
        }
        $insert->transaction_id = $transaction_id;
        $insert->payout_amount = $request->amount;
        $insert->description = $request->description;
        $insert->status = 'Success';
        $insert->save();
        
        return redirect('admin/payout/'.$type)->with('success',trans('constants.paid_success_msg'));
    }
}
