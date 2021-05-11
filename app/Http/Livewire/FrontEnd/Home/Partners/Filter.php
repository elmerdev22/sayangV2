<?php

namespace App\Http\Livewire\FrontEnd\Home\Partners;

use Livewire\Component;

class Filter extends Component
{
    public function render(){
        return view('livewire.front-end.home.partners.filter');
    }

    public function clear_filter(){
        $this->emit('clear_filter');
    }
}
