<?php

namespace Digitonic\Validation\Tests\Unit\CustomValidation\Validators;

use Digitonic\Validation\Tests\BaseTestCase;
use Illuminate\Support\Facades\Validator;

class PhoneNumberIndexValidatorTest extends BaseTestCase
{
    /** @test */
    public function can_validate_phone_number_index()
    {
        config(['digitonic.validation.allowed_mobile_origins' => ['GB']]);

        // Great Britain is allowed
        $validator = Validator::make(['csv' => "mobile\n447496368725", 'phone_index' => 0], ['phone_index' => 'phone_number_index:csv']);
        $this->assertFalse($validator->fails());

        //Fails because data is invalid
        $validator = Validator::make(['csv' => 447496368725, 'phone_index' => 1], ['phone_index' => 'phone_number_index:csv']);
        $this->assertTrue($validator->fails());

        // Fails if not within range
        $validator = Validator::make(['csv' => "mobile\n447496368725", 'phone_index' => 1], ['phone_index' => 'phone_number_index:csv']);
        $this->assertTrue($validator->fails());

        //Fails because csv dats afield is wrong
        $validator = Validator::make(['csv' => "mobile\n447496368725", 'phone_index' => 0], ['phone_index' => 'phone_number_index:csvData']);
        $this->assertTrue($validator->fails());

        //France is not allowed
        $validator = Validator::make(['csv' => "mobile\n33632126328", 'phone_index' => 0], ['phone_index' => 'phone_number_index:csv']);
        $this->assertTrue($validator->fails());
    }
}
