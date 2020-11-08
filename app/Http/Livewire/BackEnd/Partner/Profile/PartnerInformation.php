<?php

namespace App\Http\Livewire\BackEnd\Partner\Profile;

use Livewire\Component;
use App\Model\UserAccount;
use App\Model\Partner;
use UploadUtility;
use Utility;
class PartnerInformation extends Component
{
	public $account, $partner, $store_photo, $cover_photo, $followers;

	public function mount($key_token){
		$this->store_photo = UploadUtility::account_photo($key_token , 'business-information/store-photo', 'store_photo');
        $this->cover_photo = UploadUtility::account_photo($key_token , 'business-information/cover-photo', 'cover_photo', false);
		$account 	   = UserAccount::where('key_token', $key_token)->firstOrFail();
		$this->account = $account;
		$this->partner = Partner::with([
				'philippine_barangay', 
				'philippine_barangay.philippine_city', 
				'philippine_barangay.philippine_city.philippine_province',
				'philippine_barangay.philippine_city.philippine_province.philippine_region',
			])
			->where('user_account_id', $account->id)
			->first();
		
		$this->followers = Utility::count_followers($this->partner->id);
	}
	
    public function render(){
        return view('livewire.back-end.partner.profile.partner-information');
    }
}
