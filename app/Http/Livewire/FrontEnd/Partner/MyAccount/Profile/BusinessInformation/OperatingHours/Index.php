<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyAccount\Profile\BusinessInformation\OperatingHours;

use Livewire\Component;
use App\Model\OperatingHour;
use App\Model\Partner;
use Utility;

class Index extends Component
{
    public $days, $partner, $open_time = '08:00', $close_time = '17:00', $selected_id, $day_word;

    public function mount(){
        
        $this->partner = Utility::auth_partner();
        $this->days    = Utility::days();
    }

    public function render()
    {
        $data = Partner::with(['operating_hours'])->where('id', $this->partner->id)->first();
        return view('livewire.front-end.partner.my-account.profile.business-information.operating-hours.index', compact('data'));
    }

    public function edit($id)
    {
        $this->selected_id = $id;
        $data              = OperatingHour::find($id);
        
        if($data->open_time){
            $this->open_time = $data->open_time;
        }
        if($data->close_time){
            $this->close_time = $data->close_time;
        } 
    }

    public function save(){
        
        $this->validate([
            'open_time'  => 'required',
            'close_time' => 'required|after:open_time'
        ],
        [
            'after' => 'The close time must be a time after open time.'
        ]);

        $data             = OperatingHour::find($this->selected_id);
        $data->open_time  = $this->open_time;
        $data->close_time = $this->close_time;
        if($data->save()){
            $this->emit('alert', [
                'type'    => 'success',
                'title'   => 'Successfully Saved',
                'message' => 'Operating hours for '.$this->day_word.' successfully saved.'
            ]);
        }
        else{
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'An error occured'
            ]);
        }
    }

    public function status($id){
        
        $data         = OperatingHour::find($id);
        $data->status = $data->status ? false : true;
        if($data->save()){
            $this->emit('alert', [
                'type'    => 'success',
                'title'   => 'Successfully Saved',
                'message' => 'Status Successfully saved.'
            ]);
        }
        else{
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'An error occured'
            ]);
        }
    }
}
