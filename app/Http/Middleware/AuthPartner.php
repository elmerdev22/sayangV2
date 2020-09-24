<?php

namespace App\Http\Middleware;

use App\Model\Partner;
use Closure;
use Auth;
use Route;
use Request;
use Utility;

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
                $is_activated = Utility::partner_activated();
                $route        = Route::is('front-end.partner.account-activation.index');

                if($route){
                    if($is_activated){
                        return redirect(route('front-end.partner.my-account.index'))->send();
                    }else{
                        if(!$route){
                            return redirect(route('front-end.partner.account-activation.index'))->send();
                        }
                    }
                }else{
                    if(!$is_activated){
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
