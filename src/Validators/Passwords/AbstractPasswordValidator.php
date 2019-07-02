<?php

namespace Digitonic\Validation\Validators\Passwords;

use Illuminate\Validation\Validator;

abstract class AbstractPasswordValidator
{
    protected $regex = '#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#';

    public function validate($attribute, $value, $parameters, Validator $validator)
    {
        return (bool) preg_match($this->regex, $value);
    }
}
