<?php

namespace App\Http\Controllers\admin;
                                    
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController;
use DB;
use Auth;
use Hash;

class LoginController extends BaseController
{

    /**
     * return to view login screen
     * 
     * @return view page
     */
    public function index()
    {
        return view('login');
    }

    
    /**
     * admin and restaurant login check
     * 
     * @param object $request
     * 
     * @return view page to home screen
     */
	public function login(Request $request){

        if(!$request->email || !$request->password){
            return back()->with('error','Wrong email or password try again');
        }

        $credentials = $request->only('email', 'password');
        //dd(Hash::make($request->password));
        if(Auth::attempt($credentials)){
            $request->session()->put('userid', auth()->user()->id);
            $request->session()->put('user_name', auth()->user()->name);
            $request->session()->put('role', auth()->user()->role);
            //dd(auth()->user()->AccessPrivilages);
            return redirect('admin/dashboard');
        }else
        {
            if(Auth::guard('restaurant')->attempt($credentials))
            { 
                $request->session()->put('userid', auth()->guard('restaurant')->user()->id);
                $request->session()->put('user_name', auth()->guard('restaurant')->user()->restaurant_name);
                $request->session()->put('role',2);

                $url = 'admin/dashboard/';
                return redirect($url);
            }else{
                return back()->with('error','Wrong email or password try again');
            }
        }

    }

    public function logout(Request $request)
    {
       $request->session()->forget('userid');
       Auth::logout();
       return redirect('/admin')->with('success','Logout success');
    }
}