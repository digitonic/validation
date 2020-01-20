<?php

namespace Digitonic\Validation\Tests\Unit\CustomValidation\Validators;

use Digitonic\Validation\Tests\BaseTestCase;
use Illuminate\Support\Facades\Validator;

class AllowedRecipientsValidatorSanitiserTest extends BaseTestCase
{
    const SANITISED_PHONE = '447496368725';

    const VALID_PHONES = [
        '+447496368725',
        '+44 7496368725',
        '07496368725',
        '44 7496 368725',
        '(44) 7496-368725',
        '-447496368725'
    ];

    const INVALID_PHONES = [
        'sdfsdfdsf',
        'sadasdasd',
        ' ',
        '',
        '447496368725a',
        '447496368725as',
        '447496368725longText',
        '+33632126328',
        '+50240342933'
    ];

    /** @test */
    public function can_validate_allowed_phone_numbers_origin_strict_mode()
    {
        config(['digitonic.validation.allowed_mobile_origins' => ['GB']]);

        foreach (self::VALID_PHONES as $phone) {
            $validator = Validator::make(['phone_number' => $phone], ['phone_number' => 'allowed_recipients_sanitiser']);
            $this->assertFalse($validator->fails());
        }

        foreach (self::INVALID_PHONES as $phone) {
            $validator = Validator::make(['phone_number' => $phone], ['phone_number' => 'allowed_recipients_sanitiser|required']);
            $this->assertTrue($validator->fails());
        }
    }
}
