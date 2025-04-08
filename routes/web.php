<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home/index');
});

include('web/department.php');

include('web/city.php');
