<?php

namespace App\Http\Livewire\BackEnd\Setting\Home\FeaturedPartners;

use Livewire\Component;
use Livewire\WithPagination;
use App\Model\Partner;
use QueryUtility;

class Index extends Component
{
	use WithPagination;
	public $search = '', $show_entries=10, $sort = [], $sort_type='asc';

    public function featured_partners(){

		$filter = [];
		$filter['select'] = [
			'partners.*', 
		];
		$filter['where']['users.type']            = 'partner';
		$filter['where']['partners.is_activated'] = 1;
		$filter['where']['partners.is_featured']  = 1;

		return QueryUtility::partners($filter)->get();

    }

    public function partner_lists(){

		$filter = [];
		$filter['select'] = [
			'partners.*', 
		];
		$filter['where']['users.type']            = 'partner';
		$filter['where']['partners.is_activated'] = 1;

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
    
    public function sort($sort){
    	$this->sort_type   = $this->sort_type == 'asc' ? 'desc' : 'asc';
    	return $this->sort = explode('|', $sort);
	}

    public function render(){
        $data              = $this->partner_lists();
        $featured_partners = $this->featured_partners();
        return view('livewire.back-end.setting.home.featured-partners.index', compact('data','featured_partners'));
    }

    public function action($partner_id, $bool){
        $response = false;
        if($bool){
            $featured_partners_count = $this->featured_partners()->count();
            if($featured_partners_count >= 4){
                $response = false;
            }
            else{
                $response = true;
            }
        }
        else{
            $response = true;
        }
        
        if($response){
            Partner::whereId($partner_id)->update(['is_featured' => $bool]);
        }
        else{
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'Only 4 partners can selected at this moment.'
            ]);
        }
    }
}
