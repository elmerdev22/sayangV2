<?php

namespace App\Http\Livewire\FrontEnd\Product\Information;

use Livewire\Component;
use App\Model\ProductPost;
use Utility;

class BuyNow extends Component
{

    public $product_post_id, $product_post;
    public $buy_now_price, $quantity, $current_quantity, $allow_purchase;

    public function mount($product_post_id){
        $product_post           = ProductPost::with(['product'])->findOrFail($product_post_id);
        $this->product_post     = $product_post;
        $this->product_post_id  = $product_post_id;
        $this->initialize_current_quantity();

        $preferred_quantity     = 1;
        if($preferred_quantity <= $this->current_quantity){
            $this->quantity = $preferred_quantity;
        }else{
            $this->quantity = 0;
        }
        
        $this->allow_purchase = Utility::allow_purchase();
        $this->calculate_buy_now_price();
    }

    public function calculate_buy_now_price(){
        $this->buy_now_price   = $this->product_post->buy_now_price * $this->quantity;
    }

    public function validate_quantity($preferred_quantity){
        $this->initialize_current_quantity();

        if(!empty($this->product_post)){
            if(!is_numeric($preferred_quantity)){
                $this->emit('alert', [
                    'type'    => 'warning',
                    'title'   => 'Invalid Quantity',
                ]);
            }else if($preferred_quantity <= $this->current_quantity){
                $this->quantity = $preferred_quantity;
            }else{
                $this->quantity = $this->current_quantity;
                $this->emit('alert', [
                    'type'    => 'warning',
                    'title'   => 'Can\'t Add Quantity',
                    'message' => 'Available quantity for this product is <b>'.$this->current_quantity.'</b>',
                ]);
            }
        }else{
            $this->quantity = 0;
        }

        $this->calculate_buy_now_price();
    }

    public function initialize_current_quantity(){
        $product_post = ProductPost::findOrFail($this->product_post_id);
        $this->current_quantity = $product_post->quantity;
    }

    public function render(){
        return view('livewire.front-end.product.information.buy-now');
    }
}
