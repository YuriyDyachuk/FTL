<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class KtkPrefix implements Rule
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
//        if(empty($value)){
//            return true;
//        }
        return !empty($value) ?  ctype_upper($value) && substr($value, -1) === 'U' && strlen($value) === 4 : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'КТК префикс должен состоять из 4 заглавных латинский символов с \'U\' в конце.';
    }
}
