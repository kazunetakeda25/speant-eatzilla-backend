<?php

namespace App\Http\Controllers\api;
                                    
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\api\BaseController;
use Log;


class LoginController extends BaseController
{
    //

    public function get_profile(Request $request)
    {
        # code...
        $user_id = $request->header('authId');
        if($user_id=='') $user_id = ($request->authId)?$request->authId:"";
        $data = $this->users->where('id',$user_id)->get();
        
        foreach ($data as $d) {
            $d->password = $this->decrypt_password($d->password);
        }
        // $data->password = $this->decrypt_password($data->password);
       $response_array = array('status'=>true,'data'=>$data);
       $response = response()->json($response_array, 200);
        return $response;
    }

    public function send_otp_login(Request $request)
    {
        $phone = (string) $request->phone;
        $otp = rand(10000,99999);
        $message = 'OTP to verify '.APP_NAME.' Application : '.$otp;

        Log::info($message);
       $getuser = $this->users->where('phone',$phone)->first();
        if($request->is_forgot_password)
        {
            $is_forgot_password = $request->is_forgot_password;
        }else
        {
            $is_forgot_password = 0;
        }
        if($getuser)
        {
            if($is_forgot_password == 1)
            {
                 $sendSms = $this->send_otp($phone,$message);
            }
            $is_new_user = 0;
        }else{
            $sendSms = $this->send_otp($phone,$message);
            $is_new_user = 1;
        } 
// print_r($sendSms); exit;
        $response_array = array('status'=>true,'message'=>'OTP sent successfully','otp'=>$otp, 'is_new_user'=>$is_new_user);
        $response = response()->json($response_array, 200);
        return $response;
    }

     public function verify_otp_login(Request $request)
    {

         $validator = Validator::make(
                $request->all(),
                array(
                    'phone' => 'required',
                    'otp' => 'required'
                ));

        if ($validator->fails())
        {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        }else
        {

                $phone = (string) $request->phone;
                $otp = (string) $request->otp;
                $verify_sms = $this->verify_otp($phone,$otp);

                if($verify_sms)
                {
                    // echo $verify_sms->status; exit;
                    if($verify_sms->status == "ERROR")
                    {
                        $response_array = array('status'=>false,'message'=>'Invalid OTP');
                    }else
                    {
                        $response_array = array('status'=>true,'message'=>'OTP verified successfully');
                    }
                }else
                {
                    $response_array = array('status'=>false,'message'=>'Something went wrong. Try after sometime');
                }                
        }

        $response = response()->json($response_array, 200);
        return $response;
    }

    public function register(Request $request)
    {
         $validator = Validator::make(
                $request->all(),
                array(
                    'phone' => 'required',
                    'email' => 'required',
                    'password' => 'required',
                    'device_token' => 'required',
                    'login_type' =>'required',
                    'device_type' =>'required|in:'.ANDROID.','.IOS.','.WEB,
                ));

        if ($validator->fails())
        {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        }else
        {
            $users = $this->users;
            $phone = $request->phone;
            $email = $request->email;
            $password = $this->encrypt_password($request->password);
            $device_type = $request->device_type;
            $device_token = $request->device_token;
            $login_type = $request->login_type;
            $authToken = $this->generateRandomString();

            $check_phone = $users::where('phone',$phone)->get();
            $check_email = $users::where('email',$email)->get();
            $profile_image = "http://www.freeiconspng.com/uploads/account-profile-icon-1.png";

            if(count($check_phone)!=0)
            {
                $response_array = array('status' => false, 'message' => 'Mobile number already exist');
            }elseif(count($check_email)!=0)
            {
                $response_array = array('status' => false, 'message' => 'Email-id already exist');
            }else
            {
                $new_user=array();

                if($device_type!=WEB)
                {
                    $new_user[] = array(
                        'phone'=>$phone,
                        'email'=>$email,
                        'authToken'=>$authToken,
                        'device_type'=>$device_type,
                        'password'=>$password,
                        'device_type'=>$device_type,
                        'device_token'=>$device_token,
                        'profile_image'=>$profile_image,
                        'login_type'=>$login_type,
                        'referral_code'=>$this->generateRandomString_referral()
                    );
                }else
                {
                    $new_user[] = array(
                        'name'=>$request->first_name.' '.$request->last_name,
                        'phone'=>$phone,
                        'email'=>$email,
                        'authToken'=>$authToken,
                        'password'=>$password,
                        'device_type'=>$device_type,
                        'device_token'=>$device_token,
                        'profile_image'=>$profile_image,
                        'login_type'=>$login_type,
                        'referral_code'=>$this->generateRandomString_referral()
                    );
                }

                $users::insert($new_user);

                 $data = $users::where('phone','=',$phone)->first();
                $authToken = $data->authToken; $authId = $data->id;

                //send email to user
                if(EMAIL_ENABLE==1)
                {
                    $data->subject = "Welcome to ".APP_NAME;
                    $this->send_mail($data,'user_welcome');
                }
                  
               $response_array = array('status'=>true,'login_type'=>0,'authToken'=>$authToken,'authId'=>$authId,'phone'=>$data->phone,'profile_image'=>$profile_image,'email'=>$email);
            }
        }

         $response = response()->json($response_array, 200);
        return $response;
    }


	public function user_login(Request $request)
    {

           $validator = Validator::make(
                $request->all(),
                array(
                    'device_token' => 'required',
                    'login_type' =>'required',
                    'device_type' =>'required|in:'.ANDROID.','.IOS.','.WEB,
                ));

        if ($validator->fails())
        {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        }else
        {
            $users = $this->users;
            $device_token = $request->device_token;
            $login_type = $request->login_type;
            $device_type = $request->device_type;

                    ###############     TYPE=0 - mobile, TYPE=1 - Gmail, TYPE=2 - Facebook      ########################
            if($login_type==0)
            {
                $phone = $request->phone;
                $password = $this->encrypt_password($request->password);


                 $data = $users::where('phone','like', '%' .$phone. '%')->where('password',$password)->first();

                  if(count($data)!=0)
                  {

                    $authId = $data->id;
                    $profile_image = $data->profile_image;
                    if($data->name!=NULL)
                    {
                    $name = $data->name;
                    }else
                    {
                        $name="";
                    } 

                    $email = $data->email?$data->email:"";

                    $authToken =$this->generateRandomString();

                    $users::where('id',$data->id)->update(['device_token'=>$device_token,'authToken'=>$authToken, 'device_type'=>$device_type]);

                    $response_array = array('status' => true,'message' => 'Logged in successfully','authId'=>$authId,'authToken'=>$authToken,'phone'=>$phone,'profile_image'=>$profile_image,'email'=>$email,'user_name'=>$name);

                  }else
                  {
                    $response_array = array('status' => false,'message' => 'Invalid Login');
                  }
            
            }elseif($login_type==1)
            {
                // Gmail Login

                $email = $request->email;
                $device_token = $request->device_token;

                $data = $users::where('email',$email)->first();


                  if(count($data)!=0)
                  {

                    $authId = $data->id;
                    $profile_image = $data->profile_image;
                    if($data->name!=NULL)
                    {
                    $name = $data->name;
                    }else
                    {
                        $name="";
                    } 

                    $authToken =$this->generateRandomString();

                    $users::where('id',$data->id)->update(['device_token'=>$device_token,'authToken'=>$authToken,'device_type'=>$device_type]);

                    $response_array = array('status' => true,'message' => 'Logged in successfully','authId'=>$authId,'authToken'=>$authToken,'phone'=>$data->phone,'profile_image'=>$profile_image,'email'=>$email,'user_name'=>$name);

                  }else
                  {
                    $response_array = array('status' => false,'message' => 'Invalid Login');
                  }


            }else
            {
                // Facebook Login

                  $email = $request->email;
                $device_token = $request->device_token;

                $data = $users::where('email',$email)->first();


                  if(count($data)!=0)
                  {

                    $authId = $data->id;
                    $profile_image = $data->profile_image;
                    if($data->name!=NULL)
                    {
                    $name = $data->name;
                    }else
                    {
                        $name="";
                    } 

                    $authToken =$this->generateRandomString();

                    $users::where('id',$data->id)->update(['device_token'=>$device_token,'authToken'=>$authToken,'device_type'=>$device_type]);

                    $response_array = array('status' => true,'message' => 'Logged in successfully','authId'=>$authId,'authToken'=>$authToken,'phone'=>$data->phone,'profile_image'=>$profile_image,'email'=>$email,'user_name'=>$name);

                  }else
                  {
                    $response_array = array('status' => false,'message' => 'Invalid Login');
                  }
                  
            }
        }

        $response = response()->json($response_array, 200);
        return $response;
    }
    

    public function resend_otp(Request $request)
    {

        // $check = $users::where('phone','=',$phone)->first();
        $users = $this->users;
        $otp = rand(10000,99999);
        $sendSms = $this->send_otp($request->phone,$otp);
        $update =$users::where('phone','=',$request->phone)
            ->update(['otp'=>$otp]);

        return response()->json(['status'=>true,'message'=>'OTP resend successfully']);
    }

    public function update_profile(Request $request)
    {
        # code... profile_update

        $users = $this->users;
        $custom = $this->custom;
        $update = array();
        $data = $users::where('id',$request->id)->first();

        if ($request->name) {
            $update['name'] = $request->name;
        }
        if ($request->email) {
            $update['email'] = $request->email;
        }
        if($request->password)
        {
            $update['password'] = $this->encrypt_password($request->password);
        }
        // if ($request->address) {
        //     $update['lat'] = $request->lat;
        // }
        // if ($request->address) {
        //     $update['lng'] = $request->lng;
        // }
        // if ($request->address) {
        //     $update['address'] = $request->address;
        // }
        // if ($request->city) {
        //     $update['city'] = $request->city;
        // }
        if ($request->profile_image) {
            if ($data->profile_image != "") {
                $custom::delete_image($data->profile_image);
            }
           $profile_pic = $custom::upload_image($request,'profile_image');
            $update['profile_image'] = BASE_URL.$profile_pic;
        }
        
        $users::where('id',$request->id)->update($update);
        
        $data = $users::where('id',$request->id)->first();
        // $data = $this->check_null($data)->toArray();
        $response_array = array('status'=>true,'message'=>'Profile updated successfully','data'=>$data);
        $response = response()->json($response_array, 200);
        return $response;
    }

    public function forgot_password(Request $request)
    {
         $validator = Validator::make(
                $request->all(),
                array(
                    'phone' => 'required'
                ));

        if ($validator->fails())
        {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        }else
        {
            $phone = $request->phone;

            $users = $this->users;

            $check_user = $users::where('phone',$phone)->first();

            if(count($check_user)!=0)
            {
                $phone = (string) $request->phone;
                $otp = rand(10000,99999);
                $message = 'OTP to verify Foodie Application : '.$otp;
                $sendSms = $this->send_otp($phone,$otp);

            $response_array = array('status'=>true,'message'=>'OTP sent successfully','otp'=>$otp);
            }else
            {
                $response_array = array('status'=>false,'message'=>'Mobile number not registered');
            }
        }

         $response = response()->json($response_array, 200);
        return $response;

    }

    public function reset_password(Request $request)
    {

         $validator = Validator::make(
                $request->all(),
                array(
                    'password' => 'required',
                    'phone' => 'required'
                ));

        if ($validator->fails())
        {
            $error_messages = implode(',', $validator->messages()->all());
            $response_array = array('status' => false, 'error_code' => 101, 'message' => $error_messages);
        }else
        {
            $password = $this->encrypt_password($request->password);
            $phone = $request->phone;
            $users = $this->users;

            $get_user = $users::where('phone',$phone)->first();

            $users::where('phone',$phone)->update(['password'=>$password]);

            $response_array = array('status'=>true,'message'=>'Password Reset Successfull');
        }

        $response = response()->json($response_array, 200);
        return $response;

    }


    public function logout(Request $request)
    {
        if($request->header('authId')!="")
        {
            $user_id = $request->header('authId');
        }else
        {
            $user_id = $request->authId;
        }
        
        $users = $this->users;
        $users::where('id','=',$user_id)->update(['authToken'=>0]);

        $response_array = array('status'=>true,'message'=>'Logged Out Successfully');
        $response = response()->json($response_array, 200);
        return $response;
    }

    public function generate_password()
    {
        $password = "more#87654$@2790";
         $new_password  = Hash::make($password);
            // $new_password = substr($new_password,0,8);
        echo $new_password; 
        exit;
    }


    /**
     * get cms details
     * 
     * @return json $response
     */
    public function get_cms_pages()
    {
        $getdata = array(
            'about_us' => BASE_URL.'cms/about-us',
            'help' => BASE_URL.'cms/help',
            'faq' => BASE_URL.'cms/faq'
        );
        $response_array = array('status'=>true,'details'=>$getdata);
        $response = response()->json($response_array, 200);
        return $response;

    }



}
