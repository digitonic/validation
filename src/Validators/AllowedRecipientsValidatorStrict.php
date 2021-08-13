<?php

namespace Digitonic\Validation\Validators;

use Digitonic\Validation\Services\AllowedRecipientsSanitiser;
use Illuminate\Validation\Concerns\ValidatesAttributes;

class AllowedRecipientsValidatorStrict
{
    use ValidatesAttributes;

    protected $sanitiser;

    public function __construct()
    {
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
                    $this->sanitiser->getRegionCodeForNumber($proto),
                    config('digitonic.validation.allowed_mobile_origins')
                )
            ) {
                $invalidNumbers[] = $phoneNumber;
            }

        }

        return count($invalidNumbers) === 0;
    }
}
