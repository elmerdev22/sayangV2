<?php

namespace App\Http\Livewire\FrontEnd\User\MyAccount\CreditCard;

use Livewire\Component;
use App\Model\UserAccountCreditCard;
use Utility;

class Listing extends Component
{
    public $account, $credit_cards=[];
    protected $listeners = [
        'initialize_credit_cards' => '$refresh'
    ];

    public function mount(){
        $this->account      = Utility::auth_user_account();
        $this->credit_cards = UserAccountCreditCard::where('user_account_id', $this->account->id)
                        ->get();
    }

    public function render(){
        return view('livewire.front-end.user.my-account.credit-card.listing');
    }
}
