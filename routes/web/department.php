<?php

use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;

Route::get('/department', [DepartmentController::class, 'index'])
    ->name('department.index')
    ->middleware('auth');

Route::get('/department/create', [DepartmentController::class, 'create'])
    ->name('department.create');

Route::get('/department/edit{id}', [DepartmentController::class, 'edit'])
    ->name('department.edit');

Route::post('/department/store', [DepartmentController::class, 'store'])
    ->name('department.store');

Route::put('/department/update', [DepartmentController::class, 'update'])
    ->name('department.update');

Route::delete('/department/delete{id}', [DepartmentController::class, 'delete'])
    ->name('department.delete');
