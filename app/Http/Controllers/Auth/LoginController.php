<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Model\User;
use App\Model\UserAccount;
use Session;
use Utility;
use Auth;
use Hash;
use DB;

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
        if(Session::has('login_socialite_type')){
            return Socialite::driver($provider)->redirect();
        }else{
            Session::flash('login_provider_alert', 'An error occured.');
            return redirect(route('login'))->send();
        }
    }

    public function handleProviderCallback($provider)
    {
        if(Session::has('login_socialite_type')){
            $user_type = Session::get('login_socialite_type');
            Session::forget('login_socialite_type');
        }else{
            Session::flash('login_provider_alert', 'An error occured.');
            return redirect(route('login'))->send();
        }
        
        $success = false;

        DB::beginTransaction();
        try {
            if($provider == 'google'){
                $socialite_user = Socialite::driver($provider)
                    ->stateless()
                    ->user();
            }else{
                $socialite_user = Socialite::driver($provider)
                    ->fields(['name', 'first_name', 'last_name', 'email', 'gender', 'verified'])
                    ->stateless()
                    ->user();                 
            }

            $validate_email = User::where('email', $socialite_user->email)->first();

            if($validate_email){
                if($provider != $validate_email->provider){
                    //Already used in other provider
                    if($validate_email->provider != 'default'){
                        $message = 'You are attempting to login with an email that is already registered to a '.ucfirst($validate_email->provider).' account login. Instead, please select "Sign in using '.ucfirst($validate_email->provider).'".';
                    }else{
                        $message = 'You are attempting to login with an email that is already registered to the system. Instead, please enter your email and password you\'ve registered last time.';
                    }

                    Session::flash('login_provider_alert', $message);
                    DB::rollback();
                    return redirect(route('login'))->send();
                }
            }

            $find_user = User::where('provider', $provider)
                ->where('provider_id', $socialite_user->id)
                ->first();

            if(!$find_user){
                $find_user              = new User();
                $find_user->provider    = $provider;
                $find_user->provider_id = $socialite_user->id;
                $find_user->key_token   = Utility::generate_table_token('User');
                $find_user->type        = $user_type;
                $find_user->verified_at = date('Y-m-d H:i:s');
                
                if(!$socialite_user->email){
                    $find_user->verification_type = 'sms';
                }

                $is_new = true;
            }else{
                $is_new = false;
            }

            $find_user->email = $socialite_user->email;
            $given_name       = isset($socialite_user['given_name']) ? $socialite_user['given_name'] : $socialite_user->first_name;
            
            if($is_new){
                if($socialite_user->email){
                    $find_user->name = Utility::generate_username_from_email($socialite_user->email);
                }else{
                    $find_user->name = Utility::generate_username_from_name($given_name);
                }
            }


            if($find_user->save()){
                if($is_new){
                    $account            = new UserAccount();
                    $account->user_id   = $find_user->id;
                    $account->key_token = Utility::generate_table_token('UserAccount');
                }else{
                    $account = UserAccount::where('user_id', $find_user->id)->first();
                }

                $account->first_name          = $given_name;
                $account->last_name           = $socialite_user->last_name;
                $account->photo_provider_link = $socialite_user->avatar;

                if($account->save()){
                    $success = true;
                }
            }
    
        }catch(\Exception $e) {
            $success = false;
        }

        if($success){
            DB::commit();
            Session::flash('login_using_id', $find_user->id);
            return redirect(route('login-redirect.index'))->send();
        }else{
            DB::rollback();
            Session::flash('login_provider_alert', 'An error occured or Lost connection while logging in your account.');
            return redirect(route('login'))->send();
        }
    }
}
