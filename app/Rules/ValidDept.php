<?php

namespace app\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidDept implements Rule
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
        $dept=['CSE','EEE','PHY','MATH'];
        foreach($dept as $dpt){
            if($value==$dpt)return true;
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
        return 'Select a valid Dept.';
    }
}
