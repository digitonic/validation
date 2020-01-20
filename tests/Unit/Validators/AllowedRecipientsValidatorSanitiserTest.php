<?php

namespace Digitonic\Validation\Tests\Unit\CustomValidation\Validators;

use Digitonic\Validation\Tests\BaseTestCase;
use Digitonic\Validation\Validators\AllowedRecipientsValidatorSanitiser;
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

    protected function setUp(): void
    {
        parent::setUp();
        config(['digitonic.validation.allowed_mobile_origins' => ['GB']]);
    }

    /** @test */
    public function can_validate_allowed_phone_numbers_origin_strict_mode()
    {
        foreach (self::VALID_PHONES as $phone) {
            $validator = Validator::make(['phone_number' => $phone], ['phone_number' => 'allowed_recipients_sanitiser']);
            $this->assertFalse($validator->fails());
        }

        foreach (self::INVALID_PHONES as $phone) {
            $validator = Validator::make(['phone_number' => $phone], ['phone_number' => 'allowed_recipients_sanitiser|required']);
            $this->assertTrue($validator->fails());
        }
    }

    /** @test */
    public function can_sanitise_and_get_formatted_number_if_valid()
    {
        $validator = new AllowedRecipientsValidatorSanitiser();

        foreach (self::VALID_PHONES as $phone) {
            $this->assertEquals(self::SANITISED_PHONE , $validator->getFormattedNumber($phone));
        }

        foreach (self::INVALID_PHONES as $phone) {
            $this->assertFalse($validator->getFormattedNumber($phone));
        }
    }
}
