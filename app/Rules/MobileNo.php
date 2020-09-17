<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MobileNo implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $success = false;

        if(!empty($value)){
            if(isset($value[0])){
                if($value[0] == '0'){
                    $value = ltrim($value, $value[0]);
                }

                if($value[0] == '9'){
                    if(is_numeric($value)){
                        if(strlen($value) == 10){
                            $success = true;
                        }
                    }
                }
            }
        }else{
            $success = true;
        }

        return $success;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid mobile number.';
    }
}
