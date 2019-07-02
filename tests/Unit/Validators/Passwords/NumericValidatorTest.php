<?php

namespace Digitonic\Validation\Tests\Unit\CustomValidation\Validators;

use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class NumericValidatorTest extends TestCase
{
    /** @test */
    public function can_detect_a_password_with_a_numeric_character()
    {
        $validator = Validator::make(['password' => 'PASSWORD123'], ['password' => 'has_numeric']);
        $this->assertFalse($validator->fails());
    }

    /** @test */
    public function can_detect_a_password_without_a_numeric_character()
    {
        $validator = Validator::make(['password' => 'PASSWORD'], ['password' => 'has_numeric']);
        $this->assertTrue($validator->fails());
    }
}
