<?php

namespace App\Http\Controllers\FrontEnd\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Order;
use Utility;

class OrderAndReceiptController extends Controller
{
    public function index(){
        return view('front-end.partner.order-and-receipt.index');
    }
    
    public function completed(){
        return view('front-end.partner.order-and-receipt.completed');
    }
    
    public function payment_confirmed(){
        return view('front-end.partner.order-and-receipt.payment-confirmed');
    }

    public function order_placed(){
        return view('front-end.partner.order-and-receipt.order-placed');
    }
    
    public function track($order_no){
        $order = Order::with(['billing'])
            ->where('orders.partner_id', Utility::auth_partner()->id)
            ->where('orders.order_no', $order_no)
            ->firstOrFail();

        return view('front-end.partner.order-and-receipt.track', compact('order'));
    }
}
