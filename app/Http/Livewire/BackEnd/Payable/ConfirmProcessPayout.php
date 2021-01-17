<?php

namespace App\Http\Livewire\BackEnd\Payable;

use Livewire\Component;

class ConfirmProcessPayout extends Component
{
    public $payout_id;

    public function mount($payout_id){
        $this->payout_id = $payout_id;
    }
    
    public function render(){
        return view('livewire.back-end.payable.confirm-process-payout');
    }
}
