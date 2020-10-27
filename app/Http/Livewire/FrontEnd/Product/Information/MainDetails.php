<?php

namespace App\Http\Livewire\FrontEnd\Product\Information;

use Livewire\Component;
use App\Model\ProductPost;

class MainDetails extends Component
{
    public $product_post_id, $product_post;

    public function mount($product_post_id){
        $this->product_post_id = $product_post_id;
        $this->initialize();
    }

    public function initialize(){
        $this->product_post = ProductPost::with(['product', 'product.partner'])
            ->find($this->product_post_id);
    }

    public function datetime_format($date){
        return date('M d, Y H:i:s', strtotime($date));
    }

    public function render(){
        $component = $this;
        return view('livewire.front-end.product.information.main-details', compact('component'));
    }
}
