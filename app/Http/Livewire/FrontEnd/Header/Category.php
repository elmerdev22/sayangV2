<?php

namespace App\Http\Livewire\FrontEnd\Header;

use Livewire\Component;
use App\Model\Category as Categories;

class Category extends Component
{
    public $type;
    
    public function mount($type){
        $this->type = $type;
    }

    public function render()
    {
        $data = Categories::with('sub_categories')
                        ->orderBy('name','asc')
                        ->get();

        return view('livewire.front-end.header.category', compact('data'));
    }
}
