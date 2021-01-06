<?php

namespace App\Http\Livewire\FrontEnd\HelpCentre;

use Livewire\Component;
use App\Model\HelpCentre;

class Topics extends Component
{
    public $is_select = false, $selected_topic_id;
    
    public function data(){
        
        $data = HelpCentre::with(['help_centre_question.help_centre_answer'])
                ->where('is_display', true)
                ->orderBy('arrangement', 'asc')
                ->get();

        return $data;
    }
    public function render()
    {
        $data = $this->data();
        return view('livewire.front-end.help-centre.topics', compact('data'));
    }

    public function select_topic($topic_id){
        $this->selected_topic_id = $topic_id;
        $this->is_select         = true;
    }
}
