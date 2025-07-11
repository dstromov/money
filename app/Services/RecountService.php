<?php

namespace App\Services;

use App\Models\Currency;


class RecountService 
{
    public static function recount(Currency $currency)
    {
        $compositionsWithDenominations = $currency->denominations->load('compositions');

        $ratio = 1;
        $currencyFullSum = 0;
        foreach ($compositionsWithDenominations as $denomination) {
            $ratio = $denomination->ratio;
            foreach ($denomination->compositions as $composition) {
                $currencyFullSum += $ratio * $composition->value * $composition->count;    
            }
        }

        $currency->full_summ = $currencyFullSum * $currency->rate;
        
        $currency->save();
    }
}