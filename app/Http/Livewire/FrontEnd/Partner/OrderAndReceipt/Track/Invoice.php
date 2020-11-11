<?php

namespace App\Http\Livewire\FrontEnd\Partner\OrderAndReceipt\Track;

use Livewire\Component;
use App\Model\Order;
use App\Model\OrderItem;
use Utility;

class Invoice extends Component
{

    public $order_no;

    public function mount($order_no){
        $this->order_no = $order_no;
    }

    public function data(){
        return Order::with([
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
            ])
            ->where('order_no', $this->order_no)
            ->firstOrFail();
    }

    public function render(){
        $data        = $this->data();
        $order_total = Utility::order_total($data->id);

        return view('livewire.front-end.partner.order-and-receipt.track.invoice', compact('data', 'order_total'));
    }
}
