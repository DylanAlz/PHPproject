<?php

use App\Http\Controllers\ShowController;
use Illuminate\Support\Facades\Route;

Route::get('/show', [ShowController::class, 'index'])
    ->name('show.index')
    ->middleware('auth');

Route::get('/show/create', [ShowController::class, 'create'])
    ->name('show.create');

Route::get('/show/edit{id}', [ShowController::class, 'edit'])
    ->name('show.edit');

Route::post('/show/store', [ShowController::class, 'store'])
    ->name('show.store');

Route::put('/show/update', [ShowController::class, 'update'])
    ->name('show.update');

Route::delete('/show/delete{id}', [ShowController::class, 'delete'])
    ->name('show.delete');
