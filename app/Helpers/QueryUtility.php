<?php
namespace App\Helpers;

use DB;
use App\Model\Notification;
class QueryUtility{

    private static function where($filter, $data){
		if(isset($filter['where'])){
			$data = $data->where($filter['where']);
			
			return $data;
		}else{
			return false;
		}
	}

	private static function where_not($filter, $data){
		if(isset($filter['where_not'])){
			foreach($filter['where_not'] as $key => $value){
				$data = $data->where($value['field'], '!=', $value['value']);
			}
			return $data;
		}
	}
	
    private static function where_not_null($filter, $data){
		if(isset($filter['where_not_null'])){
			$data = $data->whereNotNull($filter['where_not_null']);
			
			return $data;
		}else{
			return false;
		}
	}

	private static function where_in($filter, $data){
		if(isset($filter['where_in'])){
			foreach($filter['where_in'] as $key => $value){
				$data = $data->whereIn($value['field'], $value['values']);
			}

			return $data;
		}else{
			return false;
		}
	}

	private static function date_range($filter, $data){
		if(isset($filter['date_range'])){
			foreach($filter['date_range'] as $key => $date){
				$from       = $date['from'].' 00:00:00';
				$to       	= $date['to'].' 23:59:59';
				$data       = $data->whereRaw($date['field']." >= ? AND ".$date['field']." <=?",[$from,$to]);
			}

			return $data;
		}else{
			return false;
		}
	}

	private static function date_range_two_field($filter, $data){
		if(isset($filter['date_range_two_field'])){
			foreach($filter['date_range_two_field'] as $key => $date){
				$data = $data->whereRaw($date['field_from']." <= ? AND ".$date['field_to']." >=?",[$date['date'], $date['date']]);
			}

			return $data;
		}else{
			return false;
		}
	}

	private static function value_between_min_max($filter, $data){
		if(isset($filter['value_between_min_max'])){
			foreach($filter['value_between_min_max'] as $key => $row){
				$data = $data->where($row['field'], '>=', $row['min'])->where($row['field'], '<=', $row['max']);
			}

			return $data;
		}else{
			return false;
		}
	}

	private static function where_one_to_many_rows($filter, $data){
		if(isset($filter['where_one_to_many_rows'])){
			foreach($filter['where_one_to_many_rows'] as $filter_row){
				$data= $data->whereExists(function($query) use ($filter_row){
					$query->select([DB::raw(1)])
						->from($filter_row['foreign_table'])
						->whereIn($filter_row['foreign_table'].'.'.$filter_row['where_key'], $filter_row['values']);
				});
			}

			return $data;
		}else{
			return false;
		}
	}

	private static function order_by_raw($filter, $data){
		if(isset($filter['order_by'])){
			$data = $data->orderByRaw($filter['order_by']);
			
			return $data;
		}else{
			return false;
		}
	}

    public static function region_provinces(array $filter = []){
		if(isset($filter['select'])){
			$select = $filter['select'];
		}else{
			$select = '*';
		}

		$data = DB::table('region_provinces')
				->select($select);

		$filtered = self::where($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::date_range($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::order_by_raw($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		return $data;
	}

	public static function cities(array $filter = []){
		if(isset($filter['select'])){
			$select = $filter['select'];
		}else{
			$select = '*';
		}

		$data = DB::table('cities')
			->select($select)
			->join('region_provinces', 'region_provinces.id', '=', 'cities.region_province_id');

		$filtered = self::where($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::date_range($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::order_by_raw($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		return $data;
	}

	public static function user_accounts(array $filter = []){
		if(isset($filter['select'])){
			$select = $filter['select'];
		}else{
			$select = '*';
		}
		$data = DB::table('user_accounts')
			->select($select)
			->join('users', 'users.id', '=', 'user_accounts.user_id');
	
		$filtered = self::where($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::where_not_null($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		if(isset($filter['or_where_like'])){
			$search = trim($filter['or_where_like']);
			$search = explode(' ',$search);
			$data = $data->where(function($query) use ($search) {
				foreach($search as $value){
					$query->orWhere('user_accounts.first_name','like',"%{$value}%")
						->orWhere('user_accounts.last_name','like',"%{$value}%")
						->orWhere('user_accounts.middle_name','like',"%{$value}%")
						->orWhere('users.email','like',"%{$value}%")
						->orWhere('users.name','like',"%{$value}%");
				}
            });
		}
		
		$filtered = self::where_in($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::date_range($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::order_by_raw($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		return $data;
	}
	
	public static function partners(array $filter = []){
		if(isset($filter['select'])){
			$select = $filter['select'];
		}else{
			$select = '*';
		}

		$data = DB::table('user_accounts')
			->select($select)
			->leftJoin('partners', 'partners.user_account_id', '=', 'user_accounts.id')
			->leftJoin('users', 'users.id', '=', 'user_accounts.user_id')
			->leftJoin('partner_representatives', 'partner_representatives.partner_id', '=', 'partners.id')
			->leftJoin('philippine_barangays', 'philippine_barangays.id', '=', 'partners.barangay_id')
			->leftJoin('philippine_cities', 'philippine_cities.id', '=', 'philippine_barangays.city_id')
			->leftJoin('philippine_provinces', 'philippine_provinces.id', '=', 'philippine_cities.province_id')
			->leftJoin('philippine_regions', 'philippine_regions.id', '=', 'philippine_provinces.region_id');
		

		$filtered = self::where($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		if(isset($filter['or_where_like'])){
			$search = trim($filter['or_where_like']);
			$search = explode(' ',$search);
			$data = $data->where(function($query) use ($search) {
				foreach($search as $value){
					$query->orWhere('partners.name','like',"%{$value}%")
						->orWhere('partners.email','like',"%{$value}%")
						->orWhere('partners.contact_no','like',"%{$value}%")
						->orWhere('partners.tin','like',"%{$value}%")
						->orWhere('partners.partner_no','like',"%{$value}%")
						->orWhere('partners.dti_registration_no','like',"%{$value}%")
						->orWhere('user_accounts.first_name','like',"%{$value}%")
						->orWhere('user_accounts.last_name','like',"%{$value}%")
						->orWhere('user_accounts.middle_name','like',"%{$value}%")
						->orWhere('users.email','like',"%{$value}%")
						->orWhere('users.name','like',"%{$value}%")
						->orWhere('philippine_barangays.name','like',"%{$value}%")
						->orWhere('philippine_cities.name','like',"%{$value}%")
						->orWhere('philippine_provinces.name','like',"%{$value}%")
						->orWhere('philippine_regions.name','like',"%{$value}%");
				}
            });
		}

		$filtered = self::where_in($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::date_range($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::order_by_raw($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		return $data;
	}

	public static function products(array $filter = []){
		if(isset($filter['select'])){
			$select = $filter['select'];
		}else{
			$select = '*';
		}
		$data = DB::table('products')
			->select($select)
			->join('categories', 'categories.id', '=', 'products.category_id')
			->join('partners', 'partners.id', '=', 'products.partner_id');
	
		$filtered = self::where($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		if(isset($filter['or_where_like'])){
			$search = trim($filter['or_where_like']);
			$search = explode(' ',$search);
			$data 	= $data->where(function($query) use ($search) {
				foreach($search as $value){
					$query->orWhere('products.name','like',"%{$value}%")
						->orWhere('products.description','like',"%{$value}%")
						->orWhere('products.reminders','like',"%{$value}%")
						->orWhere('products.slug','like',"%{$value}%")
						->orWhere('categories.name','like',"%{$value}%")
						->orWhere('partners.partner_no','like',"%{$value}%")
						->orWhere('partners.name','like',"%{$value}%")
						->orWhere('partners.address','like',"%{$value}%");
				}
            });
		}

		$filtered = self::where_in($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::date_range($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::order_by_raw($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		return $data;
	}

	public static function product_posts(array $filter = []){
		if(isset($filter['select'])){
			$select = $filter['select'];
		}else{
			$select = '*';
		}
		$data = DB::table('product_posts')
			->select($select)
			->join('products', 'products.id', '=', 'product_posts.product_id')
			->leftJoin('partners', 'partners.id', '=', 'products.partner_id')
			->leftJoin('product_sub_categories', 'product_sub_categories.product_id', '=', 'products.id')
			->leftJoin('user_accounts', 'user_accounts.id', '=', 'partners.user_account_id')
			->leftJoin('users', 'users.id', '=', 'user_accounts.user_id')
			->leftJoin('philippine_barangays as partner_barangays', 'partner_barangays.id', '=', 'partners.barangay_id')
			->leftJoin('philippine_cities as partner_cities', 'partner_cities.id', '=', 'partner_barangays.city_id')
			->leftJoin('philippine_provinces as partner_provinces', 'partner_provinces.id', '=', 'partner_cities.province_id')
			->leftJoin('philippine_regions as partner_regions', 'partner_regions.id', '=', 'partner_provinces.region_id');
		

		if(isset($filter['limit'])){
			$data = $data->limit($filter['limit']);
		}

		if(isset($filter['available_quantity'])){
			$data = $data->where('product_posts.quantity', '>', 0);
		}

		$filtered = self::where($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		if(isset($filter['where_date_end_expired'])){
			if($filter['where_date_end_expired']){
				$data = $data->where('product_posts.date_end', '<=', $filter['where_date_end_expired']);
			}
		}

		if(isset($filter['or_where_like'])){
			$search = trim($filter['or_where_like']);
			$search = explode(' ',$search);
			$data 	= $data->where(function($query) use ($search) {
				foreach($search as $value){
					$query->orWhere('products.name','like',"%{$value}%")
						->orWhere('product_posts.buy_now_price','like',"%{$value}%")
						->orWhere('product_posts.lowest_price','like',"%{$value}%")
						->orWhere('product_posts.quantity','like',"%{$value}%")
						->orWhere('partners.address','like',"%{$value}%")
						->orWhere('partner_barangays.name','like',"%{$value}%")
						->orWhere('partner_cities.name','like',"%{$value}%")
						->orWhere('partner_provinces.name','like',"%{$value}%")
						->orWhere('partner_regions.name','like',"%{$value}%");
				}
            });
		}

		if(isset($filter['categories'])){
			if(!empty($filter['categories'])){
				if(isset($filter['categories']['categories']) && isset($filter['categories']['sub_categories'])){
					$categories     = $filter['categories']['categories'];
					$sub_categories = $filter['categories']['sub_categories'];
					$data = $data->whereExists(function ($query) use ($categories, $sub_categories){
							$query = $query->select(DB::raw(1))
								->from('product_sub_categories')
								->whereRaw('products.id = product_sub_categories.product_id');
							
							if(!empty($sub_categories)){
								$query = $query->whereIn('product_sub_categories.sub_category_id', $sub_categories);
							}
							
							if(!empty($categories)){
								if(!empty($sub_categories)){
									$query = $query->orWhereIn('products.category_id', $categories);
								}else{
									$query = $query->whereIn('products.category_id', $categories);
								}
							}
							
							
					});
				}
			}
		}
		
		$filtered = self::value_between_min_max($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::where_in($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::where_not($filter, $data);
		if($filtered){
			$data = $filtered;
		}
		
		$filtered = self::date_range($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::date_range_two_field($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::order_by_raw($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		return $data;
	}

	
	public static function bids(array $filter = []){
		if(isset($filter['select'])){
			$select = $filter['select'];
		}else{
			$select = '*';
		}
		$data = DB::table('bids')
			->select($select)
			->join('product_posts', 'product_posts.id', '=', 'bids.product_post_id')
			->join('products', 'products.id', '=', 'product_posts.product_id')
			->leftJoin('order_bids', 'order_bids.bid_id', '=', 'bids.id')
			->leftJoin('orders', 'orders.id', '=', 'order_bids.order_id')
			->leftJoin('order_payments', 'order_payments.order_id', '=', 'orders.id')
			->leftJoin('order_payment_logs', 'order_payment_logs.order_payment_id', '=', 'order_payments.id');
		
		if(isset($filter['limit'])){
			$data = $data->limit($filter['limit']);
		}

		$filtered = self::where($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		if(isset($filter['or_where_like'])){
			$search = trim($filter['or_where_like']);
			$search = explode(' ',$search);
			$data 	= $data->where(function($query) use ($search) {
				foreach($search as $value){
					$query->orWhere('products.name','like',"%{$value}%");
				}
            });
		}

		$filtered = self::where_in($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::date_range($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::date_range_two_field($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::order_by_raw($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		return $data;
	}

	public static function orders(array $filter = []){
		if(isset($filter['select'])){
			$select = $filter['select'];
		}else{
			$select = '*';
		}
		$data = DB::table('orders')
			->select($select)
			->join('billings', 'billings.id', '=', 'orders.billing_id')
			->join('partners', 'partners.id', '=', 'orders.partner_id')
			->leftJoin('user_accounts as partner_accounts', 'partner_accounts.id', '=', 'partners.user_account_id')
			->leftJoin('order_items', 'order_items.order_id', '=', 'orders.id')
			->leftJoin('order_payments', 'order_payments.order_id', '=', 'orders.id')
			->leftJoin('order_payment_logs', 'order_payment_logs.order_payment_id', '=', 'order_payments.id')
			->leftJoin('order_payment_payout_items', 'order_payment_payout_items.order_payment_id', '=', 'order_payments.id')
			->leftJoin('order_payment_payouts', 'order_payment_payouts.id', '=', 'order_payment_payout_items.order_payment_payout_id')
			->leftJoin('user_accounts', 'user_accounts.id', '=', 'billings.user_account_id');
		
		if(isset($filter['limit'])){
			$data = $data->limit($filter['limit']);
		}

		$filtered = self::where($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::where_not($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		if(isset($filter['or_where_like'])){
			$search = trim($filter['or_where_like']);
			$search = explode(' ',$search);
			$data 	= $data->where(function($query) use ($search) {
				foreach($search as $value){
					$query->orWhere('orders.order_no','like',"%{$value}%")
						->orWhere('orders.qr_code','like',"%{$value}%")
						->orWhere('orders.status','like',"%{$value}%")
						->orWhere('orders.note','like',"%{$value}%")
						->orWhere('partners.partner_no','like',"%{$value}%")
						->orWhere('partners.name','like',"%{$value}%");
				}
            });
		}

		$filtered = self::where_in($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::date_range($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::date_range_two_field($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::order_by_raw($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		return $data;
	}

	public static function order_items(array $filter = []){
		if(isset($filter['select'])){
			$select = $filter['select'];
		}else{
			$select = '*';
		}
		$data = DB::table('order_items')
			->select($select)
			->join('product_posts', 'product_posts.id', '=', 'order_items.product_post_id')
			->join('orders', 'orders.id', '=', 'order_items.order_id')
			->leftJoin('products', 'products.id', '=', 'product_posts.product_id')
			->leftJoin('order_bids', 'order_bids.order_id', '=', 'orders.id');
		
		if(isset($filter['limit'])){
			$data = $data->limit($filter['limit']);
		}

		$filtered = self::where($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::where_in($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::date_range($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::date_range_two_field($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::order_by_raw($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		return $data;
	}

	public static function notifications($user_account_id, $notification_type = null){
		
		$data = Notification::with(['product_post.product.partner.user_account','web_notification_settings'])
                ->where('user_account_id', $user_account_id)
				->orderBy('created_at','desc');

		if($notification_type != null){
			$data->where('notification_type', $notification_type);

			return $data->paginate(10);
		}
		else{
			$data->where('is_read', 0);

			return $data->get();
		}

	}

	public static function order_payment_payouts(array $filter = []){
		if(isset($filter['select'])){
			$select = $filter['select'];
		}else{
			$select = '*';
		}

		$data = DB::table('order_payment_payouts')
			->select($select)
			->join('order_payment_payout_batches', 'order_payment_payout_batches.id', '=', 'order_payment_payouts.payout_batch_id')
			->join('partners', 'partners.id', '=', 'order_payment_payouts.partner_id')
			->leftJoin('user_accounts as partner_accounts', 'partner_accounts.id', '=', 'partners.user_account_id');
		
		if(isset($filter['limit'])){
			$data = $data->limit($filter['limit']);
		}

		$filtered = self::where($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::where_in($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::date_range($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::date_range_two_field($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::order_by_raw($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		return $data;
	}

	public static function order_payment_payout_batches(array $filter = []){
		if(isset($filter['select'])){
			$select = $filter['select'];
		}else{
			$select = '*';
		}

		$data = DB::table('order_payment_payout_batches')
			->select($select);
		
		if(isset($filter['limit'])){
			$data = $data->limit($filter['limit']);
		}

		$filtered = self::where($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::where_in($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::date_range($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::date_range_two_field($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		$filtered = self::order_by_raw($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		return $data;
	}
}