<?php

use App\Http\Controllers\API\V1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get ( '/', function() {
    return response()->json(['api_name' => 'laravel-jwt', 'api_version' => '1.0.0']);
});

Route::prefix('V1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
});

// Route::post('login', [AuthController::class, 'login']);
// Route::post('logout', 'AuthController@logout');
// Route::post('refresh', 'AuthController@refresh');
// Route::post('me', 'AuthController@me');