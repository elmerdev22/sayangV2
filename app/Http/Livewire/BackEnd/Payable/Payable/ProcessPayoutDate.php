<?php

namespace App\Http\Livewire\BackEnd\Payable\Payable;

use Livewire\Component;
use QueryUtility;

class ProcessPayoutDate extends Component
{
    public $date_from, $date_to;

    public function render(){

        return view('livewire.back-end.payable.payable.process-payout-date');
    }

    public function update(){
        $rules = [
            'date_from' => 'required|date',
            'date_to'   => 'required|date|after_or_equal:date_from'
        ];

        $this->validate($rules);
        
        $this->emit('initialize_process_payout_date', [
            'date_from' => $this->date_from,
            'date_to'   => $this->date_to
        ]);
    }
}
