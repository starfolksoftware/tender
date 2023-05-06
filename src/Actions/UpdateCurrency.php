<?php

namespace Tender\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Tender\Contracts\UpdatesCurrencies;
use Tender\Currency;
use Tender\Events\CurrencyUpdated;
use Tender\Events\UpdatingCurrency;

class UpdateCurrency implements UpdatesCurrencies
{
    /**
     * Update a currency.
     */
    public function __invoke(Model $user, Currency $currency, array $data): Currency
    {
        event(new UpdatingCurrency(user: $user, currency: $currency, data: $data));

        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
            'rate' => ['required', 'decimal:0,8'],
            'precision' => ['nullable', 'integer', 'max:255'],
            'symbol' => ['nullable', 'string', 'max:255'],
            'symbol_position' => ['string', 'max:255', 'in:before,after'],
            'decimal_mark' => ['nullable', 'string', 'max:255'],
            'thousands_separator' => ['nullable', 'string', 'max:255'],
            'enabled' => ['boolean'],
        ])->validateWithBag('updateCurrency');

        $currency->update(collect($data)->only([
            'name',
            'code',
            'rate',
            'precision',
            'symbol',
            'symbol_position',
            'decimal_mark',
            'thousands_separator',
            'enabled',
        ])->toArray());

        $currency->refresh();

        event(new CurrencyUpdated(user: $user, currency: $currency, data: $data));

        return $currency;
    }
}
