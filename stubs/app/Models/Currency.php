<?php

namespace App\Models;

use Tender\Currency as TenderCurrency;
use Tender\Events\CurrencyCreated;
use Tender\Events\CurrencyDeleted;
use Tender\Events\CurrencyUpdated;

class Currency extends TenderCurrency
{
    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => CurrencyCreated::class,
        'updated' => CurrencyUpdated::class,
        'deleted' => CurrencyDeleted::class,
    ];
}