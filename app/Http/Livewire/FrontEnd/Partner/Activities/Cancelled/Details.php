<?php

namespace App\Http\Livewire\FrontEnd\Partner\Activities\Cancelled;

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

        return view('livewire.front-end.partner.activities.cancelled.details', compact('data'));
    }

}