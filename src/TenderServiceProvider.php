<?php

namespace Tender;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Tender\Actions\CreateCurrency;
use Tender\Actions\DeleteCurrency;
use Tender\Actions\UpdateCurrency;
use Tender\Commands\InstallCommand;

class TenderServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('tender')
            ->hasConfigFile()
            ->hasCommand(InstallCommand::class);

        if (Tender::$runsMigrations) {
            $package->hasMigration('create_tender_table');
        }

        if (Tender::$registersRoutes) {
            $package->hasRoutes('web');
        }
    }

    public function packageRegistered()
    {
        Tender::createCurrenciesUsing(CreateCurrency::class);

        Tender::updateCurrenciesUsing(UpdateCurrency::class);

        Tender::deleteCurrenciesUsing(DeleteCurrency::class);
    }
}
