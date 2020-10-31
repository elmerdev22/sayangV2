<?php

namespace App\Http\Livewire\FrontEnd\Product\Information;

use Livewire\Component;
use App\Model\ProductPost;
use App\Model\Cart;
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

        $this->calculate_buy_now_price();
    }

    public function initialize_current_quantity(){
        $product_post = ProductPost::findOrFail($this->product_post_id);
        $this->current_quantity = $product_post->quantity;
    }

    public function check_cart_item(){
        return Utility::check_cart_item($this->product_post_id);
    }

    public function render(){
        $component = $this;
        return view('livewire.front-end.product.information.buy-now', compact('component'));
    }

    public function add_to_cart(){
        if($this->allow_purchase == 'allowed'){
            if(!$this->check_cart_item()){
                $quantity        = $this->quantity;
                $product_post_id = $this->product_post_id;
                $account         = Utility::auth_user_account();

                $cart                  = new Cart();
                $cart->user_account_id = $account->id;
                $cart->product_post_id = $product_post_id;
                $cart->quantity        = $quantity;
                $cart->key_token       = Utility::generate_table_token('Cart');

                if($cart->save()){
                    $total_item = Utility::total_cart_item();
                    $this->emit('initialize_cart_item_count', ['total' => number_format($total_item)]);
                    $this->emit('alert', [
                        'type'              => 'success',
                        'title'             => 'Successfully Added',
                        'message'           => 'Item successfully added to cart. <br><br>',
                        'timer'             => 3000,
                        'showConfirmButton' => false
                    ]);
                }else{
                    $this->emit('alert', [
                        'type'     => 'error',
                        'title'    => 'Failed',
                        'message'  => 'An error occured while adding item to cart.',
                    ]);
                }

            }
        }
    }

    public function update_cart(){
        if($this->check_cart_item()){
            $this->initialize_current_quantity();

            $account = Utility::auth_user_account();
            $cart    = Cart::where('product_post_id', $this->product_post_id)
                ->where('user_account_id', $account->id)
                ->firstOrFail();

            $new_quantity = $cart->quantity + $this->quantity;
            if($new_quantity <= $this->current_quantity){
                $cart->quantity = $new_quantity;
            }else{
                $cart->quantity = $this->current_quantity;
            }

            $cart->save();
            $this->quantity = 1;
            $total_item     = Utility::total_cart_item();
            $this->calculate_buy_now_price();
            $this->emit('buy_now_quantity_value', ['quantity' => $this->quantity]);
            $this->emit('initialize_cart_item_count', ['total' => number_format($total_item)]);
            $this->emit('alert', [
                'type'              => 'success',
                'title'             => 'Successfully Added',
                'message'           => 'Item successfully added to cart. <br><br>',
                'timer'             => 3000,
                'showConfirmButton' => false
            ]);
        }
    }
}
