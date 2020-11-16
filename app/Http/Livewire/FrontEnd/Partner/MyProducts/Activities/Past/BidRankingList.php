<?php

namespace App\Http\Livewire\FrontEnd\Partner\MyProducts\Activities\Past;

use Livewire\Component;
use Livewire\WithPagination;
use App\Model\Bid;

class BidRankingList extends Component
{
    use WithPagination;
    public $product_post_id, $quantity;

    public function mount($product_post_id, $quantity){
        $this->product_post_id = $product_post_id;
        $this->quantity        = $quantity;
    }
    public function render()
    {
        $bid_ranking = $this->bid_ranking();
        return view('livewire.front-end.partner.my-products.activities.past.bid-ranking-list', compact('bid_ranking'));
    }
    
    public function bid_ranking(){
        return Bid::with(['user_account'])
            ->where('product_post_id', $this->product_post_id)
            ->orderBy('bid', 'desc')
            ->orderBy('quantity', 'desc')
            ->paginate(10);
    }

}
