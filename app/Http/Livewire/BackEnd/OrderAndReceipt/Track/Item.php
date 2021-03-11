<?php

namespace App\Http\Livewire\BackEnd\OrderAndReceipt\Track;

use Livewire\Component;
use App\Model\Order;
use App\Model\OrderItem;
use UploadUtility;

class Item extends Component
{
    public $order_no;

    public function mount($order_no){
        $this->order_no = $order_no;
    }

    public function data(){
        $order = Order::where('order_no', $this->order_no)->firstOrFail();

        return OrderItem::with([
                'product_post', 
                'product_post.product', 
                'product_post.product.partner.user_account'
            ])
            ->where('order_id', $order->id)
            ->get();
    }

    public function featured_photo($user_key_token, $product_key_token){
        $featured = UploadUtility::product_featured_photo($user_key_token, $product_key_token, true);
        return $featured;
    }

    public function render(){
        $data      = $this->data();
        $component = $this;

        return view('livewire.back-end.order-and-receipt.track.item', compact('data', 'component'));
    }
}
