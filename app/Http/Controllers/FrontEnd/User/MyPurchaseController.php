<?php

namespace App\Http\Controllers\FrontEnd\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Order;
use Utility;

class MyPurchaseController extends Controller
{
    // My Purchase
    public function list(){
        return view('front-end.user.my-purchase.list');
    }
    
    public function track($order_no){
        $order = Order::with(['billing'])
            ->whereHas('billing', function ($query){
                $query->where('user_account_id', Utility::auth_user_account()->id);
            })
            ->where('orders.order_no', $order_no)
            ->firstOrFail();
            
        $order_date = $order->created_at;

        return view('front-end.user.my-purchase.track', compact('order_no', 'order_date', 'order'));
    }

    // Order Placed
    public function order_placed(){
        return view('front-end.user.my-purchase.order-placed');
    }
    // To Receive
    public function to_receive(){
        return view('front-end.user.my-purchase.to-receive');
    }
    // Cancelled
    public function cancelled(){
        return view('front-end.user.my-purchase.cancelled');
    }
    // Completed
    public function completed(){
        return view('front-end.user.my-purchase.completed');
    }
}
