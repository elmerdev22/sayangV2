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
			->join('users', 'users.id', '=', 'user_accounts.user_id');
	
		$filtered = self::where($filter, $data);
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
}