<?php

use Tender\Tender;
use Tender\Tests\Mocks\Currency as MocksCurrency;
use Tender\Tests\Mocks\TestUser;

beforeAll(function () {
    Tender::supportsTeams(false);
    Tender::useCurrencyModel(MocksCurrency::class);
});

test('currency can be created', function () {
    $user = TestUser::first();

    $response = actingAs($user)->post(route('currencies.store'), [
        'name' => 'Nigerian Naira',
        'code' => 'NGN',
        'rate' => 1,
        'redirect' => '/redirect/path',
    ]);

    $response->assertRedirect('/redirect/path');

    $this->assertDatabaseHas('currencies', [
        'name' => 'Nigerian Naira',
        'code' => 'NGN',
        'rate' => 1,
    ]);

    expect(Tender::newCurrencyModel()->count())->toEqual(1);
});

test('currency can be updated', function () {
    $user = TestUser::first();

    $currency = Tender::newCurrencyModel()->factory()->create();

    $response = actingAs($user)->put(route('currencies.update', $currency), [
        'name' => 'Currency',
        'code' => 'NGN',
        'rate' => 1,
        'redirect' => '/redirect/path',
    ]);

    $response->assertRedirect('/redirect/path');

    $this->assertDatabaseHas('currencies', [
        'name' => 'Currency',
        'code' => 'NGN',
        'rate' => 1,
    ]);
});

test('currency can be deleted', function () {
    $user = TestUser::first();

    $currency = Tender::newCurrencyModel()->factory()->create();

    $response = actingAs($user)->delete(route('currencies.destroy', $currency), [
        'redirect' => '/redirect/path',
    ]);

    $response->assertRedirect('/redirect/path');

    expect(Tender::newCurrencyModel()->count())->toEqual(0);
});