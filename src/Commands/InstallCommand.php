<?php

namespace Tender\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    public $signature = 'tender:install';

    public $description = 'Install the Tender package and resources';

    public function handle(): int
    {
        // Publish...
        $this->callSilent('vendor:publish', ['--tag' => 'tender-config', '--force' => true]);
        $this->callSilent('vendor:publish', ['--tag' => 'tender-migrations', '--force' => true]);

        // Models...
        copy(__DIR__.'/../../stubs/app/Models/Currency.php', app_path('Models/Currency.php'));

        // Service Providers...
        copy(__DIR__.'/../../stubs/app/Providers/TenderServiceProvider.php', app_path('Providers/TenderServiceProvider.php'));

        $this->installServiceProviderAfter('RouteServiceProvider', 'TenderServiceProvider');

        return self::SUCCESS;
    }

    /**
     * Install the service provider in the application configuration file.
     */
    protected function installServiceProviderAfter(string $after, string $name): void
    {
        if (! Str::contains($appConfig = file_get_contents(config_path('app.php')), 'App\\Providers\\'.$name.'::class')) {
            file_put_contents(config_path('app.php'), str_replace(
                'App\\Providers\\'.$after.'::class,',
                'App\\Providers\\'.$after.'::class,'.PHP_EOL.'        App\\Providers\\'.$name.'::class,',
                $appConfig
            ));
        }
    }
}
