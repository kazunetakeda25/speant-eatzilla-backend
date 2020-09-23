<?php 
 namespace App\Library;
 use Log;
 use App\Model\Settings;
 class Payment
 {

       public static function stripeExecuteCurlRequest($url, $data)
        {

            $settings= Settings::where('key_word','stripe_sk_key')->first();
            $result             = new \stdClass();
            $result->success    = false;
 
            // try
            // {
                $http_build_query_data  = http_build_query($data);
                Log::info("curl request:".$http_build_query_data);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true); /*POST*/
                curl_setopt($ch, CURLOPT_POSTFIELDS, $http_build_query_data);
                curl_setopt($ch, CURLOPT_USERPWD, $settings->value . ':');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $curl_result = curl_exec($ch);
                Log::info("curl response in".$curl_result);
                // print_r($curl_result);exit;

                // if($curl_result === false)
                //     Log::info('Stripe Curl result error: ' . curl_error($ch) );
                // else
                // {
                    $result = json_decode($curl_result);
                    // Log::info("curl response1".$stripe_result);
                    // if(json_last_error() == JSON_ERROR_NONE)
                    // {
                    //     if(property_exists($stripe_result, 'error'))
                    //         $result->success    = false;
                    //     else
                    //         $result->success    = true;
                    //     $result->stripe_result  = $stripe_result;
                    // }
                //}
                
                curl_close($ch);
            // }
            // catch (\Exception $e)
            // {
            //     $result->success = false;
            //     Log::info('Stripe Curl execution error: ' . $e->getMessage() );
            // }

            return $result;
        }


        public static function stripeExecuteCurlRequestCharge($url, $data, $headers)
        {   
             $settings= Settings::where('key_word','stripe_sk_key')->first();

            $result             = new \stdClass();
            $result->success    = false;

            try
            {
                $http_build_query_data  = http_build_query($data);
                Log::info($http_build_query_data);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true); /*POST*/
                curl_setopt($ch, CURLOPT_POSTFIELDS, $http_build_query_data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_USERPWD, $settings->value . ':');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $curl_result = curl_exec($ch);
                Log::info($curl_result);

                if($curl_result === false)
                    Log::info('Stripe Curl result error: ' . curl_error($ch) );
                else
                {
                    $stripe_result = json_decode($curl_result);
                    if(json_last_error() == JSON_ERROR_NONE)
                    {
                        if(property_exists($stripe_result, 'error'))
                            $result->success    = false;
                        else
                            $result->success    = true;
                        $result->stripe_result  = $stripe_result;
                    }
                }

                curl_close($ch);
            }
            catch (\Exception $e)
            {
                $result->success = false;
                Log::info('Stripe Curl execution error: ' . $e->getMessage() );
            }

            return $result;
        }


        public static function stripeCreateAccount($request)
        {
            $result                 = new \stdClass();
            $result->success        = false;
            $result->stripe_acc_id  = '';
            try
            {
                $url = 'https://api.stripe.com/v1/accounts';

                // $data['managed']    = 'true';
                $data['country']    = 'NO';

                $data['legal_entity']['type']         = 'individual';
                $data['type']         = 'custom';
                $data['legal_entity']['first_name']   = $request->first_name;
                $data['legal_entity']['last_name']    = $request->last_name;

                $data['legal_entity']['address']['city']          = $request->address_city;
                $data['legal_entity']['address']['country']       = $request->address_country;
                $data['legal_entity']['address']['line1']         = $request->address_line1;
                $data['legal_entity']['address']['line2']         = $request->address_line2;
                $data['legal_entity']['address']['postal_code']   = $request->address_postal_code;
                $data['legal_entity']['address']['state']         = $request->address_state;

                $data['legal_entity']['dob']['day']   = $request->dob_day;
                $data['legal_entity']['dob']['month'] = $request->dob_month;
                $data['legal_entity']['dob']['year']  = $request->dob_year;

                // $data['legal_entity']['ssn_last_4']   = $request->ssn_last_4;

                $data['tos_acceptance']['date']  = time();
                $data['tos_acceptance']['ip']    = $request->ip();

                $curl = self::stripeExecuteCurlRequest($url, $data);

                if($curl->success)
                {
                    $result->success    = true;
                    $result->stripe_acc_id  = $curl->stripe_result->id;
                }
            }
            catch (\Exception $e)
            {
                $result->success = false;
                Log::info('Provider Stripe Account creation error: ' . $e->getMessage() );
            }

            return $result;
        }


        public static function stripeCreateCustomer($card_token, $user)
        {
            // echo $card_token;
            //  // print_r($user); exit;

            $result             = new \stdClass();
            $result->success    = false;

            try
            {
                $url                    = 'https://api.stripe.com/v1/customers';
                $data['source']         = $card_token;
                $data['description']    = $user->email;

                $curl = self::stripeExecuteCurlRequest($url, $data);
                // print_r($curl);exit;
                if($curl->success)
                {
                    $result->success        = true;
                    $result->customer_id    = $curl->stripe_result->id;
                    $result->card_token     = $curl->stripe_result->sources->data[0]->id;
                    $result->last4      = $curl->stripe_result->sources->data[0]->last4;
                    $result->card_type      = $curl->stripe_result->sources->data[0]->brand;
                    
                }
            }
            catch (\Exception $e)
            {
                $result->success = false;
                $result->message = 'Provider Stripe Customer creation error: ' . $e->getMessage();
                Log::info('User Stripe Customer creation error: ' . $e->getMessage() );
            }

            // print_r($result); exit;
            return $result;
        }

        public static function stripeCreateAdmin($request, $email)
        {
            $result             = new \stdClass();
            $result->success    = false;

            try
            {
                $url                    = 'https://api.stripe.com/v1/customers';
                $data['source']         = $request->stripeToken;
                $data['description']    = $email;

                $curl = self::stripeExecuteCurlRequest($url, $data);

                if($curl->success)
                {
                    $result->success        = true;
                    $result->customer_id    = $curl->stripe_result->id;
                    $result->card_token     = $curl->stripe_result->sources->data[0]->id;
                    $result->last4      = $curl->stripe_result->sources->data[0]->last4;
                    $result->card_type      = $curl->stripe_result->sources->data[0]->brand;
                }
            }
            catch (\Exception $e)
            {
                $result->success = false;
                Log::info('User Stripe Customer creation error: ' . $e->getMessage() );
            }

            return $result;
        }
        public static function StripeCreateCardToken($request)


        {

        //     return $request->all();
        // exit;

            $result             = new \stdClass();
            $result->success    = false;

            try
            {
                $url                    = 'https://api.stripe.com/v1/tokens';
                $data['card']['number']   = $request->card_no;
                $data['card']['exp_month']   = $request->exp_month;
                $data['card']['exp_year']   = $request->exp_year;
                $data['card']['cvc']   = $request->cvv;

                $curl = self::stripeExecuteCurlRequest($url, $data);


// print_r($curl);exit;
                if($curl->success)
                {
                   
                
                    $result->success        = true;
                    $result->card_token    = $curl->stripe_result->id;
                    $result->card_id     = $curl->stripe_result->card->id;
                    $result->last_four     = $curl->stripe_result->card->last_four;
 
                }
            }
            catch (\Exception $e)
            {
                $result->success = false;
                Log::info('User Stripe Customer creation error: ' . $e->getMessage() );
            }

            return $result;
        }


        public static function stripeAddCard($cardToken, $card)
        {
            $result             = new \stdClass();
            $result->success    = false;

            // try
            // {
                if(isset($card->customer_id))
                {
                    $url = 'https://api.stripe.com/v1/customers/'. $card->customer_id .'/sources';
                }else
                {                    
                    $url = 'https://api.stripe.com/v1/customers';
                    $data['description']    = $card->email;
                }
                    
                $data['source'] = $cardToken;

                $curl = self::stripeExecuteCurlRequest($url, $data);
                if(isset($curl->id))
                {
                    $result->success        = true;
                    $result->customer_id    = (isset($card->customer_id))?$card->customer_id:$curl->id;
                    $result->card_token     = (isset($card->customer_id))?$curl->id:$curl->default_source;
                    //$result->card_type      = $curl->brand;
                    //$result->last_four      = $curl->last4;
                }else
                {
                    $result->success = false;
                    $result->message = $curl->error->message;
                }
            // }
            // catch (\Exception $e)
            // {
            //     $result->success = false;
            //     $result->message = 'user Stripe Account creation error: ' . $e->getMessage();
            //     Log::info('user Stripe Account creation error catch: ' . $e->getMessage() );
            // }
            return $result;
        }

        public static function stripeAdminCharge($pay_to_provider,$card,$requests)
        {

            $result             = new \stdClass();
            $result->success    = false;

            try
            {
                $provider = Provider::find($requests->confirmed_provider);
                if($provider && $provider->stripe_acc_id)
                {
                    $total_in_cents             = $pay_to_provider * 100;
                    //$application_fee_in_cents   = $request_payment->total * 100;

                    $url = 'https://api.stripe.com/v1/charges';
                    $data['amount']             = round($total_in_cents);
                    $data['currency']           = 'nok';
                    //$data['source']             = $card->customer_id;
                    $data['customer']           = $card->customer_id;
                    //$data['card']               = $card->card_token;
                    $data['destination']        = $provider->stripe_acc_id;
                    //$data['application_fee']    = $application_fee_in_cents;

                    $curl = self::stripeExecuteCurlRequest($url, $data);
                    
                    if($curl->success)
                    {
                        $result->success    = true;
                        $result->id         = $curl->stripe_result->id;
                    }
                }
                else
                    throw new \Exception('Provider stripe account details not found.');

            }
            catch (\Exception $e)
            {
                $result->success = false;
                Log::info('Stripe transaction error: ' . $e->getMessage() );
            }

            return $result;

        }


        public static function stripeCreateCharge($amout, $card)
        {
            $result             = new \stdClass();
            $result->success    = false;
            try
            {
                $total_in_cents           = $amout * 100;
        
                $url = 'https://api.stripe.com/v1/charges';
                $data['amount']             = round($total_in_cents);
                $data['currency']           = 'usd';
                $data['customer']           = $card->customer_id;
                $data['card']               = $card->card_token;
    
                $headers = [
                        'Idempotency-Key:'.rand(1234,123465)
                ];

                $curl = self::stripeExecuteCurlRequestCharge($url, $data, $headers);
                if($curl->success)
                {
                    $result->success    = true;
                    $result->id         = $curl->stripe_result->id;
                }else
                {
                    $result->success    = false;
                    $result->message         = $curl->stripe_result->error->message;                
                    throw new \Exception('Provider stripe account details not found.');
                }

            }
            catch (\Exception $e)
            {
                $result->success = false;
                Log::info('Stripe transaction error: ' . $e->getMessage() );
            }

            return $result;
        }


        public static function stripeAddBankAccount($request, $provider)
        {
            $result             = new \stdClass();
            $result->success    = false;

            try
            {
                $url                    = 'https://api.stripe.com/v1/accounts/'.$provider->stripe_acc_id;
                $data['bank_account']   = $request->bank_account_token;

                $curl = self::stripeExecuteCurlRequest($url, $data);

                if($curl->success)
                {
                    $result->success    = true;
                }

            }
            catch (\Exception $e)
            {
                $result->success = false;
                Log::info('Stripe transaction error: ' . $e->getMessage() );
            }

            return $result;
        }


        public static function stripeTransferSchedule($provider)
        {
            $result             = new \stdClass();
            $result->success    = false;

            try
            {
                $url = 'https://api.stripe.com/v1/accounts/'.$provider->stripe_acc_id;
                $data['transfer_schedule']['interval']      = 'weekly';
                $data['transfer_schedule']['weekly_anchor'] = 'saturday';

                /*  There are four possible settings for the 'interval'::
                    1) manual 2) daily | delay_days(Ex:2) 3) weekly | weekly_anchor(Ex:monday)
                    4) monthly | monthly_anchor(a number 1-31)
                    Reference Link:: https://www.hitchhq.com/stripe/activities/575973048e2e411000b8da0f
                */

                $curl = self::stripeExecuteCurlRequest($url, $data);

                if($curl->success)
                {
                    $result->success            = true;
                    $result->transfer_schedule  = $data['transfer_schedule']['interval'].'-'.$data['transfer_schedule']['weekly_anchor'];
                }

            }
            catch (\Exception $e)
            {
                $result->success = false;
                Log::info('Stripe transaction error: ' . $e->getMessage() );
            }

            return $result;
        }

 }



