<?php

namespace Tender;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait TeamHasCurrencies
{
    /**
     * Get the currencies associated with the team.
     */
    public function currencies(): HasMany
    {
        return $this->hasMany(Tender::currencyModel(), 'team_id');
    }
}