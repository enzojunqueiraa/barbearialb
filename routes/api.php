<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\ServicoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


    //Rota para a página Serviço
Route::post('/servico', [ServicoController::class, 'barbearialb']);

Route::get('descricao', [ServicoController::class, 'pesquisarPorDescricao']);

Route::get('nome', [ServicoController::class, 'pesquisarPorNome']);

Route::delete('delete/{id}', [ServicoController::class, 'excluir']);

Route::get('all', [ServicoController::class, 'retornarTodos']);

Route::put('update', [ServicoController::class, 'update']);



    // Rota para a página Cliente
Route::post('cliente', [ClienteController::class, 'cliente']);

Route::get('celular', [ClienteController::class, 'pesquisarPorCelular']);

Route::post('cliente/nome', [ClienteController::class, 'pesquisarPorNome']);

Route::get('cpf', [ClienteController::class, 'pesquisarPorCpf']);

Route::get('email', [ClienteController::class, 'pesquisarPorEmail']);

Route::delete('cliente/delete/{id}', [ClienteController::class, 'excluir']);

Route::get('cliente/all', [ClienteController::class, 'retornarTodos']);

Route::put('cliente/update', [ClienteController::class, 'update']);



    // Rotas da página Profissional
Route::post('profissional', [ProfissionalController::class, 'profissional']);

Route::get('profissional/celular', [ProfissionalController::class, 'pesquisarPorCelular']);

Route::get('profissional/nome', [ProfissionalController::class, 'pesquisarPorNome']);

Route::get('profissional/cpf', [ProfissionalController::class, 'pesquisarPorCpf']);

Route::get('profissional/email', [ProfissionalController::class, 'pesquisarPorEmail']);

Route::delete('profissional/delete/{id}', [ProfissionalController::class, 'excluir']);

Route::get('profissional/all', [ProfissionalController::class, 'retornarTodos']);

Route::put('profissional/update', [ProfissionalController::class, 'update']);