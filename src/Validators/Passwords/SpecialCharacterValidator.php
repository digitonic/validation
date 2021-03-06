<?php

namespace Digitonic\Validation\Validators\Passwords;

use Illuminate\Validation\Concerns\ValidatesAttributes;
use Illuminate\Validation\Validator;

class SpecialCharacterValidator extends AbstractPasswordValidator
{
    use ValidatesAttributes;

    public function validate($attribute, $value, $parameters, Validator $validator)
    {
        $this->regex = '([!@#$%^&*(),.?":{}|<>\/£_=\-+\[\]\'\\;`~±§])';
        return parent::validate($attribute, $value, $parameters, $validator);    }
}
