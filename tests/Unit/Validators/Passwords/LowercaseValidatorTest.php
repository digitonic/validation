<?php

namespace Digitonic\Validation\Tests\Unit\CustomValidation\Validators;

use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class LowercaseValidatorTest extends TestCase
{
    /** @test */
    public function can_detect_a_password_with_a_lowercase_character()
    {
        $validator = Validator::make(['password' => 'PASsWORD'], ['password' => 'has_lowercase']);
        $this->assertFalse($validator->fails());
    }

    /** @test */
    public function can_detect_a_password_without_a_lowercase_character()
    {
        $validator = Validator::make(['password' => 'PASSWORD'], ['password' => 'has_lowercase']);
        $this->assertTrue($validator->fails());
    }
}
