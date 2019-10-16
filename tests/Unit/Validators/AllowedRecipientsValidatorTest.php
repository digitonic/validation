<?php

namespace Digitonic\Validation\Tests\Unit\CustomValidation\Validators;

use Digitonic\Validation\Tests\BaseTestCase;
use Illuminate\Support\Facades\Validator;

class AllowedRecipientsValidatorTest extends BaseTestCase
{
    /** @test */
    public function can_validate_allowed_phone_numbers_origin()
    {
        config(['digitonic.validation.allowed_mobile_origins' => ['GB']]);

        // Great Britain is allowed
        $validator = Validator::make(['phone_number' => '447496368725'], ['phone_number' => 'allowed_recipients']);
        $this->assertFalse($validator->fails());

        //France is not allowed
        $validator = Validator::make(['phone_number' => '33632126328'], ['phone_number' => 'allowed_recipients']);
        $this->assertTrue($validator->fails());

        //Fails if malformed
        $validator = Validator::make(['phone_number' => '2126328'], ['phone_number' => 'allowed_recipients']);
        $this->assertTrue($validator->fails());
    }
}
