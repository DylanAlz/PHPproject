<?php

use App\Http\Controllers\CitiesController;
use Illuminate\Support\Facades\Route;

Route::get('/city', [CitiesController::class, 'index'])
    ->name('city.index');
