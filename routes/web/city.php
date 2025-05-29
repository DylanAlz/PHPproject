<?php

use App\Http\Controllers\CitiesController;
use App\Http\Middleware\AuthorizeMiddleware;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Facades\Route;

Route::get('/city', [CitiesController::class, 'index'])
    ->name('city.index')
    ->middleware(AuthorizeMiddleware::class . ':city.showCity');

Route::get('/city/create', [CitiesController::class, 'create'])
    ->name('city.create')
    ->middleware(AuthorizeMiddleware::class . ':city.createCity');

Route::get('/city/edit{id}', [CitiesController::class, 'edit'])
    ->name('city.edit')
    ->middleware(AuthorizeMiddleware::class . ':city.updateCity');

Route::post('/city/store', [CitiesController::class, 'store'])
    ->name('city.store')
    ->middleware(AuthorizeMiddleware::class . ':city.createCity');

Route::put('/city/update', [CitiesController::class, 'update'])
    ->name('city.update')
    ->middleware(AuthorizeMiddleware::class . ':city.updateCity');

Route::delete('/city/delete{id}', [CitiesController::class, 'delete'])
    ->name('city.delete')
    ->middleware(AuthorizeMiddleware::class . ':city.deleteCity');
