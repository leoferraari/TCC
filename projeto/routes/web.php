<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StatesController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\apiProtectedRoute;

Route::get('/login', [LoginController::class, 'login'])        ->name('login');
Route::get('/register', [LoginController::class, 'register'])        ->name('register');

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {

    Route::post('/login',       [AuthController::class, 'login'])->name('authenticate');
    Route::post('/register',    [AuthController::class, 'register']);
    Route::get('/logout',     [LoginController::class, 'logout'])->name('logout');


    Route::post('/refresh',     [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});


Route::middleware([RedirectIfAuthenticated::class])->group(function () {

    Route::get('/motivacao', [DashboardController::class, 'motivacao'])->name('motivacao');


    Route::get('/states',                 [StatesController::class, 'index']) ->name('states.index');
    Route::get('/states/create',          [StatesController::class, 'create'])->name('states.create');
    Route::get('/states/{state_id}/edit', [StatesController::class, 'edit'])  ->name('states.edit');
    Route::get('/states/{state_id}/show', [StatesController::class, 'show'])  ->name('states.show');
});


/*
Rotas da aplicação.
*/

Route::get('/', function () {
    return view('welcome');
});




