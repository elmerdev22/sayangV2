<?php

namespace App\Http\Livewire\FrontEnd;

use Livewire\Component;
use App\notifications as notif_model;
use App\Events\notifications as notif_event;
class Notification extends Component
{
	protected $listeners = ['notifications' => '$refresh'];
    public function render()
    {
    	$data = notif_model::orderBy('created_at','desc')->get();
        return view('livewire.front-end.notification', compact('data'));
    }
}
