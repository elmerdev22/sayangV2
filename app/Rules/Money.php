<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Money implements Rule
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
        $pattern = "/^[0-9]{1,}(,[0-9]{3})*(\.[0-9]+)*$/";

        if(!empty($value)){
            $valid = preg_match($pattern, $value);
            if($valid){
                $success = true;
            }else{
                $success = false;
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
        return 'Invalid money format.';
    }
}
