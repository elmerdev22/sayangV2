<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyProducts\Edit;

use Livewire\Component;
use App\Model\Product;
use App\Model\ProductTag;
use App\Model\Category;
use App\Model\SubCategory;
use App\Model\ProductSubCategory;
use App\Rules\Money;
use DB;
use Utility;
use TagNameUtility;

class Information extends Component
{
    public $account, $partner, $name, $category, $sub_categories = [], $tags = [];
    public $buy_now_price, $lowest_price, $description, $reminders;

    public function mount($product_id){
        $this->partner       = Utility::auth_partner();
        $this->account       = Utility::auth_user_account();
        $this->product_id    = $product_id;
        $product             = Product::findOrFail($product_id);
        $this->name          = $product->name;
        $this->category      = $product->category_id;
        $this->buy_now_price = $product->buy_now_price;
        $this->lowest_price  = $product->lowest_price;
        $this->description   = $product->description;
        $this->reminders     = $product->reminders;
        //subcat
        //tags
        // $this->emit('reload_sub_categories', ['sub_categories' => );
    }

    public function reset_var($var){
        $this->reset($var);
    }

    public function reload_sub_categories(){
        $sub_categories = SubCategory::where('category_id', $this->category)
            ->orderBy('name', 'asc')
            ->get()
            ->toArray();

        $this->emit('reload_sub_categories', ['sub_categories' => $sub_categories]);
    }

    public function categories(){
        return Category::orderBy('name', 'asc')->where('is_display', true)->get();
    }

    public function render(){
        $component = $this;
        return view('livewire.front-end.partner.my-products.edit.information', compact('component'));
    }

    public function update(){
        $rules = [
            'name'           => 'required|max:200|min:2',
            'category'       => 'required|numeric',
            'sub_categories' => 'nullable',
            'tags'           => 'nullable',
            'buy_now_price'  => ['nullable', new Money()],
            'lowest_price'   => ['nullable', new Money()],
            'description'    => 'nullable',
            'reminders'      => 'nullable',
        ];

        $this->validate($rules);

        $response = ['success' => false, 'message' => ''];
    }
}
