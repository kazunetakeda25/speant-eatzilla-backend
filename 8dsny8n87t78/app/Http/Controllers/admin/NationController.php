<?php

namespace App\Http\Controllers\admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\api\BaseController;
use DB;

class NationController extends BaseController
{
    /**
     * Get country list.
     *
     * @return value to blade file
     */
    public function Getcountrylist()
    {
        $data = $this->country->get();
        return view('country-list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Addcountry()
    {
        return view('add-country');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function AddEditcountry($id)
    {
        $data = $this->country->find($id);
        return view('add-country',compact('data'));
    }

    /**
     * Update the country.
     * @param  Request $request param
     * @return success response 
     */
    public function Savecountry(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'currency_code' => 'required|max:5',
            'currency_symbol' => 'required|max:3',
            'country_code' => 'required|max:5',
            'country' => 'required',

        ]);
         if($validator->fails()) {

            $error_messages = implode(',',$validator->messages()->all());

            return back()->with('error', $error_messages)->withInput();

        }
        $id = $request->id;
        if($id !="" || $id !=null){
            $check = $this->country->where('id','!=',$id)->where('country',$request->country)->count();

            $path= 'admin/edit_country/'.$id;
            $insert = $this->country->find($id);
        }else{
            $check = $this->country->where('country',$request->country)->count();
            $path= 'admin/country_list';
            $insert = $this->country;

        }     
        if($check !=0){
            return back()->with('error', trans('constants.already_exist',['param'=>'Country is ']))->withInput();
        }

            $insert->country = $request->country;
            $insert->country_code = $request->country_code;
            $insert->currency_code = $request->currency_code;
            $insert->currency_symbol = $request->currency_symbol;
            $insert->save();

        return redirect($path)->with('success',trans('constants.save_success_msg'));

    }

    /**
     * Set country to default country.
     *
     * @return back to blade file
     */
    public function Defaultcountry($id)
    {
        $this->country->where('is_default',1)->update(['is_default'=>0]);
        $country_update = $this->country->find($id);
        $country_update->is_default = 1;
        $country_update->save();  

        return back()->with('success',trans('constants.update_success_msg_country'));
  
    }

    /**
     * Get State list.
     *
     * @return value to blade file
     */
    public function Getstatelist()
    {
        $data = $this->state->with('Country')->get();
        return view('state-list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Addstate()
    {
        $country = $this->country->get();
        return view('add-state',compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return value to blade file
     */
    public function AddEditstate($id)
    {

        $country = $this->country->get();
        $data = $this->state->find($id);
        return view('add-state',compact('data','country'));
    }

    /**
     * Update the state.
     * @param  Request $request param
     * @return success response 
     */
    public function Savestate(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'country_id' => 'required',
            'state' => 'required',

        ]);
         if($validator->fails()) {

            $error_messages = implode(',',$validator->messages()->all());

            return back()->with('error', $error_messages)->withInput();

        }
        $id = $request->id;
        $country_id = $request->country_id;
        $state = $request->state;

        if($id !="" || $id !=null){

            $check = $this->state->where('id','!=',$id)
                                  ->where('country_id',$country_id)
                                  ->where('state',$state)
                                  ->count();
          
            $path= 'admin/edit_state/'.$id;
            $insert = $this->state->find($id);
        }else{

            $check = $this->state->where('country_id',$country_id)
                                 ->where('state',$state)
                                 ->count();

            $path= 'admin/state_list';
            $insert = $this->state;

        }
          if($check !=0){
                return back()->with('error', trans('constants.already_exist',['param'=>'State is ']))->withInput();
            }

            $insert->state = $state;
            $insert->country_id = $country_id;
            $insert->save();

        return redirect($path)->with('success',trans('constants.save_success_msg'));

    }

    /**
     * Get State list.
     *
     * @return json response
     */

      public function get_state_ajax(Request $request,$id) {
         
         $country = $this->state->where('country_id',$id)->get();
         echo json_encode($country);

      }


      /**
       * get state or city based on country
       * 
       * @param int $provinceid, int $id
       * 
       * @return array $data
       */
      public function getprovience($provienceid, $id)
      {
        if($id==1)
            $data =  $this->country->find($provienceid);
        else
            $data = $this->state->find($provienceid);

        return  $data;
      }


    /**
     * delete country
     * 
     * @param object $request
     * 
     * @return view page
     */
    public function delete_country(Request $request)
    {
        if($request->default==1)
        {
            return back()->with('error',"Default country could not delete!");
        }
        $id = $request->id;
        DB::delete('delete country,state,add_city,city_geofencing,add_area,restaurants,restaurants_document,restaurant_bank_details,restaurant_cuisines,restaurant_timer,restaurant_payout_history,
                    favourite_list,offers_banner,popular_brands_list,food_list,foodlist_foodquantity,foodlist_addons,requests,request_detail,requestdetail_addons,track_order_status,order_ratings,chat_messages
                    from country left join state on country.id = state.country_id 
                    left join add_city on state.id = add_city.state_id 
                    left join city_geofencing on add_city.id = city_geofencing.city_id 
                    left join add_area on add_city.id = add_area.add_city_id 
                    left join restaurants on add_city.id = restaurants.city 
                    left join restaurants_document on restaurants.id = restaurants_document.restaurants_id 
                    left join restaurant_bank_details on restaurants.id = restaurant_bank_details.restaurant_id 
                    left join restaurant_cuisines on restaurants.id = restaurant_cuisines.restaurant_id 
                    left join restaurant_timer on restaurants.id = restaurant_timer.restaurant_id 
                    left join restaurant_payout_history on restaurants.id = restaurant_payout_history.restaurant_id 
                    left join offers_banner on restaurants.id = offers_banner.restaurant_id
                    left join popular_brands_list on restaurants.id = popular_brands_list.name 
                    left join favourite_list on restaurants.id = favourite_list.restaurant_id
                    left join food_list on restaurants.id = food_list.restaurant_id
                    left join foodlist_foodquantity on food_list.id = foodlist_foodquantity.foodlist_id
                    left join foodlist_addons on food_list.id = foodlist_addons.foodlist_id
                    left join requests on restaurants.id = requests.restaurant_id 
                    left join request_detail on requests.id = request_detail.request_id 
                    left join requestdetail_addons on request_detail.id = requestdetail_addons.requestdetail_id 
                    left join track_order_status on requests.id = track_order_status.request_id 
                    left join order_ratings on requests.id = order_ratings.request_id
                    left join chat_messages on requests.id = chat_messages.request_id 
                    where country.id='.$id);

        DB::delete('delete delivery_partners,delivery_partner_details,vehicle,driver_payout_history,requests,request_detail,requestdetail_addons,track_order_status,order_ratings,chat_messages
                    from delivery_partners left join delivery_partner_details on delivery_partners.id = delivery_partner_details.delivery_partners_id 
                    left join vehicle on delivery_partners.id = vehicle.delivery_partners_id 
                    left join driver_payout_history on delivery_partners.id = driver_payout_history.delivery_boy_id 
                    left join requests on delivery_partners.id = requests.delivery_boy_id 
                    left join request_detail on requests.id = request_detail.request_id 
                    left join requestdetail_addons on request_detail.id = requestdetail_addons.requestdetail_id 
                    left join track_order_status on requests.id = track_order_status.request_id 
                    left join order_ratings on requests.id = order_ratings.request_id
                    left join chat_messages on requests.id = chat_messages.request_id 
                    where delivery_partner_details.country='.$id);

        return back()->with('success',"Country deleted successfully!");
    }


    /**
     * delete state
     * 
     * @param object $request
     * 
     * @return view page
     */
    public function delete_state(Request $request)
    {
        $id = $request->id;
        DB::delete('delete state,add_city,city_geofencing,add_area,restaurants,restaurants_document,restaurant_bank_details,restaurant_cuisines,restaurant_timer,restaurant_payout_history,
                    favourite_list,offers_banner,popular_brands_list,food_list,foodlist_foodquantity,foodlist_addons,requests,request_detail,requestdetail_addons,track_order_status,order_ratings,chat_messages
                    from state left join add_city on state.id = add_city.state_id 
                    left join city_geofencing on add_city.id = city_geofencing.city_id 
                    left join add_area on add_city.id = add_area.add_city_id 
                    left join restaurants on add_city.id = restaurants.city 
                    left join restaurants_document on restaurants.id = restaurants_document.restaurants_id 
                    left join restaurant_bank_details on restaurants.id = restaurant_bank_details.restaurant_id 
                    left join restaurant_cuisines on restaurants.id = restaurant_cuisines.restaurant_id 
                    left join restaurant_timer on restaurants.id = restaurant_timer.restaurant_id 
                    left join restaurant_payout_history on restaurants.id = restaurant_payout_history.restaurant_id 
                    left join offers_banner on restaurants.id = offers_banner.restaurant_id
                    left join popular_brands_list on restaurants.id = popular_brands_list.name 
                    left join favourite_list on restaurants.id = favourite_list.restaurant_id
                    left join food_list on restaurants.id = food_list.restaurant_id
                    left join foodlist_foodquantity on food_list.id = foodlist_foodquantity.foodlist_id
                    left join foodlist_addons on food_list.id = foodlist_addons.foodlist_id
                    left join requests on restaurants.id = requests.restaurant_id 
                    left join request_detail on requests.id = request_detail.request_id 
                    left join requestdetail_addons on request_detail.id = requestdetail_addons.requestdetail_id 
                    left join track_order_status on requests.id = track_order_status.request_id 
                    left join order_ratings on requests.id = order_ratings.request_id
                    left join chat_messages on requests.id = chat_messages.request_id 
                    where state.id='.$id);

        DB::delete('delete delivery_partners,delivery_partner_details,vehicle,driver_payout_history,requests,request_detail,requestdetail_addons,track_order_status,order_ratings,chat_messages
                    from delivery_partners left join delivery_partner_details on delivery_partners.id = delivery_partner_details.delivery_partners_id 
                    left join vehicle on delivery_partners.id = vehicle.delivery_partners_id 
                    left join driver_payout_history on delivery_partners.id = driver_payout_history.delivery_boy_id 
                    left join requests on delivery_partners.id = requests.delivery_boy_id 
                    left join request_detail on requests.id = request_detail.request_id 
                    left join requestdetail_addons on request_detail.id = requestdetail_addons.requestdetail_id 
                    left join track_order_status on requests.id = track_order_status.request_id 
                    left join order_ratings on requests.id = order_ratings.request_id
                    left join chat_messages on requests.id = chat_messages.request_id 
                    where delivery_partner_details.state_province='.$id);

        return back()->with('success',"State deleted successfully!");
    }



    /**
     * delete state
     * 
     * @param object $request
     * 
     * @return view page
     */
    public function delete_city(Request $request)
    {
        $id = $request->id;
        DB::delete('delete add_city,city_geofencing,add_area,restaurants,restaurants_document,restaurant_bank_details,restaurant_cuisines,restaurant_timer,restaurant_payout_history,
                    favourite_list,offers_banner,popular_brands_list,food_list,foodlist_foodquantity,foodlist_addons,requests,request_detail,requestdetail_addons,track_order_status,order_ratings,chat_messages
                    from add_city left join city_geofencing on add_city.id = city_geofencing.city_id 
                    left join add_area on add_city.id = add_area.add_city_id 
                    left join restaurants on add_city.id = restaurants.city 
                    left join restaurants_document on restaurants.id = restaurants_document.restaurants_id 
                    left join restaurant_bank_details on restaurants.id = restaurant_bank_details.restaurant_id 
                    left join restaurant_cuisines on restaurants.id = restaurant_cuisines.restaurant_id 
                    left join restaurant_timer on restaurants.id = restaurant_timer.restaurant_id 
                    left join restaurant_payout_history on restaurants.id = restaurant_payout_history.restaurant_id 
                    left join offers_banner on restaurants.id = offers_banner.restaurant_id
                    left join popular_brands_list on restaurants.id = popular_brands_list.name 
                    left join favourite_list on restaurants.id = favourite_list.restaurant_id
                    left join food_list on restaurants.id = food_list.restaurant_id
                    left join foodlist_foodquantity on food_list.id = foodlist_foodquantity.foodlist_id
                    left join foodlist_addons on food_list.id = foodlist_addons.foodlist_id
                    left join requests on restaurants.id = requests.restaurant_id 
                    left join request_detail on requests.id = request_detail.request_id 
                    left join requestdetail_addons on request_detail.id = requestdetail_addons.requestdetail_id 
                    left join track_order_status on requests.id = track_order_status.request_id 
                    left join order_ratings on requests.id = order_ratings.request_id
                    left join chat_messages on requests.id = chat_messages.request_id 
                    where add_city.id='.$id);

        DB::delete('delete delivery_partners,delivery_partner_details,vehicle,driver_payout_history,requests,request_detail,requestdetail_addons,track_order_status,order_ratings,chat_messages
                    from delivery_partners left join delivery_partner_details on delivery_partners.id = delivery_partner_details.delivery_partners_id 
                    left join vehicle on delivery_partners.id = vehicle.delivery_partners_id 
                    left join driver_payout_history on delivery_partners.id = driver_payout_history.delivery_boy_id 
                    left join requests on delivery_partners.id = requests.delivery_boy_id 
                    left join request_detail on requests.id = request_detail.request_id 
                    left join requestdetail_addons on request_detail.id = requestdetail_addons.requestdetail_id 
                    left join track_order_status on requests.id = track_order_status.request_id 
                    left join order_ratings on requests.id = order_ratings.request_id
                    left join chat_messages on requests.id = chat_messages.request_id 
                    where delivery_partner_details.city='.$id);

        return back()->with('success',"City deleted successfully!");
    }
}
