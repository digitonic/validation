<?php

namespace Digitonic\Validation\Validators\Passwords;

use Illuminate\Validation\Concerns\ValidatesAttributes;
use Illuminate\Validation\Validator;

class LowercaseValidator extends AbstractPasswordValidator
{
    use ValidatesAttributes;

    public function validate($attribute, $value, $parameters, Validator $validator)
    {
        $this->regex = '([a-z])';
        return (bool) preg_match($this->regex, $value);
    }
}
