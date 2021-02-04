<?php

namespace App\Http\Livewire\FrontEnd\Partner\Payable\Payable;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Model\AdminBankAccount;
use App\Model\OrderPaymentPayout;
use App\Model\OrderPaymentPayoutItem;
use App\Model\OrderPaymentPayoutBatch;
use QueryUtility;
use PaymentUtility;
use Utility;
use DB;

class Proceed extends Component
{
    use WithFileUploads;

    public $key_tokens, $partner_id, $receipt, $payable_note;
    
    protected $listeners = [
        'payable_proceed' => 'initialize'
    ];

    public function mount(){
        $this->partner_id = Utility::auth_partner()->id;
    }

    public function initialize($param){
        $this->key_tokens = $param['key_tokens'];
    }

    public function admin_bank_accounts(){
        return AdminBankAccount::with(['bank'])
            ->where('is_active', true)
            ->get();
    }

    public function data(){
        if(!empty($this->key_tokens)){
            if(is_array($this->key_tokens)){
                if(count($this->key_tokens)){
                    $filter = [];
                    $filter['select'] = [
                        'orders.*',
                        'order_payments.id as order_payment_id',
                        'orders.id as order_id',
                        'orders.key_token as order_key_token'
                    ];
                    $filter['where']['order_payment_payouts.id'] = null;
                    $filter['where']['orders.status']            = 'completed';
                    $filter['where_in'][]                        = [
                        'field'  => 'order_payments.payment_method',
                        'values' => ['cash_on_pickup']
                    ];
                    $filter['where_in'][]                        = [
                        'field'  => 'orders.key_token',
                        'values' => $this->key_tokens
                    ];
                    
                    $filter['where']['partners.id'] = $this->partner_id;
                    $filter['order_by']             = 'orders.date_completed asc';
        
                    return QueryUtility::orders($filter)->get();
                }
            }
        }
        
        return [];
    }

    public function render(){
        $data      = $this->data();
        $component = $this;
        return view('livewire.front-end.partner.payable.payable.proceed', compact('data', 'component'));
    }

    public function order_total($order_id){
        return Utility::order_total($order_id)['total'];
    }
    
    public function store(){
        
        $rules = [
            'payable_note' => 'nullable|min:5'
        ];

        if($this->receipt){
            $rules['receipt'] = 'image|mimes:jpeg,jpg,png|max:1024';
        }else{
            $rules['receipt'] = 'nullable';
        }

        $this->validate($rules);
        
        $data = $this->data();

        if(count($data) <= 0){
            $this->emit('alert', [
                'type'  => 'error',
                'title' => 'No Data Found'
            ]);
            return false;
        }

        $overall_total_commission = 0;
        $overall_total_amount     = 0;
        $overall_total_net_amount = 0;

        foreach($data as $key => $row){
            $total_amount              = $this->order_total($row->order_id);
            $sayang_comission          = Utility::sayang_commission($total_amount);
            $overall_total_commission += $sayang_comission['total_commission'];
            $overall_total_amount     += $total_amount;
            $overall_total_net_amount += $sayang_comission['net_amount'];
        }
        
        
        DB::beginTransaction();
        $response = ['success' => false, 'message' => 'An error occured'];

        try{
            $payout_batch                        = new OrderPaymentPayoutBatch();
            $payout_batch->batch_no              = Utility::generate_payout_batch_no();
            $payout_batch->commission_percentage = PaymentUtility::commission_percentage();
            $payout_batch->type                  = 'cash';
            $payout_batch->key_token             = Utility::generate_table_token('OrderPaymentPayoutBatch');
            
            if($payout_batch->save()){
                $payout                    = new OrderPaymentPayout();
                $payout->payout_batch_id   = $payout_batch->id;
                $payout->partner_id        = $this->partner_id;
                $payout->payout_no         = Utility::generate_payout_no();
                $payout->total_amount      = $overall_total_amount;
                $payout->sayang_commission = $overall_total_commission;
                $payout->paymongo_fee      = 0;
                $payout->foreign_fee       = 0;
                $payout->net_amount        = $overall_total_net_amount;
                $payout->key_token         = Utility::generate_table_token('OrderPaymentPayout');
                $payout->status            = 'completed';
                $payout->date_completed    = date('Y-m-d H:i:s');
                
                if($this->receipt){
                    $receipt    = $this->receipt;
                    $collection = 'payout/'.$payout->key_token.'/receipt/';
                    $payout->clearMediaCollection($collection);
                    $payout->addMedia($receipt->getRealPath())->usingFileName($receipt->getClientOriginalName())->toMediaCollection($collection);
                }

                if($payout->save()){
                    foreach($data as $order){
                        $payout_item                          = new OrderPaymentPayoutItem();
                        $payout_item->order_payment_id        = $order->order_payment_id;
                        $payout_item->order_payment_payout_id = $payout->id;
                        $item_success                         = $payout_item->save();

                        if(!$item_success){
                            throw new \Exception('Uncaught Exception');
                        }
                    }

                    $response['success'] = true;
                    $response['message'] = 'Payable successfully completed.';
                }

            }
            
        }catch(\Exception $e){
            $response['success'] = false;
        }

        if($response['success']){
            DB::commit();
            $this->emit('initialize_payable', true);
            $this->emit('alert', [
                'type'    => 'success',
                'title'   => 'Successfully Completed!',
                'message' => $response['message']
            ]);
            $this->reset(['receipt', 'payable_note', 'key_tokens']);
        }else{
            DB::rollback();
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => $response['message']
            ]);
        }
    }
}
