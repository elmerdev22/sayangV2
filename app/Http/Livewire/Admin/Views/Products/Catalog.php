<?php

namespace App\Http\Livewire\Admin\Views\Products;

use Livewire\Component;
use Category;
class Catalog extends Component
{
    public $input_category;
    public function validator($data){
        
    }
    public function add_category(){
        
    }
    public function render()
    {
        return view('livewire.admin.views.products.catalog');
    }
}
