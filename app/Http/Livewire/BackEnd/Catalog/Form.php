<?php

namespace App\Http\Livewire\BackEnd\Catalog;

use Livewire\Component;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class Form extends Component
{
    public function render()
    {
		$slug = SlugService::createSlug(Post::class, 'slug', 'My First Post');
        return view('livewire.back-end.catalog.form');
    }
}
