<?php

namespace Tender\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Tender\Contracts\CreatesCurrencies;
use Tender\Contracts\DeletesCurrencies;
use Tender\Contracts\UpdatesCurrencies;
use Tender\Tender;

class CurrencyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatesCurrencies $createsCurrencies): RedirectResponse|JsonResponse
    {
        $currency = $createsCurrencies(
            request()->user(),
            request()->all(),
            request('team_id')
        );

        return request()->wantsJson() ? response()->json(['currency' => $currency]) : redirect()->to(
            request()->get('redirect', Tender::redirects('store', '/'))
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(mixed $currency, UpdatesCurrencies $updatesCurrencies): RedirectResponse|JsonResponse
    {
        $currency = Tender::newCurrencyModel()->findOrFail($currency);

        $currency = $updatesCurrencies(
            request()->user(),
            $currency,
            request()->all()
        );

        return request()->wantsJson() ? response()->json(['currency' => $currency]) : redirect()->to(
            request()->get('redirect', Tender::redirects('update', '/'))
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mixed $currency, DeletesCurrencies $deletesCurrencies): RedirectResponse|JsonResponse
    {
        $currency = Tender::newCurrencyModel()->findOrFail($currency);

        $deletesCurrencies(
            request()->user(),
            $currency
        );

        return request()->wantsJson() ? response()->json([]) : redirect()->to(
            request()->get('redirect', Tender::redirects('destroy', '/'))
        );
    }
}