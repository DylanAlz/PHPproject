<?php

use App\Http\Controllers\CitiesController;
use Illuminate\Support\Facades\Route;

Route::get('/city', [CitiesController::class, 'index'])
    ->name('city.index')
    ->middleware('auth');

Route::get('/city/create', [CitiesController::class, 'create'])
    ->name('city.create');

Route::get('/city/edit{id}', [CitiesController::class, 'edit'])
    ->name('city.edit');

Route::post('/city/store', [CitiesController::class, 'store'])
    ->name('city.store');

Route::put('/city/update', [CitiesController::class, 'update'])
    ->name('city.update');

Route::delete('/city/delete{id}', [CitiesController::class, 'delete'])
    ->name('city.delete');
