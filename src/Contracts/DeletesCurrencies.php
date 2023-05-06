<?php

namespace Tender\Contracts;

use Illuminate\Database\Eloquent\Model;
use Tender\Currency;

interface DeletesCurrencies
{
    /**
     * Delete an existing currency.
     */
    public function __invoke(Model $user, Currency $currency): void;
}
