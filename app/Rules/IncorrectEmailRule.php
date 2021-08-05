<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class IncorrectEmailRule implements Rule
{

    public function passes($attribute, $value) {

        return strtolower($value) !== 'email@hack.net';
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() {
        return 'Email not allowed';
    }
}
