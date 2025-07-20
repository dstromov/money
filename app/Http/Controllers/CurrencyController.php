<?php

namespace App\Http\Controllers;

use App\Http\Requests\Currencies\RenameCurrencyRequest;
use App\Http\Requests\Currencies\StoreCurrencyRequest;
use App\Http\Requests\Currencies\UpdateRateCurrencyRequest;
use App\Http\Resources\CurrencyCollection;
use App\Models\Currency;
use App\Services\CurrencyService;
use App\Services\RecountService;

class CurrencyController extends Controller
{
    public function index()
    {
        //TODO добавить пагинацию и фильтры
        return Currency::all()->sortBy('country')->toResourceCollection();
    }

    public function store(StoreCurrencyRequest $request)
    {
        $validatedData = $request->validated();
        CurrencyService::store($validatedData);

        return redirect()->route('indexCurrencies');
    }

    public function show(Currency $currency)
    {
        return $currency->toResource();
    }

    public function update(Currency $currency, RenameCurrencyRequest $request)
    {
        $validatedData = $request->validated();
        $result = CurrencyService::update($currency, $validatedData);

        if ($result['status'] === 'failure') {
            return $result['message'];
        }

        return redirect()->route('indexCurrencies');
    }

    public function destroy(Currency $currency)
    {
        CurrencyService::destroy($currency);

        return redirect()->route('indexCurrencies');
    }

    public function updateRate(Currency $currency, UpdateRateCurrencyRequest $request)
    {
        $validatedData = $request->validated();

        CurrencyService::update($currency, $validatedData);
        RecountService::recount($currency);

        return redirect()->route('indexCurrencies');
    }

    public function refresh(Currency $currency)
    {
        RecountService::recount($currency);

        return redirect()->route('indexCurrencies');
    }
}
