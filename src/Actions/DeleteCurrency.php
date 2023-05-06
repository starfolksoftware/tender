<?php

namespace Tender\Actions;

use Illuminate\Database\Eloquent\Model;
use Tender\Contracts\DeletesCurrencies;
use Tender\Currency;
use Tender\Events\CurrencyDeleted;
use Tender\Events\DeletingCurrency;

class DeleteCurrency implements DeletesCurrencies
{
    /**
     * Delete a currency.
     */
    public function __invoke(Model $user, Currency $currency): void
    {
        event(new DeletingCurrency(user: $user, currency: $currency));

        $currency->delete();

        event(new CurrencyDeleted(user: $user, currency: $currency));
    }
}
