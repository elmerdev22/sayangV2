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
        $cart              = Utility::cart($this->account->id, true);
        $this->total       = $cart['total_price'];
        $this->total_price = $cart['total'];
        $this->discount    = $cart['total_discount'];

        if($cart['total_items'] > 0){
            $this->is_disabled = false;
        }else{
            $this->is_disabled = true;
        }
    }

    public function render(){
        return view('livewire.front-end.user.my-cart.index.check-out');
    }
}
