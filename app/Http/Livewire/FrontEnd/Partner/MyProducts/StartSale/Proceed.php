<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyProducts\StartSale;

use Livewire\Component;
use App\Model\ProductPost;
use Utility;

class Proceed extends Component
{
    public $partner, $selected_products = [], $start_date, $end_date;
    protected $listeners = [
        'proceed_to_start_sale' => 'initialize'
    ];

    public function mount(){
        $this->partner = Utility::auth_partner();
    }

    public function initialize($param){
        $this->selected_products = $param['data'];
        $this->emit('proceed_done', true);
    }

    public function render(){
        return view('livewire.front-end.partner.my-products.start-sale.proceed');
    }
}
