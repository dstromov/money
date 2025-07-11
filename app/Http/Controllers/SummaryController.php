<?php

namespace App\Http\Controllers;

use App\Models\Composition;
use App\Models\Currency;
use App\Models\Denomination;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $sumCurrencies = Currency::sum('full_summ'); // Сумма коллекции
        $compositionUniqueCount = Composition::where('count', '>', 0)->count(); // Кол-во уникальных позиций
        $lastEditedComposition = Composition::orderBy('updated_at','desc')->first()->updated_at; // Дата последнего пополнения коллекции

        $comp = Composition::where('count', '>', 0)->get();

        $currenciesIds =[];
        foreach ($comp as $value) {
            $currenciesIds[] = $value->denomination->currency_id;          
        }

        $countriesInCollection = Currency::whereIn('id',$currenciesIds)->get('country');

        return ['data' => [
            'sumCurrencies' => $sumCurrencies, 
            'compositionUniqueCount' => $compositionUniqueCount, 
            'lastEditedComposition' => $lastEditedComposition,
            'countriesInCollection' => $countriesInCollection,
            ]];
        




        
        
    }
}
