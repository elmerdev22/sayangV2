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
}
