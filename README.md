# eventjet-vatin
[![Build Status](https://travis-ci.org/eventjet/eventjet-vatin.svg?branch=master)](https://travis-ci.org/eventjet/eventjet-vatin)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/eventjet/eventjet-vatin/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/eventjet/eventjet-vatin/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/eventjet/eventjet-vatin/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/eventjet/eventjet-vatin/?branch=master)

VAT identification number value object and validation

This package uses [ddeboer/vatin](https://github.com/ddeboer/vatin) for validation.

## Usage

You can create an instance of `Eventjet\Vatin\Vatin` directly:

```php
$vatin = new Eventjet\Vatin\Vatin('NL123456789B01');
```

This checks if the format of the VAT IN is correct. If you also want to check if the number actually exists using 
[VIES](http://ec.europa.eu/taxation_customs/vies/vieshome.do), you should use the factory instead:

```php
$validator = new Ddeboer\Vatin\Validator;
$factory = new Eventjet\Vatin\VatinFactory($validator);
$vatin = $factory->create('NL123456789B01');
```
