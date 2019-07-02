<?php

namespace Digitonic\Validation\Validators;

use Illuminate\Validation\Concerns\ValidatesAttributes;
use Illuminate\Validation\Validator;

class PasswordStrengthValidator
{
    use ValidatesAttributes;

    public function validate($attribute, $value, $parameters, Validator $validator)
    {
        $regex = '#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#';

        if (preg_match($regex, $value)) {
            return true;
        }

        return false;
    }
}
