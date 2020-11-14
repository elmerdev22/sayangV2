<?php

namespace App\Http\Livewire\FrontEnd\Product\Information;

use Livewire\Component;
use App\Model\ProductPost;
use App\Model\Bid;
use Livewire\WithPagination;
use Utility;
use Auth;

class AllMyBids extends Component
{
    use WithPagination;
    protected $listeners = ['show-my-bids' => '$refresh'];

    public $account, $product_post_id;

    public function mount($product_post_id){
        $this->account         = Utility::auth_user_account();
        $this->product_post_id = $product_post_id;
    }

    public function render()
    {
        $bid = Bid::where('product_post_id', $this->product_post_id)
            ->where('user_account_id', $this->account->id)
            ->orderBy('bid', 'desc')
            ->orderBy('quantity', 'desc')
            ->paginate(5);

        return view('livewire.front-end.product.information.all-my-bids', compact('bid'));
    }
    
    public function delete_all(){
        $data = Bid::where('product_post_id', $this->product_post_id)
            ->where('user_account_id', $this->account->id);

        if($data->delete()){
            $this->emit('reload-ranking-list');
        }
    }

    public function delete_selected($id){
        $data = Bid::where('id', $id);

        if($data->delete()){
            $this->emit('reload-ranking-list');
        }
    }
}
