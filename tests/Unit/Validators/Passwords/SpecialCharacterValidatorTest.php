<?php

namespace Digitonic\Validation\Tests\Unit\CustomValidation\Validators;

use Digitonic\Validation\Tests\BaseTestCase;
use Illuminate\Support\Facades\Validator;

class SpecialCharacterValidatorTest extends BaseTestCase
{
    /** @test */
    public function can_detect_a_password_with_a_special_character()
    {
        $validator = Validator::make(['password' => 'pa§$word!'], ['password' => 'has_special']);
        $this->assertFalse($validator->fails());
    }

    /** @test */
    public function can_detect_a_password_without_a_special_character()
    {
        $validator = Validator::make(['password' => 'password'], ['password' => 'has_special']);
        $this->assertTrue($validator->fails());
    }
}
