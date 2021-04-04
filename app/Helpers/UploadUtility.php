<?php
namespace App\Helpers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Model\UserAccount;
use App\Model\Category;
use App\Model\Product;
use App\Model\OrderPaymentPayout;
use App\Model\Setting;
use App\Model\ImageSetting;
use App\Model\HelpCentre;

class UploadUtility{

    public static function payout_receipt($payout_key_token){
        $payout     = OrderPaymentPayout::where('key_token', $payout_key_token)->firstOrFail();
        $media_photo = $payout->getMedia('payout/'.$payout_key_token.'/receipt/');

        return $media_photo;
    }

    public static function product_featured_photo($user_key_token, $product_key_token, $thumb=false, $modify = false){
        $product     = Product::where('key_token', $product_key_token)->firstOrFail();
        $media_photo = $product->getMedia($user_key_token.'/product/'.$product_key_token.'/featured-photo/');
        
        if($modify){
            return $media_photo;
        }
        else{
            if(count($media_photo) > 0){
                if($thumb){
                    return $media_photo[0]->getFullUrl('thumb');
                }else{
                    return $media_photo[0]->getFullUrl();
                }
            }else{
                return asset('images/default-photo/image.png');
            }
        }
    }

    public static function product_photos($user_key_token, $product_key_token, $thumb=false, $modify = false){
        $product     = Product::where('key_token', $product_key_token)->firstOrFail();
        $media_photo = $product->getMedia($user_key_token.'/product/'.$product_key_token.'/photo/');
        
        if($modify){
            return $media_photo;
        }
        else{
            if(count($media_photo) > 0){
                if($thumb){
                    return $media_photo[0]->getFullUrl('thumb');
                }else{
                    return $media_photo[0]->getFullUrl();
                }
            }else{
                return asset('images/default-photo/image.png');
            }
        }
    }

    public static function account_photo($user_key_token, $path, $type, $thumb=true){
        $account     = UserAccount::where('key_token', $user_key_token)->firstOrFail();
        $media_photo = $account->getMedia($user_key_token.'/'.$path);

        if(count($media_photo) > 0){
            if($thumb){
                return $media_photo[0]->getFullUrl('thumb');
            }else{
                return $media_photo[0]->getFullUrl();
            }
        }else if($account->photo_provider_link){
            return $account->photo_provider_link;
        }else{
            if($type == 'profile'){
                return asset('images/default-photo/account.png');
            }
            else if($type == 'store_photo'){
                return asset('images/default-photo/store.png');
            }
            else if($type == 'cover_photo'){
                return asset('images/default-photo/cover.jpg');
            }
            else{
                return asset('images/default-photo/image.png');
            }
        }
    }
    
    public static function category_photo($category_key_token, $thumb=true){
        $category    = Category::where('key_token', $category_key_token)->firstOrFail();
        $media_photo = $category->getMedia('catalog/category-photo');

        if(count($media_photo) > 0){
            if($thumb){
                return $media_photo[0]->getFullUrl('thumb');
            }else{
                return $media_photo[0]->getFullUrl();
            }
        }else if($category->photo_provider_link){
            return $category->photo_provider_link;
        }else{
            return asset('images/default-photo/image.png');
        }
    }

    public static function help_centre_photos($help_centre_id, $thumb=true){
        $data        = HelpCentre::where('id', $help_centre_id)->firstOrFail();
        $media_photo = $data->getMedia('help-centre');

        if(count($media_photo) > 0){
            if($thumb){
                return $media_photo[0]->getFullUrl('thumb');
            }else{
                return $media_photo[0]->getFullUrl();
            }
        }else if($data->photo_provider_link){
            return $data->photo_provider_link;
        }else{
            return asset('images/default-photo/image.png');
        }
    }

    public static function content_photo($settings_key, $thumb=false){
        $setting     = Setting::where('settings_key', $settings_key)->firstOrFail();
        $media_photo = $setting->getMedia('content/'.$settings_key);

        if(count($media_photo) > 0){
            if($thumb){
                return $media_photo[0]->getFullUrl('thumb');
            }else{
                return $media_photo[0]->getFullUrl();
            }
        }else if($setting->photo_provider_link){
            return $setting->photo_provider_link;
        }else{
            if($settings_key == 'logo'){
                return asset('images/logo/logo.png');
            }
            else if($settings_key == 'icon'){
                return asset('images/logo/icon.png');
            }
        }
    }

    public static function image_setting($image_setting_id, $folder_name, $thumb=false){
        $setting     = ImageSetting::where('id', $image_setting_id)->firstOrFail();
        $media_photo = $setting->getMedia('content/'.$folder_name);

        if($folder_name == 'home-bg-image'){
            $thumb = true;
        }

        if(count($media_photo) > 0){
            if($thumb){
                return $media_photo[0]->getFullUrl('thumb');
            }else{
                return $media_photo[0]->getFullUrl();
            }
        }else if($setting->photo_provider_link){
            return $setting->photo_provider_link;
        }else{
            if($folder_name == 'home-bg-image'){
                return asset('images/default-photo/cover.jpg');
            }
            else if($folder_name == 'advocacy-section'){
                return 'https://image.freepik.com/free-photo/farmer-hand-watering-young-baby-plants_35892-713.jpg';
            }
            else if($folder_name == 'become-a-partner'){
                return 'https://image.freepik.com/free-photo/two-confident-business-man-shaking-hands-during-meeting-office-success-dealing-greeting-partner-concept_1423-185.jpg';
            }
        }
    }

    public static function upload_file($parent_dir, $key_token = null){
        if($key_token){
            return 'public/'.$key_token.'/'.$parent_dir;
        }else{
            return 'public/'.$parent_dir.'/'.$key_token;
        }
    }

    public static function unlink($dir, $path){
        //Public directory/folder
        $public_path = public_path('storage/'.$dir.'/'.$path);
        if($path != null && $path != ''){
            if(file_exists($public_path)){
                unlink($public_path);
            }
        }
    }

    public static function conversion_dimension($key=null){
        $response = [
            'width'  => 250,
            'height' => 250
        ];

        if($key){
            return $response[$key];
        }else{
            return $response;
        }
    }

    public static function livewire_tmp_url($photo){
        $path       = $photo->getFilename();
        $full_path  = \Storage::path('livewire-tmp/'.$path);
        $base64     = base64_encode(\Storage::get('livewire-tmp/'.$path));
        $image_data = 'data:'.mime_content_type($full_path) . ';base64,' . $base64;
        
        return $image_data;
    }
}