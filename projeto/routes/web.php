<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioAtendimentoController;
use App\Http\Controllers\DynamicDropdownController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CheckListController;
use App\Http\Controllers\ComodoController;
use App\Http\Controllers\CheckListAtividadeController;
use App\Http\Controllers\ProjetoController;
use App\Http\Middleware\RedirectIfAuthenticated;


Route::get('/login', [LoginController::class, 'login'])        ->name('login');
Route::get('/register', [LoginController::class, 'register'])        ->name('register');

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {

    Route::post('/login',       [AuthController::class, 'login'])->name('authenticate');
    Route::post('/register',    [AuthController::class, 'register']);
    Route::get('/logout',       [LoginController::class, 'logout'])->name('logout');
    Route::post('/refresh',     [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);

    Route::post('/usuario_atendimento', [UsuarioAtendimentoController::class, 'store'])->name('usuario_atendimento.store');
    Route::delete('/usuario_atendimento/destroy/{id_municipio}', [UsuarioAtendimentoController::class, 'destroy'])->name('usuario_atendimento.destroy');

    Route::post('/check_list', [CheckListController::class, 'store'])->name('check_list.store');
    Route::post('/check_list_atividade', [CheckListAtividadeController::class, 'store'])->name('check_list_atividade.store');

    Route::post('/projeto', [ProjetoController::class, 'store'])->name('projeto.store');
    Route::post('/comodo', [ComodoController::class, 'store'])->name('comodo.store');
});


Route::middleware([RedirectIfAuthenticated::class])->group(function () {

    Route::get('/motivacao', [DashboardController::class, 'motivacao'])->name('motivacao');

    Route::get('/usuario_atendimento',                 [UsuarioAtendimentoController::class, 'index'])->name('usuario_atendimento.index');
    Route::get('/usuario_atendimento/create',          [UsuarioAtendimentoController::class, 'create'])->name('usuario_atendimento.create');

    // Route::post('/usuario_atendimento/store/{iCodigo}', [UsuarioAtendimentoController::class, 'store'])->name('usuario_atendimento/store');
    // Route::get('/usuario_atendimento/{state_id}/edit',  [UsuarioAtendimentoController::class, 'edit']) ->name('states.edit');
    // Route::get('/usuario_atendimento/{state_id}/show', [UsuarioAtendimentoController::class, 'show']) ->name('states.show');

    Route::get('/projeto/create', [ProjetoController::class, 'create'])->name('projeto.create');
    
    Route::get('/check_list/create', [CheckListController::class, 'create'])->name('check_list.create');

    Route::get('/check_list_atividade/create', [CheckListAtividadeController::class, 'create'])->name('check_list_atividade.create');

    Route::get('/comodo/create/{id_projeto}', [ComodoController::class, 'create'])->name('comodo.create');
});


/*
Rotas da aplicação.
*/

Route::get('/', function () {
    return view('welcome');
});




