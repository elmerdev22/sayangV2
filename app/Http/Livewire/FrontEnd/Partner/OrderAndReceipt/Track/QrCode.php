<?php

namespace App\Http\Livewire\FrontEnd\Partner\OrderAndReceipt\Track;

use Livewire\Component;

class QrCode extends Component
{
    public $qr_code;

    protected $listeners = [
        'initialize_qr_code' => 'initialize'
    ];

    public function initialize($data){
        $this->qr_code = $data['qr_code'];
    }

    public function render(){
        return view('livewire.front-end.partner.order-and-receipt.track.qr-code');
    }
}
