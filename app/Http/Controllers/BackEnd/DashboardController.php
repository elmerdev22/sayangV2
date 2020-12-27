<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Order;
use App\Model\Partner;
use App\Model\User;
use App\Model\ProductPost;
use QueryUtility;
use Utility;
class DashboardController extends Controller
{
    public function index(){
        $data = [
            'order_placed'       => self::orders('order_placed'),
            'to_receive'         => self::orders('to_receive'),
            'completed'          => self::orders('completed'),
            'cancelled'          => self::orders('cancelled'),
            'activated_partners' => self::partners('activated'),
            'pending_partners'   => self::partners('pending'),
            'blocked_partners'   => self::partners('blocked'),
            'verified_users'     => self::users(0),
            'blocked_users'      => self::users(1),
            'active_products'    => self::products('active'),
            'ended_products'     => self::products('done'),
            'cancelled_products' => self::products('cancelled'),
        ];
        return view('back-end.dashboard.index', compact('data'));
    }

    public function orders($status){

        return Order::where('status', $status)->count();

    }

    public function partners($type){
        $filter = [];
        
        $filter['where']['users.type'] = 'partner';

        if($type == 'activated' ){
            $filter['where']['partners.status']  = 'done';
        }
        else if($type == 'pending'){
            $filter['where']['partners.status']  = 'pending';
        }
        else if($type == 'blocked'){
            $filter['where']['users.is_blocked']  = 1;
        }
        
        return QueryUtility::partners($filter)->count();
        
    }

    public function users($status){

        return User::where('type','user')->where('is_blocked', $status)->count();

    }

    public function products($status){

        return ProductPost::where('status', $status)->count();

    }
}
