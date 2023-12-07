# Add a balance / credit system to any Laravel model

[![Latest Version on Packagist](https://img.shields.io/packagist/v/geowrgetudor/laravel-balance.svg?style=flat-square)](https://packagist.org/packages/geowrgetudor/laravel-balance)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/geowrgetudor/laravel-balance/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/geowrgetudor/laravel-balance/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/geowrgetudor/laravel-balance/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/geowrgetudor/laravel-balance/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/geowrgetudor/laravel-balance.svg?style=flat-square)](https://packagist.org/packages/geowrgetudor/laravel-balance)

This is a small package that adds a credit system that you might need for various reasons:

-   awarding users based on their activity
-   rewards in credits instead of real money
-   rewards in credits for referrals
-   etc.

## Installation

Install the package via composer:

```bash
composer require geowrgetudor/laravel-balance
```

Publish and run the migrations with:

```bash
php artisan vendor:publish --tag="balance-migrations"
php artisan migrate
```

If you decide to change the default migration table name, make sure you publish the config file and change the table name there too:

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

Add the `HasBalance` trait to any model you need to.

```php
use Geow\Balance\Traits\HasBalance;

class User extends Model {
    // ...
    use HasBalance;

}
```

## Usage

```php
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
