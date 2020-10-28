<?php
namespace App\Helpers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Mail\VerificationCheck as MailVerificationCheck;
use App\Model\Partner;
use App\Model\User;
use App\Model\UserAdmin;
use App\Model\UserAccount;
use App\Model\Product;
use App\Model\ProductPost;
use App\Model\ProductSubCategory;
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
        $text          = strtolower($text);
        $original_text = $text;
        
        //Validate if exists
        $check = false;

        $times = 0;
        $model_string = 'App\\Model\\'.ucfirst($model_string);

        do{
            $times++;
            $model      = new $model_string();
            $check_slug = $model::where($key, $text)->count();

            if($check_slug > 0){
                $text         = $original_text.'-'.$times;
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

    public static function auth_user_admin(){
        if(Auth::check()){
            if(Auth::user()->type == 'admin'){
                return UserAdmin::where('user_id', Auth::user()->id)->first();
            }else{
                return null;
            }
        }else{
            return null;
        }
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

    public static function auth_partner(){
        if(Auth::check()){
            if(Auth::user()->type != 'admin'){
                if(self::partner_activated()){
                    $account = self::auth_user_account();
                    return Partner::select([
                            'partners.*',
                            'partners.id as partner_id',
                            'partners.key_token as partner_key_token',
                            'partner_representatives.first_name as representative_first_name',
                            'partner_representatives.last_name as representative_last_name',
                            'partner_representatives.designation as representative_designation',
                            'partner_representatives.email as representative_email',
                            'partner_representatives.contact_no as representative_contact_no',
                            'partner_representatives.uploaded_id_file as representative_uploaded_id_file',
                            'partner_representatives.uploaded_id_file_name as representative_uploaded_id_file_name',
                            'partner_representatives.key_token as representative_key_token',
                            'philippine_barangays.name as barangay_name',
                            'philippine_cities.name as city_name',
                            'philippine_provinces.name as province_name',
                            'philippine_regions.name as region_name'
                        ])
                        ->leftJoin('partner_representatives', 'partner_representatives.partner_id', '=', 'partners.id')
                        ->leftJoin('philippine_barangays', 'philippine_barangays.id', '=', 'partners.barangay_id')
                        ->leftJoin('philippine_cities', 'philippine_cities.id', '=', 'philippine_barangays.city_id')
                        ->leftJoin('philippine_provinces', 'philippine_provinces.id', '=', 'philippine_cities.province_id')
                        ->leftJoin('philippine_regions', 'philippine_regions.id', '=', 'philippine_provinces.region_id')
                        ->where('partners.user_account_id', $account->id)
                        ->first();
                }else{
                    return null;
                }
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

    public static function partner_full_address($partner_id){
        $partner = Partner::select([
                'partners.address',
                'philippine_barangays.name as barangay_name',
                'philippine_cities.name as city_name',
                'philippine_provinces.name as province_name',
                'philippine_regions.name as region_name'
            ])
            ->where('partners.id', $partner_id)
            ->leftJoin('philippine_barangays', 'philippine_barangays.id', '=', 'partners.barangay_id')
            ->leftJoin('philippine_cities', 'philippine_cities.id', '=', 'philippine_barangays.city_id')
            ->leftJoin('philippine_provinces', 'philippine_provinces.id', '=', 'philippine_cities.province_id')
            ->leftJoin('philippine_regions', 'philippine_regions.id', '=', 'philippine_provinces.region_id')
            ->first();
        
        if($partner){
            $response = '';
            if($partner->address){
                $response  .= $partner->address.', ';
            }

            $response .= ucwords(strtolower($partner->barangay_name.', '.$partner->city_name.', '.$partner->province_name.', '));

            $response .= $partner->region_name;
        }else{
            $response = null;
        }

        return ucwords($response);
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

    public static function mobile_number_ph_format($no){
        if(!empty($no)){
            if($no[0] == 9){
                return '(+63)'.$no;
            }else if($no[0] == 0){
                $no = substr($no, 1);
                return '(+63)'.$no;
            }else{
                return $no;
            }
        }else{
            return null;
        }
    }

    public static function datatables_show_entries(){
        return ['10', '25', '50', '100', '300', '500', '1000'];
    }

    public static function top_nav_validate_auth_verify(){
        if(Auth::check()){
            $type        = Auth::user()->type;
            $is_verified = Auth::user()->verified_at;

            if($type != 'admin'){
                if($type == 'partner'){
                    if($is_verified){
                        $continue = true;
                    }else{
                        $continue = false;
                    }

                    if($continue){
                        if(self::partner_activated()){
                            return true;
                        }else{
                            return false;
                        }
                    }else{
                        return false;
                    }
                }else{
                    if($is_verified){
                        return true;
                    }else{
                        return false;
                    }
                }
            }else{
                return true;
            }
        }else{
            return true;
        }
    }
    
    public static function decimal_format($value, $places=2){
        if($value == ''){
            $value = 0.00;
        }

        return str_replace(',', '', $value);
    }

    public static function is_product_deletable($id){
        //condition TBA
        $count = ProductPost::where('product_id', $id)->count();
        return $count > 0 ? false : true;
    }

    public static function is_category_deletable($id){
        //condition TBA
        $count = Product::where('category_id', $id)->count();
        return $count > 0 ? false : true;
    }

    public static function is_subcategory_deletable($id){
        //condition TBA
        $count = ProductSubCategory::where('sub_category_id', $id)->count();
        return $count > 0 ? false : true;
    }

    public static function allow_purchase(){
        if(Auth::check()){
            $user      = Auth::user();
            $user_type = $user->type;
            if($user_type == 'user'){
                if(!$user->verified_at){
                    $allow_purchase = 'not_verified';
                }else{
                    $allow_purchase = 'allowed';
                }
            }else{
                $allow_purchase = 'not_allowed';
            }
        }else{
            $allow_purchase = 'login';
        }

        return $allow_purchase;
    }

}