<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($username, $editProfile = false)
    {
        $this->username = $username;
        $this->editProfile = $editProfile;
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
        if ($this->editProfile) {
            if ($value == '' || $value == null) {
                return true;
            } else {
                return preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $value) && !str_contains($value, $this->username);
            }
        } else {
            return preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $value) && !str_contains($value, $this->username);
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Password must contain 1 lowercase, 1 uppercase, 1 number, 1 special character, and minimum 8 characters and not contain username.';
    }
}
