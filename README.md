# Tender

A simple and straighforward package to attach currencies to models in your Laravel applications.

## Installation

You can install the package via composer:

```bash
composer require starfolksoftware/tender
php artisan tender:install
php artisan migrate
```

## Configuration

This is the contents of the published config file:

```php
return [
    'middleware' => ['web'],

    'redirects' => [
        'store' => null,
        'update' => null,
        'destroy' => '/',
    ],
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="tender-views"
```

## Usage

```php
<?php

namespace App\Models;

use App\Abstracts\Model;
use Tender\HasCurrencies;

class Product extends Model
{
    use HasCurrencies;
}

```

To enable team support:

```php
// this should be in a service provider
/**
 * Bootstrap any application services.
 *
 * @return void
 */
public function boot()
{
    Tender::supportsTeams();
}
```

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tender\TeamHasCurrencies;

class Team extends JetstreamTeam
{
    use TeamHasCurrencies;
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Faruk Nasir](https://github.com/frknasir)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.