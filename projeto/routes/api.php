<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\apiProtectedRoute;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\CheckListController;
use App\Http\Controllers\CheckListAtividadeController;
use App\Http\Controllers\UsuarioAtendimentoController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\HomeController;
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


Route::group(['prefix' => 'check_list_js'], function () {
    Route::post('', [CheckListController::class, 'addCheckList']);
    Route::delete('/{id_checklist}/{id_usuario}', [CheckListController::class, 'destroy']);
    Route::get('/{id_checklist}/{id_usuario}', [CheckListController::class, 'getCheckList']);
    Route::put('', [CheckListController::class, 'update']);
});

Route::group(['prefix' => 'check_list_atividade'], function () {
    Route::post('', [CheckListAtividadeController::class, 'addAtividadeCheckList']);
    Route::get('/{id_checklist}/{id_atividade}', [CheckListAtividadeController::class, 'getAtividadeCheckList']);
    Route::delete('/{id_checklist}/{id_atividade}', [CheckListAtividadeController::class, 'destroy']);
    Route::put('', [CheckListAtividadeController::class, 'update']);
});

Route::group(['prefix' => 'projeto'], function () {
     Route::patch('/cancelar', [ProjetoController::class, 'cancelar']);
});

Route::group(['prefix' => 'usuario_atendimento_js'], function () {
    Route::delete('/{id_municipio}/{id_usuario}',  [UsuarioAtendimentoController::class, 'delete'])->name('api.usuario_atendimento_js.delete');
});

Route::group(['prefix' => 'usuario_atendimento_remove_todos'], function () {
    Route::delete('/{id_usuario}',  [UsuarioAtendimentoController::class, 'delete_todos'])->name('api.usuario_atendimento_remove_todos.delete_todos');
});



Route::group(['middleware' => ['apiJwt']], function () {
    Route::get('/cidade_atendimento/{id}/{id_usuario}',   [UsuarioAtendimentoController::class, 'cid_atendimento'])->name('cidade_atendimento.cid_atendimento'); //Ok
    Route::get('/cidades/{id_estado}',   [MunicipioController::class, 'cidades'])->name('cidades.getMunicipiosFromEstado'); //Ok
});
  














    



  

