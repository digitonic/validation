<?php

namespace Digitonic\CustomValidation\Commands;

use Digitonic\CustomValidation\CustomValidationServiceProvider;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Installer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'digitonic:validation:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install digitonic custom validation rules';

    public function handle()
    {
        Artisan::call('vendor:publish', ['--provider' => CustomValidationServiceProvider::class]);
    }
}
