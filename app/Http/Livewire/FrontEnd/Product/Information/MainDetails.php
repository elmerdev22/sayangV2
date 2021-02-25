<?php

namespace App\Http\Livewire\FrontEnd\Product\Information;

use Livewire\Component;
use App\Model\ProductPost;
use Utility;
class MainDetails extends Component
{
    public $product_post_id, $product_post, $store_hours;
    public $force_disabled = false;

    protected $listeners = [
        'force_disabled' => 'force_disabled',
        'refresh_time'   => '$refresh',
    ];

    public function mount($product_post_id, $force_disabled){
        $this->product_post_id = $product_post_id;
        $this->force_disabled  = $force_disabled;
        $this->initialize();
    }

    public function force_disabled(){
        if(!$this->force_disabled){
            $this->emit('force_disabled', true);
        }

        $this->force_disabled = true;
    }

    public function initialize(){
        $this->product_post = ProductPost::with(['product', 'product.partner'])
            ->find($this->product_post_id);

        $this->store_hours = Utility::store_hours($this->product_post->product->partner->id);
    }

    public function datetime_format($date){
        return date('M d, Y H:i:s', strtotime($date));
    }

    public function render(){
        $component = $this;
        return view('livewire.front-end.product.information.main-details', compact('component'));
    }

    public function product_post_update_event($param){
        if(!empty($param)){
            $initialize = false;

            foreach($param['data'] as $row){
                if($row['product_post_id'] == $this->product_post_id){
                    $initialize = true;
                    break;
                }
            }

            if($initialize){
                $this->initialize();
            }
        }
    }
}
