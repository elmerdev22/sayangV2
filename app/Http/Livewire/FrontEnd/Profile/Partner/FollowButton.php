<?php

namespace App\Http\Livewire\FrontEnd\Profile\Partner;

use Livewire\Component;
use App\Model\Follower;
use Utility;

class FollowButton extends Component
{
    public $follower, $partner_id, $user;

    public function mount($partner_id){
        $this->user        = Utility::auth_user_account();
        $this->partner_id  = $partner_id;
    }

    public function render()
    {
        if($this->user != null){
            $this->follower = Follower::where('partner_id', $this->partner_id)
            ->where('user_account_id', $this->user->id)
            ->first();
        }

        return view('livewire.front-end.profile.partner.follow-button');
    }

    public function follow(){
        $follow                  = new Follower();
        $follow->partner_id      = $this->partner_id;
        $follow->user_account_id = $this->user->id;
        $follow->save();
    }

    public function unfollow(){
        Follower::where('partner_id', $this->partner_id)
                ->where('user_account_id', $this->user->id)
                ->delete();
    }

    public function notification($notif){
        $user            = $this->follower;
        $user->is_notify = $notif;
        $user->save();
    }
}
