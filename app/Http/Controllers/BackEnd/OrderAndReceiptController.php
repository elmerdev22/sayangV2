<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Order;

class OrderAndReceiptController extends Controller
{
    public function index(){
        return view('back-end.order-and-receipt.index');
    }

    public function track($order_no){
        $order = Order::where('order_no', $order_no)->firstOrFail();

        return view('back-end.order-and-receipt.track', compact('order'));
    }
}
