<?php

namespace Digitonic\Validation;

use Illuminate\Support\ServiceProvider;
use Digitonic\Validation\Validators\AllowedRecipientsValidator;
use Digitonic\Validation\Validators\CsvValidator;
use Digitonic\Validation\Validators\Passwords\LowercaseValidator;
use Digitonic\Validation\Validators\Passwords\NumericCharacterValidator;
use Digitonic\Validation\Validators\Passwords\SpecialCharacterValidator;
use Digitonic\Validation\Validators\Passwords\UppercaseValidator;
use Digitonic\Validation\Validators\PhoneNumberIndexValidator;
use Illuminate\Support\Facades\Validator;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
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

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('digitonic.validation'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'digitonic.validation');
    }
}
