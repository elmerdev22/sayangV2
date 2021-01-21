<?php

namespace App\Http\Livewire\BackEnd\Payable;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Model\OrderPaymentPayout;
use DB;

class ConfirmProcessPayout extends Component
{
    use WithFileUploads;

    public $payout_id, $receipt, $payout_note;

    protected $listeners = [
        'initialize_confirm_process_payout' => 'initialize'
    ];

    public function mount($payout_id = null){
        $this->payout_id = $payout_id;
    }

    public function initialize($payout_id){
        $this->payout_id   = $payout_id;
        $this->reset(['payout_note', 'receipt']);
    }
    
    public function data(){
        if($this->payout_id){
            return OrderPaymentPayout::with([
                'order_payment_payout_batch',
                'partner.user_account',
                'partner.partner_bank_accounts.bank'
            ])
            ->findOrFail($this->payout_id);
        }else{
            return [];
        }
    }

    public function render(){
        $data = $this->data();
        return view('livewire.back-end.payable.confirm-process-payout', compact('data'));
    }

    public function update(){
        $payout = OrderPaymentPayout::findOrFail($this->payout_id);

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
            $payout->note           = $this->payout_note;
            $payout->status         = 'completed';
            $payout->date_completed = date('Y-m-d H:i:s');
            
            if($payout->save()){
                if($this->receipt){
                    $receipt    = $this->receipt;
                    $collection = 'payout/'.$payout->key_token.'/receipt/';
                    $payout->clearMediaCollection($collection);
                    $payout->addMedia($receipt->getRealPath())->usingFileName($receipt->getClientOriginalName())->toMediaCollection($collection);
                }
                
                if($payout->save()){
                    $response['success'] = true;
                    $response['message'] = 'Payout successfully confirmed.';                
                }
            }
        }catch(\Exception $e){
            $response['success'] = false;
        }

        if($response['success']){
            DB::commit();
            $this->emit('initialize_process_payout_listing', true);
            $this->emit('initialize_payout_information', true);
            $this->emit('close_modal_confirm_process_payout', true);
            $this->emit('alert', [
                'type'    => 'success',
                'title'   => 'Successfully Updated!',
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
