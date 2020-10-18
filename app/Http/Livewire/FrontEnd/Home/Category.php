<?php

namespace App\Http\Livewire\FrontEnd\Home;

use Livewire\Component;
use App\Model\Category as Categories;

class Category extends Component
{
    public function render()
    {
        $data = Categories::orderBy('name','asc')
                        ->where('is_display', 1)
                        ->get();

        return view('livewire.front-end.home.category', compact('data'));
    }
}
