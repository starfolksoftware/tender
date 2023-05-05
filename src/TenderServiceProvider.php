<?php

namespace Tender\Tender;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Tender\Tender\Commands\TenderCommand;

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
            ->hasViews()
            ->hasMigration('create_tender_table')
            ->hasCommand(TenderCommand::class);
    }
}
