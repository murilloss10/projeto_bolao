<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApostasController;
use App\Http\Controllers\ClubesController;
use App\Http\Controllers\PartidasController;
use App\Http\Controllers\UsuariosController;


Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

//revisar o metodo de atualizar
Route::get('perfil', [UsuariosController::class, 'index'])->middleware(['auth'])->name('perfil.index');
Route::post('perfil/criar', [UsuariosController::class, 'store'])->middleware(['auth'])->name('perfil.criar');
Route::post('perfil/editar/{id}', [UsuariosController::class, 'atualizar'])->middleware(['auth'])->name('perfil.editar');
//Clubes
Route::get('clubes', [ClubesController::class, 'index'])->middleware(['auth'])->name('clubes.index');
Route::post('clubes/criar', [ClubesController::class, 'store'])->middleware(['auth'])->name('clubes.criar');
Route::get('clubes/{id}', [ClubesController::class, 'index'])->middleware(['auth'])->name('clubes.formEditar');
Route::post('clubes/editar', [ClubesController::class, 'update'])->middleware(['auth'])->name('clubes.editar');
Route::get('clubes/excluir/{id}', [ClubesController::class, 'destroy'])->middleware(['auth'])->name('clubes.excluir');
Route::get('clubes/restaurar/{id}', [ClubesController::class, 'restaurar'])->middleware(['auth'])->name('clubes.restaurar');
//Partidas
Route::get('partidas', [PartidasController::class, 'index'])->middleware(['auth'])->name('partidas.index');
Route::post('partidas/criar', [PartidasController::class, 'store'])->middleware(['auth'])->name('partidas.criar');
Route::get('partidas/{id}', [PartidasController::class, 'formEditar'])->middleware(['auth'])->name('partidas.formEditar');
Route::post('partida/editar', [PartidasController::class, 'update'])->middleware(['auth'])->name('partidas.editar');
Route::get('partidas/{id}/placar', [PartidasController::class, 'formPlacar'])->middleware(['auth'])->name('partidas.formPlacar');
Route::post('partidas/alterar-placar', [PartidasController::class, 'alterarPlacar'])->middleware(['auth'])->name('partidas.alterarPlacar');
//Apostas
Route::get('apostas', [ApostasController::class, 'index'])->middleware(['auth'])->name('apostas.index');
Route::get('apostas/adicionar', [ApostasController::class, 'adicionarAposta'])->middleware(['auth'])->name('apostas.adicionar');//usado para o admin adicionar aposta para usuário cadastrado
Route::post('apostas/criar', [ApostasController::class, 'store'])->middleware(['auth'])->name('apostas.criar');
Route::get('apostas/{id}/validar', [ApostasController::class, 'validarAposta'])->middleware(['auth'])->name('apostas');
Route::get('aposta/vizualizar/{id}', [ApostasController::class, 'visualizarAposta'])->middleware(['auth'])->name('apostas.vizualizar');
Route::get('aposta/img/qrcode/link/{id}', [ApostasController::class, 'qrCodeLink'])->middleware(['auth'])->name('apostas.qrCodeLink');
Route::get('aposta/img/qrcode/pix', [ApostasController::class, 'qrCodePix'])->middleware(['auth'])->name('apostas.qrCodePix');
Route::post('aposta/validar/{id}', [ApostasController::class, 'validarAposta'])->middleware(['auth'])->name('validarAposta');