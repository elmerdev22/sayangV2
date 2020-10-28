<?php

namespace App\Http\Livewire\FrontEnd\Product\Information;

use Livewire\Component;
use App\Model\Product;
use UploadUtility;

class Photo extends Component
{
    public $media_photos = [], $featured_photo, $product;

    public function mount($product_id){
        $product              = Product::with(['partner.user_account'])->findOrFail($product_id);
        $this->product        = $product;
        $this->media_photos   = UploadUtility::product_photos($product->partner->user_account->key_token, $product->key_token);
        $this->featured_photo = UploadUtility::product_featured_photo($product->partner->user_account->key_token, $product->key_token);
    }

    public function render(){
        return view('livewire.front-end.product.information.photo');
    }
}
