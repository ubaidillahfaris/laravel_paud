<?php

use App\Http\Controllers\PpdbController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')
->group(function(){
    Route::prefix('ppdb')
    ->name('ppdb.')
    ->controller(PpdbController::class)
    ->group(function(){
        Route::post('store','store')->name('store');
    });
});