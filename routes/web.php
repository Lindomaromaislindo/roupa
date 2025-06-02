<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ColecaoController;
use App\Http\Controllers\ProdutoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cliente',               [ClienteController::class, 'index'])->name('cliente.index');
Route::get('/cliente/create',        [ClienteController::class, 'create'])->name('cliente.create');
Route::post('/cliente/store',        [ClienteController::class, 'store'])->name('cliente.store');
Route::get('/cliente/edit/{id}',     [ClienteController::class, 'edit'])->name('cliente.edit');
Route::put('/cliente/update/{id}',   [ClienteController::class, 'update'])->name('cliente.update');
Route::delete('/cliente/{id}',       [ClienteController::class, 'destroy'])->name('cliente.destroy');
Route::post('/cliente/search',       [ClienteController::class, 'search'])->name('cliente.search');

Route::get('/colecao',               [ColecaoController::class, 'index'])->name('colecao.index');
Route::get('/colecao/create',        [ColecaoController::class, 'create'])->name('colecao.create');
Route::post('/colecao/store',        [ColecaoController::class, 'store'])->name('colecao.store');
Route::get('/colecao/edit/{id}',     [ColecaoController::class, 'edit'])->name('colecao.edit');
Route::put('/colecao/update/{id}',   [ColecaoController::class, 'update'])->name('colecao.update');
Route::delete('/colecao/{id}',       [ColecaoController::class, 'destroy'])->name('colecao.destroy');
Route::post('/colecao/search',       [ColecaoController::class, 'search'])->name('colecao.search');

Route::get('/produto',               [ProdutoController::class, 'index'])->name('produto.index');
Route::get('/produto/create',        [ProdutoController::class, 'create'])->name('produto.create');
Route::post('/produto/store',        [ProdutoController::class, 'store'])->name('produto.store');
Route::get('/produto/edit/{id}',     [ProdutoController::class, 'edit'])->name('produto.edit');
Route::put('/produto/update/{id}',   [ProdutoController::class, 'update'])->name('produto.update');
Route::delete('/produto/{id}',       [ProdutoController::class, 'destroy'])->name('produto.destroy');
Route::post('/produto/search',       [ProdutoController::class, 'search'])->name('produto.search');
