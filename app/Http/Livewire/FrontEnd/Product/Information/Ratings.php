<?php

namespace App\Http\Livewire\FrontEnd\Product\Information;

use Livewire\Component;
use App\Model\PartnerRating;
use Utility;
class Ratings extends Component
{
    public $partner_id;
    public $show = 5;

    public function mount($partner_id){
        $this->partner_id = $partner_id;
    }

    public function data(){
        return PartnerRating::with(['user_account'])->where('partner_id', $this->partner_id)->paginate($this->show);
    }

    public function render()
    {
        $data = $this->data();
        return view('livewire.front-end.product.information.ratings', compact('data'));
    }

    public function load_more(){
        $this->show = $this->show + 5;
    }
}
