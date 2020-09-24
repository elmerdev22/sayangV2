<?php

namespace App\Http\Livewire\Admin\Views\Products\Catalog\Components;

use Livewire\Component;
use App\Model\Category;
class MainCategoryCards extends Component
{
	protected $listeners = ['main_category' => '$refresh'];
    public function render()
    {
        $main_categories = Category::where('parent_category_id','=',NULL)->get();

        return view('livewire.admin.views.products.catalog.components.main-category-cards',compact('main_categories'));
    }
}
