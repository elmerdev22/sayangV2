<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyProducts\Index;

use Livewire\Component;
use Livewire\WithPagination;
use App\Model\Product;
use App\Model\ProductPost;
use App\Model\ProductSubCategory;
use DB;
use Utility;
use UploadUtility;
use QueryUtility;

class Listing extends Component
{
	use WithPagination;

    public $search = '', $show_entries=10, $sort = [], $sort_type='desc';
    public $partner;

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
    
    public function render(){
        $data = $this->data();

        return view('livewire.front-end.partner.my-products.index.listing', compact('data'));
    }

    public function sort($sort){
    	$this->sort_type   = $this->sort_type == 'asc' ? 'desc' : 'asc';
    	return $this->sort = explode('|', $sort);
	}
	
	public function delete($key_token){
		$product = Product::where('key_token', $key_token)
			->where('partner_id', $this->partner->id)
			->firstOrFail();

		$account = Utility::auth_user_account();
		
		if(Utility::is_product_deletable($product->id)){
			$response = ['success' => false];
			try{
				$media_photos   = UploadUtility::product_photos($account->key_token, $product->key_token);
				$featured_photo = UploadUtility::product_featured_photo($account->key_token, $product->key_token);
		
				if(!empty($media_photos)){
					foreach($media_photos as $key => $row){
						$row->delete();
					}
				}
		
				if(!empty($featured_photo)){
					foreach($featured_photo as $key => $row){
						$row->delete();
					}
				}
		
				ProductSubCategory::where('product_id', $product->id)->delete();
				ProductPost::where('product_id', $product->id)->delete();
				$product->delete();

				$response['success'] = true;
			}catch(\Exception $e){
				$response['success'] = false;
			}

			if($response['success']){
                DB::commit();
                $this->emit('initialize_list', true);
                $this->emit('alert', [
                    'type'     => 'success',
                    'title'    => 'Successfully Deleted',
                    'message'  => 'Product successfully deleted.'
                ]);
            }else{
                DB::rollback();
                $this->emit('alert', [
                    'type'    => 'error',
                    'title'   => 'Failed',
                    'message' => 'An error occured while deleting the product.'
                ]);
            }
		}	

	}
}
