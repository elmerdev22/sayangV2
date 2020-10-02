<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class AuthUser
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
        if(Auth::check()){
            $user = Auth::user();

            if($user->type == 'user'){
                if($user->is_blocked){
                    Session::flash('error', 'Your account was blocked.');
                    Auth::logout();
                    return redirect(route('login'))->send();
                }

                return $next($request);
            }else{
                abort(401);
            }
        }else{
            return redirect('/')->send();
        }
    }
}
