<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Middleware\AuthorizeMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/department', [DepartmentController::class, 'index'])
    ->name('department.index')
    ->middleware(AuthorizeMiddleware::class . ':department.showDepartments');

Route::get('/department/create', [DepartmentController::class, 'create'])
    ->name('department.create')
    ->middleware(AuthorizeMiddleware::class . ':department.createDepartments');

Route::get('/department/edit{id}', [DepartmentController::class, 'edit'])
    ->name('department.edit')
    ->middleware(AuthorizeMiddleware::class . ':department.updateDepartments');

Route::post('/department/store', [DepartmentController::class, 'store'])
    ->name('department.store')
    ->middleware(AuthorizeMiddleware::class . ':department.createDepartments');

Route::put('/department/update', [DepartmentController::class, 'update'])
    ->name('department.update')
    ->middleware(AuthorizeMiddleware::class . ':department.updateDepartments');

Route::delete('/department/delete{id}', [DepartmentController::class, 'delete'])
    ->name('department.delete')
    ->middleware(AuthorizeMiddleware::class . ':department.deleteDepartments');
