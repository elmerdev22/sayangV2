<?php

namespace App\Http\Livewire\BackEnd\Setting\HelpCentre\Edit;

use Livewire\Component;
use App\Model\HelpCentreQuestion;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Model\HelpCentreAnswer;

class Question extends Component
{
    public $help_centre_id, $question, $selected_question_id, $answer;

    public function mount($help_centre_id){
        $this->help_centre_id = $help_centre_id;
    }

    public function data(){
        $data = HelpCentreQuestion::with(['help_centre_answer'])
                ->where('help_centre_id', $this->help_centre_id)
                ->get();
                
        return $data;
    }

    public function render()
    {
        $data = $this->data();
        return view('livewire.back-end.setting.help-centre.edit.question', compact('data'));
    }

    public function save_question(){
        
        $this->validate([
            'question' => 'required',
        ]);

        $data                 = HelpCentreQuestion::firstOrNew(['id' => $this->selected_question_id]);
        $data->help_centre_id = $this->help_centre_id;
        $data->question       = $this->question;
        $data->slug           = SlugService::createSlug(HelpCentreQuestion::class, 'slug', $this->question);
        if($data->save()){
            $this->question = '';
            $this->emit('close_modal');
        	$this->emit('notif_alert', [
                'timer'    => 1500,
                'position' => 'center',
                'type'     => 'success',
                'message'  => 'Successfully Added!'
            ]);
        }
        $this->selected_question_id = '';
    }

    public function delete_question($id){
        $data = HelpCentreQuestion::where('id', $id)->first();
        if($data->delete()){
            $this->emit('notif_alert', [
                'timer'    => 1500,
                'position' => 'center',
                'type'     => 'success',
                'message'  => 'Successfully Deleted!'
            ]);
        }
    }

    public function delete_answer($id){
        $data = HelpCentreAnswer::where('id', $id)->first();
        if($data->delete()){
            $this->emit('notif_alert', [
                'timer'    => 1500,
                'position' => 'center',
                'type'     => 'success',
                'message'  => 'Successfully Deleted!'
            ]);
        }
    }

    
    public function add_answer(){
        
        $this->validate([
            'answer' => 'required',
        ]);

        $data                          = new HelpCentreAnswer();
        $data->help_centre_question_id = $this->selected_question_id;
        $data->answer                  = $this->answer;
        if($data->save()){
            $this->answer = '';
        	$this->emit('notif_alert', [
                'timer'    => 1500,
                'position' => 'center',
                'type'     => 'success',
                'message'  => 'Successfully Added!'
            ]);
        }
    }
}
