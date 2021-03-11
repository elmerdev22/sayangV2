<?php

use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Seeder;
use App\Model\Category;
use App\Helpers\Utility;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_name = 'Others';

        $category             = new Category();
        $category->name       = $category_name;
        $category->is_display = 1;
        $category->key_token  = Utility::generate_table_token('Category');
        $category->slug       = SlugService::createSlug(Category::class, 'slug', $category_name);
        $category->save();
    }
}
