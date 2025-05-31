<?php

use App\Http\Controllers\GenreController;
use Illuminate\Support\Facades\Route;

Route::get('/genre', [GenreController::class, 'index'])
    ->name('genre.index')
    ->middleware('auth');

Route::get('/genre/create', [GenreController::class, 'create'])
    ->name('genre.create');

Route::get('/genre/edit/{id}', [GenreController::class, 'edit'])
    ->name('genre.edit');

Route::post('/genre/store', [GenreController::class, 'store'])
    ->name('genre.store');

Route::put('/genre/update', [GenreController::class, 'update'])
    ->name('genre.update');

Route::delete('/genre/delete/{id}', [GenreController::class, 'delete'])
    ->name('genre.delete');
