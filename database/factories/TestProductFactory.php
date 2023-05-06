<?php

namespace Tender\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tender\Tests\Mocks\TestProduct;

class TestProductFactory extends Factory
{
    protected $model = TestProduct::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
