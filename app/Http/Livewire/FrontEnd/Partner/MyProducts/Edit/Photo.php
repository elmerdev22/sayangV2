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
        'initialize_photos' => '$refresh'
    ];

    public function mount($product_id){
        $this->partner        = Utility::auth_partner();
        $this->account        = Utility::auth_user_account();
        $this->product_id     = $product_id;
        $product              = Product::findOrFail($product_id);
        $this->media_photos   = UploadUtility::product_photos($this->account->key_token, $product->key_token);
        $this->featured_photo = UploadUtility::product_featured_photo($this->account->key_token, $product->key_token);
    }

    public function render(){
        return view('livewire.front-end.partner.my-products.edit.photo');
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
