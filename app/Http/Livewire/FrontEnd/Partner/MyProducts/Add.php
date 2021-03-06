<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyProducts;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Model\Product;
use App\Model\ProductTag;
use App\Model\Category;
use App\Model\SubCategory;
use App\Model\ProductSubCategory;
use App\Rules\Money;
use DB;
use Utility;
use TagNameUtility;

class Add extends Component
{
    use WithFileUploads;

    public $account, $partner, $name, $category, $sub_categories = [], $tags = [];
    public $regular_price=0.00, $buy_now_price=0.00, $lowest_price=0.00, $description, $reminders;
    public $featured_photo=0, $photos=[], $price_percentage = [];
    public $discount, $discount_percent;
    public $about_product, $weight, $width, $height, $length, $shelf_life, $paper_packaging;

    public function mount(){
        $this->partner = Utility::auth_partner();
        $this->account = Utility::auth_user_account();
        $this->compute_price_percentage();
    }

    public function categories(){
        return Category::orderBy('name', 'asc')->get();
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

    public function apply_featured_photo($key, $force=false){
        if($force){
            if(!empty($this->photos)){
                if($key == $this->featured_photo){
                    foreach($this->photos as $row_key => $photo){
                        $this->featured_photo = $row_key;
                        break;
                    }
                }
            }else{
                $this->featured_photo = 0;
            }
        }else{
            $this->featured_photo = $key;
        }
    }

    public function remove_photo($key){
        $photos = $this->photos;
        if(isset($photos[$key])){
            unset($this->photos[$key]);
            $this->apply_featured_photo($key, true);
        }
    }

    public function compute_price_percentage(){
        $this->price_percentage = Utility::price_percentage($this->regular_price, $this->buy_now_price);
        $this->discount         = $this->price_percentage['discount'];
        $this->discount_percent = $this->price_percentage['discount_percent'];
    }

    public function render(){
        $component = $this;
        return view('livewire.front-end.partner.my-products.add', compact('component'));
    }

    public function store(){
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
            'photos'         => 'required',
            'photos.*'       => 'image|mimes:jpeg,jpg,png|max:2048'
        ];

        $this->compute_price_percentage();
        $this->emit('money_input_field', [
            'regular_price' => $this->regular_price,
            'buy_now_price' => $this->buy_now_price,
            'lowest_price'  => $this->lowest_price
        ]);
        
        $this->validate($rules);

        $response = ['success' => false, 'message' => ''];

        DB::beginTransaction();

        try{
            // Do the insert of product here...
            $key_token                = Utility::generate_table_token('Product');
            $product                  = new Product();
            $product->partner_id      = $this->partner->id;
            $product->category_id     = $this->category;
            $product->name            = $this->name;
            $product->regular_price   = $this->regular_price;
            $product->buy_now_price   = $this->buy_now_price;
            $product->lowest_price    = $this->lowest_price;
            $product->description     = $this->description;
            $product->reminders       = $this->reminders;
            $product->about_product   = $this->about_product;
            $product->weight          = $this->weight;
            $product->width           = $this->width;
            $product->height          = $this->height;
            $product->length          = $this->length;
            $product->shelf_life      = $this->shelf_life;
            $product->paper_packaging = $this->paper_packaging ? 1 : 0;
            $product->slug            = Utility::generate_table_slug('Product', $this->name);
            $product->key_token       = $key_token;

            if($product->save()){
                $validator_checker = array();
                
                if(!empty($this->tags)){
                    if(is_array($this->tags)){
                        foreach($this->tags as $tag){
                            $tag_id                  = TagNameUtility::validate('Tag', $tag);
                            $product_tag             = new ProductTag();
                            $product_tag->tag_id     = $tag_id;
                            $product_tag->product_id = $product->id;
                            $product_tag->key_token  = Utility::generate_table_token('ProductTag');
                            if($product_tag->save()){
                                array_push($validator_checker, true);
                            }else{
                                array_push($validator_checker, false);
                            }
                        }
                    }else{
                        array_push($validator_checker, false);
                    }
                }
                
                if(!in_array(false, $validator_checker)){
                    if(!empty($this->sub_categories)){
                        if(is_array($this->sub_categories)){
                            foreach($this->sub_categories as $sub_category){
                                $product_sub_category                  = new ProductSubCategory();
                                $product_sub_category->product_id      = $product->id;
                                $product_sub_category->sub_category_id = $sub_category;
                                $product_sub_category->key_token       = Utility::generate_table_token('ProductSubCategory');

                                if($product_sub_category->save()){
                                    array_push($validator_checker, true);
                                }else{
                                    array_push($validator_checker, false);
                                }
                            }
                        }else{
                            array_push($validator_checker, false);
                        }
                    }
                }

                if(!empty($this->photos)){
                    if(is_array($this->photos)){
                        foreach($this->photos as $key => $photo){
                            if($this->featured_photo == $key){
                                $collection = $this->account->key_token.'/product/'.$key_token.'/featured-photo/';
                            }else{
                                $collection = $this->account->key_token.'/product/'.$key_token.'/photo/';
                            }

                            $product->clearMediaCollection($collection);
                            $product->addMedia($photo->getRealPath())->usingFileName($photo->getClientOriginalName())->toMediaCollection($collection);
                        }
                    }else{
                        array_push($validator_checker, false);
                    }
                }

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
            DB::commit();
            $this->reset();
            $this->emit('alert_link', [
                'type'     => 'success',
                'title'    => 'Successfully Added',
                'message'  => 'Product successfully saved.',
            ]);
        }else{
            DB::rollback();
            $this->reset(['photos']);
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => 'An error occured while adding the product.'
            ]);
        }
    }
}
