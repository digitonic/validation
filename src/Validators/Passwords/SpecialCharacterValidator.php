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
        return (bool) preg_match($this->regex, $value);
    }
}
