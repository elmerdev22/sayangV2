<?php

namespace App\Http\Livewire\FrontEnd\User\Ratings;

use Livewire\Component;
use App\Model\Rating;
use App\Model\PartnerRating;
use App\Model\Order;
use UploadUtility;
use Utility;

class Index extends Component
{
	protected $listeners = ['rate_order_no' => 'rate_order_no'];

    public $star   = 5;
    public $rating = [];
    public $account;
    public $comment, $partner_id, $order_id, $seller_name, $store_photo;

    public function mount(){
        $this->account = Utility::auth_user_account();
    }

    public function rate_order_no($order_no){
        $data              = Order::with(['partner.user_account'])->where('order_no', $order_no)->first();
        $key_token         = $data->partner->user_account->key_token;
        
        $this->store_photo = UploadUtility::account_photo($key_token , 'business-information/store-photo', 'store_photo');
        $this->seller_name = $data->partner->name;
        $this->partner_id  = $data->partner->id;
        $this->order_id    = $data->id;
    }

    public function render()
    {
        $data = Rating::orderBy('rating','asc')->where('star', $this->star)->get();
        return view('livewire.front-end.user.ratings.index', compact('data'));
    }

    public function submit(){
        
        $data                  = new PartnerRating();
        $data->user_account_id = $this->account->id;
        $data->partner_id      = $this->partner_id;
        $data->order_id        = $this->order_id;
        $data->star            = $this->star;
        $data->rating          = implode(",", $this->rating);
        $data->comment         = $this->comment;
        $data->save();
        
        $this->emit('alert_link', [
            'type'    => 'success',
            'title'   => 'Successfully Added',
            'message' => 'Yuor Rating successfully submitted.'
        ]);
    }
}
