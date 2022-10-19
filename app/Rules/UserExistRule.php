<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UserExistRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($users, $username, $isExist = true)
    {
        //
        $this->users = $users;
        $this->username = $username;
        $this->isExist = $isExist;
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
        foreach ($this->users ?? [] as $key => $value) {
            if ($value['user_username'] == $this->username) {
                return $this->isExist ? true : false;
            }
        }
        if ($this->username == 'admin') {
            return $this->isExist ? true : false;
        }
        return $this->isExist ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->isExist ? 'User not found' : 'User already exist';
    }
}
