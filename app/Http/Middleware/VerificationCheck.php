<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Request;

class VerificationCheck
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
            
            if($user->type == 'user' || $user->type == 'partner'){
                if(!$user->verified_at){
                    if($user->type == 'user'){
                        if(Request::segment(2) != 'verification-check'){
                            return redirect(route('front-end.user.verification-check.index'));
                        }
                    }else{
                        dd('merchant verification');
                    }
                }
            }
        }

        return $next($request);
    }
}
