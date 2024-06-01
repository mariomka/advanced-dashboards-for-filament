# Advanced Dashboards for Filament

**This package is a work in progress and is not ready for production use.**

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mariomka/advanced-dashboards-for-filament.svg?style=flat-square)](https://packagist.org/packages/mariomka/advanced-dashboards-for-filament)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/mariomka/advanced-dashboards-for-filament/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/mariomka/advanced-dashboards-for-filament/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/mariomka/advanced-dashboards-for-filament/fix-php-code-styling.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/mariomka/advanced-dashboards-for-filament/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mariomka/advanced-dashboards-for-filament.svg?style=flat-square)](https://packagist.org/packages/mariomka/advanced-dashboards-for-filament)

## Installation

You can install the package via composer:

```bash
composer require mariomka/advanced-dashboards-for-filament
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="advanced-dashboards-for-filament-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="advanced-dashboards-for-filament-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="advanced-dashboards-for-filament-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$advancedDashboardsForFilament = new Mariomka\AdvancedDashboardsForFilament();
echo $advancedDashboardsForFilament->echoPhrase('Hello, Mariomka!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Mario Juarez](https://github.com/mariomka)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
