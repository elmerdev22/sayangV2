<?php

namespace App\Http\Livewire\FrontEnd\User\Header;

use Livewire\Component;
use App\Model\Notification as Notifications;
use App\Model\UserAccount;
use UploadUtility;
use Auth;

class Notification extends Component
{
    public function mount(){
        $this->auth    = Auth::user();
        $this->account = UserAccount::where('user_id', $this->auth->id)->firstOrFail();
    }

    public function render()
    {   
        $data = Notifications::with(['product_post.product.partner.user_account','web_notification_settings'])
                ->where('is_read', 0)
                ->orderBy('created_at','desc')
                ->get();
                
        return view('livewire.front-end.user.header.notification', compact('data'));
    }
}
