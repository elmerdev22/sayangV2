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
                    if(Request::segment(1) != 'verification-check'){
                        return redirect(route('verification-check.index'));
                    }
                }
            }
        }

        return $next($request);
    }
}
