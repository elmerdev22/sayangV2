<?php
namespace App\Helpers;

use Utility;

class TagNameUtility{
    
    public static function validate($model_string, $value, $field='name'){
        $model_param  = $model_string;
        $model_string = 'App\\Model\\'.ucfirst($model_string);
        $model        = $model_string::where($field, $value)->first();
        
        if(!$model){
            $model            = new $model_string();
            $model->name      = $value;
            $model->slug      = Utility::generate_table_slug($model_param, $value);
            $model->key_token = Utility::generate_table_token($model_param);
            $model->save();
        }
        
        return $model->id;
    }
}