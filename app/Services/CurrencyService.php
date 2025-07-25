<?php

namespace App\Services;

use App\Models\Currency;


class CurrencyService
{
    public static function store(Array $validatedData): Currency
    {
        $currency = new Currency;
        $currency->fill($validatedData);
        $currency->save();

        return $currency;
    }

    public static function update(Currency $currency, Array $validatedData): Array
    {
        if (!$validatedData){
            return ['status' => 'failure','massage' => 'Не передано ни одного поля для переименования']; //TODO переписать на выброс исключения
        }

        $currency->fill($validatedData);
        $currency->save();

        return ['status' => 'success'];
    }

    public static function destroy(Currency $currency)
    {
        $currency->delete();
    }

}
