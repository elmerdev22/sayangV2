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
    
    public function cancelled(){
        return view('front-end.partner.order-and-receipt.cancelled');
    }
    
    public function track($order_no){
        $order = Order::with(['billing', 'order_payment'])
            ->where('orders.partner_id', Utility::auth_partner()->id)
            ->where('orders.order_no', $order_no)
            ->firstOrFail();

        $is_cancellable          = false;
        $is_payment_confirmable = false;
   
        if($order->order_payment->payment_method == 'cash_on_pickup'){
            if($order->status == 'order_placed'){
                $is_payment_confirmable = true;
                $is_cancellable         = true;
            }
        }else if($order->status == 'order_placed'){
            $is_cancellable = true;
        }

        return view('front-end.partner.order-and-receipt.track', compact('order', 'is_cancellable', 'is_payment_confirmable'));
    }
}
