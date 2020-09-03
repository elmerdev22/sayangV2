<?php

namespace App\Http\Livewire\FrontEnd;

use Livewire\Component;
use App\notifications;
class Button extends Component
{
    public function render()
    {
        return view('livewire.front-end.button');
    }

    public function add(){
    	$notif = new notifications();
    	$notif->message = 'hello world!';
    	if($notif->save()){
    		event(new \App\Events\notifications('hello world!'));
    	}
    }
}
