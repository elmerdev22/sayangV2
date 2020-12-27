<?php

namespace App\Http\Livewire\BackEnd\User\Index;

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
			'user_accounts.*',
			'user_accounts.created_at as date_registered',
			'users.name',
			'users.email',
			'users.is_blocked',
			'users.verified_at',
		];

		$filter['where']['users.type'] = 'user';
		
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

		return QueryUtility::user_accounts($filter)->paginate($this->show_entries);
	}

    public function updatingSearch(){
		$this->resetPage();
	}

    public function render(){
    	$data = $this->data();

        return view('livewire.back-end.user.index.listing', compact('data'));
    }

    public function sort($sort){
    	$this->sort_type   = $this->sort_type == 'asc' ? 'desc' : 'asc';
    	return $this->sort = explode('|', $sort);
	}
	
	public function reset_filter(){
		$this->reset();
	}
}
