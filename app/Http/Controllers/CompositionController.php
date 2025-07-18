<?php

namespace App\Http\Controllers;


use App\Http\Requests\Compositions\DestroyCompositionRequest;
use App\Http\Requests\Compositions\StoreCompositionRequest;
use App\Http\Requests\Compositions\UpdateCompositionRequest;
use App\Http\Requests\Compositions\UpdateCountCompositionRequest;
use App\Services\CompositionService;
use App\Services\RecountService;


class CompositionController extends Controller
{

    public function store(StoreCompositionRequest $request)
    {
        $validatedData = $request->validated();

        $result = CompositionService::store($validatedData);

        if ($result['status'] === 'failure') {
            return $result['message'];
        }

        $currency = $result;

        return redirect()->route('showCurrencyWithDenominations', ['currency' => $currency->id]);
    }

    public function update(UpdateCompositionRequest $request)
    {
        $validatedData = $request->validated();
        $result = CompositionService::update($validatedData);

        if ($result['status'] === 'failure') {
            return $result['message'];
        }

        $currency = $result;
        RecountService::recount($currency);

        return redirect()->route('showCurrencyWithDenominations', ['currency' => $currency->id]);
    }

    public function destroy(DestroyCompositionRequest $request)
    {
        $validatedData = $request->validated();
        $currency = CompositionService::destroy($validatedData);
        RecountService::recount($currency);

        return redirect()->route('showCurrencyWithDenominations', $currency->id);
    }

    public function updateCount(UpdateCountCompositionRequest $request)
    {
        $validatedData = $request->validated();
        $currency = CompositionService::update($validatedData);
        RecountService::recount($currency);

        return redirect()->route('showCurrencyWithDenominations', ['currency' => $currency->id]);
    }

}
