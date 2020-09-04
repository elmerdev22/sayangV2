<?php

namespace App\Http\Livewire\FrontEnd;

use Livewire\Component;
use App\notifications as notif;
class Button extends Component
{
    public function render()
    {
        return view('livewire.front-end.button');
    }

    public function add(){
    	$notif = new notif();
    	$notif->message = 'hello world!';
    	if($notif->save()){
    		event(new \App\Events\notifications('hello world!'));
    	}
    }
}
