<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\HistoricoController;
use App\Http\Controllers\ResultadoController;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/', [HistoricoController::class, 'index'])->middleware(['auth'])->name('index');
Route::get('/buscar', [HistoricoController::class, 'search'])->middleware(['auth'])->name('search');
Route::post('/salvar/{id}',[HistoricoController::class, 'store'])->middleware(['auth'])->name('store');
Route::post('/delete/{id}',[HistoricoController::class, 'delete'])->middleware(['auth'])->name('delete');
Route::get('/historico',[HistoricoController::class, 'show'])->middleware(['auth'])->name('showhistorico');
Route::get('/deleteall',[HistoricoController::class,'deleteall'])->middleware(['auth'])->name('deleteallhistorico');

///resultado

Route::get('/resultados',[ResultadoController::class,'index'])->middleware(['auth'])->name('indexresultado');
Route::get('/details/{id}',[ResultadoController::class,'details'])->middleware(['auth'])->name('details');
Route::put('/atualiza/{id}',[ResultadoController::class,'update'])->middleware(['auth'])->name('update');
Route::post('/deleteresultado/{id}',[ResultadoController::class, 'deleteresultado'])->middleware(['auth'])->name('deleteresultado');