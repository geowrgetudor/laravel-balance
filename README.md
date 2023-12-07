# Add a balance / credit system to any Laravel model

[![Latest Version on Packagist](https://img.shields.io/packagist/v/geowrgetudor/laravel-balance.svg?style=flat-square)](https://packagist.org/packages/geowrgetudor/laravel-balance)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/geowrgetudor/laravel-balance/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/geowrgetudor/laravel-balance/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/geowrgetudor/laravel-balance/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/geowrgetudor/laravel-balance/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/geowrgetudor/laravel-balance.svg?style=flat-square)](https://packagist.org/packages/geowrgetudor/laravel-balance)

This is a small package that ads

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-balance.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-balance)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require geowrgetudor/laravel-balance
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="balance-migrations"
php artisan migrate
```

If you decide to change the default migration's table name, make sure you publish the config file and change the table name there too:

```bash
php artisan vendor:publish --tag="balance-config"
```

This is the contents of the published config file:

```php
return [
    /**
     * Default table name.
     * If you have changed the migration, make sure you change this too.
     */
    'table' => 'balances'
];

```

## Prepare your model

```php
use Geow\Balance\Traits\HasBalance;

class User extends Model {
    // ...
    use HasBalance;

}
```

## Usage

```php
$user = User::first();

// Set balance (similar to increaseCredit() method - just a naming difference)
$user->setCredit(2000);

// Get balance
$user->credit;

// Increase balance
$user->increaseCredit(1000);

// Decrease balance
$user->decreaseCreit(500);

// Reset balance to 0
$user->resetCredit();

// Check if the user has balance
$user->hasCredit();

// Passing a reason for setting/increasing/deacreasing the balance
$user->setCredit(20000, 'Signup bonus');
$user->increaseCredit(1000, 'Awarded credits');
$user->decreaseCredit(250, 'Service usage');

// Get balance currency style (divided by 100). For example your currency is $ and you want to award your user $10
$user->increaseCredit(1000); // $10 in cents
$user->credit; // returns 1000 (represeting cents)
$user->creditCurrency; // returns 10 (representing dollars)

// Getting all model related transactions (increases and decresed in balance)
$user->credits; // Returns \Illuminate\Database\Eloquent\Collection
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [George Tudor](https://github.com/geowrgetudor)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
