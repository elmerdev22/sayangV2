<?php

namespace App\Http\Livewire\FrontEnd\User\CheckOut\Index;

use Livewire\Component;
use App\Model\Billing;
use App\Model\Order;
use App\Model\OrderItem;
use App\Model\OrderPayment;
use App\Model\OrderPaymentLog;
use App\Model\UserAccountAddress;
use App\Model\UserAccountBank;
use Utility;
use DB;

class ContinueToCheckOut extends Component
{
    public $account, $payment_method = [], $billing_address_id, $total_price=0.00;

    //Sample Bank Account Balance, We will remove this after the payment paymongo implemented
    public $temporary_account_balance=5000;
    
    protected $listeners = [
        'set_payment_method'     => 'set_payment_method',
        'set_billing_address_id' => 'set_billing_address_id'
    ];

    public function mount(){
        $this->account = Utility::auth_user_account();
        $this->initialize_address();
        $this->initialize_bank();
        $this->set_total_price();
    }

    public function initialize_address(){
        $data = UserAccountAddress::with([
                'philippine_barangay', 
                'philippine_barangay.philippine_city', 
                'philippine_barangay.philippine_city.philippine_province',
                'philippine_barangay.philippine_city.philippine_province.philippine_region',
            ])
            ->where('user_account_id', $this->account->id)
            ->where('is_default', true)
            ->first();
        
        if($data){
            $this->set_billing_address_id($data->id);
        }
    }

    public function initialize_bank(){
        $default = UserAccountBank::where('user_account_id', $this->account->id);
        $default = $default->where('is_default', true)->first();
        if($default){
            $payment_method = [
                'payment_method'    => 'online_payment',
                'payment_key_token' => $default->key_token
            ];

            $this->set_payment_method($payment_method);
        }
    }

    public function set_payment_method(array $payment_method = []){
        $this->payment_method = $payment_method;
    }

    public function set_billing_address_id(int $billing_address_id = null){
        $this->billing_address_id = $billing_address_id;
    }

    public function set_total_price(){
        $cart_total        = Utility::cart_totals($this->account->id);
        $this->total_price = $cart_total['total_price'];
    }

    public function render(){
        return view('livewire.front-end.user.check-out.index.continue-to-check-out');
    }

    public function proceed(){
        if(!empty($this->payment_method) || !empty($this->billing_address_id)){

            if($this->temporary_account_balance >= $this->total_price){
                /*  Do the Insert of Order Transactions
                    and the payment API transaction here...
                */
                $response = ['success' => 'false'];
                DB::beginTransaction();

                try{


                }catch(\Exception $e){
                    $response['success'] = false;
                }

                if($response['success']){
                    // redirect to something after the process 
                    $this->emit('alert', [
                        'type'     => 'success',
                        'title'    => 'Order Successfully Processed',
                        'redirect' => '/'
                    ]);
                }else{
                    $this->emit('remove_loading_card', true);
                    $this->emit('alert', [
                        'type'    => 'error',
                        'title'   => 'Failed',
                        'message' => 'An error occured while in order transaction.'
                    ]);
                }

            }else{
                $this->emit('remove_loading_card', true);
                $this->emit('alert', [
                    'type'    => 'error',
                    'title'   => 'Insufficient Account Balance',
                    'message' => 'Total Price to Pay: <b>₱ '.number_format($this->total_price, 2).'</b>'
                ]);
            }

        }else{
            $this->emit('remove_loading_card', true);
            $this->emit('alert', [
                'type'    => 'error',
                'title'   => 'Failed!',
                'message' => 'Please Select Address and Payment Method'
            ]);
        }
    }

}
