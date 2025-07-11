<?php

namespace App\Http\Controllers;

use App\Http\Requests\Denominations\DestroyDenominationRequest;
use App\Http\Requests\Denominations\StoreDenominationRequest;
use App\Http\Requests\Denominations\UpdateCountDenominationRequest;
use App\Http\Requests\Denominations\UpdateDenominationRequest;
use App\Models\Currency;
use App\Models\Denomination;
use App\Services\DenominationService;
use App\Services\RecountService;
use Illuminate\Http\Request;

class DenominationController extends Controller
{   

    public function store(Currency $currency, StoreDenominationRequest $request)
    {
        $validatedData = $request->validated();
        $result = DenominationService::store($currency, $validatedData);

        if ($result['status'] === 'failure') {
            return $result['message'];
        }
        
        return redirect()->route('showCurrencyWithDenominations', ['currency' => $currency->id]);
    }

    public function show(Currency $currency)
    {
        // return DenominationService::show($currency);

        return $currency->toResource();















    }

    public function update(UpdateDenominationRequest $request)
    {
        $validatedData = $request->validated();
        $result = DenominationService::update($validatedData);

        if (is_array($result) && $result['status'] === 'failure') { // условие проверки статуса избыточено, сделан для однообразия и наглядности    
            return $result['message'];
        }

        $currency = $result;
        RecountService::recount($currency);

        return redirect()->route('showCurrencyWithDenominations', ['currency' => $currency->id]);
    }

    public function destroy(DestroyDenominationRequest $request)
    {
        $validatedData = $request->validated();
        $currency = DenominationService::destroy($validatedData);

        // if (is_array($result) && $result['status'] === 'failure') { // условие проверки статуса избыточено, сделан для однообразия и наглядности
        //     return $result['message'];
        // }

        // $currency = $result;
        RecountService::recount($currency);
        
        //экшн возвращает родительскую модель с оставшимися дочерними если они остались
        return redirect()->route('showCurrencyWithDenominations', ['currency' => $currency->id]);
    } 

}
