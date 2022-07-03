<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\apiProtectedRoute;
use App\Http\Controllers\LoginController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['apiJwt']], function () {

        /**
     * STATES
     */    
    Route::get('states/datatable/{type}', [StatesController::class, 'datatable'])->name('api.states.datatable');
    Route::get('states/{state_id?}',      [StatesController::class, 'list'])     ->name('api.states.list');
    Route::post('states',                 [StatesController::class, 'store'])    ->name('api.states.store');
    Route::put('states',                  [StatesController::class, 'update'])   ->name('api.states.update');
    Route::delete('states',               [StatesController::class, 'delete'])   ->name('api.states.delete');
});


Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware([apiProtectedRoute::class])->group(function() {
    Route::post('/user-profile', [AuthController::class, 'userProfile'])->name('userProfile');
    // Route::post('/logout',     [LoginController::class, 'logout'])->name('logout');
});




Route::get('/', function() {
    return response()->json(['api_name' => 'laravel_jwt', 'api_version' => '1.0']);
});


    



  

