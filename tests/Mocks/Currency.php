<?php

namespace Tender\Tests\Mocks;

use Tender\Currency as TenderCurrency;
use Tender\Events\CurrencyCreated;
use Tender\Events\CurrencyDeleted;
use Tender\Events\CurrencyUpdated;

class Currency extends TenderCurrency
{
    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): \Illuminate\Database\Eloquent\Factories\Factory
    {
        return CurrencyFactory::new();
    }

    /**
     * The event map for the model.
     */
    protected $dispatchesEvents = [
        'created' => CurrencyCreated::class,
        'updated' => CurrencyUpdated::class,
        'deleted' => CurrencyDeleted::class,
    ];
}