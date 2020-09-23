<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $errors = array();
        $errors['status'] = false;

        $auth_id = $request->header('authId');
        $authToken = $request->header('authToken');

        if (!$auth_id) {
            $auth_id = $request->authId;
            if(!$auth_id)
            {
                $errors['message'] = 'auth id should not be null';
                return response()->json($errors);
            }
        }
        if (!$authToken) {
            $authToken = $request->authToken;
            if(!$authToken)
            {
                $errors['message'] = 'auth token should not be null';
                return response()->json($errors);
            }
        }
        $check_auth = DB::table('users')
                        ->where('id', $auth_id)
                        ->where('authToken', $authToken)->count();
        if ($check_auth == 0) {

            $check_auth = DB::table('delivery_partners')
                        ->where('id', $auth_id)
                        ->where('authToken', $authToken)->count();

        }
        if ($check_auth == 0) {
            $errors['message'] = 'Auth id , Auth token doesn`t match';
            return response()->json($errors,401);
        }

        $request->authId = $auth_id;
        $request->authToken = $authToken;
        return $next($request);
    }
}
