<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
//        if (Auth::guard($guard)->check()) {
//            return redirect('/home');
//        }
//
//        return $next($request);
        /* If Session Has data then send request to next page otherwise return login*/
        if(Session::has('login_data')){
            $login_data = Session::get('login_data');
           if(isset($login_data[0]->user_role_name) && !empty($login_data[0]->user_role_name) &&$login_data[0]->user_role_name =='Admin'){
               return $next($request);
           }else{
               return redirect('');
           }

        }else{
            return redirect('');
        }
    }
}
