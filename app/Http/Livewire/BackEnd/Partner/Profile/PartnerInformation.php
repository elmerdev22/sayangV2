<?php

namespace App\Http\Livewire\BackEnd\Partner\Profile;

use Livewire\Component;
use App\Model\UserAccount;
use App\Model\Partner;
use UploadUtility;
use Utility;
class PartnerInformation extends Component
{
	public $account, $partner, $store_photo, $cover_photo, $followers, $products, $ratings, $slug;

	public function mount($key_token){
		$this->store_photo = UploadUtility::account_photo($key_token , 'business-information/store-photo', 'store_photo');
        $this->cover_photo = UploadUtility::account_photo($key_token , 'business-information/cover-photo', 'cover_photo', false);
		
		$account 	   = UserAccount::where('key_token', $key_token)->firstOrFail();
		$this->account = $account;
		$this->partner = Partner::with(['philippine_barangay.philippine_city.philippine_province.philippine_region'])
						->where('user_account_id', $account->id)
						->first();
						
		$this->slug  = $this->partner->slug;

		if(!empty($this->partner)){
			$this->followers = Utility::count_followers($this->partner->id);
			$this->ratings   = Utility::get_partner_ratings($this->partner->id);
			$this->products  = Utility::count_products($this->partner->id);
		}else{
			$this->followers = 0;
			$this->ratings   = 'No Ratings Yet';
			$this->products  = 0;
		}
	}
	
    public function render(){
        return view('livewire.back-end.partner.profile.partner-information');
    }
}
