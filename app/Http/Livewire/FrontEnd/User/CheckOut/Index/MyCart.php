<?php

namespace App\Http\Livewire\FrontEnd\User\CheckOut\Index;

use Livewire\Component;
use App\Model\Cart;
use App\Model\Product;
use UploadUtility;
use Utility;

class MyCart extends Component
{
    public $account, $total_price=0.00, $total=0.00, $discount=0.00, $total_items=0, $total_quantity_items=0;

    public function mount(){
        $this->account = Utility::auth_user_account();
    }

    public function initialize(){
        $cart                       = Utility::cart($this->account->id, true);
        $this->total_price          = $cart['total_price'];
        $this->total                = 0.00;
        $this->discount             = 0.00;
        $this->total_items          = $cart['total_items'];
        $this->total_quantity_items = $cart['total_quantity_items'];

        return $cart['products'];
    }
    
    public function render(){
        $data = $this->initialize();
        return view('livewire.front-end.user.check-out.index.my-cart', compact('data'));
    }
    
    public function product_featured_photo($product_id){
        $product        = Product::with(['partner', 'partner.user_account'])->findOrFail($product_id);
        $featured_photo = UploadUtility::product_featured_photo($product->partner->user_account->key_token, $product->key_token, true);

        return $featured_photo;
    }
}
