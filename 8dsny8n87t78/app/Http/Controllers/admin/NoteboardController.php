<?php

namespace App\Http\Controllers\admin;
                                    
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController;
use DB;

class NoteboardController extends BaseController
{

    /**
     * function to get notification list 
     * @param no param
     * @return array o blade file
     */

	public function noticeboard_list()
	{
		return view('noticeboard_list');
	}

    /**
     * function to View add_noticeboard blade file 
     * @param no param
     * @return view add_noticeboard
     */

	public function add_noticeboard()
	{
		return view('add_noticeboard');
	}

    /**
     * function to View custum push blade file 
     * @param no param
     * @return view custumpush
     */

	public function custumpush()
	{
		return view('custumpush');
	}

    /**
     * function to send push notification based send to user , provider or all 
     * @param Request param
     * @return back with success response
     */

	public function send_custumpush(Request $request)
	{

			$validator = Validator::make($request->all(), [
                'send_to' => 'required',
                'title' => 'required',
                'message' => 'required',
            ]);
		

        if($validator->fails()) {

            $error_messages = implode(',',$validator->messages()->all());
            return back()->with('error', $error_messages)->withInput();

        }else{

        	$send_to = $request->send_to;
        	$message = $request->message;
			$imagename = "";
			if($request->hasFile('image'))
			{
				$image = self::base_image_upload_product($request,'image');
				$imagename = BASE_URL.PROMO_IMAGE_PATH.$image;
			}
			if($send_to=='ALL') $data = $this->users::get(); $provider = $this->deliverypartners;	
			if($send_to=='USERS') $data = $this->users::get();
			if($send_to=='PROVIDERS') $data = $this->deliverypartners::get();
			
			foreach ($data as $key => $value) {
				# code...
				if(isset($value->device_token) && $value->device_token!='' && isset($value->device_type) && $value->device_type!='')
				{
					$title = trans('constants.order_status_update');
					$data = array(
						'device_token' => $value->device_token,
						'device_type' => $value->device_type,
						'title' => $title,
						'message' => $message,
						'image' => $imagename
					);
					$this->user_send_push_notification($data);
				}
			}

			if($send_to=='ALL')
			{

				foreach ($provider as $key => $value) {
					# code...
				if(isset($value->device_token) && $value->device_token!='' && isset($value->device_type) && $value->device_type!='')
					{
						$title = trans('constants.order_status_update');
						$data = array(
							'device_token' => $value->device_token,
							'device_type' => $value->device_type,
							'title' => $title,
							'message' => $message,
						);
						$this->user_send_push_notification($data);
					}
				}
			}
        }

		return back()->with('success',trans('constants.push_notification').trans('constants.send_success_msg'));
	}


	public function base_image_upload_product($request,$key)    
    {        
        $imageName = $request->file($key)->getClientOriginalName();       
         $ext = $request->file($key)->getClientOriginalExtension();
         $imageName = $this->generate_random_string().'.'.$ext;        
         $request->file($key)->move('public/promo_images/',$imageName);       
         return $imageName;
    }
}