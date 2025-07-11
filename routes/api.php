<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompositionController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DenominationController;
use App\Http\Controllers\SummaryController;


Route::get('/summary', SummaryController::class); // данные для дашборда по всей коллекции

// TODO сделать через группу роутов
//Route::controller(CurrencyController::class)->group()
//TODO добавить необязательный GET-параметр для возврара всего ресура при добавлении или изменении позиций
Route::get('/currencies', [CurrencyController::class, 'index'])->name('indexCurrencies');
Route::post('/currencies', [CurrencyController::class, 'store']);
Route::get('/currencies/{currency}', [CurrencyController::class, 'show'])->name('showCurrencyWithDenominations');
Route::patch('/currencies/{currency}/rename', [CurrencyController::class, 'update']);
Route::delete('/currencies/{currency}', [CurrencyController::class, 'destroy']);
Route::patch('/currencies/{currency}/update-rate', [CurrencyController::class, 'updateRate']);
Route::patch('/currencies/{currency}/refresh', [CurrencyController::class, 'refresh']);

Route::post('/denominations/{currency}', [DenominationController::class, 'store']);
// Route::get('/denominations/{currency}', [DenominationController::class, 'show'])->name('showCurrencyWithDenominations');
Route::patch('/denominations/update', [DenominationController::class, 'update']);
Route::delete('/denominations', [DenominationController::class, 'destroy']);

// Route::get('/compositions/{currency}', [CompositionController::class, 'show'])->name('showDenominationsWithCompositions');
Route::post('/compositions', [CompositionController::class, 'store']);
Route::patch('/compositions/update', [CompositionController::class, 'update']);
Route::delete('/compositions', [CompositionController::class, 'destroy']);
Route::patch('/compositions/edit-count', [CompositionController::class, 'updateCount']);



