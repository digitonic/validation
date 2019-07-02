# Digitonic Validator

## Overview

This package will just provide some custom validator out of the box in one single package.

## Getting Started

Install the package (Remember to add the private digitonic satis repo to the composer.json)

```bash
$ composer require digitonic/validation 
```

### Install command config

```bash
$ php artisan dig:va:ins
```

### Validators keys

```bash
$ allowed_recipients
```
```bash
$ csv
```
```bash
$ phone_number_index
```
Check to ensure a validated string contains one or more uppercase characters.
```bash
$ has_uppercase
```

Check to ensure a validated string contains one or more lowercase characters.
```bash
$ has_lowercase
```
Check to ensure a validated string contains one or more numeric characters.
```bash
$ has_numeric
```

Check to ensure a validated string contains one or more special characters.
```bash
$ has_special
```

