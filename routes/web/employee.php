<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/employee', [EmployeeController::class, 'index'])
    ->name('employee.index')
    ->middleware('auth');

Route::get('/employee/create', [EmployeeController::class, 'create'])
    ->name('employee.create');

Route::get('/employee/edit/{id}', [EmployeeController::class, 'edit'])
    ->name('employee.edit');

Route::post('/employee/store', [EmployeeController::class, 'store'])
    ->name('employee.store');

Route::put('/employee/update', [EmployeeController::class, 'update'])
    ->name('employee.update');

Route::delete('/employee/delete/{id}', [EmployeeController::class, 'delete'])
    ->name('employee.delete');
