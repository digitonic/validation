<?php

namespace Digitonic\Validation\Tests;

use Digitonic\Validation\ValidationServiceProvider;
use Orchestra\Testbench\TestCase;

class BaseTestCase extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            ValidationServiceProvider::class
        ];
    }

    protected function getPackageAliases($app)
    {
        return [];
    }
}
