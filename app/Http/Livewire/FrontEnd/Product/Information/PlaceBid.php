<?php

namespace App\Http\Livewire\FrontEnd\Product\Information;

use Livewire\Component;
use App\Model\ProductPost;
use App\Model\Bid;
use Livewire\WithPagination;
use Utility;
use Auth;

class PlaceBid extends Component
{
    use WithPagination;

    public $product_post_id, $product_post, $allow_purchase;
    public $total_amount, $quantity, $current_quantity, $bid_price, $lowest_price, $minimum_bid;

    public function mount($product_post_id){
        $product_post          = ProductPost::with(['product'])->findOrFail($product_post_id);
        $this->product_post    = $product_post;
        $this->product_post_id = $product_post_id;

        $this->minimum_bid     = Utility::settings('minimum_bid');

        $lowest_bid      = Bid::where('product_post_id', $this->product_post_id)->orderBy('bid', 'desc')->first();
        $this->bid_price = $lowest_bid != null ? $lowest_bid->bid : $product_post->lowest_price;
        $this->bid_price = $this->bid_price + floatval($this->minimum_bid);

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
        $this->mount($this->product_post_id);

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
        $product_post           = ProductPost::findOrFail($this->product_post_id);
        $this->current_quantity = $product_post->quantity;
    }

    public function render(){
        $ranking = $this->ranking_list();
        return view('livewire.front-end.product.information.place-bid', compact('ranking'));
    }

    public function ranking_list(){
        return Bid::with(['user_account'])
            ->where('product_post_id',$this->product_post_id)
            ->orderBy('bid', 'desc')
            ->orderBy('quantity', 'desc')
            ->paginate(5);
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

    public function confirm_bid(){

        $bidder = Auth::user()->id;
        
        $bid                  = new Bid();
        $bid->bid_no          = Utility::generate_bid_no();
        $bid->product_post_id = $this->product_post_id;
        $bid->user_id         = $bidder;
        $bid->bid             = $this->bid_price;
        $bid->quantity        = $this->quantity;
        $bid->status          = 'active';
        $bid->key_token       = Utility::generate_table_token('Bid');
        $bid->save();

        $this->mount($this->product_post_id);
    }

}
