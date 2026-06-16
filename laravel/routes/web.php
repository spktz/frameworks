<?php

use App\Http\Controllers\CurrencyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('api/currencies', [CurrencyController::class, 'index']);

Route::post('api/currencies', [CurrencyController::class, 'store']);

Route::get('api/currencies/{id}', [CurrencyController::class, 'show']);

Route::patch('api/currencies/{id}', [CurrencyController::class, 'update']);

Route::delete('api/currencies/{id}', [CurrencyController::class, 'destroy']);
