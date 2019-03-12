<?php

namespace Digitonic\CustomValidation\Validators;

use Illuminate\Validation\Concerns\ValidatesAttributes;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;

class AllowedRecipientsValidator
{
    use ValidatesAttributes;

    protected $libPhoneNumber;

    public function __construct()
    {
        $this->libPhoneNumber = PhoneNumberUtil::getInstance();
    }

    public function validate($attribute, $value, $parameters, $validator)
    {
        $phoneNumbers = collect(explode(',', $value));
        $phoneNumbers = $phoneNumbers->map(function($phoneNumber) {
            return trim($phoneNumber);
        });

        $invalidNumbers = [];

        foreach ($phoneNumbers as $phoneNumber) {
            if (!empty($phoneNumber)) {
                try {
                    $proto = $this->libPhoneNumber->parse($this->preparePhoneNumber($phoneNumber), null);
                    if (!in_array(
                        $this->libPhoneNumber->getRegionCodeForNumber($proto),
                        config('digitonic.custom-validation.allowed_recipients.allowed_origins')
                    )) {
                        $invalidNumbers[] = $phoneNumber;
                    }
                } catch (NumberParseException $exception) {
                    $invalidNumbers[] = $phoneNumber;
                }
            }
        }

        return count($invalidNumbers) === 0;
    }

    /**
     * @param string $phoneNumber
     *
     * @return string
     */
    protected function preparePhoneNumber($phoneNumber)
    {
        return '+' . ltrim($phoneNumber, '+');
    }
}
