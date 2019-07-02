<?php

namespace Digitonic\Validation;

use Digitonic\Validation\Commands\Installer;
use Digitonic\Validation\Validators\AllowedRecipientsValidator;
use Digitonic\Validation\Validators\CsvValidator;
use Digitonic\Validation\Validators\Passwords\LowercaseValidator;
use Digitonic\Validation\Validators\Passwords\NumericCharacterValidator;
use Digitonic\Validation\Validators\Passwords\SpecialCharacterValidator;
use Digitonic\Validation\Validators\Passwords\UppercaseValidator;
use Digitonic\Validation\Validators\PhoneNumberIndexValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('allowed_recipients', AllowedRecipientsValidator::class . '@validate');
        Validator::extend('csv', CsvValidator::class . '@validate');
        Validator::extend('phone_number_index', PhoneNumberIndexValidator::class . '@validate');
        Validator::extend('has_uppercase', UppercaseValidator::class  . '@validate');
        Validator::extend('has_lowercase', LowercaseValidator::class  . '@validate');
        Validator::extend('has_numeric', NumericCharacterValidator::class  . '@validate');
        Validator::extend('has_special', SpecialCharacterValidator::class  . '@validate');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/validation.php', 'digitonic.validation');

        $this->commands([
            Installer::class,
        ]);

        $this->publishes([
            __DIR__.'/../config/validation.php' => config_path('digitonic/validation.php'),
        ]);
    }
}
