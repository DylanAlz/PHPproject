<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home/index');
});

Route::get('/cartelera', function () {
    return view('cinema/cartelera');
});

include('web/department.php');

include('web/city.php');
