# Digitonic Validation

[![Latest Version on Packagist](https://img.shields.io/packagist/v/digitonic/validation.svg?style=flat-square)](https://packagist.org/packages/digitonic/validation)
[![Build Status](https://img.shields.io/travis/digitonic/validation/master.svg?style=flat-square)](https://travis-ci.org/digitonic/validation)
[![Quality Score](https://img.shields.io/scrutinizer/g/digitonic/validation.svg?style=flat-square)](https://scrutinizer-ci.com/g/digitonic/validation)
[![Total Downloads](https://img.shields.io/packagist/dt/digitonic/validation.svg?style=flat-square)](https://packagist.org/packages/digitonic/validation)

This package will provide some custom validation out of the box in one single package. Using a configuration, you may create your own custom validations.

## Installation

You can install the package via composer:

```bash
$ composer require digitonic/validation 
```

### Publish the config

```bash
$ php artisan vendor:publish --provider="Digitonic\Validation\ValidationServiceProvider"
```

### Validators keys

##### Allowed Recipients

This validator will check for the validity of a given mobile phone number in a configured country.  

```bash
allowed_recipients
```

##### CSV

This validator will check the contents of a given CSV has at least one valid row.

```bash
csv
```

##### Phone Number Index

This validator will check the contents of a passed CSV file for a given key and validate that this value is a valid mobile phone number within a configured country.
 
```bash
phone_number_index
```

### Password Validation

Check to ensure a validated string contains one or more uppercase characters.

```bash
has_uppercase
```

Check to ensure a validated string contains one or more lowercase characters.
```bash
has_lowercase
```
Check to ensure a validated string contains one or more numeric characters.
```bash
has_numeric
```

Check to ensure a validated string contains one or more special characters.
```bash
has_special
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email steven@digitonic.co.uk instead of using the issue tracker.

## Credits

- [Yannick Glade](https://github.com/MrTammer)
- [Chris Crawford](https://github.com/ChrisCrawford1)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
