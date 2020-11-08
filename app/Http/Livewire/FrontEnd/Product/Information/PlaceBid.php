<?php

namespace App\Http\Livewire\FrontEnd\Product\Information;

use Livewire\Component;
use App\Model\ProductPost;
use Utility;

class PlaceBid extends Component
{
    public $product_post_id, $product_post, $allow_purchase;
    public $total_amount, $quantity, $current_quantity, $bid_price, $lowest_price;

    public function mount($product_post_id){
        $product_post          = ProductPost::with(['product'])->findOrFail($product_post_id);
        $this->product_post    = $product_post;
        $this->product_post_id = $product_post_id;
        $this->lowest_price    = $product_post->lowest_price;
        $this->bid_price       = $product_post->lowest_price;
        $this->initialize_current_quantity();

        $preferred_quantity     = 1;
        if($preferred_quantity <= $this->current_quantity){
            $this->quantity = $preferred_quantity;
        }else{
            $this->quantity = 0;
        }

        $this->allow_purchase = Utility::allow_purchase();
        $this->calculate_price();
    }

    public function calculate_price(){
        $this->total_amount = $this->bid_price * $this->quantity;
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
                if($preferred_quantity <= 0){
                    $this->quantity = 1;
                    $this->emit('buy_now_quantity_value', ['quantity' => $this->quantity]);
                }else{
                    $this->quantity = $preferred_quantity;
                }
            }else{
                $this->quantity = $this->current_quantity;
                $this->emit('buy_now_quantity_value', ['quantity' => $this->quantity]);
            }
        }else{
            $this->quantity = 0;
        }

        $this->calculate_price();
    }

    public function set_bid_price($value){
        if($value >= $this->lowest_price){
            $this->bid_price = Utility::decimal_format($value);
            $this->calculate_price();
        }
    }

    public function initialize_current_quantity(){
        $product_post = ProductPost::findOrFail($this->product_post_id);
        $this->current_quantity = $product_post->quantity;
    }

    public function render(){
        return view('livewire.front-end.product.information.place-bid');
    }

    public function product_post_update_event($param){
        if(!empty($param)){
            $initialize = false;

            foreach($param['data'] as $row){
                if($row['product_post_id'] == $this->product_post_id){
                    $initialize = true;
                    break;
                }
            }

            if($initialize){
                $this->initialize_current_quantity();
                $this->validate_quantity($this->quantity);
            }
        }
    }
}
