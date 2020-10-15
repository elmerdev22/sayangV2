<?php
namespace App\Helpers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Model\UserAccount;

class UploadUtility{

    public static function profile_picture($user_key_token, $thumb=true){
        $account     = UserAccount::where('key_token', $user_key_token)->firstOrFail();
        $media_photo = $account->getMedia($user_key_token.'/profile-picture');

        if(count($media_photo) > 0){
            if($thumb){
                return $media_photo[0]->getFullUrl('thumb');
            }else{
                return $media_photo[0]->getFullUrl();
            }
        }else if($account->photo_provider_link){
            return $account->photo_provider_link;
        }else{
            return asset('images/default-photo/account.png');
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

}