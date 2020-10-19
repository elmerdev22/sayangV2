<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyProducts;

use Livewire\Component;
use App\Model\Category;
use App\Model\SubCategory;
use DB;
use Utility;
use TagNameUtility;

class Add extends Component
{
    public $partner, $name, $category, $sub_categories = [], $tags = [];
    public $buy_now_price, $lowest_price, $description, $reminders;
    public $featured_photo, $photos=[];

    public function mount(){
        $this->partner = Utility::auth_partner();
    }

    public function categories(){
        return Category::orderBy('name', 'asc')->where('is_display', true)->get();
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

    public function render(){
        $component = $this;
        return view('livewire.front-end.partner.my-products.add', compact('component'));
    }

    public function store(){
        $rules = [
            'name'           => 'required|max:200|min:2',
            'category'       => 'required|numeric',
            'sub_categories' => 'nullable',
            'tags'           => 'nullable',
            'buy_now_price'  => 'nullable',
            'lowest_price'   => 'nullable',
            'description'    => 'nullable',
            'reminders'      => 'nullable'
        ];
        
        $photo_validation = 'nullable|image|mimes:jpeg,jpg,png|max:2048';

        if(!empty($this->featured_photo)){
            $rules['featured_photo'] = $photo_validation;
        }
        if(!empty($this->photos)){
            $rules['photos'] = $photo_validation;
        }

        $this->validate($rules);

        $response = ['success' => false, 'message' => ''];

        DB::beginTransaction();

        try{
            // Do the insert of product here...
            $response['success'] = true;
        }catch(\Exception $e){
            $response['success'] = false;
        }

        if($response['success']){
            DB::commit();
            $this->reset();
            $this->emit('alert_link', [
                'type'     => 'success',
                'title'    => 'Successfully Added',
                'message'  => 'Product successfully saved.',
            ]);
        }else{
            DB::rollback();
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'An error occured'
            ]);
        }
    }
}
