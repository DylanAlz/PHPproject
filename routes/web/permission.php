<?php

use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;

Route::get('/permission', [PermissionController::class, 'index'])
    ->name('permission.index')
    ->middleware('auth');

Route::get('/permission/create', [PermissionController::class, 'create'])
    ->name('permission.create');

Route::get('/permission/edit/{id}', [PermissionController::class, 'edit'])
    ->name('permission.edit');

Route::post('/permission/store', [PermissionController::class, 'store'])
    ->name('permission.store');

Route::put('/permission/update', [PermissionController::class, 'update'])
    ->name('permission.update');

Route::delete('/permission/delete/{id}', [PermissionController::class, 'delete'])
    ->name('permission.delete');
