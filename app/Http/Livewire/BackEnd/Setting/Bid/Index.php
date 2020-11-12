<?php

namespace App\Http\Livewire\BackEnd\Setting\Bid;

use Livewire\Component;
use App\Model\Setting;
use Utility;
class Index extends Component
{
    public $bid_increment_percent;

    public function mount(){
        $this->bid_increment_percent = Utility::settings('bid_increment_percent');
    }
    public function render()
    {
        return view('livewire.back-end.setting.bid.index');
    }

    public function update_bid_increment_percent(){

        $data                 = Setting::where('settings_key', 'bid_increment_percent')->first();
        $data->settings_value = $this->bid_increment_percent;
        if($data->save()){
            $this->emit('alert', [
                'type'              => 'success',
                'title'             => 'Successfully Updated',
                'message'           => 'Bid Increment Percent Successfully Updated!. <br><br>',
                'timer'             => 1500,
                'showConfirmButton' => false
            ]);
        }
        $this->mount();
    }
}
