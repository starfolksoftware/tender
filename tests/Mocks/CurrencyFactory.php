<?php

namespace Tender\Tests\Mocks;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tender\Tender;

class CurrencyFactory extends Factory
{
    protected $model = Currency::class;

    public function definition()
    {
        $defs = [
            'name' => $this->faker->word(),
            'code' => $this->faker->currencyCode(),
            'rate' => $this->faker->randomDigitNotZero(),
        ];

        if (Tender::$supportsTeams) {
            $defs['team_id'] = 1;
        }

        return $defs;
    }
}