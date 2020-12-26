<?php

namespace App\Http\Livewire\FrontEnd\User\MyBid\Win;

use Livewire\Component;
use App\Model\UserAccountAddress;
use App\Model\Product;
use SettingsUtility;
use UploadUtility;
use PaymentUtility;
use QueryUtility;
use Utility;

class PayNow extends Component
{
    public $bid_key_token=null, $payment_method, $account, $address, $winning_bid_expiration;
    protected $listeners = [
        'bid_pay_now' => 'initialize'
    ];

    public function mount(){
        $this->account                = Utility::auth_user_account();
        $this->payment_method         = 'cash_on_pickup';
        $this->winning_bid_expiration = SettingsUtility::settings_value('winning_bid_expiration');
        $this->address();
    }

    public function initialize($param){
        $this->bid_key_token = $param['bid_key_token'];
    }

    public function data(){
        $filter = [];
        $filter['select'] = [
            'bids.id as bid_id', 
            'bids.quantity as bid_quantity', 
            'bids.bid as bid_price', 
            'bids.key_token as bid_key_token', 
            'products.id as product_id',
            'products.name as product_name',
            'products.slug as product_slug',
            'product_posts.date_start', 
            'product_posts.date_end', 
            'order_bids.id as order_bid_id', 
        ];
        $filter['where']['bids.key_token']      = $this->bid_key_token;
        $filter['where']['bids.status']         = 'win';
        $filter['where']['bids.winning_status'] = 'not_paid';
        
        return QueryUtility::bids($filter)->first();
    }

    public function address($key_token=null){
        $data = UserAccountAddress::with(['philippine_barangay.philippine_city.philippine_province.philippine_region'])
            ->where('user_account_id', $this->account->id);
        
        if($key_token){
            $data = $data->where('key_token', $key_token);
        }else{
            $data = $data->where('is_default', true);
        }
        
        $this->address = $data->first();
    }

    public function render(){
        $data      = $this->data();
        $component = $this;
        return view('livewire.front-end.user.my-bid.win.pay-now', compact('data', 'component'));
    }

    public function product_featured_photo($product_id){
        $product        = Product::with(['partner', 'partner.user_account'])->findOrFail($product_id);
        $featured_photo = UploadUtility::product_featured_photo($product->partner->user_account->key_token, $product->key_token);

        return $featured_photo[0]->getFullUrl('thumb');
    }

    public function expiration($date_ended){
		return date('M/d/Y h:iA', strtotime($date_ended.'+'.$this->winning_bid_expiration.' hours'));
    }
    
    public function change_payment_method($method){
        $allowed_method = PaymentUtility::allowed_method();

        if(in_array($method, $allowed_method)){
            $this->payment_method = $method;
        }else{
            $this->emit('alert', [
                'type'  => 'error',
                'title' => 'Invalid Payment Method.'
            ]);
        }

        $this->emit('remove_loading_card', true);
    }

    public function proceed(){
        $response = ['success'=>false, 'message'=>'Unable to process your request'];

        try{
            if(!empty($this->address)){
                if(in_array($this->payment_method, PaymentUtility::allowed_method())){
                    
                }else{
                    $response['message'] = 'Invalid Payment Method.';
                }
            }else{
                $response['message'] = 'No billing address yet.';
            }
        }catch(\Exception $e){
            $response['success'] = false;
            $response['message'] = 'An error occured.';
        }


        if($response['success']){

        }else{
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed',
                'message' => $response['message']
            ]);
        }
    }
}
