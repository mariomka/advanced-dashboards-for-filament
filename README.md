# Filament Dashboards

**This package is a work in progress and is not ready for production use.**

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mariomka/filament-dashboards.svg?style=flat-square)](https://packagist.org/packages/mariomka/filament-dashboards)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/mariomka/filament-dashboards/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/mariomka/filament-dashboards/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/mariomka/filament-dashboards/fix-php-code-styling.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/mariomka/filament-dashboards/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mariomka/filament-dashboards.svg?style=flat-square)](https://packagist.org/packages/mariomka/filament-dashboards)

Dashboard with filters for Filament

## Installation

You can install the package via composer:

```bash
composer require mariomka/filament-dashboards
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-dashboards-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-dashboards-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-dashboards-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$filamentDashboards = new Mariomka\FilamentDashboards();
echo $filamentDashboards->echoPhrase('Hello, Mariomka!');
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
