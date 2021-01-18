<?php

namespace App\Http\Livewire\FrontEnd\Home;

use Livewire\Component;
use App\Model\ImageSetting;

class CarouselSlider extends Component
{
    public function render()
    {
        $data = ImageSetting::orderBy('arrangement','asc')->where('is_display', true)->get();
        return view('livewire.front-end.home.carousel-slider', compact('data'));
    }
}
