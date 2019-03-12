<?php

namespace Digitonic\CustomValidation;

use App\Validation\CsvValidator;
use App\Validation\IsUniqueToOrganizationValidator;
use App\Validation\ScheduledPausesValidator;
use App\Validation\WithinBusinessHoursValiadator;
use Digitonic\CustomValidation\Commands\Installer;
use Digitonic\CustomValidation\Validators\AllowedRecipientsValidator;
use Digitonic\CustomValidation\Validators\PhoneNumberIndexValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class CustomValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
//        Validator::extend('unique_to_organization', IsUniqueToOrganizationValidator::class . '@validate');
        Validator::extend('allowed_recipients', AllowedRecipientsValidator::class . '@validate');
//        Validator::extend('csv', CsvValidator::class . '@validate');
        Validator::extend('phone_number_index', PhoneNumberIndexValidator::class . '@validate');
//        Validator::extend('within_business_hours', WithinBusinessHoursValiadator::class . '@validate');
//        Validator::extend('scheduled_pauses', ScheduledPausesValidator::class . '@validate');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/custom-validation.php', 'digitonic.custom-validation');

        $this->commands([
            Installer::class,
        ]);

        $this->publishes([
            __DIR__.'/../config/custom-validation.php' => config_path('digitonic/custom-validation.php'),
        ]);
    }
}
