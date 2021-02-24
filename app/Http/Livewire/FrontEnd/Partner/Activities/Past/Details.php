<?php

namespace App\Http\Livewire\FrontEnd\Partner\Activities\Past;

use Livewire\Component;
use Livewire\WithPagination;
use App\Model\Product;
use App\Model\Bid;
use App\Model\ProductPost;
use DB;
use Utility;
use QueryUtility;
use UploadUtility;

class Details extends Component
{
    use WithPagination;
    public $account,$product_post_id,$product_name,$product_quantity,$featured_photo,$search;

    public function mount($product_post_id){
        $this->account          = Utility::auth_user_account();
        $this->product_post_id  = $product_post_id;
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
        $this->featured_photo = UploadUtility::product_featured_photo($this->account->key_token, $data->product_key_token);
        $bid_ranking_list     = $this->ranking_list();
        $product_sold         = $this->product_sold();

        return view('livewire.front-end.partner.activities.past.details', compact('data','bid_ranking_list','product_sold'));
    }

    public function ranking_list(){
        return Bid::with(['user_account'])
            ->where('product_post_id', $this->product_post_id)
            ->orderBy('bid', 'desc')
            ->orderBy('quantity', 'desc')
            ->paginate(10);
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

}