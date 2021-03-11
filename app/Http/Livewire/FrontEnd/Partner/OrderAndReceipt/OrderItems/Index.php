<?php

namespace App\Http\Livewire\FrontEnd\Partner\OrderAndReceipt\OrderItems;

use Livewire\Component;
use App\Model\Order;
use App\Model\OrderItem;
use UploadUtility;

class Index extends Component
{
    public $order_no;

    protected $listeners = [
        'initialize_order_items' => 'initialize'
    ];

    public function initialize($data){
        $this->order_no = $data['order_no'];
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
        $data      = $this->order_no ? $this->data() : [];
        $component = $this;

        return view('livewire.front-end.partner.order-and-receipt.order-items.index', compact('data', 'component'));
    }
}
