<?php

use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;

Route::get('/department', [DepartmentController::class, 'index'])
    ->name('department.index');
