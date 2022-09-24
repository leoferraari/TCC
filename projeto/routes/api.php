<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\apiProtectedRoute;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\CheckListController;
use App\Http\Controllers\UsuarioAtendimentoController;

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


Route::group(['prefix' => 'check_listt'], function () {
    Route::post('', [CheckListController::class, 'addCheckList']);
});

Route::get('/cidade_atendimento/{id}/{id_usuario}',   [UsuarioAtendimentoController::class, 'cid_atendimento'])->name('cidade_atendimento.cid_atendimento'); //Ok
Route::get('/cidades/{id_estado}',   [MunicipioController::class, 'cidades'])->name('cidades.getMunicipiosFromEstado'); //Ok


// Route::post('/login', [AuthController::class, 'login'])->name('login');



// Route::middleware([apiProtectedRoute::class])->group(function() {
    // Route::post('/user-profile', [AuthController::class, 'userProfile'])->name('userProfile');
    // Route::post('usuario_atendimento', [UsuarioAtendimentoController::class, 'store'])->name('api.usuario_atendimento.store');
    // Route::post('/usuario_atendimento', [UsuarioAtendimentoController::class, 'store'])    ->name('usuario_atendimento.store');
    // Route::post('/logout',     [LoginController::class, 'logout'])->name('logout');
// });








    



  

