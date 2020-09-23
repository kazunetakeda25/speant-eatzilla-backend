<?php
namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use DB;
use App\Model\Users;
use App\Http\Controllers\api\BaseController;
use Illuminate\Support\Facades\Log;
use App\Model\Cards;
use App\Model\Settings;
use App\Model\Transactions;
use App\Library\Payment;
use Validator;

class StripeController extends BaseController 
{
	//

    public function get_balance(Request $request)
    {
        $user = Users::find($request->header('authId'));
        $response_array = array('status' => true,'wallet_balance'=>$user->wallet_balance);
        $response = response()->json($response_array,200);
        return $response;
    }


    /**
     * Add card details to user
     * 
     * @param object $request
     * 
     * @return json $response
     */
    public function user_add_card_stripe(Request $request)
    {
        $validator = Validator::make(
                    $request->all(),
                    array(
                        'last_four' => 'required',
                        'card_token' => 'required',
                        'customer_id' => 'required',
                    )
                );

        if ($validator->fails())
        {
           $error_messages = implode(',', $validator->messages()->all());
           $response_array = array('status' => false , 'error_code' => 101 , 'message' => $error_messages);
        }else 
        {
            $userid = $request->header('authId');
            $user = $this->users->find($userid);
            $payment = Cards::where('user_id',$userid)->where('is_default',1)->first();
            if(!$payment)
                $result = Payment::stripeAddCard($request->card_token, $user);
            else
                $result = Payment::stripeAddCard($request->card_token, $payment);
                
            if($result->success){
                $cards = new Cards;
                $cards->user_id = $user->id;
                $cards->customer_id = $result->customer_id;
                $cards->last_four = $request->last_four;
                $cards->card_token = $result->card_token;

                // Check is any default is available
                $check_card = Cards::where('user_id',$request->id)->first();

                if($payment) {
                    $cards->is_default = 0;
                } else {
                    $cards->is_default = 1;
                }
                $cards->save();

                if(!$payment) {
                    // $user->payment_mode = CARD;
                    $user->default_card = $cards->id;
                    $user->save();
                }
                $response_array = array('status' => true,'message'=>"Thanks for adding your Card");
            }else
            {
                $response_array = array('status' => false,'message'=>$result->message);
            }
        }

        $response = response()->json($response_array,200);
        return $response;
    }


    /**
     * send publishing key to user for add card
     * 
     * @return json $response
     */
    public function get_stripe_token(Request $request)
    {
    	$data=DB::table('settings')->where('key_word', '=', 'stripe_pk_key')->select('value')->first();
    	$token = $data->value;
    	return response()->json(['status'=>true,'token'=>$token]);
    }


    /**
     * get card details based on user
     * 
     * @param object $request
     * 
     * @return json $response
     */
    public function getCards(Request $request)
    {
    	$user_id = $request->header('authId');
    	$data = Cards::where('user_id',$user_id)->get();	
    	return response()->json(['status'=>true,'data'=>$data]);
    }



    /**
     * Add amount to the user wallet
     * 
     * @param object $request
     * 
     * @return json $response
     */
    public function add_money_to_wallet(Request $request)
    {

        $validator = Validator::make(
                $request->all(),
                array(
                    'amount' => 'required',
                )
            );

        if ($validator->fails())
        {
           $error_messages = implode(',', $validator->messages()->all());
           $response_array = array('status' => false , 'error_code' => 101 , 'message' => $error_messages);
        } else 
        {
            $user_id = $request->header('authId');
            $user = $this->users->find($user_id);           
            $user_card = Cards::where('user_id',$user_id)->where('is_default',1)->first();
            if($user_card) 
            {
                //$user_card = $check_card_exists->first();
                
                //Stripe Payment
                $stripe_charge = Payment::stripeCreateCharge($request->amount, $user_card);
            
                //if($transaction == '0'){
                if(!$stripe_charge->success)
                {
                    $response_array = array('success' => false, 'error_code' => 158);
                    return response()->json($response_array , 200);
                }
                else 
                {
                    $user->wallet_balance = $user->wallet_balance + $request->amount;
                    $user->save();
                    $response_array = array('status'=>true, 'message' => 'Money added successfully', 'wallet_balance'=>$user->wallet_balance);
                }                    
            }else
            {
                $response_array = array('status'=>false, 'message' => 'No Cards Found');
            }
        }
        return response()->json($response_array , 200);
    }

   

    /**
     * Make card default to the user
     * 
     * @param object $request
     * 
     * @return json $response
     */
    public function default_card(Request $request) 
    {
        $user_id = $request->header('authId');
        $validator = Validator::make(
            $request->all(),
            array(
                'card_id' => 'required|integer|exists:cards,id,user_id,'.$user_id,
            )
        );
        if($validator->fails()) 
        {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status'=>false, 'message'=>$error_messages);
        }else 
        {            
            $user = $this->users->find($user_id);
            $old_default = Cards::where('user_id' , $user_id)->where('is_default', 1)->update(array('is_default' => 0));
            $card = Cards::where('id' , $request->card_id)->update(array('is_default' => 1));
            if($card) 
            {
                if($user) 
                {
                    $user->default_card = $request->card_id;
                    $user->save();
                }
                $response_array = array('status'=>true, 'messages'=>'Default card changed successfully');
            }else 
            {
                $response_array = array('status'=>false, 'error' => 'Default card changed failed');
            }
        }
        return response()->json($response_array , 200);
    }

    public function selectCard(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            array(
                'card_id' => 'required|integer|exists:cards,id,user_id,'.$request->id,
            )
        );

        if ($validator->fails()) {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('success' => false, 'error_message' =>$error_messages , 'error_code' => 101, 'message'=>$error_messages);

        } else {

            if($request->payment_mode == CARD){

                $user = User::find($request->id);

                $old_default = Cards::where('user_id' , $request->id)->where('is_default', 1)->update(array('is_default' => 0));

                $card = Cards::where('id' , $request->card_id)->update(array('is_default' => 1));

                if($card) {
                    if($user) {
                        // $user->payment_mode = CARD;
                        $user->default_card = $request->card_id;
                        $user->save();
                    }
                    $response_array = Helper::null_safe(array('success' => true));
                } else {
                    $response_array = array('status' => false , 'message' => 'Something went wrong');
                }

                Log::info("default card changed");
            }else{
                Log::info("payment_mode is different".print_r($request->payment_mode,true));

                $response_array = array(
                'success' => true
                );
            }

        }
        $response = response()->json($response_array, 200);
        return $response;

    }



    /**
     * Delete card based on cardid
     * 
     * @param object $request
     * 
     * @return json $response
     */
    public function delete_card(Request $request) 
    {    
        $user_id = $request->header('authId');    
        $validator = Validator::make(
            $request->all(),
            array(
                'card_id' => 'required|integer|exists:cards,id,user_id,'.$user_id,
            ),
            array(
                'exists' => 'The :attribute doesn\'t belong to user:'.$user_id
            )
        );
        if ($validator->fails()) 
        {
           $error_messages = implode(',', $validator->messages()->all());
           $response_array = array('status'=>false, 'messages' => $error_messages);
        } else 
        {
            $card_id = $request->card_id;
            $get_card = Cards::where('id' , $card_id)->first();
            if(!$get_card)
            {
                $response_array = array('status'=>false, 'messages'=>'Card not found');
            }else
            {
                Cards::where('id',$card_id)->delete();
                $user = $this->users->find($user_id);
                if($user) 
                {
                    if($get_card->is_default==1) 
                    {
                        $check_card = Cards::where('user_id' , $user_id)->first();
                        if($check_card)
                        {
                            $old_default = Cards::where('user_id' , $user_id)->where('is_default', 1)->update(array('is_default' => 0));
                            $card = Cards::where('id' , $check_card->id)->update(array('is_default' => 1));  
                        }                 
                    }
                    $user->save();
                }
                $response_array = array('status'=>true, 'messages'=>'Card deleted successfully');
            }
        }
        return response()->json($response_array , 200);
    }


    /**
     * update stripe token in user table
     * 
     * @param object $request
     * 
     * @return json $response
     */
    public function update_stripetoken(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            array(
                'stripe_access_token' => 'required',
                'account_id' => 'required'
            )
        );
        if($validator->fails()) 
        {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('success' => false, 'error_message' =>$error_messages , 'error_code' => 101, 'message'=>$error_messages);

        }else 
        {
            $user_id = $request->header('authId');   
            $user = $this->users->find($user_id);
            if($user) 
            {
                if($user->device_type=='ios')
                {
                    $public_token = $request->stripe_access_token;
                    $result = file_get_contents('http://'.$_SERVER['HTTP_HOST'].':3030/get_access_token?public_token='.$public_token);
                    $result = json_decode($result);
                    $stripe_access_token = $result->access_token;
                }else
                {
                    $stripe_access_token = $request->stripe_access_token;
                }                
                $user->stripe_access_token = $stripe_access_token;
                $user->account_id = $request->account_id;
                $user->save();

                //create asset report token in node.js
                $result = file_get_contents('http://'.$_SERVER['HTTP_HOST'].':3030/generate_assetreport?id='.$user_id.'&access_token='.$stripe_access_token);
                //$result = file_get_contents('http://'.$_SERVER['HTTP_HOST'].':3030/get_assetreport?asset_report_token='.$user->asset_report_token);
                $response_array = array('status'=>true, 'message'=>'Token updated successfully');
            }else
            {
                $response_array = array('status'=>false, 'message'=>'User not found!');
            }
        }
        return response()->json($response_array , 200);
    }


    /**
     * update credit amount to the user
     * 
     * @param object $request
     * 
     * @return json $response
     */
    public function update_credit_amount(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            array(
                'credit_amount' => 'required',
            )
        );
        if($validator->fails()) 
        {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('success' => false, 'error_message' =>$error_messages , 'error_code' => 101, 'message'=>$error_messages);

        }else 
        {
            $user_id = $request->header('authId');   
            $user = $this->users->find($user_id);
            if($user) 
            {
                $get_data = $this->user_credit->where('user_id',$user_id)->latest()->first();
                if(!$get_data)
                {
                    $this->user_credit->user_id = $user_id;
                    $this->user_credit->amount = $request->credit_amount;
                    $this->user_credit->credit_amount = $request->credit_amount;
                    $this->user_credit->status = 0;
                    $this->user_credit->save();
                    $response_array = array('status'=>true, 'message'=>'Credit amount added. Waiting for admin approval!');
                }elseif($get_data->status==2)
                {
                    $this->user_credit->user_id = $user_id;
                    $this->user_credit->amount = $request->credit_amount;
                    $this->user_credit->credit_amount = $request->credit_amount;
                    $this->user_credit->status = 0;
                    $this->user_credit->save();
                    $response_array = array('status'=>true, 'message'=>'Credit amount added. Waiting for admin approval!');
                }elseif($get_data->status==1)
                {
                    $response_array = array('status'=>false, 'message'=>'Credit amount already added!');
                }else
                {
                    $response_array = array('status'=>false, 'message'=>'You have already added credit amount and admin not yet approved');
                }
            }else
            {
                $response_array = array('status'=>false, 'message'=>'User not found!');
            }
        }
        return response()->json($response_array , 200);
    }


    /**
     * get credit balance for the user
     * 
     * @param object $request
     * 
     * @return json $response
     */
    public function get_credit_amount(Request $request)
    {
        $user_id = $request->header('authId');   
        $user = $this->users->find($user_id);
        if($user->stripe_access_token!=null || $user->stripe_access_token!='') 
        {
            $get_data = $this->user_credit->where('user_id',$user_id)->latest()->first();
            if(!$get_data)
                $get_data = new \stdClass();

            $response_array = array('status'=>true, 'details'=>$get_data);
        }else
        {
            $response_array = array('status'=>false, 'message'=>'Data not found!');
        }
        return response()->json($response_array , 200);
    }

}
