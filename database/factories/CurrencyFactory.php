<?php

namespace Tender\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tender\Currency;

class CurrencyFactory extends Factory
{
    protected $model = Currency::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'code' => $this->faker->currencyCode(),
            'rate' => $this->faker->randomDigitNotZero(),
        ];
    }
}
