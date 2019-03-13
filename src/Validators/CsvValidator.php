<?php

namespace Digitonic\Validation\Validators;

use Illuminate\Validation\Concerns\ValidatesAttributes;
use League\Csv\Reader;

class CsvValidator
{
    use ValidatesAttributes;

    public function validate($attribute, $value, $parameters, $validator)
    {
        ini_set("auto_detect_line_endings", true);

        try {
            $csv = Reader::createFromString($value);
            $numRows = 0;
            foreach($csv->getIterator() as $row){
                $numRows++;
            }

            return $numRows > 1;
        } catch (\Exception $e) {
            return false;
        }
    }
}
