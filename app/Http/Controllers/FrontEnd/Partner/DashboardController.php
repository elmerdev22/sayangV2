<?php

namespace App\Http\Controllers\FrontEnd\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Order;
use QueryUtility;
use Utility;
class DashboardController extends Controller
{
    public function index(){
        $data = [
            'order_placed'    => self::data('order_placed'),
            'to_receive'      => self::data('to_receive'),
            'completed'       => self::data('completed'),
            'cancelled'       => self::data('cancelled'),
            'total_followers' => Utility::count_followers(self::partner()->id),
            'total_products'  => Utility::count_products(self::partner()->id),
        ];

        return view('front-end.partner.dashboard.index', compact('data'));
    }

    public function partner(){
        return Utility::auth_partner();
    }

    public function data($status){
        
        $partner = self::partner();

		$filter = [];
		$filter['select'] = [
			'orders.*', 
        ];
        
		$filter['where']['orders.partner_id'] = $partner->id;
		$filter['where']['orders.status']     = $status;

		return QueryUtility::orders($filter)->count();
    }
}
