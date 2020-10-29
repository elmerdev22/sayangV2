<?php

namespace App\Http\Livewire\FrontEnd\User\MyCart\Index;

use Livewire\Component;
use App\Model\Cart;
use Utility;

class Listing extends Component
{
    public $account;

    public function mount(){
        $this->account = Utility::auth_user_account();

        $this->initialize();
    }

    public function initialize(){
        $carts = Cart::with(['product_post', 'product_post.product', 'product_post.product.partner'])
            ->where('user_account_id', $this->account->id)
            ->get();

        
    }

    public function render(){
        return view('livewire.front-end.user.my-cart.index.listing');
    }
}
