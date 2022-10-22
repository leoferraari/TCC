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
use App\Http\Controllers\ComodoController;
use App\Http\Controllers\ArquivoProjetoController;
use App\Http\Controllers\MedidaController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['middleware'=> ['apiJwt']],function(){
    Route::group(['prefix' => 'check_list_js'], function () {
        Route::post('', [CheckListController::class, 'addCheckList']);
        Route::delete('/{id_checklist}/{id_usuario}', [CheckListController::class, 'destroy']);
        Route::get('/{id_checklist}/{id_usuario}', [CheckListController::class, 'getCheckList']);
        Route::put('', [CheckListController::class, 'update']);
    });
// });

Route::group(['prefix' => 'check_list_atividade'], function () {
    Route::post('', [CheckListAtividadeController::class, 'addAtividadeCheckList']);
    Route::get('/{id_checklist}/{id_atividade}', [CheckListAtividadeController::class, 'getAtividadeCheckList']);
    Route::delete('/{id_checklist}/{id_atividade}', [CheckListAtividadeController::class, 'destroy']);
    Route::put('', [CheckListAtividadeController::class, 'update']);

    Route::get('/concluir_atividade/{id_checklist}/{id_projeto}', [CheckListAtividadeController::class, 'getAtividadesConcluidas']);
    Route::post('/concluir_atividades', [CheckListAtividadeController::class, 'insereAtividadesConcluidas']);
});

Route::group(['prefix' => 'check_list_visualizacao'], function () {
    Route::get('/{id_checklist}/{id_usuario}', [CheckListController::class, 'getAtividadesCheckList']);
});

Route::group(['prefix' => 'comodo'], function () {
    Route::post('', [ComodoController::class, 'addComodo']);
    Route::delete('/{id_comodo}/{id_projeto}', [ComodoController::class, 'destroy']);
    Route::get('/{id_comodo}/{id_projeto}', [ComodoController::class, 'getComodo']);
    Route::put('', [ComodoController::class, 'update']);
});

Route::group(['prefix' => 'arquivo_projeto'], function () {
    Route::post('', [ArquivoProjetoController::class, 'addArquivo']);
    Route::delete('/{id_arquivo}/{id_projeto}', [ArquivoProjetoController::class, 'destroy']);
    Route::get('/{id_arquivo}/{id_projeto}', [ArquivoProjetoController::class, 'getArquivo']);
    Route::put('', [ArquivoProjetoController::class, 'update']);
});

Route::group(['prefix' => 'area_medicoes'], function () {
    Route::post('', [MedidaController::class, 'addAreaMedicao']);
    Route::delete('/{id_projeto}/{id_comodo}/{id_medida}', [MedidaController::class, 'destroy']);
    Route::get('/{id_projeto}/{id_comodo}/{id_medida}', [MedidaController::class, 'getDescricaoMedida']);
    Route::put('', [MedidaController::class, 'update_area_medicao']);
});

Route::group(['prefix' => 'medidas'], function () {
    Route::post('', [MedidaController::class, 'addMedida']);
    Route::delete('/{id_projeto}/{id_comodo}/{id_medida}', [MedidaController::class, 'destroy']);
    Route::get('/{id_projeto}/{id_comodo}/{id_medida}', [MedidaController::class, 'getDescricaoMedida']);
    Route::put('', [MedidaController::class, 'update_area_medicao']);
});


Route::group(['prefix' => 'projeto'], function () {
    Route::patch('/cancelar', [ProjetoController::class, 'cancelar']);
    Route::patch('/aceitar', [ProjetoController::class, 'aceitar']);
    Route::patch('/recusar', [ProjetoController::class, 'recusar']);
    Route::patch('/concluir', [ProjetoController::class, 'concluir']);
    Route::delete('', [ProjetoController::class, 'delete']);
    Route::get('/{id_projeto}', [ProjetoController::class, 'getDescricaoProjeto']);
});

Route::group(['prefix' => 'usuario_atendimento_js'], function () {
    Route::delete('/{id_municipio}/{id_usuario}',  [UsuarioAtendimentoController::class, 'delete'])->name('api.usuario_atendimento_js.delete');
});

Route::group(['prefix' => 'usuario_atendimento_remove_todos'], function () {
    Route::delete('/{id_usuario}',  [UsuarioAtendimentoController::class, 'delete_todos'])->name('api.usuario_atendimento_remove_todos.delete_todos');
});

// Route::group(['middleware' => ['apiJwt']], function () {
    Route::get('/cidade_atendimento/{id}/{id_usuario}',   [UsuarioAtendimentoController::class, 'cid_atendimento'])->name('cidade_atendimento.cid_atendimento'); //Ok
    Route::get('/cidades/{id_estado}',   [MunicipioController::class, 'cidades'])->name('cidades.getMunicipiosFromEstado'); //Ok
// });
  














    



  

