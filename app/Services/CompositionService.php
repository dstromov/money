<?php

namespace App\Services;

use App\Models\Composition;
use App\Models\Currency;
use App\Models\Denomination;
use Illuminate\Support\Facades\DB;

class CompositionService
{
    public static function store(Array $validatedData)
    {

        // каждая функция должна ровно одно действие. не должно быть таких жирных смешанных классов.
        // как первый шаг, создать допметоды прямо тут внутри класса.

        Denomination::findOrFail($validatedData['denomination_id']);

        //TODO добавить проверку еще и на уровне БД - составной уникальный ключ
        $existedComposition = Composition::where('denomination_id', $validatedData['denomination_id'])
            ->where('value', $validatedData['value'])
            ->count();

        if ($existedComposition) {
            //TODO переписать на выбрасывание исключений
            return ['message' => 'такая модель уже есть', 'status' => 'failure'];
        }

        $composition = new Composition;
        $composition->fill($validatedData);
        $composition->save();
        $currencyId = $composition->denomination->currency_id;

        return  Currency::find($currencyId);
    }

    public static function update(Array $validatedData)
    {
        $composition = Composition::findOrFail($validatedData['id']);

        if (isset($validatedData['value'])) { // условие не вызывается, когда меняется кол-во позиции
            $existedComposition = Composition::where('denomination_id', $composition->denomination_id)
                ->where('value', $validatedData['value'])
                ->where('id', $validatedData['id'])
                ->count();
        }

        if (isset($existedComposition) && $existedComposition) {
            //TODO переписать на выбрасывание исключений
            return ['message' => 'такая модель уже есть', 'status' => 'failure'];
        }

        $composition->fill($validatedData);
        $composition->save();
        $currencyId = $composition->denomination->currency_id;

        return Currency::find($currencyId);
    }

    public static function destroy(Array $validatedData): Currency
    {
        $composition = Composition::findOrFail($validatedData['id']);
        $composition->delete();

        $currencyId = $composition->denomination->currency_id;

        return Currency::find($currencyId);
    }

}
