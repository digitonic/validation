<?php

namespace Digitonic\Validation\Tests\Unit\CustomValidation\Validators;

use Digitonic\Validation\Services\AllowedRecipientsSanitiser;
use Digitonic\Validation\Tests\BaseTestCase;

class AllowedRecipientsSanitiserTest extends BaseTestCase
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

    public $sanitiser;

    protected function setUp(): void
    {
        parent::setUp();
        config(['digitonic.validation.allowed_mobile_origins' => ['GB']]);
        $this->sanitiser = new AllowedRecipientsSanitiser();
    }

    /** @test */
    public function can_get_formatted_number_if_valid()
    {
        foreach (self::VALID_PHONES as $phone) {
            $this->assertEquals(self::SANITISED_PHONE , $this->sanitiser->getFormattedNumber($phone));
        }

        foreach (self::INVALID_PHONES as $phone) {
            $this->assertFalse($this->sanitiser->getFormattedNumber($phone));
        }
    }

    /** @test */
    public function can_sanitise_phone_number_to_create_lib_phone_number_object()
    {
        foreach (self::VALID_PHONES as $phone) {
            $this->assertEquals('+' . self::SANITISED_PHONE , $this->sanitiser->sanitisePhoneNumber($phone));
        }
    }

    /** @test */
    public function can_get_lib_phone_number_object_if_valid()
    {
        foreach (self::VALID_PHONES as $phone) {
           $phoneObject = $this->sanitiser->getPhoneNumberObject($this->sanitiser->sanitisePhoneNumber($phone));
           $this->assertTrue("libphonenumber\PhoneNumber" == get_class($phoneObject));
        }
    }
}
