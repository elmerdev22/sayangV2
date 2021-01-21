<?php

namespace App\Http\Livewire\BackEnd\Payable\Information;

use Livewire\Component;
use App\Model\OrderPaymentPayout;
use UploadUtility;

class Index extends Component
{
    public $payout_id;
    protected $listeners = [
        'initialize_payout_information' => '$refresh'
    ];

    public function mount($payout_id){
        $this->payout_id = $payout_id;
    }

    public function data(){
        return OrderPaymentPayout::with([
                'order_payment_payout_batch',
                'partner.user_account',
                'partner.partner_bank_accounts.bank'
            ])
            ->findOrFail($this->payout_id);
    }

    public function render(){
        $data           = $this->data();
        $payout_receipt = $this->payout_receipt();

        return view('livewire.back-end.payable.information.index', compact('data', 'payout_receipt'));
    }

    public function payout_receipt(){
        $data     = $this->data();
        $response = null;
        
        $receipt = UploadUtility::payout_receipt($data->key_token);

        if(count($receipt) > 0){
            $response = $receipt[0];
        }

        return $response; 
    }
}
