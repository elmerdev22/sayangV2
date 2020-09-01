<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
    
            $user = Socialite::driver($provider)->stateless()->user();
     
            $finduser = User::where('provider_id', $user->id)->first();

            if($finduser){
     
                $updateUser = User::where('provider_id',$user->id)->first();
                $updateUser->email = $user->email;
                $updateUser->provider = $provider;
                $updateUser->provider_id = $user->id;
                if($updateUser->save()){
                    Auth::login($updateUser);
                    return redirect('/');
                }
     
            }else{

                $newUser = new User();
                $newUser->email = $user->email;
                $newUser->provider = $provider;
                $newUser->provider_id = $user->id;
                if($newUser->save()){
                    Auth::login($newUser);
                    return redirect('/');
                }
            }
    
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
