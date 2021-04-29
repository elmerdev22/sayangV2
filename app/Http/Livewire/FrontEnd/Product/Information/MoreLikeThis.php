<?php

namespace App\Http\Livewire\FrontEnd\Product\Information;

use Livewire\Component;
use App\Model\Partner;
use App\Model\Product;
use App\Model\UserAccount;
use QueryUtility;
use UploadUtility;
use Utility;

class MoreLikeThis extends Component
{
    public $product_category_id, $product_post_id;
    public $limit = 20;

    public function mount($product_category_id, $product_post_id)
    {
        $this->product_category_id = $product_category_id;
        $this->product_post_id     = $product_post_id;

    }

    public function initialize(){
        $filter = [];
        $filter['select'] = [
            'product_posts.*',
            'products.name as product_name',
            'products.regular_price as regular_price',
            'products.partner_id',
            'products.slug as product_slug',
            'partners.name as partner_name'
        ];

        $filter['where_not'][] = [
            'field' => 'product_posts.id',
            'value' => $this->product_post_id
        ];
        
        $filter['where']['products.category_id'] = $this->product_category_id;
        $filter['where']['product_posts.status'] = 'active';
        $filter['available_quantity']            = true;
                $date_time                       = date('Y-m-d H:i:s');

        $filter['date_range_two_field'][] = [
            'field_from' => 'product_posts.date_start',
            'field_to'   => 'product_posts.date_end',
            'date'       => $date_time
        ];

        $filter['order_by'] = 'product_posts.created_at desc';

        return QueryUtility::product_posts($filter)->paginate($this->limit);
    }

    public function product_featured_photo($product_id, $partner_id){
        $product      = Product::find($product_id);
        $partner      = Partner::find($partner_id);
        $user_account = UserAccount::find($partner->user_account_id);

        return UploadUtility::product_featured_photo($user_account->key_token, $product->key_token);
    }

    public function datetime_format($date){
        return date('M d, Y H:i:s', strtotime($date));
    }

    public function render()
    {
        $data      = $this->initialize();
        $component = $this;
        return view('livewire.front-end.product.information.more-like-this', compact('data','component'));
    }
}
