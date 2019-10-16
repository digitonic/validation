<?php

namespace Digitonic\Validation\Tests\Unit\CustomValidation\Validators;

use Digitonic\Validation\Tests\BaseTestCase;
use Illuminate\Support\Facades\Validator;

class LowercaseValidatorTest extends BaseTestCase
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
