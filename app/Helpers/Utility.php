<?php
namespace App\Helpers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Mail\VerificationCheck as MailVerificationCheck;
use App\Model\Partner;
use App\Model\User;
use App\Model\UserAccount;
use Carbon\Carbon;
use Schema;
use Mail;
use Auth;
use DB;

class Utility{

    public static function socialite_providers(){
        return ['google', 'facebook'];
    }
    
    public static function generate_unique_token($len = 13) {
        // uniqid gives 13 chars, but you could adjust it to your needs.
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($len / 2));
        }else if(function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($len / 2));
        }else{
            throw new Exception("no cryptographically secure random function available");
        }

        return substr(bin2hex($bytes), 0, $len);
    }

    public static function generate_file_name($model_string, $key){
        do{
            $continue     = true;
            $token        = self::generate_unique_token(10);
            
            $model_string = 'App\\Model\\'.ucfirst($model_string);
            $model        = new $model_string();
            $check        = $model::where($key, 'like', "%{$token}%")->count();

            if($check == 0){
                $continue = false;
            }

        }while($continue);
        
        return $token;
    }
    
    public static function generate_table_token($model_string, $key='key_token'){
        do{
            $continue     = true;
            $token        = self::generate_unique_token(20);
            
            $model_string = 'App\\Model\\'.ucfirst($model_string);
            $model        = new $model_string();
            $check        = $model::where($key, $token)->count();

            if($check == 0){
                $continue = false;
            }

        }while($continue);
        
        return $token;
    }

    public static function generate_table_slug($model_string, $text, $key='slug'){
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        //Validate if exists
        $check = false;

        $model_string = 'App\\Model\\'.ucfirst($model_string);
        do{
            $model        = new $model_string();
            $check_slug   = $model::where($key, $text)->count();

            if($check_slug > 0){
                if(!$check){
                    $text = $text.'-'.rand(10, 99);
                }else{
                    $text = substr($text, 0, -3);
                    $text = $text.'-'.rand(1, 100);
                }
                $check        = true;
                $already_used = true;
            }else{
                $already_used = false;
            }
        }while($already_used);

        return $text;
    }

    public static function generate_username_from_email($email){
        $username = explode('@', $email)[0];
        
        do{
            $check_user   = User::where('name', $username)->first();
            if($check_user){
                $username     = $username.'.'.rand(1,100);
                $already_used = true;
            }else{
                $already_used = false;
            }
        }while($already_used);

        return $username;
    }

    public static function generate_username_from_name($name){
        $name     = str_replace('-', '', $name);
        $name     = str_replace(' ', '', $name);
        $username = strtolower($name);
        
        do{
            $check_user   = User::where('name', $username)->first();
            if($check_user){
                $username     = $username.'.'.rand(1,10000);
                $already_used = true;
            }else{
                $already_used = false;
            }
        }while($already_used);

        return $username;
    }

    public static function generate_partner_no(){
        do{
            $continue     = true;
            $generated_id = date('ym').rand(1000,9999);
            $check        = Partner::where('partner_no', $generated_id)->count();
            if($check == 0){
                $continue = false;
            }
        }while($continue);

        return $generated_id;
    }
    
    public static function component_request($rules, $var){
        $response = [];

        foreach($rules as $key => $value){
            $response[$key] = $var->$key;
        }

        return $response;
    }

    public static function auth_user_account(){
        if(Auth::check()){
            if(Auth::user()->type != 'admin'){
                return UserAccount::where('user_id', Auth::user()->id)->first();
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

    public static function generate_verification_expiration(int $minutes = 5){
        $time = ($minutes * 60) + time();
        return date('Y-m-d H:i:s', $time);
    }

    public static function is_date_time_expired($date_to, $current=null){
        if(!$current){
            $current = time();
        }else{
            $current = strtotime($current);
        }

        $date_to = strtotime($date_to);

        if($current < $date_to){
            return $date_to - $current;
        }else{
            return true;
        }
    }

    public static function mail_verification_code($user){
        $details = ['verification_code' => $user->verification_code];

        Mail::to($user->email)->send(new MailVerificationCheck($details));
        if(Mail::failures()){
            return false;
        }else{
            return true;
        }
    }

    public static function partner_activated(){
        $account = self::auth_user_account();
        $partner = Partner::where('user_account_id', $account->id)->first();

        if($partner){
            if($partner->is_activated){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
}