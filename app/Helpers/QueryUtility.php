<?php
namespace App\Helpers;

use DB;

class QueryUtility{

    private static function where($filter, $data){
		if(isset($filter['where'])){
			$data = $data->where($filter['where']);
			
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
			->join('users', 'users.id', '=', 'user_accounts.user_id')
			->leftjoin('partners', 'partners.user_account_id', '=', 'user_accounts.id')
			->leftjoin('cities', 'cities.id', '=', 'user_accounts.city_id')
			->leftjoin('cities as partner_city', 'partner_city.id', '=', 'partners.city_id');
	
		$filtered = self::where($filter, $data);
		if($filtered){
			$data = $filtered;
		}
		if(isset($filter['search'])){
			$search = trim($filter['search']);
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

		$data = DB::table('partners')
			->select($select)
			->join('user_accounts', 'user_accounts.id', '=', 'partners.user_account_id')
			->leftjoin('cities', 'cities.id', '=', 'partners.city_id')
			->leftjoin('region_provinces', 'region_provinces.id', '=', 'cities.region_province_id');
	
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

		$filtered = self::order_by_raw($filter, $data);
		if($filtered){
			$data = $filtered;
		}

		return $data;
	}

}