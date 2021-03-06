<?php

namespace App\Http\Livewire\FrontEnd\Product\Information;

use Livewire\Component;
use App\Model\ProductPost;
use App\Model\Bid;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Utility;
use Auth;
use Session;
use Carbon\Carbon;

class PlaceBid extends Component
{
    use WithPagination;
    protected $listeners = ['reload-ranking-list' => 'refresh'];

    public $view_my_bids = false;
    public $product_post_id, $product_post, $allow_purchase, $account, $elements_round_off;
    public $total_amount, $quantity, $current_quantity, $bid, $lowest_price, $lowest_bid, $bid_increment;
    public $ranking_top_show;

    public function mount($product_post_id){
        
        $this->account         = Utility::auth_user_account();

        $product_post          = ProductPost::with(['product'])->findOrFail($product_post_id);
        $this->product_post    = $product_post;
        $this->product_post_id = $product_post_id;

        $this->elements_round_off = Utility::settings('elements_round_off');
        $bid_increment_percent    = Utility::settings('bid_increment_percent');
        $this->ranking_top_show   = Utility::settings('ranking_top_show');

        $this->bid_increment    = round( ($bid_increment_percent / 100) * $product_post->buy_now_price );

        $lowest_bid       = Bid::where('product_post_id', $this->product_post_id)->orderBy('bid', 'desc')->first();
        $this->lowest_bid = $lowest_bid != null ? $lowest_bid->bid + floatval($this->bid_increment) : $product_post->lowest_price;
        $this->bid        = $lowest_bid != null ? $lowest_bid->bid + floatval($this->bid_increment) : $product_post->lowest_price;
        
        $this->initialize_current_quantity();
        $preferred_quantity     = 1;
        if($preferred_quantity <= $this->current_quantity){
            $this->quantity = $preferred_quantity;
        }else{
            $this->quantity = 0;
        }

        $this->allow_purchase = Utility::allow_purchase();
        $this->calculate_price();
    }

    public function calculate_price(){
        if($this->bid != null){
            $this->total_amount = $this->bid * $this->quantity;
        }
        else{
            $this->total_amount = 0.00;
        }
    }

    public function validate_quantity($preferred_quantity){
        $this->mount($this->product_post_id);

        $this->initialize_current_quantity();

        if(!empty($this->product_post)){
            if(!is_numeric($preferred_quantity)){
                Session::flash('quantity_required', 'Quantity is required!');
                
            }else if($preferred_quantity <= $this->current_quantity){
                if($preferred_quantity <= 0){
                    $this->quantity = 1;
                    $this->emit('buy_now_quantity_value', ['quantity' => $this->quantity]);
                }else{
                    $this->quantity = $preferred_quantity;
                }
            }else{
                $this->quantity = $this->current_quantity;
                $this->emit('buy_now_quantity_value', ['quantity' => $this->quantity]);
            }
        }else{
            $this->quantity = 0;
        }
        
        $this->calculate_price();
    }

    public function set_bid($value){
        if($value >= $this->lowest_price){
            $this->bid = $value;
            $this->calculate_price();
        }
    }

    public function initialize_current_quantity(){
        $product_post           = ProductPost::findOrFail($this->product_post_id);
        $this->current_quantity = $product_post->quantity;
    }

    public function render(){
        if(Auth::check() && Auth::user()->type == 'user'){
            $this->view_my_bids = $this->view_my_bids() >= 1 ? true : false;
        }
        $ranking = $this->ranking_list();
        
        return view('livewire.front-end.product.information.place-bid', compact('ranking'));
    }

    public function ranking_list(){
        return Bid::with(['user_account'])
            ->where('product_post_id', $this->product_post_id)
            ->orderBy('bid', 'desc')
            ->orderBy('quantity', 'desc')
            ->paginate($this->ranking_top_show);
    }

    public function view_my_bids(){
        return Bid::where('product_post_id', $this->product_post_id)
            ->where('user_account_id', $this->account->id)
            ->count();
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
                $this->initialize_current_quantity();
                $this->validate_quantity($this->quantity);
            }
        }
    }

    public function confirm_bid(){

        $product_post_id                     = $this->product_post_id;
        $popcorn_bidding_last_minutes        = Utility::settings('popcorn_bidding_last_minutes');
        $popcorn_bidding_last_minutes_repeat = Utility::settings('popcorn_bidding_last_minutes_repeat');
        $popcorn_bidding_additional_minutes  = Utility::settings('popcorn_bidding_additional_minutes');

        $get_highest_bid = $this->get_highest_bid();
        $get_highest_bid = $get_highest_bid ? $get_highest_bid->bid : $this->lowest_price;
        $next_bid        = $get_highest_bid + $this->bid_increment;

        $this->validate([
            'bid' => ['required','numeric','min:'.$next_bid.'']
        ]);
        
        $to              = Carbon::now();
        $from            = $this->product_post->date_end;
        $diff_in_minutes = $to->diffInMinutes($from);

        if($this->bid < $this->lowest_bid){
            Session::flash('minimum_bid', 'The minimum Bid is '.$this->lowest_bid);
        }
        else{
            
            if($this->bid >= $this->product_post->buy_now_price){
                $this->bid = $get_highest_bid;
                Session::flash('reach_buy_now_price', 'Your Bid reach the buy now price, your latest bid change to highest bid.');
            }
            if($diff_in_minutes < $popcorn_bidding_last_minutes){
                
                $new_date_end = date('Y-m-d H:i',strtotime('+'.$popcorn_bidding_additional_minutes.' minutes',strtotime($from)));
                
                $product_post = ProductPost::where('id', $this->product_post_id)->firstorFail();
                if($product_post->extend < $popcorn_bidding_last_minutes_repeat){
                    $product_post->extend   = $product_post->extend + 1;
                    $product_post->date_end = $new_date_end;
                    if($product_post->save()){
                        $this->emit('refresh_time');
                    }
                }

            }

            $this->add_bid();
            
        }

        $this->mount($this->product_post_id);
    }

    public function add_bid(){
        $bid                  = new Bid();
        $bid->bid_no          = Utility::generate_bid_no();
        $bid->product_post_id = $this->product_post_id;
        $bid->user_account_id = $this->account->id;
        $bid->bid             = $this->bid;
        $bid->quantity        = $this->quantity;
        $bid->status          = 'active';
        $bid->key_token       = Utility::generate_table_token('Bid');
        $bid->save();
    }

    public function refresh(){
        $this->mount($this->product_post_id);
    }

    public function get_highest_bid(){
        
        return Bid::where('product_post_id', $this->product_post_id)
                ->orderBy('bid', 'desc')
                ->first();
    }
}
