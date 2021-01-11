<?php

namespace App\Http\Livewire\BackEnd\OrderAndReceipt\Track;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Model\Order;
use App\Model\OrderItem;
use App\Model\OrderPayment;
use App\Model\OrderPaymentPayout;
use PaymentUtility;
use Utility;
use DB;

class ProcessPayout extends Component
{
    use WithFileUploads;

    public $order_id, $order_payment_id, $receipt, $payout_note;

    public function mount($order_id){
        $this->order_id         = $order_id;
        $this->order_payment_id = OrderPayment::where('order_id', $this->order_id)->first()->id;
    }

    public function render(){
        return view('livewire.back-end.order-and-receipt.track.process-payout');
    }

    public function store(){
        $order_payment_payout = OrderPaymentPayout::where('order_payment_id', $this->order_payment_id)->first();
        
        if($order_payment_payout){
            $this->emit('alert', [
                'type'  => 'error',
                'title' => 'Unable to Process'
            ]);

            return false;
        }

        $rules = [
            'payout_note' => 'nullable|min:5'
        ];

        if($this->receipt){
            $rules['receipt'] = 'image|mimes:jpeg,jpg,png|max:1024';
        }else{
            $rules['receipt'] = 'nullable';
        }

        $this->validate($rules);
        DB::beginTransaction();
        $response = ['success' => false, 'message' => 'An error occured'];
        
        try{
            $payout                        = new OrderPaymentPayout();
            $payout->order_payment_id      = $this->order_payment_id;
            $payout->note                  = $this->payout_note;
            $payout->commission_percentage = PaymentUtility::commission_percentage();
            $payout->key_token             = Utility::generate_table_token('OrderPaymentPayout');
            
            if($this->receipt){
                $receipt    = $this->receipt;
                $collection = 'payout/'.$payout->key_token.'/receipt/';
                $payout->clearMediaCollection($collection);
                $payout->addMedia($receipt->getRealPath())->usingFileName($receipt->getClientOriginalName())->toMediaCollection($collection);
            }

            if($payout->save()){
                $response['success'] = true;
                $response['message'] = 'Payout successfully processed.';                
            }

        }catch(\Exception $e){
            $response['success'] = false;
        }

        if($response['success']){
            DB::commit();
            $this->emit('alert_link', [
                'type'    => 'success',
                'title'   => 'Successfully Processed',
                'message' => $response['message']
            ]);
            $this->reset(['receipt', 'payout_note']);
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