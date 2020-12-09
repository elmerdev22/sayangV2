<?php

namespace App\Http\Livewire\FrontEnd\User\Ratings;

use Livewire\Component;
use App\Model\Rating;

class Index extends Component
{
    public $star   = 5;
    public $rating = [];
    public $comment;

    public function render()
    {
        $data = Rating::orderBy('rating','asc')->where('star', $this->star)->get();
        return view('livewire.front-end.user.ratings.index', compact('data'));
    }

    public function submit(){
        dd($this->rating);
    }
}
