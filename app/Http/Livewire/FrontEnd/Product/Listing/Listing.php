<?php

namespace App\Http\Livewire\FrontEnd\Product\Listing;

use Livewire\Component;
use Livewire\WithPagination;
use App\Model\Partner;
use App\Model\Product;
use App\Model\UserAccount;
use App\Model\Category;
use App\Model\SubCategory;
use UploadUtility;
use QueryUtility;

class Listing extends Component
{
	use WithPagination;
    public $min_price, $max_price, $search, $category, $limit=6, $sort_by='', $view_by='grid_view';
    public $selected_category_id, $selected_sub_category_id, $partner_id;

    protected $listeners = [
        'set_filter'      => 'set_filter',
        'set_price_range' => 'set_price_range',
        'clear_filter'    => 'clear_filter'
    ];

    public function mount($search, $partner_id, $category = null, $sub_category = null){
        $this->partner_id = $partner_id;

        if($search != null){
            $this->search = $search;
        }
        if($category != null && $sub_category == null){
            $this->selected_category_id = Category::where('slug', $category)->first()->id;
        }
        if($category != null && $sub_category != null){
            $this->selected_sub_category_id = SubCategory::where('slug', $sub_category)->first()->id;
        }
    }

    public function clear_filter(){
        $this->reset(['search', 'min_price', 'max_price', 'category', 'limit', 'sort_by', 'view_by', 'selected_category_id', 'selected_sub_category_id']);
        $this->resetPage();
    }

    public function set_price_range($param){
        $this->min_price = $param['min_price'];
        $this->max_price = $param['max_price'];
    }

    public function set_filter($param){
        if($param['type'] == 'category'){
            $this->selected_category_id     = $param['id'];
            $this->selected_sub_category_id = null;
        }
        else{
            $this->selected_sub_category_id = $param['id'];
            $this->selected_category_id     = null;
        }
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
        $filter['available_quantity']            = true;
                $date_time                       = date('Y-m-d H:i:s');

        $filter['date_range_two_field'][] = [
            'field_from' => 'product_posts.date_start',
            'field_to'   => 'product_posts.date_end',
            'date'       => $date_time
        ];

        if(!empty($this->min_price) && !empty($this->max_price)){
            $filter['value_between_min_max'][] = [
                'field' => 'product_posts.buy_now_price',
                'min'   => $this->min_price,
                'max'   => $this->max_price,
            ];
        }

        if(!empty($this->partner_id)){
            $filter['where']['products.partner_id'] = $this->partner_id;
        }

        if(!empty($this->selected_category_id)){
            $filter['where']['products.category_id'] = $this->selected_category_id;
        }
        else if(!empty($this->selected_sub_category_id)){
            $filter['where']['product_sub_categories.sub_category_id'] = $this->selected_sub_category_id;
        }

        if(!empty($this->search)){
            $filter['or_where_like'] = $this->search;
        }

        if($this->sort_by == 'lowest_price'){
            $filter['order_by'] = 'product_posts.buy_now_price asc, product_posts.created_at desc';
        }
        else if($this->sort_by == 'highest_price'){
            $filter['order_by'] = 'product_posts.buy_now_price desc, product_posts.created_at desc';
        }
        else if($this->sort_by == 'ending_soon'){
            $filter['order_by'] = 'product_posts.date_end asc';
        }
        else if($this->sort_by == 'recently_added'){
            $filter['order_by'] = 'product_posts.created_at desc';
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
    
    public function load_more(){
        $this->limit += 9;
    }
}
