<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioAtendimentoController;
use App\Http\Controllers\DynamicDropdownController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CheckListController;
use App\Http\Controllers\ComodoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\CheckListAtividadeController;
use App\Http\Controllers\ProjetoController;
use App\Http\Middleware\RedirectIfAuthenticated;


Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/register', [LoginController::class, 'register'])->name('register');


Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {

    Route::post('/login',       [AuthController::class, 'login'])->name('authenticate');
    Route::post('/register',    [AuthController::class, 'register']);
    Route::get('/logout',       [LoginController::class, 'logout'])->name('logout');
    Route::post('/refresh',     [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);

    Route::post('/usuario_atendimento', [UsuarioAtendimentoController::class, 'store'])->name('usuario_atendimento.store');
    Route::delete('/usuario_atendimento/destroy/{id_municipio}/{id_usuario}', [UsuarioAtendimentoController::class, 'destroy'])->name('usuario_atendimento.destroy');

    // Route::post('/check_list', [CheckListController::class, 'store'])->name('check_list.store');
    Route::post('/check_list_js', [CheckListController::class, 'store'])->name('api.check_list.store');
    Route::delete('/check_list/destroy/{iCodigoCheckList}', [CheckListController::class, 'destroy'])->name('check_list.destroy');

    // Route::post('/check_list_atividade', [CheckListAtividadeController::class, 'store'])->name('check_list_atividade.store');


    Route::post('/projeto', [ProjetoController::class, 'store'])->name('projeto.store');
    // Route::post('/comodo', [ComodoController::class, 'store'])->name('comodo.store');

    Route::put('/usuario/update/{iCodigoUsuario}', [PerfilController::class, 'update'])->name('usuario/update');

    Route::put('/projeto/update/{iProjeto}', [ProjetoController::class, 'update'])->name('projeto/update');
});


Route::middleware([RedirectIfAuthenticated::class])->group(function () {

    Route::get('/perfil', [PerfilController::class, 'perfil'])->name('perfil');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/usuario_atendimento',                 [UsuarioAtendimentoController::class, 'index'])->name('usuario_atendimento.index');
    Route::get('/usuario_atendimento/create',          [UsuarioAtendimentoController::class, 'create'])->name('usuario_atendimento.create');

    // Route::post('/usuario_atendimento/store/{iCodigo}', [UsuarioAtendimentoController::class, 'store'])->name('usuario_atendimento/store');
    // Route::get('/usuario_atendimento/{state_id}/edit',  [UsuarioAtendimentoController::class, 'edit']) ->name('states.edit');
    // Route::get('/usuario_atendimento/{state_id}/show', [UsuarioAtendimentoController::class, 'show']) ->name('states.show');

    Route::get('/projeto/create', [ProjetoController::class, 'create'])->name('projeto.create');
    
    Route::get('/check_list', [CheckListController::class, 'index'])->name('check_list');
    Route::get('/check_list/create', [CheckListController::class, 'create'])->name('check_list.create');

    Route::get('/check_list_atividade/{iCodigoCheckList}', [CheckListAtividadeController::class, 'index'])->name('check_list_atividade');

    Route::get('/check_list_atividade/create/{iCodigoCheckList}', [CheckListAtividadeController::class, 'create'])->name('check_list_atividade.create');
    Route::get('/projeto/{id_situacao}', [ProjetoController::class, 'index'])->name('projeto.index'); //Ok

    Route::get('/projeto_alteracao/{iCodigoProjeto}',  [ProjetoController::class, 'alterar'])->name('projeto.alterar');

    // Route::get('/comodo/create/{id_projeto}', [ComodoController::class, 'create'])->name('comodo.create');

    Route::get('/comodos/{id_projeto}', [ComodoController::class, 'index'])->name('comodos.index'); //Ok
});




