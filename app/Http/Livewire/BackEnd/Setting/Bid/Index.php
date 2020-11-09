<?php

namespace App\Http\Livewire\BackEnd\Setting\Bid;

use Livewire\Component;
use App\Model\Setting;
use Utility;
class Index extends Component
{
    public $minimum_bids;

    public function mount(){
        $this->minimum_bids = Utility::settings('minimum_bids');
    }
    public function render()
    {
        return view('livewire.back-end.setting.bid.index');
    }

    public function update_minimum_bids(){

        $data                 = Setting::where('settings_key', 'minimum_bids')->first();
        $data->settings_value = $this->minimum_bids;
        if($data->save()){
            $this->emit('alert', [
                'type'              => 'success',
                'title'             => 'Successfully Updated',
                'message'           => 'Minimum Bids Successfully Updated!. <br><br>',
                'timer'             => 1500,
                'showConfirmButton' => false
            ]);
        }
        $this->mount();
    }
}
