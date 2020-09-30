<?php

namespace App\Http\Livewire\BackEnd\Partner\Index;

use Livewire\Component;
use Livewire\WithPagination;
use QueryUtility;

class Listing extends Component
{
	use WithPagination;

	public $search = '', $show_entries=10, $sort = [], $sort_type='asc';

	public function mount(){
		$this->sort = ['user_accounts.created_at'];
	}

	public function data(){
		$filter = [];
		$filter['select'] = [
			'partners.*', 
			'partners.name as partner_name', 
			'user_accounts.first_name as account_first_name',
			'user_accounts.last_name as account_last_name',
			'user_accounts.created_at as date_registered',
			'philippine_cities.name as city_name',
			'philippine_provinces.name as province_name'
		];
		
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

		return QueryUtility::partners($filter)->paginate($this->show_entries);
	}

	public function updatingSearch(){
		$this->resetPage();
	}

    public function render(){
    	$data = $this->data();

        return view('livewire.back-end.partner.index.listing', compact('data'));
    }

    public function sort($sort){
    	$this->sort_type   = $this->sort_type == 'asc' ? 'desc' : 'asc';
    	return $this->sort = explode('|', $sort);
    }
}
