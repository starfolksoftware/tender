<?php

namespace Tender\Contracts;

use Illuminate\Database\Eloquent\Model;
use Tender\Currency;

interface CreatesCurrencies
{
    /**
     * Create a new currency.
     */
    public function __invoke(Model $user, array $data, int|string|null $teamId = null): Currency;
}
