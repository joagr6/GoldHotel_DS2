<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\HospedeController;
use App\Http\Controllers\QuartoController;

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

/**
 * Rotas Reserva
 */
Route::get('/reserva', [ReservaController::class, 'index'])->name('reserva.index');
Route::get('/reserva/create', [ReservaController::class, 'create'])->name('reserva.create');
Route::post('/reserva', [ReservaController::class, 'store'])->name('reserva.store');
Route::get('/reserva/edit/{id}', [ReservaController::class, 'edit'])->name('reserva.edit');
Route::put('/reserva/update/{id}', [ReservaController::class, 'update'])->name('reserva.update');
Route::post('/reserva/search', [ReservaController::class, 'search'])->name('reserva.search');
Route::delete('/reserva/{id}', [ReservaController::class, 'destroy'])->name('reserva.destroy');


/**
 * Rotas Quarto
 */
Route::get('/quarto', [QuartoController::class, 'index'])->name('quarto.index');
Route::get('/quarto/create', [QuartoController::class, 'create'])->name('quarto.create');
Route::post('/quarto', [QuartoController::class, 'store'])->name('quarto.store');
Route::get('/quarto/edit/{id}', [QuartoController::class, 'edit'])->name('quarto.edit');
Route::put('/quarto/update/{id}', [QuartoController::class, 'update'])->name('quarto.update');
Route::post('/quarto/search', [QuartoController::class, 'search'])->name('quarto.search');
Route::delete('/quarto/{id}', [QuartoController::class, 'destroy'])->name('quarto.destroy');


/**
 * Rotas Hospede
 */
Route::get('/hospede', [HospedeController::class, 'index'])->name('hospede.index');
Route::get('/hospede/create', [HospedeController::class, 'create'])->name('hospede.create');
Route::post('/hospede', [HospedeController::class, 'store'])->name('hospede.store');
Route::get('/hospede/edit/{id}', [HospedeController::class, 'edit'])->name('hospede.edit');
Route::put('/hospede/update/{id}', [HospedeController::class, 'update'])->name('hospede.update');
Route::post('/hospede/search', [HospedeController::class, 'search'])->name('hospede.search');
Route::delete('/hospede/{id}', [HospedeController::class, 'destroy'])->name('hospede.destroy');