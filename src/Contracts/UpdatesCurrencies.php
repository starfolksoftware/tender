<?php

namespace Tender\Contracts;

use Illuminate\Database\Eloquent\Model;
use Tender\Currency;

interface UpdatesCurrencies
{
    /**
     * Update an existing currency.
     */
    public function __invoke(Model $user, Currency $currency, array $data): Currency;
}
