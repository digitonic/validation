<?php

namespace Digitonic\Validation\Tests\Unit\CustomValidation\Validators;

use Digitonic\Validation\Tests\BaseTestCase;
use Illuminate\Support\Facades\Validator;

class CsvValidatorTest extends BaseTestCase
{
    /** @test */
    public function can_validate_csvs()
    {
        // a single line is not a valid csv
        $validator = Validator::make(['csv' => 'header_1, header_2'], ['csv' => 'csv']);
        $this->assertTrue($validator->fails());

        $validator = Validator::make(['csv' => "header_1\nvalue_1"], ['csv' => 'csv']);
        $this->assertFalse($validator->fails());
    }
}
