<?php

use Illuminate\Support\Facades\Route;

/*
Rotas da aplicação.
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/motivacao', function () {
    return view('teste');
});