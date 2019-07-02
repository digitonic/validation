<?php

namespace Digitonic\Validation\Validators\Passwords;

abstract class AbstractPasswordValidator
{
    protected $regex = '#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#';
}
