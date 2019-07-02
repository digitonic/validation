<?php

namespace Digitonic\Validation\Tests\Unit\Validators\Passwords;

use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class PasswordStrengthValidatorTest extends TestCase
{
    /** @test */
    public function can_detect_all_required_password_validators()
    {
        $validator = Validator::make(['password' => 'Tx!@256@$\][*&$£'], ['password' => 'has_uppercase|has_lowercase|has_numeric|has_special']);
        $this->assertFalse($validator->fails());
    }

    /** @test */
    public function can_detect_missing_special_character_when_required()
    {
        $validator = Validator::make(['password' => 'Tx56'], ['password' => 'has_uppercase|has_lowercase|has_numeric|has_special']);
        $this->assertTrue($validator->fails());
    }

    /** @test */
    public function can_detect_missing_numeric_character_when_required()
    {
        $validator = Validator::make(['password' => 'Tx!$@'], ['password' => 'has_uppercase|has_lowercase|has_numeric|has_special']);
        $this->assertTrue($validator->fails());
    }

    /** @test */
    public function can_detect_missing_uppercase_character_when_required()
    {
        $validator = Validator::make(['password' => 'tx!$@5346'], ['password' => 'has_uppercase|has_lowercase|has_numeric|has_special']);
        $this->assertTrue($validator->fails());
    }

    /** @test */
    public function can_detect_missing_lowercase_character_when_required()
    {
        $validator = Validator::make(['password' => 'TX!$@5346'], ['password' => 'has_uppercase|has_lowercase|has_numeric|has_special']);
        $this->assertTrue($validator->fails());
    }

}
