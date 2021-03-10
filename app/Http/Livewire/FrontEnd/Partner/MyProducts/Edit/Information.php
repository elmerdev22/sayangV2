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
    public $product_id, $account, $partner, $name, $category, $old_category, $sub_categories = [], $tags = [];
    public $regular_price, $buy_now_price, $lowest_price, $description, $reminders;
    public $selected_sub_categories = [], $initial_sub_categories=[], $money_input_initialize=[];
    public $about_product, $weight, $width, $height, $length, $shelf_life, $paper_packaging;

    public function mount($product_id){
        $this->partner       = Utility::auth_partner();
        $this->account       = Utility::auth_user_account();
        $this->product_id    = $product_id;
        $product             = Product::findOrFail($product_id);
        $this->name          = $product->name;
        $this->category      = $product->category_id;
        $this->old_category  = $product->category_id;
        
        $this->regular_price = $product->regular_price;
        $this->buy_now_price = $product->buy_now_price;
        $this->lowest_price  = $product->lowest_price;

        $this->description     = $product->description;
        $this->reminders       = $product->reminders;
        $this->about_product   = $product->about_product;
        $this->weight          = $product->weight;
        $this->width           = $product->width;
        $this->height          = $product->height;
        $this->length          = $product->length;
        $this->shelf_life      = $product->shelf_life;
        $this->paper_packaging = $product->paper_packaging;
        
        $this->money_input_initialize = [
            'regular_price' => $this->regular_price,
            'buy_now_price' => $this->buy_now_price,
            'lowest_price'  => $this->lowest_price
        ];

        $product_tags = ProductTag::with(['tag'])
            ->where('product_id', $product_id)
            ->get();

        foreach($product_tags as $product_tag){
            $this->tags[] = $product_tag->tag->name;
        }

        $product_sub_categories = ProductSubCategory::where('product_id', $product_id)->get();
        
        foreach($product_sub_categories as $product_sub_category){
            $this->selected_sub_categories[] = $product_sub_category->sub_category_id;
        }

        $this->reload_sub_categories(true);
    }

    public function reset_var($var){
        $this->reset($var);
    }

    public function reload_sub_categories($mount=false){
        $sub_categories = SubCategory::where('category_id', $this->category)
            ->orderBy('name', 'asc')
            ->get()
            ->toArray();
        
        if(!$mount){
            $this->emit('reload_sub_categories', [
                'sub_categories' => $sub_categories
            ]);
        }else{
            $this->initial_sub_categories = [
                'sub_categories'          => $sub_categories,
                'selected_sub_categories' => $this->selected_sub_categories
            ];
        }
    }

    public function categories(){
        return Category::orderBy('name', 'asc')->where('is_display', true)->get();
    }

    public function render(){
        $component        = $this;
        $price_percentage = Utility::price_percentage($this->regular_price, $this->buy_now_price);

        return view('livewire.front-end.partner.my-products.edit.information', compact('component', 'price_percentage'));
    }

    public function update(){
        $this->regular_price = Utility::decimal_format($this->regular_price);
        $this->buy_now_price = Utility::decimal_format($this->buy_now_price);
        $this->lowest_price  = Utility::decimal_format($this->lowest_price);
        $rules = [
            'name'           => 'required|max:200|min:2',
            'category'       => 'required|numeric',
            'sub_categories' => 'nullable',
            'tags'           => 'nullable',
            'regular_price'  => ['required', new Money(), 'gte:buy_now_price'],
            'buy_now_price'  => ['required', new Money(), 'lte:regular_price'],
            'lowest_price'   => ['required', new Money(), 'lte:buy_now_price'],
            'description'    => 'required',
            'reminders'      => 'required',
            'weight'         => 'required|numeric',
            'width'          => 'required',
            'height'         => 'required',
            'length'         => 'required',
            'shelf_life'     => 'required|numeric|min:0',
        ];

        $this->emit('money_input_field', [
            'regular_price' => $this->regular_price,
            'buy_now_price' => $this->buy_now_price,
            'lowest_price'  => $this->lowest_price
        ]);

        $this->validate($rules);

        $response = ['success' => false, 'message' => ''];
        DB::beginTransaction();

        try{
            $product = Product::findOrFail($this->product_id);

            if($this->name != $product->name){
                $product->name = $this->name;
                $product->slug = Utility::generate_table_slug('Product', $this->name);
            }
            
            $product->category_id     = $this->category;
            $product->description     = $this->description;
            $product->reminders       = $this->reminders;
            $product->regular_price   = $this->regular_price;
            $product->buy_now_price   = $this->buy_now_price;
            $product->lowest_price    = $this->lowest_price;
            $product->about_product   = $this->about_product;
            $product->weight          = $this->weight;
            $product->width           = $this->width;
            $product->height          = $this->height;
            $product->length          = $this->length;
            $product->shelf_life      = $this->shelf_life;
            $product->paper_packaging = $this->paper_packaging ? 1 : 0 ;
            
            if($product->save()){
                $validator_checker = array();
                
                // Update Tags
                $product_tags = ProductTag::with(['tag'])
                    ->where('product_id', $product->id);

                $tags = [];

                if(!empty($this->tags)){
                    if(is_array($this->tags)){
                        foreach($this->tags as $tag){
                            $tag_id = TagNameUtility::validate('Tag', $tag);
                            $tags[] = [
                                'id'   => $tag_id,
                                'name' => $tag
                            ];
                        }
                    }else{
                        array_push($validator_checker, false);
                    }
                }else{
                    if($product_tags->count() > 0){
                        foreach($product_tags->get() as $product_tag){
                            ProductTag::find($product_tag->id)->delete();
                        }
                    }
                }
                
                if($product_tags->count() > 0){
                    $product_tag_collection = [];
                    foreach($product_tags->get() as $product_tag){
                        $product_tag_collection[] = [
                            'id'   => $product_tag->tag->id,
                            'name' => $product_tag->tag->name
                        ];
                    }

                    foreach($tags as $tag_row){
                        $do_insert = true;

                        foreach($product_tag_collection as $product_tag_collection_row){
                            if($tag_row['id'] == $product_tag_collection_row['id']){
                                $do_insert = false;
                                break;
                            }
                        }

                        if($do_insert){
                            $new_product_tag             = new ProductTag();
                            $new_product_tag->tag_id     = $tag_row['id'];
                            $new_product_tag->product_id = $product->id;
                            $new_product_tag->key_token  = Utility::generate_table_token('ProductTag');
    
                            if($new_product_tag->save()){
                                array_push($validator_checker, true);
                            }else{
                                array_push($validator_checker, false);
                            }
                        }
                    }

                    foreach($product_tag_collection as $product_tag_collection_row){
                        $do_delete = true;
                        
                        foreach($tags as $tag_row){
                            if($tag_row['id'] == $product_tag_collection_row['id']){
                                $do_delete = false;
                                break;
                            }
                        }

                        if($do_delete){
                            $product_tag_delete = ProductTag::where('product_id', $product->id)
                                ->where('tag_id', $product_tag_collection_row['id'])
                                ->first();

                            if($product_tag_delete){
                                if($product_tag_delete->delete()){
                                    array_push($validator_checker, true);
                                }else{
                                    array_push($validator_checker, false);
                                }
                            }
                        }
                    }

                }else{
                    if(count($tags) > 0){
                        foreach($tags as $tag_row){
                            $new_product_tag             = new ProductTag();
                            $new_product_tag->tag_id     = $tag_row['id'];
                            $new_product_tag->product_id = $product->id;
                            $new_product_tag->key_token  = Utility::generate_table_token('ProductTag');
    
                            if($new_product_tag->save()){
                                array_push($validator_checker, true);
                            }else{
                                array_push($validator_checker, false);
                            }
                        }
                    }
                }
                // End of Update Tags

                // Update Sub Categories
                if($this->category != $this->old_category){
                    $sub_category_delete = ProductSubCategory::where('product_id', $product->id);
                    
                    if($sub_category_delete->count()){
                        if($sub_category_delete->delete()){
                            array_push($validator_checker, true);
                        }else{
                            array_push($validator_checker, false);
                        }
                    }
                    
                    $selected_sub_categories = [];
                }else{
                    $selected_sub_categories = $this->selected_sub_categories;
                }

                if(!empty($this->sub_categories)){
                    if(is_array($this->sub_categories)){
                        foreach($this->sub_categories as $sub_category){
                            $do_insert = true;
                            
                            if(count($selected_sub_categories) > 0){
                                if(in_array($sub_category, $selected_sub_categories)){
                                    $do_insert = false;
                                }
                            }

                            if($do_insert){
                                $new_product_sub_category                  = new ProductSubCategory();
                                $new_product_sub_category->product_id      = $product->id;
                                $new_product_sub_category->sub_category_id = $sub_category;
                                $new_product_sub_category->key_token       = Utility::generate_table_token('ProductSubCategory');
                                
                                if($new_product_sub_category->save()){
                                    array_push($validator_checker, true);
                                }else{
                                    array_push($validator_checker, false);
                                }
                            }
                        }

                        if(count($selected_sub_categories) > 0){
                            foreach($selected_sub_categories as $old_sub_category){
                                if(!in_array($old_sub_category, $this->sub_categories)){
                                    $product_sub_cate_delete = ProductSubCategory::where('product_id', $product->id)
                                        ->where('sub_category_id', $old_sub_category)
                                        ->first();
                                    
                                    if($product_sub_cate_delete){
                                        if($product_sub_cate_delete->delete()){
                                            array_push($validator_checker, true);
                                        }else{
                                            array_push($validator_checker, false);
                                        }
                                    }
                                }
                            }
                        }
                    }else{
                        array_push($validator_checker, false);
                    }
                }else{
                    $sub_category_delete = ProductSubCategory::where('product_id', $product->id);
                    
                    if($sub_category_delete->count()){
                        if($sub_category_delete->delete()){
                            array_push($validator_checker, true);
                        }else{
                            array_push($validator_checker, false);
                        }
                    }
                }
                // End of Sub Categories
                
                if(in_array(false, $validator_checker)){
                    $response['success'] = false;
                }else{
                    $response['success'] = true;
                }
            }
            
        }catch(\Exception $e){
            // DB::rollback();
            // dd($e);
            $response['success'] = false;
        }

        if($response['success']){
            // DB::rollback();
            DB::commit();
            $this->reset();
            $this->emit('alert_link', [
                'type'     => 'success',
                'title'    => 'Successfully Updated',
                'message'  => 'Product successfully saved.',
                'redirect' => route('front-end.partner.my-products.list.edit', ['slug' => $product->slug])
            ]);
        }else{
            DB::rollback();
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'An error occured while updating the product.'
            ]);
        }
    }
}
