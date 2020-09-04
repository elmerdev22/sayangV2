<?php

namespace App\Http\Livewire\FrontEnd\Product;

use Livewire\Component;

class Details extends Component
{
	public $buy_now = true;

    public function render()
    {
        return view('livewire.front-end.product.details');
    }

    public function change_action($buy_now){
    	$this->buy_now = $buy_now == true ? false : true;
    }
}
