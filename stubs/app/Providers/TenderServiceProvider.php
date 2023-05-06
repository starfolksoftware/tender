<?php

namespace App\Providers;

use App\Models\Currency;
use Illuminate\Support\ServiceProvider;
use Tender\Actions\CreateCurrency;
use Tender\Actions\DeleteCurrency;
use Tender\Actions\UpdateCurrency;
use Tender\Tender;

class TenderServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Tender::supportsTeams();

        Tender::createCurrenciesUsing(CreateCurrency::class);

        Tender::updateCurrenciesUsing(UpdateCurrency::class);

        Tender::deleteCurrenciesUsing(DeleteCurrency::class);

        Tender::useCurrencyModel(Currency::class);

        // Tender::useTeamModel(Team::class);
    }
}
