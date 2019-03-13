<?php

namespace Digitonic\Validation\Tests\Feature;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

class InstallerTest extends TestCase
{
    /** @test */
    public function can_install_package()
    {
        File::delete(config_path('digitonic/validation.php'));

        $this->artisan('digitonic:validation:install');

        $this->assertTrue(File::exists(config_path('digitonic/validation.php')));

        File::delete(config_path('digitonic/validation.php'));
    }
}
