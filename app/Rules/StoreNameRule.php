<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StoreNameRule implements Rule
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
        $trimmed = trim($value);
        $spaces = substr_count($trimmed, ' ');
        return $spaces >= 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Store name must be contain at least 2 words.';
    }
}
