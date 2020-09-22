<?php
namespace App\Helpers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadUtility{

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