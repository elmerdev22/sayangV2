<?php

namespace App\Http\Controllers\FrontEnd\PrintPreview;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Order;
use Utility;
use Auth;

class InvoiceController extends Controller
{
    public function index($order_no){
        $user  = Auth::user();
        $order = Order::with([
            'billing',
            'order_payment', 
            'order_payment.bank', 
            'order_items', 
            'order_items.product_post', 
            'order_items.product_post.product',
            'partner',
            'partner.philippine_barangay',
            'partner.philippine_barangay.philippine_city',
            'partner.philippine_barangay.philippine_city.philippine_province',
            'partner.philippine_barangay.philippine_city.philippine_province.philippine_region',
        ]);
        
        if($user->type == 'user'){
            $order = $order->whereHas('billing', function ($query){
                $query->where('user_account_id', Utility::auth_user_account()->id);
            });
        }else if($user->type == 'partner'){
            $partner = Utility::auth_partner();
            $order   = $order->where('partner_id', $partner->id);
        }else if($user->type != 'admin'){
            abort(404);
        }

        $data        = $order->where('status', 'completed')->where('order_no', $order_no)->firstOrFail();
        $order_total = Utility::order_total($data->id);
        return view('front-end.print-preview.invoice', compact('data', 'order_total'));
    }
}
