<?php

namespace App\Http\Controllers\FrontEnd\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderAndReceiptController extends Controller
{
    public function index(){
        return view('front-end.partner.order-and-receipt.index');
    }

    public function order($order_id){
        return view('front-end.partner.order-and-receipt.order');
    }
}
