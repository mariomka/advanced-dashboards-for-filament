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

Then you need to update your Filament panel configuration:

```php
public function panel(Panel $panel): Panel
{
    return $panel
        // other configurations
        ->discoverQuestions(in: app_path('Filament/Questions'), for: 'App\\Filament\\Questions')
        // other configurations
}
```

If you're building a [custom theme](https://filamentphp.com/docs/3.x/panels/themes#creating-a-custom-theme), you need import a css file in your `resources/css/filament/{panel}/theme.css` file:

```css
@import '/vendor/mariomka/advanced-dashboards-for-filament/resources/css/overwrites.css';
```

And disable load the CSS in your `config/advanced-dashboards-for-filament.php` file:

```php
[
    'load_css' => false,
];
```

Optionally, you can publish the config file with:

```bash
php artisan vendor:publish --tag="advanced-dashboards-for-filament-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="advanced-dashboards-for-filament-views"
```

## Usage

TBD

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Credits

- [Mario Juárez](https://github.com/mariomka)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
