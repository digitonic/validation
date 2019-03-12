<?php

namespace Digitonic\CustomValidation\Validators;

use Illuminate\Validation\Concerns\ValidatesAttributes;
use Illuminate\Validation\Validator;
use League\Csv\Reader;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;

class PhoneNumberIndexValidator
{
    use ValidatesAttributes;

    protected $libPhoneNumber;

    public function __construct()
    {
        $this->libPhoneNumber = PhoneNumberUtil::getInstance();
    }

    public function validate($attribute, $value, $parameters, Validator $validator)
    {
        $csvDataKey = $parameters[0];
        $requestData = $validator->getData();

        if (array_key_exists($csvDataKey, $requestData)) {
            $csvData = $validator->getData()[$csvDataKey];
            try {
                $csv = Reader::createFromString($csvData);
                $firstRow = $csv->fetchOne();
                $phoneNumbers = $csv->fetchColumn($value);
                $invalidNumbers = [];
                $row = 0;

                // If the phoneNumberIndex is greater than the number of columns in the file
                if ($value >= count($firstRow)) {
                    return false;
                }

                foreach ($phoneNumbers as $phoneNumber) {
                    if ($row > 0) {
                        if (!empty($phoneNumber)) {
                            try {
                                $proto = $this->libPhoneNumber->parse($this->preparePhoneNumber($phoneNumber), null);
                                if (!in_array(
                                    $this->libPhoneNumber->getRegionCodeForNumber($proto),
                                    config('digitonic.custom-validation.allowed_mobile_origins')
                                )) {
                                    $invalidNumbers[] = $phoneNumber;
                                }
                            } catch (NumberParseException $exception) {
                                $invalidNumbers[] = $phoneNumber;
                            }
                        }
                    }

                    $row++;
                }

                return count($invalidNumbers) === 0;

            } catch (\Exception $e) {
                return false;
            }
        }

        return false;
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