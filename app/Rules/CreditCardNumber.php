<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CreditCardNumber implements Rule
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
            if(is_numeric(str_replace('-', '', $value))){
                if(strlen($value) == 19){
                    $success = true;
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
        return 'The :attribute must be a valid credit card number.';
    }
}
