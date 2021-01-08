<?php

namespace App\Http\Livewire\FrontEnd\HelpCentre;

use Livewire\Component;
use App\Model\HelpCentreQuestion;

class Search extends Component
{
    public $search;

    public function data(){
        $data = HelpCentreQuestion::where('question', 'like', '%'.$this->search.'%')->get();
        return $data;
    }

    public function render()
    {
        $data = $this->data();
        return view('livewire.front-end.help-centre.search', compact('data'));
    }

    public function select_question($id){
        $data         = HelpCentreQuestion::where('id', $id)->first();
        $this->search = $data->question;
        $this->emit('submit_form');
    }
}
