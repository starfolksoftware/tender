<?php

use Tender\Tender;
use Tender\Tests\Mocks\Currency as MocksCurrency;
use Tender\Tests\Mocks\TestProduct;

beforeAll(function () {
    Tender::supportsTeams(false);
    Tender::useCurrencyModel(MocksCurrency::class);
});

it('can sync currency to a model', function () {
    $currency = Tender::newCurrencyModel()->factory()->create();

    [$product] = TestProduct::factory()->count(5)->create();

    $product->syncCurrencies($currency);

    expect($product->currencies()->count())->toBe(1);

    expect($product->currencies()->first())
        ->id->toBe($currency->id)
        ->team_id->toBeNull()
        ->type->toBe($currency->type)
        ->name->toBe($currency->name)
        ->rate->toBe((float) $currency->rate);

    // test that only one product has currency
    expect($product->hasCurrencies($currency))->toBeTrue();
    expect($product->hasAllCurrencies($currency))->toBeTrue();
    expect(TestProduct::withAllCurrencies($currency)->count())->toBe(1);
    expect(TestProduct::withAnyCurrencies($currency)->count())->toBe(1);
    expect(TestProduct::withoutCurrencies($currency)->count())->toBe(4);
    expect(TestProduct::withoutAnyCurrencies()->count())->toBe(4);
});

it('can attach and detach currency to a model', function () {
    [$currency1, $currency2, $currency3] = Tender::newCurrencyModel()->factory()->count(3)->create();

    [$product] = TestProduct::factory()->count(5)->create();

    $product->attachCurrencies([$currency1->id, $currency2->id]);

    expect($product->currencies()->count())->toBe(2);

    expect(TestProduct::withoutCurrencies($currency3)->count())->toBe(5);

    expect($product->currencies()->first())
        ->id->toBe($currency1->id)
        ->team_id->toBeNull()
        ->type->toBe($currency1->type)
        ->name->toBe($currency1->name)
        ->rate->toBe((float) $currency1->rate);

    $product->detachCurrencies($currency1);

    expect($product->currencies()->count())->toBe(1);

    expect(TestProduct::withAnyCurrencies($currency2)->count())->toBe(1);

    $product->detachCurrencies();

    expect($product->currencies()->count())->toBe(0);

    expect(TestProduct::withoutAnyCurrencies()->count())->toBe(5);
});
