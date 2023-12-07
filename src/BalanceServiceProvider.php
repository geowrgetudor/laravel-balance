<?php

namespace Geow\Balance;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BalanceServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-balance')
            ->hasConfigFile()
            ->hasMigration('create_balances_table');
    }
}
