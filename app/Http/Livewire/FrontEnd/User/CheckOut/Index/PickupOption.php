<?php

namespace App\Http\Livewire\FrontEnd\User\CheckOut\Index;

use Livewire\Component;

class PickupOption extends Component
{
    public $pickup_option;

    public function render(){
        return view('livewire.front-end.user.check-out.index.pickup-option');
    }

    public function change_pickup_option($pickup_option){
        $this->pickup_option = $pickup_option;
        
        $this->emit('set_pickup_option', $pickup_option);
    }
}
