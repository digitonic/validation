<?php

namespace Digitonic\Validation\Validators;

use Digitonic\Validation\Services\AllowedRecipientsSanitiser;
use Illuminate\Validation\Concerns\ValidatesAttributes;
use libphonenumber\PhoneNumberUtil;

class AllowedRecipientsValidatorSanitiser
{
    use ValidatesAttributes;

    protected $libPhoneNumber;

    protected $sanitiser;

    public function __construct()
    {
        $this->libPhoneNumber = PhoneNumberUtil::getInstance();
        $this->sanitiser = new AllowedRecipientsSanitiser();
    }

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @return bool
     */
    public function validate($attribute, $value, $parameters, $validator): bool
    {
        $phoneNumbers = collect(explode(',', $value));

        $invalidNumbers = [];

        foreach ($phoneNumbers as $phoneNumber) {
            $proto = $this->sanitiser->getPhoneNumberObject($phoneNumber);

            if (!$proto ||
                !in_array(
                    $this->libPhoneNumber->getRegionCodeForNumber($proto),
                    config('digitonic.validation.allowed_mobile_origins')
                )
            ) {
                $invalidNumbers[] = $phoneNumber;
            }

        }

        return count($invalidNumbers) === 0;
    }
}
