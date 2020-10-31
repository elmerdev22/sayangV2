<?php

namespace App\Http\Livewire\FrontEnd\User\MyCart\Index;

use Livewire\Component;
use App\Model\Cart;
use App\Model\Product;
use App\Model\ProductPost;
use Utility;
use UploadUtility;

class Listing extends Component
{
    public $account, $data = [];

    protected $listeners = [
        'initialize_cart_list' => 'initialize'
    ];

    public function mount(){
        $this->account = Utility::auth_user_account();
        $this->initialize();
    }

    public function initialize(){
        $carts = Cart::with(['product_post', 'product_post.product', 'product_post.product.partner'])
            ->where('user_account_id', $this->account->id)
            ->get();
        
        $data = [];

        foreach($carts as $row){
            $is_new            = true;
            $partner_id        = $row->product_post->product->partner->id;
            $product_id        = $row->product_post->product->id;
            $date_start        = $row->product_post->date_start;
            $date_end          = $row->product_post->date_end;
            $buy_now_price     = $row->product_post->buy_now_price;
            $selected_quantity = $row->quantity;
            $total_price       = $selected_quantity * $buy_now_price;
            $insert            = [];
            $insert            = [
                'partner_id'   => $partner_id,
                'partner_name' => $row->product_post->product->partner->name,
                'products'     => []
            ];

            $featured_photo = $this->product_featured_photo($product_id);

            $product = [
                'product_id'        => $product_id,
                'name'              => $row->product_post->product->name,
                'featured_photo'    => $featured_photo[0]->getFullUrl('thumb'),
                'total_price'       => $total_price,
                'regular_price'     => $row->product_post->product->regular_price,
                'buy_now_price'     => $buy_now_price,
                'lowest_price'      => $row->product_post->lowest_price,
                'date_start'        => $date_start,
                'date_end'          => $date_end,
                'current_quantity'  => $row->product_post->quantity,
                'selected_quantity' => $selected_quantity,
                'product_post_id'   => $row->product_post_id,
                'cart_id'           => $row->id,
                'cart_key_token'    => $row->key_token,
                'post_status'       => Utility::product_post_status($row->product_post_id),
            ];

            $insert['products'][] = $product;

            if(!empty($data)){
                foreach($data as $exist_key => $exist_row){
                    if($exist_row['partner_id'] == $partner_id){
                        $is_new     = false;
                        $insert_key = $exist_key;
                        break;
                    }
                }
            }else{
                $is_new = true;
            }

            if($is_new){
                $data[] = $insert;
            }else{
                $data[$insert_key]['products'][] = $product;
            }
        }
        
        $this->data = $data;
    }

    public function product_featured_photo($product_id){
        $product        = Product::with(['partner', 'partner.user_account'])->findOrFail($product_id);
        $featured_photo = UploadUtility::product_featured_photo($product->partner->user_account->key_token, $product->key_token);

        return $featured_photo;
    }

    public function render(){
        return view('livewire.front-end.user.my-cart.index.listing');
    }

    public function quantity_update($cart_key_token, $new_quantity){
        $cart         = Cart::where('user_account_id', $this->account->id)->where('key_token', $cart_key_token)->firstOrFail();
        $post_status  = Utility::product_post_status($cart->product_post_id);

        if($post_status == 'active'){
            $product_post = ProductPost::find($cart->product_post_id);

            $current_quantity = $product_post->quantity;
            if($new_quantity == 0){
                $cart->quantity = 1;
            }else if($new_quantity <= $current_quantity){
                $cart->quantity = $new_quantity;
            }else{
                $cart->quantity = $current_quantity;
            }

            $cart->save();
            
            $total_item  = Utility::total_cart_item();
            $this->emit('initialize_cart_item_count', ['total' => number_format($total_item)]);
            $this->initialize();
        }

    }

    public function delete($key_token){
        $cart = Cart::where('key_token', $key_token)->firstOrFail();
        $cart->delete();

        $total_item  = Utility::total_cart_item();

        $this->emit('initialize_cart_list', true);
        $this->emit('initialize_cart_item_count', ['total' => number_format($total_item)]);
        $this->emit('alert', [
            'type'     => 'success',
            'title'    => 'Successfully Deleted',
            'message'  => 'Item successfully deleted.'
        ]);
    }
}
