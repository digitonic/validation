<?php

namespace Digitonic\Validation\Validators;

use Illuminate\Validation\Concerns\ValidatesAttributes;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\PhoneNumberFormat;

class AllowedRecipientsValidatorSanitiser
{
    use ValidatesAttributes;

    protected $libPhoneNumber;

    public function __construct()
    {
        $this->libPhoneNumber = PhoneNumberUtil::getInstance();
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
            $proto = $this->getPhoneNumberObject($phoneNumber);

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

    /**
     * Get formatted phone number in E.164 standard without (+).
     * This method will return false if the number is not valid.
     *
     * @param string $phoneNumber
     *
     * @return mixed
     */
    public function getFormattedNumber(string $phoneNumber)
    {
        $phoneNumberObject = $this->getPhoneNumberObject($phoneNumber);

        if ($phoneNumberObject) {
            if (in_array(
                $this->libPhoneNumber->getRegionCodeForNumber($phoneNumberObject),
                config('digitonic.validation.allowed_mobile_origins')
            )) {
                // Format number to E.164 standard and remove '+'
                $formattedPhone = str_replace(
                    '+',
                    '',
                    $this->libPhoneNumber->format($phoneNumberObject, PhoneNumberFormat::E164)
                );

                return $formattedPhone;
            }
        }

        return false;
    }

    /**
     * Get phoneNumberObject.
     *
     * @param string $phoneNumber
     *
     * @return mixed
     */
    protected function getPhoneNumberObject(string $phoneNumber)
    {
        try {
            if (!preg_match('/[A-Za-z]/', $phoneNumber)) {
                $phoneNumberObject = $this->libPhoneNumber->parse($this->sanitisePhoneNumber($phoneNumber), null);
                if ($this->libPhoneNumber->isPossibleNumber($phoneNumberObject)) {
                    return $phoneNumberObject;
                }
            }
        } catch (NumberParseException $exception) {
            // Do nothing
        }

        return false;
    }

    /**
     * @param string $phoneNumber
     * @return string
     */
    protected function sanitisePhoneNumber(string $phoneNumber): string
    {
        $phoneNumber = $this->getDigits($phoneNumber);

       return $this->formatNumber($phoneNumber);
    }

    /**
     * @param string $phoneNumber
     * @return string
     */
    protected function getDigits(string $phoneNumber): string
    {
        return preg_replace('#\D+#', '', $phoneNumber);
    }

    /**
     * @param string $phoneNumber
     * @return string
     */
    protected function formatNumber(string $phoneNumber): string
    {
        // Format UK numbers starting with 07 or 7
        preg_match('/^0*(7\d{9})$/', $phoneNumber, $outputUkPhone);

        if ($outputUkPhone) {
            return '+44' . $outputUkPhone[1];
        }

        return '+' . $phoneNumber;
    }
}
