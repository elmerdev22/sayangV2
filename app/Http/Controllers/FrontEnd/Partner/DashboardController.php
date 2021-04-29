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
        $decimal_places = Utility::settings('elements_round_off');
        $elements       = Utility::rescued_elements_computation('partner');

        $data = [
            'order_placed'             => self::data('order_placed'),
            'to_receive'               => self::data('to_receive'),
            'completed'                => self::data('completed'),
            'cancelled'                => self::data('cancelled'),
            'total_followers'          => Utility::count_followers(self::partner()->id),
            'total_products_active'    => Utility::count_products(self::partner()->id, 'active'),
            'total_products_ended'     => Utility::count_products(self::partner()->id, 'done'),
            'total_products_cancelled' => Utility::count_products(self::partner()->id, 'cancelled'),
            'element_trees'            => number_format($elements['trees'], $decimal_places),
            'element_water'            => number_format($elements['water'], $decimal_places),
            'element_energy'           => number_format($elements['energy'], $decimal_places),
        ];


        return view('front-end.partner.dashboard.index', compact('data','elements'));
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
        
        if($status == 'order_placed'){
            $filter['where']['order_payments.payment_method'] = 'cash_on_pickup';
        }

		return QueryUtility::orders($filter)->count();
    }
}
