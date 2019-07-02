<?php

namespace Digitonic\Validation\Validators\Passwords;

use Illuminate\Validation\Concerns\ValidatesAttributes;
use Illuminate\Validation\Validator;

class NumericCharacterValidator extends AbstractPasswordValidator
{
    use ValidatesAttributes;

    public function validate($attribute, $value, $parameters, Validator $validator)
    {
        $this->regex = '([0-9])';
        return parent::validate($attribute, $value, $parameters, $validator);    }
}
