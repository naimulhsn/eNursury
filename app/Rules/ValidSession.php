<?php

namespace app\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidSession implements Rule
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
        $session=['2012-13','2013-14','2014-15','2015-16','2016-17','2017-18','2018-19'];
        foreach($session as $ss){
            if($value==$ss)return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Selected session is invalid.';
    }
}
