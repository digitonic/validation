<?php

namespace Digitonic\Validation\Validators\Passwords;

use Illuminate\Validation\Concerns\ValidatesAttributes;
use Illuminate\Validation\Validator;

class UppercaseValidator extends AbstractPasswordValidator
{
    use ValidatesAttributes;

    public function validate($attribute, $value, $parameters, Validator $validator)
    {
        $this->regex = '([A-Z])';
        return (bool) preg_match($this->regex, $value);
    }
}
