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

}