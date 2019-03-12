<?php

namespace Tests\Unit\CustomValidation\Validators;

use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class AllowedRecipientsValidatorTest extends TestCase
{
    /** @test */
    public function can_validate_allowed_phone_numbers_origin()
    {
        config(['digitonic.custom-validation.allowed_recipients.allowed_origins' => ['GB']]);

        // Great Britain is allowed
        $validator = Validator::make(['phone_number' => '447496368725'], ['phone_number' => 'allowed_recipients']);
        $this->assertFalse($validator->fails());

        //France is not allowed
        $validator = Validator::make(['phone_number' => '33632126328'], ['phone_number' => 'allowed_recipients']);
        $this->assertTrue($validator->fails());
    }
}
