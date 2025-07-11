<?php

namespace App\Services;

use App\Models\Currency;
use App\Models\Denomination;

class DenominationService 
{
    public static function store(Currency $currency, Array $validatedData): Array
    {
        $denomination = new Denomination;
        $denomination->currency_id = $currency->id;

        foreach ($validatedData as $key => $value) {
            $denomination->$key = $value;
        }

        $validateForDoulble = self::validateForDoulble($currency, $denomination);

        if ($validateForDoulble['status'] === 'failure') {
            return $validateForDoulble;
        }        
                
        $denomination->save();

        return ['status' => 'success'];
    }

    // public static function show(Currency $currency)
    // {
    //     // возвращаетм модель денег со вложенными номиналами
    //     // TODO добавить сортировку по ratio
    //     return [$currency, $currency->denominations][0];
    // }

    public static function update(Array $validatedData)
    {
        $denominationId = $validatedData['id'];
        unset($validatedData['id']);
        
        if (!$validatedData){
            //TODO переписать на выброс исключения
            return ['message' => 'Не передано ни одного поля для изменения', 'status' => 'failure'];
        }

        $denomination = Denomination::findOrFail($denominationId);
        $currency = Currency::find($denomination->currency->id);

        foreach ($validatedData as $key => $value) {
            $denomination->$key = $value;
        }

        $validateForDoulble = self::validateForDoulble($currency, $denomination, true);

        if ($validateForDoulble['status'] === 'failure') {
            return $validateForDoulble;
        }               

        $denomination->save();

        return $currency;
    }

    public static function destroy(Array $validatedData): Currency
    {
        $denomination = Denomination::findOrFail($validatedData['id']);

        $currency = Currency::find($denomination->currency->id);
        $denomination->delete();

        return $currency;
    }

    private static function validateForDoulble(Currency $currency, Denomination $denomination, bool $IsEdition = false)
    {
    //TODO можно ли сделать этот метод нестатичесим? или и так норм?
    //TODO перенести проверку в валидацию запроса
    
        $editedDenominationId = 0; // для случая добавление позиции
        if ($IsEdition) $editedDenominationId = $denomination->id; // редактирование позиции
        
        $existedDenomination = Denomination::where('currency_id', $currency->id)
            ->where('name', $denomination->name)
            ->where('type', $denomination->type)
            ->whereNot('id', $editedDenominationId)
            ->get('id'); // специально в проверке нет поля ratio, чтобы не задвоить какой-либо номинал с разным соотношением;
        
        if ($existedDenomination->count() !== 0) {
            //TODO переписать на выбрасывание исключений
            return ['message' => 'модель с таким названием и типом уже есть', 'status' => 'failure'];
        }

        $existedRatio = Denomination::where('currency_id', $currency->id)
            ->where('name', $denomination->name)
            ->where('type', $denomination->type)
            ->where('ratio', $denomination->ratio)
            ->whereNot('id', $editedDenominationId)
            ->get('id');

        if ($existedRatio->count() !== 0) {
            return ['message' => 'такая модель уже есть', 'status' => 'failure'];
        }  

        return ['status' => 'success'];
    }

}