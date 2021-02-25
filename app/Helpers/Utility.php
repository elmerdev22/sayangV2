<?php
namespace App\Helpers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Mail\EmailNotification;
use App\Mail\VerificationCheck as MailVerificationCheck;
use App\Model\Cart;
use App\Model\Billing;
use App\Model\Order;
use App\Model\OrderPaymentPayout;
use App\Model\OrderPaymentPayoutBatch;
use App\Model\Bid;
use App\Model\Partner;
use App\Model\User;
use App\Model\UserAdmin;
use App\Model\UserAccount;
use App\Model\Product;
use App\Model\ProductPost;
use App\Model\OrderItem;
use App\Model\Follower;
use App\Model\Setting;
use App\Model\ProductSubCategory;
use App\Model\EmailNotificationSetting;
use App\Model\DescriptionSetting;
use App\Model\Notification;
use App\Model\PartnerRating;
use App\Model\ImageSetting;
use Carbon\Carbon;
use UploadUtility;
use PaymentUtility;
use Schema;
use Mail;
use Auth;
use DB;

class Utility{

    public static function socialite_providers(){
        return ['google', 'facebook'];
    }
    
    public static function carbon_diff($date){
        return Carbon::parse($date)->diffForHumans();
    }
    
    public static function currency_code(){
        return '₱';
    }

    public static function error_message($type){
        $data = '';

        if($type == 'blocked_partner_error'){
            $data = 'Your account has been blocked. you cannot post a new product right now, please contact your administrator for further assistance. ';
        }

        return $data;
    }

    public static function img_source($type){
        if($type == 'not_found'){
            return 'https://image.freepik.com/free-vector/fixing-pages-found-system-error_45923-201.jpg';
        }else if($type == 'loading'){
            return asset('images/gif/loading.gif');
        }
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

    public static function table_foreign_keys($table){
    	$conn = Schema::getConnection()->getDoctrineSchemaManager();

		return array_map(function($key) {
			return $key->getName();
		}, $conn->listTableForeignKeys($table));
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

    public static function is_product_post_cancellable($id){
        //condition TBA
        $order_item_count = OrderItem::where('product_post_id', $id)->count();
        $bid_count        = Bid::where('product_post_id', $id)->count();
        $cart_count       = Cart::where('product_post_id', $id)->count();
        
        return $order_item_count > 0 || $bid_count > 0 || $cart_count > 0  ? false : true;
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

        
    public static function is_partner_ratetable($user_account_id, $partner_id, $order_id){
        //condition TBA
        $count = PartnerRating::where('user_account_id', $user_account_id)
                ->where('partner_id', $partner_id)
                ->where('order_id', $order_id)
                ->count();
                
        return $count > 0 ? false : true;
    }

    public static function get_partner_ratings($partner_id){
        
        $data  = [1, 2, 3, 4, 5];
        $stars = [];
        foreach($data as $star){
            $count = PartnerRating::where('partner_id', $partner_id)->where('star', $star)->count();
            $stars[$star] = $count;
        }
        if(array_sum($stars) == 0){
            return "No Ratings";
        }
        else{
            $data = ((5*$stars[5])+(4*$stars[4])+(3*$stars[3])+(2*$stars[2])+(1*$stars[1])) / ($stars[5]+$stars[4]+$stars[3]+$stars[2]+$stars[1]);
            return number_format($data, 1);
        }
        
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
                $row->is_checkout = false;
                $row->save();

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

    public static function generate_payout_batch_no(){
        do{
            $continue     = true;
            $generated_id = 'PYB'.date('ymd').rand(1000,9999);
            $check        = OrderPaymentPayoutBatch::where('batch_no', $generated_id)->count();
            if($check == 0){
                $continue = false;
            }
        }while($continue);

        return $generated_id;
    }

    public static function generate_payout_no(){
        do{
            $continue     = true;
            $generated_id = 'PY'.date('ymd').rand(1000,9999);
            $check        = OrderPaymentPayout::where('payout_no', $generated_id)->count();
            if($check == 0){
                $continue = false;
            }
        }while($continue);

        return $generated_id;
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
            $generated_id = 'BN'.date('ymd').'0'.rand(100000,999999);
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

    public static function count_products($partner_id, $status = 'active'){
        return DB::table('product_posts')
                ->join('products', 'products.id', '=', 'product_posts.product_id')
                ->where('products.partner_id', $partner_id)
                ->where('product_posts.status', $status)
                ->count();
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
                    'discount_percent' => number_format($discount + 0 , 0),
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
            // 'product_posts.buy_now_price',
            'order_items.price as buy_now_price',
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

    public static function str_starred($str, $per_char=4){
        $str_length = strlen($str);
        $response   = $str;
        
        if($str_length > $per_char){
            $response = $masked =  str_pad(substr($str, -$per_char), strlen($str), '*', STR_PAD_LEFT);
        }

        return $response;
    }

    public static function settings($settings_key){
        $data = Setting::where('settings_key', $settings_key)->first();
        return $data->settings_value;
    }

    public static function email_notification_settings($settings_key){
        $data = EmailNotificationSetting::where('settings_key', $settings_key)->first();
        return $data;
    }

    public static function bid_details($product_post_id, $type){
        $data = Bid::where('product_post_id', $product_post_id);

        if($type == 'count'){
            return $data->count();
        }
        else if($type == 'top'){
            $top =  $data->max('bid');
            return $top <= 0 ? 'None' : number_format($top, 2) ;
        }
    }

    public static function send_notification($email_notification_details, $email){
        \Mail::to($email)->send(new EmailNotification($email_notification_details));
    }

    public static function email_notification_details($settings_key, $url_link){

        $data = [
            'subject'  => self::email_notification_settings($settings_key)->subject,
            'message'  => self::email_notification_settings($settings_key)->message,
            'url_link' => $url_link,
        ];

        return $data;
    }

    public static function new_notification($user_account_id, $product_post_id, $settings_key, $notification_type){
        
            $notif                    = new Notification();
            $notif->user_account_id   = $user_account_id;
            $notif->product_post_id   = $product_post_id;
            $notif->type              = $settings_key;
            $notif->notification_type = $notification_type;
            $notif->save();
    }

    public static function notification_check($user_account_id, $product_post_id, $settings_key, $notification_type){
        
        $data = Notification::where('user_account_id', $user_account_id)
                ->where('product_post_id', $product_post_id)
                ->where('type', $settings_key)
                ->where('notification_type', $notification_type)
                ->count();

        if($data == 0){
            $notif                    = new Notification();
            $notif->user_account_id   = $user_account_id;
            $notif->product_post_id   = $product_post_id;
            $notif->type              = $settings_key;
            $notif->notification_type = $notification_type;
            $notif->save();
            $data = true;
        }
        else{
            $data = false;
        }

        return $data;
    }

    public static function order_can_repay($order_id){
        $order_items = OrderItem::with(['product_post'])->where('order_id', $order_id)->get();
        $repay       = true;
        
        foreach($order_items as $row){
            $status = self::product_post_status($row->product_post_id);
            if($status == 'active'){
                if($row->product_post->quantity >= $row->quantity){
                    continue;
                }else{
                    $repay = false;
                    break;
                }
            }else{
                $repay = false;
                break;
            }
        }

        return $repay;
    }

    public static function sayang_commission($total_amount, int $commission_percentage=null){
        if($commission_percentage == null){
            $commission_percentage = PaymentUtility::commission_percentage();
        }

        $total_commission = round($commission_percentage * ($total_amount / 100), 2);

        return [
            'commission_percentage' => $commission_percentage,
            'total_amount'          => $total_amount,
            'total_commission'      => $total_commission,
            'net_amount'            => $total_amount - $total_commission
        ];
    }
    
    public static function order_payout_total_orders($payout_id){
        return DB::table('order_payment_payout_items')->where('order_payment_payout_id', $payout_id)->count();
    }

    public static function description_settings($settings_key){
        return DescriptionSetting::where('settings_key', $settings_key)->first();
    }

    public static function home_background_random(){
        
        $data = ImageSetting::inRandomOrder()->where('settings_group', 'home_bg_image')->where('is_display', true)->first();
        return UploadUtility::image_setting($data->id, 'home-bg-image');
    }

    public static function days(){
        return [
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
            7 => 'Sunday',
        ];
    }

    public static function store_hours()
    {
        $response = [
            'is_set'     => false,
            'open_time'  => '',
            'close_time' => '',
            'status'     => '',
        ];  

        $partner         = self::auth_partner();
        $data            = Partner::with(['operating_hours'])->where('id', $partner->id)->first();
        $operating_hours = $data->operating_hours->where('day', date('w'))->first();
        
        if($operating_hours){
            if($operating_hours->status){
                $response['is_set'] = true;
            }
            
            $response['open_time']  = date('h:i a', strtotime($operating_hours->open_time));
            $response['close_time'] = date('h:i a', strtotime($operating_hours->close_time));
            
            $currentTime = Carbon::now();

            if($currentTime->between($operating_hours->open_time, $operating_hours->close_time, true)){
                $response['status'] = 'Open now';
            }else{
                $response['status'] = 'Close now';
            }
        }

        return $response;
    }
}