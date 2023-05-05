<?php

use Illuminate\Support\Facades\Route;
use Tender\Http\Controllers\CurrencyController;

Route::group([
    'middleware' => config('tender.middleware', ['web']),
], function () {
    Route::resource('currencies', CurrencyController::class)->only(['store', 'update', 'destroy']);
});