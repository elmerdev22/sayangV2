<?php

namespace App\Http\Livewire\FrontEnd\Home\AllMostPopular;

use Livewire\Component;
use App\Model\Partner;
use App\Model\Product;
use App\Model\UserAccount;
use QueryUtility;
use UploadUtility;
use Utility;
use Livewire\WithPagination;
use DB;
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
            'partners.name as partner_name',
            DB::raw('COUNT(bids.product_post_id) as most_popular'),
        ];
        $filter['where']['product_posts.status'] = 'active';
        $filter['available_quantity']            = true;
                $date_time                       = date('Y-m-d H:i:s');

        $filter['date_range_two_field'][] = [
            'field_from' => 'product_posts.date_start',
            'field_to'   => 'product_posts.date_end',
            'date'       => $date_time
        ];

        return QueryUtility::product_posts($filter)
                ->leftJoin('bids','bids.product_post_id', '=', 'product_posts.id')
                ->groupBy('product_posts.id')
                ->orderBy('most_popular', 'desc')
                ->paginate($this->limit);
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

    public function render(){
        $data      = $this->initialize();
        $component = $this;
        return view('livewire.front-end.home.all-most-popular.index', compact('data', 'component'));
    }

    public function load_more(){
        $this->limit += 8;
    }
}
