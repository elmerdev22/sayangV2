<?php

namespace App\Http\Livewire\FrontEnd\Home\AllRecentlyAdded;

use Livewire\Component;
use App\Model\Partner;
use App\Model\Product;
use App\Model\UserAccount;
use QueryUtility;
use UploadUtility;
use Utility;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $limit = 12;

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
        $filter['where']['product_posts.status'] = 'active';
        $filter['available_quantity']            = true;
        $date_time = date('Y-m-d H:i:s');

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

        return UploadUtility::product_featured_photo($user_account->key_token, $product->key_token)[0]->getFullUrl('thumb');;
    }

    public function datetime_format($date){
        return date('M d, Y H:i:s', strtotime($date));
    }

    public function render(){
        $data      = $this->initialize();
        $component = $this;
        return view('livewire.front-end.home.all-recently-added.index', compact('data', 'component'));
    }
}
