<?php

namespace App\Http\Livewire\BackEnd\Payable\CompletedInformation\Receivable;

use Livewire\Component;
use QueryUtility;

class Listing extends Component
{
    public $partner_id;
    
    public function mount($partner_id){
        $this->partner_id = $partner_id;
    }

    public function render(){
        return view('livewire.back-end.payable.completed-information.receivable.listing');
    }
}
