<?php

namespace App\Http\Livewire\BackEnd\Payable\Completed;

use Livewire\Component;
use Livewire\WithPagination;
use QueryUtility;
use DB;

class Listing extends Component
{
    use WithPagination;
    public $status, $search = '', $show_entries=25, $sort = [], $sort_type='asc';
    
    public function mount(){
        $this->sort    = ['partners.name'];
    }

    public function data(){
        
        $filter = [];

        $filter['select'] = [
			'partners.name as partner_name', 
            'partners.slug as partner_slug',
            DB::raw("SUM(order_payment_payouts.total_amount) as overall_total_amount"),
            DB::raw("SUM(order_payment_payouts.sayang_commission) as overall_sayang_commission"),
            DB::raw("SUM(order_payment_payouts.paymongo_fee) as overall_paymongo_fee"),
            DB::raw("SUM(order_payment_payouts.foreign_fee) as overall_foreign_fee"),
            DB::raw("SUM(order_payment_payouts.net_amount) as overall_net_amount")
        ];
        
        $filter['where']['order_payment_payouts.status'] = 'completed';

        if($this->sort){
			$sort_table = '';
			foreach($this->sort as $key => $value){
				$sort_table .= $value.' '.$this->sort_type.', ';
			}
			$sort_table = substr($sort_table, 0, -2);
			$filter['order_by'] = $sort_table;
        }

        // if($this->search){
		// 	$filter['or_where_like'] = $this->search;
		// }
        
        return QueryUtility::order_payment_payouts($filter)
                    ->groupBy('order_payment_payouts.partner_id')
                    ->where('partners.name','like',"%{$this->search}%")
                    ->paginate($this->show_entries);
    }

    public function render(){
        $data = $this->data();
        return view('livewire.back-end.payable.completed.listing', compact('data'));
    }

    public function updatingSearch(){
		$this->resetPage();
    }
    
    public function sort($sort){
    	$this->sort_type   = $this->sort_type == 'asc' ? 'desc' : 'asc';
    	return $this->sort = explode('|', $sort);
	}
}
