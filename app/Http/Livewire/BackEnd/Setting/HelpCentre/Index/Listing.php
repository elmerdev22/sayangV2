<?php

namespace App\Http\Livewire\BackEnd\Setting\HelpCentre\Index;

use Livewire\Component;
use App\Model\HelpCentre;

class Listing extends Component
{
    protected $listeners = ['help-centre-listing' => '$refresh'];

    public $search;

    public function data(){
        $data = HelpCentre::with(['help_centre_question'])
                ->orderBy('arrangement', 'asc')
                ->where('topic', 'like', '%'.$this->search.'%')
                ->paginate(10);
                
        return $data; 
    }

    public function render()
    {
        $data = $this->data();
        // dd($data);
        return view('livewire.back-end.setting.help-centre.index.listing', compact('data'));
    }

    public function display($id){
        $data             = HelpCentre::where('id', $id)->first();
        $data->is_display = $data->is_display ? false : true;
        $data->save();
        
        $this->emit('notif_alert', [
            'timer'    => 1500,
            'position' => 'center',
            'type'     => 'success',
            'message'  => 'Successfully Saved!'
        ]);    
    }

    
    public function delete($id){
        $collection = 'help-centre';
        $data       = HelpCentre::where('id', $id)->first();
        $data->clearMediaCollection($collection);
        
        if($data->delete()){
            $this->emit('notif_alert', [
                'timer'    => 1500,
                'position' => 'center',
                'type'     => 'success',
                'message'  => 'Successfully Deleted!'
            ]);
            
            $this->emit('help-centre-add');
        }
    }

    public function update_arrangement($id, $arrangement){
        $data              = HelpCentre::where('id', $id)->first();
        $data->arrangement = $arrangement;
        if($data->save()){
            $this->emit('notif_alert', [
                'timer'    => 1500,
                'position' => 'center',
                'type'     => 'success',
                'message'  => 'Successfully Saved!'
            ]);            
        }
    }
}
