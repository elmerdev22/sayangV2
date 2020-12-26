<?php

namespace App\Http\Controllers\FrontEnd\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Partner;
use UploadUtility;
use Utility;
class PartnerController extends Controller
{
    public function index($slug){
        $data = Partner::with(['user_account'])
                ->where('slug', $slug)
                ->firstOrFail();

        $cover_photo = UploadUtility::account_photo($data->user_account->key_token , 'business-information/cover-photo', 'cover_photo', false);
        $store_photo = UploadUtility::account_photo($data->user_account->key_token , 'business-information/store-photo', 'cover_photo');
        
        $data = [
            'partner_id'    => $data->id,
            'store_name'    => $data->name,
            'ratings'       => Utility::get_partner_ratings($data->id),
            'products'      => Utility::count_products($data->id),
            'followers'     => Utility::count_followers($data->id),
            'store_address' => $data->address,
            'store_joined'  => $data->created_at,
            'cover_photo'   => $cover_photo,
            'store_photo'   => $store_photo,
        ];

        return view('front-end.profile.partner', compact('data'));
    }
}
