<?php

namespace App\Http\Livewire\FrontEnd\Product\Listing;

use Livewire\Component;
use Livewire\WithPagination;
use App\Model\Partner;
use App\Model\Product;
use App\Model\UserAccount;
use UploadUtility;
use QueryUtility;

class Listing extends Component
{
	use WithPagination;
    public $price_range=[], $search, $category, $limit=9, $sort_by='latest_items', $view_by='grid_view';

    protected $listeners = [
        'set_filter'   => 'set_filter',
        'clear_filter' => 'clear_filter'
    ];

    public function clear_filter(){
        $this->reset();
        $this->resetPage();
    }

    public function set_filter($param){
        $type        = $param['type'];
        $this->$type = $param;
        $this->resetPage();
    }

    public function data(){
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
        $date_time = date('Y-m-d H:i:s');

        $filter['date_range_two_field'][] = [
            'field_from' => 'product_posts.date_start',
            'field_to'   => 'product_posts.date_end',
            'date'       => $date_time
        ];

        if(!empty($this->price_range)){
            if(isset($this->price_range['price_min']) && isset($this->price_range['price_max'])){
                $filter['value_between_min_max'][] = [
                    'field' => 'product_posts.buy_now_price',
                    'min'   => $this->price_range['price_min'],
                    'max'   => $this->price_range['price_max'],
                ];
            }            
        }

        if(!empty($this->category)){
            $filter['categories'] = $this->category;
        }

        if(!empty($this->search)){
            $filter['or_where_like'] = $this->search['key_word'];
        }

        if($this->sort_by == 'cheapest'){
            $filter['order_by'] = 'product_posts.buy_now_price asc, product_posts.created_at desc';
        }else{
            $filter['order_by'] = 'product_posts.updated_at desc';
        }

        $query = QueryUtility::product_posts($filter);

        return $query;
    }

    public function updatingSearch(){
		$this->resetPage();
    }

    public function product_featured_photo($product_id, $partner_id){
        $product      = Product::find($product_id);
        $partner      = Partner::find($partner_id);
        $user_account = UserAccount::find($partner->user_account_id);

        return UploadUtility::product_featured_photo($user_account->key_token, $product->key_token)[0]->getFullUrl();
    }

    public function datetime_format($date){
        return date('M d, Y H:i:s', strtotime($date));
    }

    public function render(){
        $query       = $this->data();
        $total_items = $query->count();
        $data        = $query->paginate($this->limit);
        $component   = $this;
        
        return view('livewire.front-end.product.listing.listing', compact('data', 'component', 'total_items'));
    }

    public function view_by($type){
        $this->view_by = $type;
    }
}