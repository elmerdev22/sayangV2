<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyProducts\StartSale;

use Livewire\Component;
use Livewire\WithPagination;
use App\Model\Product;
use Utility;
use QueryUtility;

class Listing extends Component
{
    use WithPagination;

    public $search = '', $show_entries=2, $sort = [], $sort_type='desc';
    public $partner, $selected_products = [];

    public function mount(){
        $this->partner = Utility::auth_partner();
        $this->sort    = ['products.created_at'];
    }

    public function data(){
        $filter = [];
		$filter['select'] = [
			'products.*', 
			'products.created_at as date_added', 
			'categories.name as category_name' 
		];
		$filter['where']['products.partner_id'] = $this->partner->id;
		
		if($this->search){
			$filter['or_where_like'] = $this->search;
		}
		
		if($this->sort){
			$sort_table = '';
			foreach($this->sort as $key => $value){
				$sort_table .= $value.' '.$this->sort_type.', ';
			}
			$sort_table = substr($sort_table, 0, -2);
			$filter['order_by'] = $sort_table;
		}

		return QueryUtility::products($filter)->paginate($this->show_entries);
    }

    public function updatingSearch(){
		$this->resetPage();
    }
    
    public function find_selected_product($key_token, $selected_key, $default_value=false){
        $response = $default_value;

        if(!empty($this->selected_products)){
            if(is_array($this->selected_products)){
                foreach($this->selected_products as $key => $selected_product){
                    if($selected_product['key_token'] == $key_token){
                        $response = $selected_product[$selected_key];
                        break;
                    }
                }
            }
        }

        return $response;
    }

    public function render(){
        $data      = $this->data();
        $component = $this;
        return view('livewire.front-end.partner.my-products.start-sale.listing', compact('data', 'component'));
    }

    public function sort($sort){
    	$this->sort_type   = $this->sort_type == 'asc' ? 'desc' : 'asc';
    	return $this->sort = explode('|', $sort);
    }

    public function select_product(array $data){
        $response = ['success' => false, 'message' => ''];

        if(isset($data['key_token']) && isset($data['buy_now_price']) && isset($data['lowest_price']) && isset($data['is_selected'])){
            $buy_now_price = Utility::decimal_format($data['buy_now_price']);
            $lowest_price  = Utility::decimal_format($data['lowest_price']);

            if(is_numeric($lowest_price) && is_numeric($buy_now_price)){
                if($data['is_selected']){
                    $product = Product::where('key_token', $data['key_token'])
                        ->where('partner_id', $this->partner->id)
                        ->first();
                    
                    if($product){
                        $is_new           = true;
                        $selected_product = [
                            'product_id'    => $product->id,
                            'key_token'     => $data['key_token'],
                            'buy_now_price' => $buy_now_price,
                            'lowest_price'  => $lowest_price,
                            'quantity'      => $data['quantity'],
                            'is_selected'   => $data['is_selected']
                        ];

                        if(!empty($this->selected_products)){
                            if(is_array($this->selected_products)){
                                foreach($this->selected_products as $key => $value){
                                    if($value['key_token'] == $data['key_token']){
                                        $is_new       = false;
                                        $existing_key = $key;
                                        break;
                                    }
                                }
                            }
                        }

                        if($is_new){
                            $this->selected_products[] = $selected_product;
                        }else{
                            $this->selected_products[$existing_key] = $selected_product;
                        }

                        $response['success'] = true;
                    }else{
                        $response['message'] = 'Product not found.';
                    }
                }else{
                    if(!empty($this->selected_products)){
                        if(is_array($this->selected_products)){
                            foreach($this->selected_products as $key => $selected_product){
                                if($selected_product['key_token'] == $data['key_token']){
                                    unset($this->selected_products[$key]);
                                    break;
                                }
                            }
                        }
                    }

                    $response['success'] = true;
                }
            }else{
                $response['message'] = 'Invalid Amount';
            }
        }else{
            $response['message'] = 'An error occured while selecting product.';
        }

        if(!$response['success']){
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => $response['message']
            ]);
        }
    }

    public function proceed(){
        if(empty($this->selected_products)){
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'No Product Selected.'
            ]);
        }else{
            $this->emit('proceed_to_start_sale', ['data' => $this->selected_products]);
        }
    }
}
