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
    public $regular_price, $buy_now_price, $lowest_price, $description, $reminders;
    public $featured_photo=0, $photos=[];

    public function mount(){
        $this->partner = Utility::auth_partner();
        $this->account = Utility::auth_user_account();
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
            'regular_price'  => ['required', new Money()],
            'buy_now_price'  => ['required', new Money()],
            'lowest_price'   => ['required', new Money()],
            'description'    => 'required',
            'reminders'      => 'nullable',
            'photos'         => 'required',
            'photos.*'       => 'image|mimes:jpeg,jpg,png|max:2048'
        ];

        $this->validate($rules);

        $response = ['success' => false, 'message' => ''];

        DB::beginTransaction();

        try{
            // Do the insert of product here...
            $key_token              = Utility::generate_table_token('Product');
            $product                = new Product();
            $product->partner_id    = $this->partner->id;
            $product->category_id   = $this->category;
            $product->name          = $this->name;
            $product->regular_price = Utility::decimal_format($this->regular_price);
            $product->buy_now_price = Utility::decimal_format($this->buy_now_price);
            $product->lowest_price  = Utility::decimal_format($this->lowest_price);
            $product->description   = $this->description;
            $product->reminders     = $this->reminders;
            $product->slug          = Utility::generate_table_slug('Product', $this->name);
            $product->key_token     = $key_token;

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
