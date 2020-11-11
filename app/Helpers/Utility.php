<?php
namespace App\Helpers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Mail\VerificationCheck as MailVerificationCheck;
use App\Model\Cart;
use App\Model\Billing;
use App\Model\Order;
use App\Model\Bid;
use App\Model\Partner;
use App\Model\User;
use App\Model\UserAdmin;
use App\Model\UserAccount;
use App\Model\Product;
use App\Model\ProductPost;
use App\Model\Follower;
use App\Model\Setting;
use App\Model\ProductSubCategory;
use Carbon\Carbon;
use UploadUtility;
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

    public static function check_cart_item($product_post_id, $user_account_id=null){
        if($user_account_id === null){
            $user_account_id = self::auth_user_account()->id;
        }

        $cart = Cart::where('user_account_id', $user_account_id)
                ->where('product_post_id', $product_post_id)
                ->first();
        
        if($cart){
            return true;
        }else{
            return false;
        }
    }

    public static function total_cart_item($user_account_id=null){
        if($user_account_id === null){
            $user_account_id = self::auth_user_account()->id;
        }
        return Cart::where('user_account_id', $user_account_id)->sum('quantity');
    }

    public static function is_date_expired($from, $to){
        if(date('Y-m-d H:i:s', strtotime($from)) > date('Y-m-d H:i:s', strtotime($to))){
            return true;
        }else{
            return false;
        }
    }

    public static function product_post_status($product_post_id){
        $product_post     = ProductPost::find($product_post_id);
        $response         = 'not found';
        $current_datetime = date('Y-m-d H:i:s');

        if($product_post){
            if($product_post->status == 'cancelled'){
                $response = 'cancelled';
            }else if($product_post->status == 'done'){
                $response = 'ended';
            }else{
                $is_date_end_expired   = self::is_date_expired($current_datetime, $product_post->date_end);
                $is_date_start_expired = self::is_date_expired($current_datetime, $product_post->date_start);

                if(!$is_date_start_expired){
                    $response = 'pending';
                }else if($is_date_end_expired){
                    $response = 'ended';
                }else{
                    if($product_post->quantity > 0){
                        $response = 'active';
                    }else{
                        $response = 'sold out'; //or no quantity
                    }
                }
            }

        }

        return $response;
    }

    public static function cart($user_account_id, $is_checkout=false){
        $carts = Cart::with(['product_post', 'product_post.product', 'product_post.product.partner'])
                ->where('user_account_id', $user_account_id);

        if($is_checkout){
            $carts = $carts->whereHas('product_post', function($query){
                    $query->where('status', 'active');
                })
                ->where('is_checkout', true);
        }
        
        $carts    = $carts->get();

        $overall_total        = 0.00;
        $overall_total_price  = 0.00;
        $discount             = 0.00;
        $total_items          = 0;
        $total_quantity_items = 0;
        $products             = [];
        $data                 = [];

        foreach($carts as $row){
            $post_status    = self::product_post_status($row->product_post_id);
            $is_disabled    = false;
            
            if($post_status != 'active'){
                $is_disabled        = true;
                $carts->is_checkout = false;
                $carts->save();

                if($is_checkout){
                    continue;
                }
            }

            $total_items++;
            $is_new                = true;
            $partner_id            = $row->product_post->product->partner->id;
            $product_id            = $row->product_post->product->id;
            $date_start            = $row->product_post->date_start;
            $date_end              = $row->product_post->date_end;
            $buy_now_price         = $row->product_post->buy_now_price;
            $selected_quantity     = $row->quantity;
            $total_quantity_items += $selected_quantity;
            $total_price           = $selected_quantity * $buy_now_price;
            $overall_total        += $row->product_post->product->regular_price * $selected_quantity;
            $overall_total_price  += $total_price;
            $item_percentage       = self::price_percentage($row->product_post->product->regular_price, $row->product_post->buy_now_price);
            $discount             += $item_percentage['discount'] * $selected_quantity;

            $insert                = [];
            $insert                = [
                'partner_id'   => $partner_id,
                'partner_name' => $row->product_post->product->partner->name,
                'products'     => []
            ];

            $featured_photo = UploadUtility::product_featured_photo($row->product_post->product->partner->user_account->key_token, $row->product_post->product->key_token);

            $product = [
                'product_id'             => $product_id,
                'product_post_id'        => $row->product_post->id,
                'name'                   => $row->product_post->product->name,
                'is_checkout'            => $row->is_checkout,
                'is_disabled'            => $is_disabled,
                'featured_photo'         => $featured_photo[0]->getFullUrl('thumb'),
                'total_price'            => $total_price,
                'regular_price'          => $row->product_post->product->regular_price,
                'product_post_key_token' => $row->product_post->key_token,
                'product_slug'           => $row->product_post->product->slug,
                'buy_now_price'          => $buy_now_price,
                'lowest_price'           => $row->product_post->lowest_price,
                'date_start'             => $date_start,
                'date_end'               => $date_end,
                'current_quantity'       => $row->product_post->quantity,
                'selected_quantity'      => $selected_quantity == 0 ? 1 : $selected_quantity,
                'product_post_id'        => $row->product_post_id,
                'cart_id'                => $row->id,
                'cart_key_token'         => $row->key_token,
                'post_status'            => $post_status,
            ];

            $insert['products'][] = $product;
            $products[] = $product;

            if(!empty($data)){
                foreach($data as $exist_key => $exist_row){
                    if($exist_row['partner_id'] == $partner_id){
                        $is_new     = false;
                        $insert_key = $exist_key;
                        break;
                    }
                }
            }else{
                $is_new = true;
            }

            if($is_new){
                $data[] = $insert;
            }else{
                $data[$insert_key]['products'][] = $product;
            }
        }

        return [
            'total'                => $overall_total, //Not discounted
            'total_price'          => $overall_total_price, //discounted
            'total_items'          => $total_items, //Total Rows of Items
            'total_quantity_items' => $total_quantity_items, //Total sum of quantities
            'total_discount'       => $discount, //Total Discounts per item quantity
            'products'             => $products, //Array for list of products
            'partner_products'     => $data //Array for list of products with partner details
        ];
    }

    public static function generate_billing_no(){
        do{
            $continue     = true;
            $generated_id = 'BN'.date('ymd').'0'.rand(1000,9999);
            $check        = Billing::where('billing_no', $generated_id)->count();
            if($check == 0){
                $continue = false;
            }
        }while($continue);

        return $generated_id;
    }

    public static function generate_order_no(){
        do{
            $continue     = true;
            $generated_id = 'PN'.date('ymd').'0'.rand(1000,9999);
            $check        = Order::where('order_no', $generated_id)->count();
            if($check == 0){
                $continue = false;
            }
        }while($continue);

        return $generated_id;
    }

    public static function generate_bid_no(){
        do{
            $continue     = true;
            $generated_id = 'BN'.date('ymd').'0'.rand(1000,9999);
            $check        = Bid::where('bid_no', $generated_id)->count();
            if($check == 0){
                $continue = false;
            }
        }while($continue);

        return $generated_id;
    }
    
    public static function count_followers($partner_id){
        return Follower::where('partner_id', $partner_id)->count();
    }

    public static function price_percentage($number_1, $number_2){
        $number_1 = self::decimal_format($number_1);
        $number_2 = self::decimal_format($number_2);
        $response = [
            'discount'         => 0,
            'discount_percent' => 0,
            'percentage'       => 0
        ];

        if($number_1 > 0){
            if($number_1 >= $number_2){
                $percentage = round($number_2 / ($number_1 / 100),2);
                $response   = $percentage;
                $discount   = abs(100 - $percentage);
    
                $response = [
                    'discount'         => $number_1 - $number_2,
                    'discount_percent' => $discount + 0,
                    'percentage'       => $percentage + 0
                ];            
            }
        }

        return $response;
    }

    public static function order_total($order_id){
        $total_discount = 0;
        $sub_total      = 0;
        $total          = 0;

        $filter = [];
        $filter['select'] = [
            'order_items.quantity',
            'product_posts.buy_now_price',
            'products.regular_price'
        ];
        $filter['where']['order_items.order_id'] = $order_id;
        
        $data = QueryUtility::order_items($filter)->get();

        foreach($data as $row){
            $price_percentage  = self::price_percentage($row->regular_price, $row->buy_now_price);
            $total_discount   += $price_percentage['discount'] * $row->quantity;
            $sub_total        += $row->regular_price * $row->quantity;
            $total            += $row->buy_now_price * $row->quantity;
        }

        return [
            'total_discount' => $total_discount,   //item discount
            'sub_total'      => $sub_total,        //not discounted, overall regular price total
            'total'          => $total             //discounted
        ];
    }

    public static function str_starred($str){
        $str_length = strlen($str);
        $response   = '';
        
        if($str_length > 0){
            $response = substr($str, 0, 1).str_repeat('*', $str_length - 2).substr($str, $str_length - 1, 1);
        }

        return $response;
    }

    public static function settings($settings_key){
        $data = Setting::where('settings_key', $settings_key)->first();
        return $data->settings_value;
    }
}