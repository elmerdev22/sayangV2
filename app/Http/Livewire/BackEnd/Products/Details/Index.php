<?php

namespace App\Http\Livewire\BackEnd\Products\Details;

use Livewire\Component;
use Livewire\WithPagination;
use App\Model\Product;
use App\Model\Bid;
use App\Model\UserAccount;
use App\Model\ProductPost;
use DB;
use Utility;
use QueryUtility;
use UploadUtility;
use Illuminate\Support\Str; 
use Carbon\Carbon;

class Index extends Component
{
    use WithPagination;
    public $user_id,$product_post_id,$product_name,$product_quantity,$featured_photo,$search,$cancellation_reason;

    public function mount($product_post_id, $user_id){
        $this->product_post_id = $product_post_id;
        $this->user_id         = $user_id;
    }
    
    public function account(){
        return UserAccount::where('user_id', $this->user_id)->first();
    }

    public function data(){
        
        $filter = [];
		$filter['select'] = [
			'products.key_token as product_key_token', 
			'products.regular_price as regular_price', 
			'products.name as product_name', 
			'product_posts.*',
        ];
        
        $filter['where']['product_posts.id']  = $this->product_post_id;
        
        return QueryUtility::product_posts($filter)->first();
    }

    public function render()
    {  
        $data                 = $this->data();
        $this->featured_photo = UploadUtility::product_featured_photo($this->account()->key_token, $data->product_key_token);
        $product_sold         = $this->product_sold();
        // dd($data);
        return view('livewire.back-end.products.details.index', compact('data','product_sold'));
    }

    public function product_sold(){
        
		$filter = [];
		$filter['select'] = [
            'orders.order_no', 
            'orders.created_at', 
            'orders.status', 
            'order_items.quantity as product_quantity', 
        ];
        
		$filter['where']['order_items.product_post_id'] = $this->product_post_id;
		
		return QueryUtility::order_items($filter)->where('orders.order_no', 'like', '%'.$this->search.'%')->paginate(5);
    }

    public function save_quantity(){
        $product_post           = ProductPost::where('id', $this->product_post_id)->first();
        $product_post->quantity = $this->product_quantity;
        if($product_post->save()){
            
            $this->emit('alert', [
                'type'     => 'success',
                'title'    => 'Successfully Saved',
                'message'  => 'Product Quantity successfully saved!',
            ]);
        }
    }

    public function cancel(){
        if(!Utility::is_product_post_cancellable($this->product_post_id)){
            $this->emit('alert_link', [
                'type'     => 'error',
                'title'    => 'Oops..',
                'message'  => 'Cant`t cancel because this Product already have transactions.',
            ]);
        }
        else{
            $this->validate([
                'cancellation_reason' => 'required',
            ]);
    
            $product_post                      = ProductPost::where('id', $this->product_post_id)->first();
            $product_post->status              = 'cancelled';
            $product_post->date_cancelled      = Carbon::now();
            $product_post->cancelled_by        = 'admin';
            $product_post->cancellation_reason = $this->cancellation_reason;
            if($product_post->save()){
                
                Utility::new_notification($this->account()->id, $this->product_post_id, 'partner_product_post_cancelled', 'activity');
                $this->emit('alert_link', [
                    'type'     => 'success',
                    'title'    => 'Successfully Cancelled',
                    'message'  => 'Product successfully Cancelled!',
                ]);
            }
        }
    }
}
