<?php

namespace Digitonic\Validation\Tests\Unit\CustomValidation\Validators;

use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class UppercaseValidatorTest extends TestCase
{
    /** @test */
    public function can_detect_a_password_without_an_uppercase_character()
    {
        $validator = Validator::make(['password' => 'nouppercase'], ['password' => 'has_uppercase']);
        $this->assertTrue($validator->fails());
    }

    /** @test */
    public function can_detect_a_password_with_an_uppercase_character()
    {
        $validator = Validator::make(['password' => 'someUpperCase'], ['password' => 'has_uppercase']);
        $this->assertFalse($validator->fails());
    }
}
