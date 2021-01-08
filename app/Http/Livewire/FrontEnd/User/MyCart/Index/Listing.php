<?php

namespace App\Http\Livewire\FrontEnd\User\MyCart\Index;

use Livewire\Component;
use App\Model\Cart;
use App\Model\Product;
use App\Model\ProductPost;
use DB;
use Utility;
use UploadUtility;

class Listing extends Component
{
    public $account, $data = [], $is_check_all, $is_disabled_all;

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
            $post_status    = Utility::product_post_status($row->product_post_id);
            $is_disabled    = false;
            
            if($post_status != 'active'){
                $is_disabled = true;
            }

            $product = [
                'product_id'             => $product_id,
                'name'                   => $row->product_post->product->name,
                'is_checkout'            => $row->is_checkout,
                'is_disabled'            => $is_disabled,
                'featured_photo'         => $featured_photo[0]->getFullUrl('thumb'),
                'total_price'            => $total_price,
                'regular_price'          => $row->product_post->product->regular_price,
                'product_post_key_token' => $row->product_post->key_token,
                'product_slug'           => $row->product_post->product->slug,
                'buy_now_price'          => $buy_now_price,
                'lowest_price'           => $row->product_post->lowest_price,
                'date_start'             => $date_start,
                'date_end'               => $date_end,
                'current_quantity'       => $row->product_post->quantity,
                'selected_quantity'      => $selected_quantity == 0 ? 1 : $selected_quantity,
                'product_post_id'        => $row->product_post_id,
                'cart_id'                => $row->id,
                'cart_key_token'         => $row->key_token,
                'post_status'            => $post_status,
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

        foreach($data as $key => $row){
            $checker   = [];
            $sub_total = 0;
            $disabled  = 0;
            foreach($row['products'] as $row_product){
                if($row_product['is_disabled']){
                    $disabled++;
                }else{
                    $checker[] = $row_product['is_checkout'];
                    
                    if($row_product['is_checkout']){
                        $sub_total += $row_product['total_price'];
                    }
                }
            }

            if(count($row['products']) == $disabled){
                $data[$key]['is_check_all'] = false;
                $data[$key]['is_disabled']  = true;
            }else{
                $data[$key]['is_disabled'] = false;
                $data[$key]['is_check_all'] = (in_array(false, $checker) || count($checker) <= 0) ? false:true;
            }

            $data[$key]['sub_total'] = $sub_total;
        }

        $checker  = [];
        $disabled = 0;

        foreach($data as $key => $row){
            if($row['is_disabled']){
                $disabled++;
            }else{
                $checker[] = $row['is_check_all'];
            }
        }

        if(count($data) == $disabled){
            $this->is_disabled_all = true;
            $this->is_check_all    = false;
        }else{
            $this->is_disabled_all = false;
            $this->is_check_all = (in_array(false, $checker) || count($checker) <= 0) ? false:true;
        }
        
        $this->data         = $data;
    }

    public function product_featured_photo($product_id){
        $product        = Product::with(['partner', 'partner.user_account'])->findOrFail($product_id);
        $featured_photo = UploadUtility::product_featured_photo($product->partner->user_account->key_token, $product->key_token);

        return $featured_photo;
    }

    public function set_initialize_cart_checkout(){
        $this->emit('initialize_cart_checkout', true);
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
            $this->emit('initialize_cart_item_count', ['total' => $total_item]);
            $this->emit('initialize_cart_checkout', true);
            $this->initialize();
        }

    }

    public function reset_checkout_items($force_emit=true){
        $cart_items = Cart::where('user_account_id', $this->account->id)->get();   

        foreach($cart_items as $row){
            $row->is_checkout = false;
            $row->save();
        }

        if($force_emit){
            $this->emit('initialize_cart_checkout', true);
            $this->emit('remove_card_listing_loader', true);
            $this->initialize();
        }
    }

    public function checkout_items($cart_key_tokens){
        if(count($cart_key_tokens) > 0){
            $response = ['success' => false];

            DB::beginTransaction();
            try{
                $this->reset_checkout_items(false);

                foreach($cart_key_tokens as $key_token){
                    $cart_item = Cart::where('user_account_id', $this->account->id)->where('key_token', $key_token)->first();

                    if($cart_item){
                        $post_status = Utility::product_post_status($cart_item->product_post_id);
                        if($post_status == 'active'){
                            $cart_item->is_checkout = true;
                            $cart_item->save();
                        }
                    }
                }

                $response['success'] = true;
            }catch(\Exception $e){
                $response['success'] = false;
            }

            if($response['success']){
                DB::commit();
                $this->initialize();
                $this->emit('initialize_cart_checkout', true);
                $this->emit('remove_card_listing_loader', true);
            }else{
                DB::rollback(); 
                $this->emit('remove_card_listing_loader', true);
            }

        }
    }

    public function delete($key_token){
        $cart = Cart::where('user_account_id', $this->account->id)->where('key_token', $key_token)->firstOrFail();
        $cart->delete();

        $total_item  = Utility::total_cart_item();

        $this->emit('initialize_cart_list', true);
        $this->emit('initialize_cart_checkout', true);
        $this->emit('initialize_cart_item_count', ['total' => $total_item]);
        $this->emit('alert', [
            'type'  => 'success',
            'title' => 'Successfully Deleted.',
        ]);
    }

    public function product_post_update_event($param){
        if(!empty($param)){
            $initialize = false;

            foreach($param['data'] as $row){
                $total_item = Cart::where('user_account_id', $this->account->id)
                    ->where('product_post_id', $row['product_post_id'])
                    ->count();

                if($total_item){
                    $initialize = true;
                    break;
                }
            }

            if($initialize){
                $total_item  = Utility::total_cart_item();
                $this->emit('initialize_cart_list', true);
                $this->emit('initialize_cart_checkout', true);
                $this->emit('initialize_cart_item_count', ['total' => $total_item]);
            }
        }
    }
}
