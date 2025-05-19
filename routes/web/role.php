<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/role', [RoleController::class, 'index'])
    ->name('role.index')
    ->middleware('auth');

Route::get('/role/create', [RoleController::class, 'create'])
    ->name('role.create');

Route::get('/role/edit/{id}', [RoleController::class, 'edit'])
    ->name('role.edit');

Route::post('/role/store', [RoleController::class, 'store'])
    ->name('role.store');

Route::put('/role/update', [RoleController::class, 'update'])
    ->name('role.update');

Route::delete('/role/delete/{id}', [RoleController::class, 'delete'])
    ->name('role.delete');
