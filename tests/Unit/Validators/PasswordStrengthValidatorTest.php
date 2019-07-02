<?php

namespace Digitonic\Validation\Tests\Unit\CustomValidation\Validators;

use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class PasswordStrengthValidatorTest extends TestCase
{
    /** @test */
    public function can_detect_a_strong_password()
    {
        $validator = Validator::make(['password' => 'TybsdYxFAzXgs236@$!'], ['password' => 'password_strength']);
        $this->assertFalse($validator->fails());
    }

    /** @test */
    public function can_detect_a_password_without_a_number()
    {
        $validator = Validator::make(['password' => 'TybsdYxFAzXgs@$!'], ['password' => 'password_strength']);
        $this->assertTrue($validator->fails());
    }

    /** @test */
    public function can_detect_a_password_without_an_uppercase_character()
    {
        $validator = Validator::make(['password' => 'nouppercase124'], ['password' => 'password_strength']);
        $this->assertTrue($validator->fails());
    }
}
