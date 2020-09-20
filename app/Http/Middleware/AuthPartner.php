<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Request;

class AuthPartner
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
            if(Auth::user()->type == 'partner'){
                $is_account_activated = false;

                if(!$is_account_activated){
                    if(Request::segment('2') != 'account-activation'){
                        return redirect(route('front-end.partner.account-activation.index'))->send();
                    }
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
