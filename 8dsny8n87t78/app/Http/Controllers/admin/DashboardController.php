<?php

namespace App\Http\Controllers\admin;
                                    
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController;
use Carbon\Carbon;
use DB;

class DashboardController extends BaseController
{
	public function index(Request $request)
   
   //for super admin dashboard //

	{

    $restaurant_id = $request->session()->get('userid');
    $role = $request->session()->get('role');

		$total_users = DB::table('users')->select('id')->count();

		$total_delivery_partners = DB::table('delivery_partners')->select('id')->count();

		$total_restaurants = DB::table('restaurants')->select('id')->count();

		$total_earnings = DB::table('requests')->sum('bill_amount');

		$total_admin_comission = DB::table('requests')->sum('admin_commision');

		$total_restaurant_comission = DB::table('requests')->sum('restaurant_commision');

		$total_delivery_boy_comission = DB::table('requests')->sum('delivery_boy_commision');

    //recent orders
    $query = $this->foodrequest
                    ->orderby('id','desc')
                    ->limit(5);
    $query = $query->when(($role!=1),function($q)use($restaurant_id){
                return $q->where('restaurant_id',$restaurant_id);
            });
                    
    $recent_deliveries = $query->get();

		//for pie chart
		$month=date('m');
    $prev_month=date('m',strtotime("-1 month"));
    $previous_week = strtotime("-1 week +1 day");
    $start_week = strtotime("last sunday midnight",$previous_week);
    $end_week = strtotime("next saturday",$start_week);
    $last_week_start=date('Y-m-d',$start_week)." 00:00:00";
    $last_week_end=date('Y-m-d',$end_week)." 23:59:59";

    $current_month=DB::table('requests')
        ->when(($role!=1),function($q)use($restaurant_id){
            $q->where('restaurant_id', $restaurant_id);
        })
        ->whereMonth('created_at', '=', $month)
        ->select('restaurant_commision')->sum('restaurant_commision');
    
    $last_month=DB::table('requests')
        ->when(($role!=1),function($q)use($restaurant_id){
            $q->where('restaurant_id', $restaurant_id);
        })
        ->whereMonth('requests.created_at', '=', $prev_month)
        ->select('restaurant_commision')->sum('restaurant_commision');

    $current_week=DB::table('requests')
        ->when(($role!=1),function($q)use($restaurant_id){
            $q->where('restaurant_id', $restaurant_id);
        })
      ->whereBetween('requests.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
      ->select('restaurant_commision')->sum('restaurant_commision');

    $last_week=DB::table('requests')
        ->when(($role!=1),function($q)use($restaurant_id){
          $q->where('restaurant_id', $restaurant_id);
        })
        ->whereBetween('requests.created_at', [$last_week_start, $last_week_end])
        ->select('restaurant_commision')->sum('restaurant_commision');


        $week_number  = date("W", strtotime('now'));// ISO-8601 week number
        $year_number  = date("o", strtotime('now'));// ISO-8601 year number

        //print_r($week_number);exit();

      

    if($week_number<=9)
    {
      $week_number= "0".$week_number; 
    }
    $this_year = date('Y');
    $monday = date('Y-m-d', strtotime("$this_year-W$week_number")); 
    //print_r($monday);exit();
    $tuesday= date('Y-m-d',strtotime("$monday +1 days"));
    $wednesday= date('Y-m-d',strtotime("$monday +2 days"));
    $thursday= date('Y-m-d',strtotime("$monday +3 days"));
    $friday= date('Y-m-d',strtotime("$monday +4 days"));
    $saturday= date('Y-m-d',strtotime("$monday +5 days"));
    $sunday= date('Y-m-d',strtotime("$monday +6 days"));

    $monday_admin_earnings = DB::table('requests')
                           ->whereDate('requests.created_at','=',$monday)
                           
                           ->sum('admin_commision');
                           //print_r($monday_admin_earnings);exit();                          
    $tuesday_admin_earnings = DB::table('requests')
                           ->whereDate('requests.created_at','=',$tuesday)
                           ->sum('admin_commision');

    $wednesday_admin_earnings = DB::table('requests')
                           ->whereDate('requests.created_at','=',$wednesday)
                           ->sum('admin_commision');
    $thursday_admin_earnings = DB::table('requests')
                           ->whereDate('requests.created_at','=',$thursday)
                           ->sum('admin_commision');
    $friday_admin_earnings = DB::table('requests')
                           ->whereDate('requests.created_at','=',$friday)
                           ->sum('admin_commision');
    $saturday_admin_earnings = DB::table('requests')
                           ->whereDate('requests.created_at','=',$saturday)
                          ->sum('admin_commision');
                          //print_r($saturday_admin_earnings);exit();
    $sunday_admin_earnings = DB::table('requests')
                           ->whereDate('requests.created_at','=',$sunday)
                           ->sum('admin_commision');

    $admin=$monday_admin_earnings.','.$tuesday_admin_earnings.','.$wednesday_admin_earnings.','.$thursday_admin_earnings.','.$friday_admin_earnings
        .','.$saturday_admin_earnings.','.$sunday_admin_earnings;

   // For Restaurant Day Wise Earnings //

    $monday_restaurant_earnings = DB::table('requests')
                           ->whereDate('requests.created_at','=',$monday)
                           ->sum('restaurant_commision');                          
    $tuesday_restaurant_earnings = DB::table('requests')
                           ->whereDate('requests.created_at','=',$tuesday)
                           ->sum('restaurant_commision');
    $wednesday_restaurant_earnings = DB::table('requests')
                           ->whereDate('requests.created_at','=',$wednesday)
                           ->sum('restaurant_commision');
    $thursday_restaurant_earnings = DB::table('requests')
                           ->whereDate('requests.created_at','=',$thursday)
                           ->sum('restaurant_commision');
    $friday_restaurant_earnings = DB::table('requests')
                           ->whereDate('requests.created_at','=',$friday)
                           ->sum('restaurant_commision');
    $saturday_restaurant_earnings = DB::table('requests')
                           ->whereDate('requests.created_at','=',$saturday)
                          ->sum('restaurant_commision');
    $sunday_restaurant_earnings = DB::table('requests')
                           ->whereDate('requests.created_at','=',$sunday)
                           ->sum('restaurant_commision');
    $restaurant=$monday_restaurant_earnings.','.$tuesday_restaurant_earnings.','.$wednesday_restaurant_earnings.','.$thursday_restaurant_earnings.','.$friday_restaurant_earnings.','.$saturday_restaurant_earnings.','.$sunday_restaurant_earnings; 

    // For Delivery Boy Earnings//  

    $monday_delivery_boy_earnings = DB::table('requests')
                           ->whereDate('requests.created_at','=',$monday)
                           ->sum('delivery_boy_commision');                          
    $tuesday_delivery_boy_earnings = DB::table('requests')
                           ->whereDate('requests.created_at','=',$tuesday)
                           ->sum('delivery_boy_commision');
    $wednesday_delivery_boy_earnings = DB::table('requests')
                           ->whereDate('requests.created_at','=',$wednesday)
                           ->sum('delivery_boy_commision');
    $thursday_delivery_boy_earnings = DB::table('requests')
                           ->whereDate('requests.created_at','=',$thursday)
                           ->sum('delivery_boy_commision');
    $friday_delivery_boy_earnings = DB::table('requests')
                           ->whereDate('requests.created_at','=',$friday)
                           ->sum('delivery_boy_commision');
    $saturday_delivery_boy_earnings = DB::table('requests')
                           ->whereDate('requests.created_at','=',$saturday)
                          ->sum('delivery_boy_commision');
    $sunday_delivery_boy_earnings = DB::table('requests')
                           ->whereDate('requests.created_at','=',$sunday)
                           ->sum('delivery_boy_commision');
    $delivery_boy=$monday_delivery_boy_earnings.','.$tuesday_delivery_boy_earnings.','.$wednesday_delivery_boy_earnings.','.$thursday_delivery_boy_earnings.','.$friday_delivery_boy_earnings.','.$saturday_delivery_boy_earnings.','.$sunday_delivery_boy_earnings; 

    // For Restaurant Dashboard //

    

    $total_res_orders = DB::table('requests')
    ->where('restaurant_id',$restaurant_id)
    ->select('id')
    ->count();
    //print_r($total_users);exit();

    $today_res_comission = DB::table('requests')
    ->where('restaurant_id',$restaurant_id)
    ->whereDate('created_at', Carbon::today())
    ->sum('restaurant_commision');

    $today_orders = DB::table('requests')
    ->where('restaurant_id',$restaurant_id)
    ->whereDate('created_at', Carbon::today())
    ->groupby('user_id')
    ->count();
    //print_r($res_total_users);exit();

    $total_res_comission = DB::table('requests')
    ->where('restaurant_id',$restaurant_id)
    ->sum('restaurant_commision');
    
        
    $res_monday_admin_earnings = DB::table('requests')
                           ->where('restaurant_id',$restaurant_id)
                           ->whereDate('requests.created_at','=',$monday)
                           ->sum('admin_commision');                          
    $res_tuesday_admin_earnings = DB::table('requests')
                           ->where('restaurant_id',$restaurant_id)
                           ->whereDate('requests.created_at','=',$tuesday)
                           ->sum('admin_commision');
    $res_wednesday_admin_earnings = DB::table('requests')
                           ->where('restaurant_id',$restaurant_id)
                           ->whereDate('requests.created_at','=',$wednesday)
                           ->sum('admin_commision');
    $res_thursday_admin_earnings = DB::table('requests')
                           ->where('restaurant_id',$restaurant_id)
                           ->whereDate('requests.created_at','=',$thursday)
                           ->sum('admin_commision');
    $res_friday_admin_earnings = DB::table('requests')
                           ->where('restaurant_id',$restaurant_id)
                           ->whereDate('requests.created_at','=',$friday)
                           ->sum('admin_commision');
    $res_saturday_admin_earnings = DB::table('requests')
                           ->where('restaurant_id',$restaurant_id)
                           ->whereDate('requests.created_at','=',$saturday)
                          ->sum('admin_commision');
    $res_sunday_admin_earnings = DB::table('requests')
                           ->where('restaurant_id',$restaurant_id)
                           ->whereDate('requests.created_at','=',$sunday)
                           ->sum('admin_commision');
    $res_admin=$res_monday_admin_earnings.','.$res_tuesday_admin_earnings.','.$res_wednesday_admin_earnings.','.$res_thursday_admin_earnings.','.$res_friday_admin_earnings
        .','.$res_saturday_admin_earnings.','.$res_sunday_admin_earnings;

   // For Restaurant Day Wise Earnings //

    $res_monday_restaurant_earnings = DB::table('requests')
                           ->where('restaurant_id',$restaurant_id)
                           ->whereDate('requests.created_at','=',$monday)
                           ->sum('restaurant_commision');                          
    $res_tuesday_restaurant_earnings = DB::table('requests')
                           ->where('restaurant_id',$restaurant_id)
                           ->whereDate('requests.created_at','=',$tuesday)
                           ->sum('restaurant_commision');
    $res_wednesday_restaurant_earnings = DB::table('requests')
                           ->where('restaurant_id',$restaurant_id)
                           ->whereDate('requests.created_at','=',$wednesday)
                           ->sum('restaurant_commision');
    $res_thursday_restaurant_earnings = DB::table('requests')
                           ->where('restaurant_id',$restaurant_id)
                           ->whereDate('requests.created_at','=',$thursday)
                           ->sum('restaurant_commision');
    $res_friday_restaurant_earnings = DB::table('requests')
                           ->where('restaurant_id',$restaurant_id)
                           ->whereDate('requests.created_at','=',$friday)
                           ->sum('restaurant_commision');
    $res_saturday_restaurant_earnings = DB::table('requests')
                           ->where('restaurant_id',$restaurant_id)
                           ->whereDate('requests.created_at','=',$saturday)
                           ->sum('restaurant_commision');
    $res_sunday_restaurant_earnings = DB::table('requests')
                           ->where('restaurant_id',$restaurant_id)
                           ->whereDate('requests.created_at','=',$sunday)
                           ->sum('restaurant_commision');
    $res_restaurant=$res_monday_restaurant_earnings.','.$res_tuesday_restaurant_earnings.','.$res_wednesday_restaurant_earnings.','.$res_thursday_restaurant_earnings.','.$res_friday_restaurant_earnings.','.$res_saturday_restaurant_earnings.','.$res_sunday_restaurant_earnings; 

    // For Delivery Boy Earnings//  

    $res_monday_delivery_boy_earnings = DB::table('requests')
                           ->where('restaurant_id',$restaurant_id)
                           ->whereDate('requests.created_at','=',$monday)
                           ->sum('delivery_boy_commision');                          
    $res_tuesday_delivery_boy_earnings = DB::table('requests')
                           ->where('restaurant_id',$restaurant_id)
                           ->whereDate('requests.created_at','=',$tuesday)
                           ->sum('delivery_boy_commision');
    $res_wednesday_delivery_boy_earnings = DB::table('requests')
                           ->where('restaurant_id',$restaurant_id)
                           ->whereDate('requests.created_at','=',$wednesday)
                           ->sum('delivery_boy_commision');
    $res_thursday_delivery_boy_earnings = DB::table('requests')
                           ->where('restaurant_id',$restaurant_id)
                           ->whereDate('requests.created_at','=',$thursday)
                           ->sum('delivery_boy_commision');
    $res_friday_delivery_boy_earnings = DB::table('requests')
                           ->where('restaurant_id',$restaurant_id)
                           ->whereDate('requests.created_at','=',$friday)
                           ->sum('delivery_boy_commision');
    $res_saturday_delivery_boy_earnings = DB::table('requests')
                           ->where('restaurant_id',$restaurant_id)
                           ->whereDate('requests.created_at','=',$saturday)
                           ->sum('delivery_boy_commision');
    $res_sunday_delivery_boy_earnings = DB::table('requests')
                           ->where('restaurant_id',$restaurant_id)
                           ->whereDate('requests.created_at','=',$sunday)
                           ->sum('delivery_boy_commision');
    $res_delivery_boy=$res_monday_delivery_boy_earnings.','.$res_tuesday_delivery_boy_earnings.','.$res_wednesday_delivery_boy_earnings.','.$res_thursday_delivery_boy_earnings.','.$res_friday_delivery_boy_earnings.','.$res_saturday_delivery_boy_earnings.','.$res_sunday_delivery_boy_earnings; 


   
    //today earnings
    $current_date = date("Y-m-d");
    $today_earnings = $this->foodrequest->when(($role!=1),
                          function($q)use($restaurant_id){
                            $q->where('restaurant_id', $restaurant_id);
                          })
                          ->whereDate('created_at',$current_date)
                          ->sum('bill_amount');



 // echo $role;exit();


		return view('index',['today_earnings'=>$today_earnings,'total_users'=>$total_users,'total_delivery_partners'=>$total_delivery_partners,'total_restaurants'=>$total_restaurants,'total_earnings'=>$total_earnings,'total_admin_comission'=>$total_admin_comission,'total_restaurant_comission'=>$total_restaurant_comission,'total_delivery_boy_comission'=>$total_delivery_boy_comission,'recent_deliveries'=>$recent_deliveries,'current_month'=>$current_month,'last_month'=>$last_month,'current_week'=>$current_week,'last_week'=>$last_week,'admin_earnings'=>$admin,'restaurant_earnings'=>$restaurant,'delivery_boy_earnings'=>$delivery_boy,'total_res_comission'=>$total_res_comission,'total_res_orders'=>$total_res_orders,'res_admin_earnings'=>$res_admin,'res_restaurant_earnings'=>$res_restaurant,'res_delivery_boy_earnings'=>$res_delivery_boy,'today_res_comission'=>$today_res_comission,'today_orders'=>$today_orders]);
	}

	public function commission_settings(Request $request)
	{
		$admin_commission = DB::table('settings')->where('key_word','admin_commission')->first();
		$restaurant_commission = DB::table('settings')->where('key_word','restaurant_commission')->first();
		$delivery_boy_commission = DB::table('settings')->where('key_word','delivery_boy_commission')->first();

		$ids = array();
		$ids[0] = $admin_commission->id;
		$ids[1] = $restaurant_commission->id;
		$ids[2] = $delivery_boy_commission->id;

		// print_r($ids); exit;
		// echo $admin_commission; exit;
		return view('commission_settings',['admin_commission'=>$admin_commission,'restaurant_commission'=>$restaurant_commission,'delivery_boy_commission'=>$delivery_boy_commission,'commission_id'=>$ids]);
	}

	public function update_commission_settings(Request $request)
	{
		$id = $request->id;

		DB::table('settings')->where('id',$id)->update(['value'=>$request->commission_value]);

		return redirect('/admin/commission_settings');
	}


}