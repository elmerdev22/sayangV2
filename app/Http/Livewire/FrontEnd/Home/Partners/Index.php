<?php

namespace App\Http\Livewire\FrontEnd\Home\Partners;

use Livewire\Component;
use Livewire\WithPagination;
use QueryUtility;

class Index extends Component
{
	use WithPagination;
    public $search, $limit=6, $sort_by='';

    public function updatingSearch(){
		$this->resetPage();
    }

    public function data(){
        
		$filter = [];
		$filter['select'] = [
			'partners.*', 
            'user_accounts.key_token as user_key_token'
		];
		$filter['where']['users.type']            = 'partner';
		$filter['where']['partners.is_activated'] = 1;

		if($this->search){
			$filter['or_where_like'] = $this->search;
		}
        
		return QueryUtility::partners($filter)->paginate($this->limit);
    }

    public function render(){
        $data = $this->data();
        return view('livewire.front-end.home.partners.index', compact('data'));
    }

    public function load_more(){
        $this->limit += 9;
    }
}
