<?php

namespace App\Http\Livewire\BackEnd\Partner\Index;

use Livewire\Component;
use Livewire\WithPagination;
use Session;
use QueryUtility;

class Listing extends Component
{
	use WithPagination;

	public $search = '', $show_entries=10, $sort = [], $sort_type='asc';
	public $account_status, $block_status, $date_from, $date_to, $reset_filter = false;

	public function mount(){
		$this->sort = ['user_accounts.created_at'];
	}

	public function data(){
		$filter = [];
		$filter['select'] = [
			'partners.*', 
			'partners.name as partner_name', 
			'user_accounts.key_token as account_key_token',
			'user_accounts.first_name as account_first_name',
			'user_accounts.last_name as account_last_name',
			'user_accounts.created_at as date_registered',
			'philippine_cities.name as city_name',
			'philippine_provinces.name as province_name'
		];
		$filter['where']['users.type'] = 'partner';
		
		if($this->account_status != null){
			if($this->account_status == 'activated'){
				$filter['where']['partners.is_activated'] = 1;
			}
			else if($this->account_status == 'for_activation'){
				$filter['where']['partners.status']       = 'done';
				$filter['where']['partners.is_activated'] = 0;
			}
			else{
				$filter['where']['partners.status'] = 'pending';
			}
		}
		
		if($this->block_status != null){
			$filter['where']['users.is_blocked'] = $this->block_status;
		}

		if($this->date_from != null && $this->date_to == null){
			Session::flash('date_to_error','This Date To is Required.');
		}
		if($this->date_from == null && $this->date_to != null){
			Session::flash('date_from_error','This Date From is Required.');
		}
		if($this->date_from != null && $this->date_to != null){
			$filter['date_range'][] = [
				'from'  => $this->date_from,
				'to'    => $this->date_to,
				'field' => 'user_accounts.created_at'
			];
		}

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

		if($this->account_status != null || $this->block_status != null || $this->date_from != null || $this->date_from != null){
			$this->reset_filter = true;
		}
		else{
			$this->reset_filter = false;
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
	
	public function reset_filter(){
		$this->reset();
	}
}
