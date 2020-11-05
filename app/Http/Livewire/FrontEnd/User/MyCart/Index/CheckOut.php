<?php

namespace App\Http\Livewire\FrontEnd\User\MyCart\Index;

use Livewire\Component;
use App\Model\Cart;
use Utility;

class CheckOut extends Component
{
    public $account, $total_price, $discount, $total, $is_disabled;
    protected $listeners = [
        'initialize_cart_checkout' => 'initialize'
    ];

    public function mount(){
        $this->account = Utility::auth_user_account();
        $this->initialize();
    }

    public function initialize(){
        $carts = Cart::with(['product_post', 'product_post.product'])
            ->where('user_account_id', $this->account->id)
            ->where('is_checkout', true)
            ->get();

        $this->total_price = 0.00;
        $this->total       = 0.00;
        $this->discount    = 0.00;
        $total_items       = 0;

        foreach($carts as $row){
            $post_status = Utility::product_post_status($row->product_post_id);
            if($post_status == 'active'){
                $this->total_price += $row->product_post->buy_now_price * $row->quantity;
                $total_items++;
            }
        }

        if($total_items > 0){
            $this->is_disabled = false;
        }else{
            $this->is_disabled = true;
        }

        $this->total = $this->total_price;
    }

    public function render(){
        return view('livewire.front-end.user.my-cart.index.check-out');
    }
}
