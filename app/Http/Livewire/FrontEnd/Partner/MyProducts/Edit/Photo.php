<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyProducts\Edit;

use Livewire\Component;
use App\Model\Product;
use DB;
use Utility;
use UploadUtility;
use TagNameUtility;

class Photo extends Component
{
    public $partner, $account, $product_id;
    public $photos = [], $media_photos = [], $featured_photo;
    protected $listeners = [
        'initialize_photos'          => '$refresh',
        'initialize_photos_featured' => 'initialize'
    ];

    public function mount($product_id){
        $this->partner        = Utility::auth_partner();
        $this->account        = Utility::auth_user_account();
        $this->product_id     = $product_id;
        $product              = Product::findOrFail($product_id);
        $this->initialize();
    }

    public function initialize(){
        $product              = Product::findOrFail($this->product_id);
        $this->media_photos   = UploadUtility::product_photos($this->account->key_token, $product->key_token);
        $this->featured_photo = UploadUtility::product_featured_photo($this->account->key_token, $product->key_token);
    }

    public function render(){
        return view('livewire.front-end.partner.my-products.edit.photo');
    }

    public function update_featured($key){
        $media_photos = $this->media_photos;
        if(isset($media_photos[$key])){
            $response = ['success' => false, 'message' => ''];
            DB::beginTransaction();

            try{
                $product             = Product::findOrFail($this->product_id);
                $to_featured         = $media_photos[$key];
                $old_featured        = count($this->featured_photo) > 0 ? $this->featured_photo[0] : 0;
                $featured_collection = $this->account->key_token.'/product/'.$product->key_token.'/featured-photo/';
                $photos_collection   = $this->account->key_token.'/product/'.$product->key_token.'/photo/';

                $to_featured->move($product, $featured_collection);
                $old_featured ? $old_featured->move($product, $photos_collection) : '';
                $response['success'] = true;
            }catch(\Exception $e){
                $response['success'] = false;
            }

            if($response['success']){
                DB::commit();
                $this->emit('initialize_photos_featured', true);
                $this->emit('alert', [
                    'type'     => 'success',
                    'title'    => 'Successfully Updated',
                    'message'  => 'Featured Photo successfully updated.'
                ]);
            }else{
                DB::rollback();
                $this->emit('alert', [
                    'type'    => 'error',
                    'title'   => 'Failed',
                    'message' => 'An error occured while updating the featured photo.'
                ]);
            }            
        }
    }

    public function delete($key){
        $media_photos = $this->media_photos;
        if(isset($media_photos[$key])){

            if($media_photos[$key]->delete()){
                unset($media_photos[$key]);
                $this->emit('initialize_photos', true);
                $this->emit('alert', [
                    'type'     => 'success',
                    'title'    => 'Successfully Deleted',
                    'message'  => 'Photo successfully deleted.'
                ]);
            }
        }
    }
}
