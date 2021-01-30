<?php

namespace App\Http\Livewire\BackEnd\Payable\Receivable;

use Livewire\Component;
use Livewire\WithPagination;
use App\Model\Partner;
use QueryUtility;
use Utility;

class Listing extends Component
{
    use WithPagination;
    public $status, $search = '', $show_entries=10, $sort = [], $sort_type='asc';

    public function mount(){
        $this->sort = ['partners.name'];
    }

    public function data($partner_id=null){
        $filter = [];
        
        if($partner_id){
            $filter['select'] = [
                'orders.*',
                'orders.id as order_id'
            ];
        }else{
            $filter['select'] = [
                'partners.*',
                'partners.id as partner_id',
                'partners.key_token as partner_key_token'
            ];
        }

        $filter['where']['orders.status'] = 'completed';
        $filter['where_in'][]             = [
            'field'  => 'order_payments.payment_method',
            'values' => ['cash_on_pickup']
        ];
        $filter['where']['order_payment_payout_items.id'] = null;
        
        if($partner_id){
            $filter['where']['orders.partner_id'] = $partner_id;
        }

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

        if($partner_id){
            return QueryUtility::orders($filter);
        }else{
            return QueryUtility::orders($filter)->groupBy('orders.partner_id')
                                ->where('partners.name','like',"%{$this->search}%")
                                ->paginate($this->show_entries);
        }
    }

    public function orders($partner_id){
        $total_sayang_commission = 0;
        $total_amount            = 0;
        $data                    = $this->data($partner_id);

        foreach($data->get() as $row){
            $order_total              = Utility::order_total($row->id)['total'];
            $sayang_commission        = Utility::sayang_commission($order_total);
            $total_sayang_commission += $sayang_commission['total_commission'];
            $total_amount            += $order_total;
        }

        return [
            'total_sayang_commission' => $total_sayang_commission,
            'total_amount'            => $total_amount,
            'total_order'             => $data->count()
        ];
    }

    public function render(){
        $data      = $this->data();
        $component = $this;
        
        return view('livewire.back-end.payable.receivable.listing', compact('data', 'component'));
    }

    public function updatingSearch(){
		$this->resetPage();
    }
    
    public function sort($sort){
    	$this->sort_type   = $this->sort_type == 'asc' ? 'desc' : 'asc';
    	return $this->sort = explode('|', $sort);
    }
    
    public function partner_receivable($key_token){
        
        $partner = Partner::select([
                'partners.*',
                'user_accounts.key_token as account_key_token'
            ])
            ->join('user_accounts', 'user_accounts.id', '=', 'partners.user_account_id')
            ->where('partners.key_token', $key_token)
            ->firstOrFail();

        $this->emit('partner_receivable', [
            'partner_id'                => $partner->id,
            'partner_name'              => ucfirst($partner->name),
            'partner_account_key_token' => $partner->account_key_token
        ]);
    }
}
