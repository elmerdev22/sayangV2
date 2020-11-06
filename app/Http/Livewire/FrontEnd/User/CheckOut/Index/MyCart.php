<?php

namespace App\Http\Livewire\FrontEnd\User\CheckOut\Index;

use Livewire\Component;
use App\Model\Cart;
use Utility;

class MyCart extends Component
{
    public $account, $total_price=0.00, $total=0.00, $discount=0.00, $total_items=0, $total_quantity_items=0;

    public function mount(){
        $this->account = Utility::auth_user_account();
    }

    public function initialize(){
        $carts = Cart::with(['product_post', 'product_post.product'])
            ->where('user_account_id', $this->account->id)
            ->where('is_checkout', true)
            ->get();

        $this->total_price    = 0.00;
        $this->total          = 0.00;
        $this->discount       = 0.00;
        $total_items          = 0;
        $total_quantity_items = 0;

        foreach($carts as $row){
            $post_status = Utility::product_post_status($row->product_post_id);
            if($post_status == 'active'){
                $this->total_price += $row->product_post->buy_now_price * $row->quantity;
                $total_items++;
                $total_quantity_items += $row->quantity;
            }
        }

        $this->total                = $this->total_price;
        $this->total_items          = $total_items;
        $this->total_quantity_items = $total_quantity_items;

        return $carts;
    }
    
    public function render(){
        $data = $this->initialize();
        return view('livewire.front-end.user.check-out.index.my-cart', compact('data'));
    }
}
