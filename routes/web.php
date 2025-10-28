<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\HospedeController;
use App\Http\Controllers\QuartoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdministradorController;



Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/login-hospede', [HospedeController::class, 'showLoginForm'])
    ->name('hospede.login');

Route::post('/login-hospede', [HospedeController::class, 'login'])
    ->name('hospede.login.post');

Route::get('/logout-hospede', [HospedeController::class, 'logout'])
    ->name('hospede.logout');


Route::get('/cadastro-hospede', [HospedeController::class, 'cadastro'])->name('hospede.cadastro');
Route::post('/cadastro-hospede', [HospedeController::class, 'store'])->name('hospede.store');

Route::get('/hospede/dados', [HospedeController::class, 'edit'])->name('hospede.dados');
Route::put('/hospede/{id}', [HospedeController::class, 'update'])->name('hospede.update');

Route::middleware('auth:hospede')->group(function () {

    Route::post('/hospede/logout', [HospedeController::class, 'logout'])->name('hospede.logout');

    Route::get('/hospede/dashboard', [HospedeController::class, 'dashboard'])->name('hospede.dashboard');

});

Route::get('/reserva', [ReservaController::class, 'index'])->name('reserva.index');
Route::get('/reserva/create', [ReservaController::class, 'create'])->name('reserva.create');
Route::post('/reserva', [ReservaController::class, 'store'])->name('reserva.store');
Route::get('/reserva/edit/{id}', [ReservaController::class, 'edit'])->name('reserva.edit');
Route::put('/reserva/update/{id}', [ReservaController::class, 'update'])->name('reserva.update');
Route::post('/reserva/search', [ReservaController::class, 'search'])->name('reserva.search');
Route::delete('/reserva/{id}', [ReservaController::class, 'destroy'])->name('reserva.destroy');


Route::get('/quartos', [QuartoController::class, 'index'])->name('quartos.index');
Route::post('/quartos', [QuartoController::class, 'store'])->name('quartos.store');
Route::get('/hospede/quartos', [QuartoController::class, 'listaHospede'])->name('hospede.quartos');


Route::get('/admin/login', [AdministradorController::class, 'showLoginForm'])->name('login.admin');
Route::post('/admin/login', [AdministradorController::class, 'login'])->name('login.admin.post');

Route::middleware('auth:administrador')->group(function () {
    Route::get('/cadastro-quarto', [QuartoController::class, 'create'])->name('quartos.create');
    Route::post('/cadastro-quarto', [QuartoController::class, 'store'])->name('quartos.store');

    // ✅ Corrigido: antes chamava store(), agora chama index()

    Route::delete('/quartos/{id}', [QuartoController::class, 'destroy'])->name('quartos.destroy');
    Route::put('/quartos/{id}', [QuartoController::class, 'update'])->name('quartos.update');
    Route::get('/quartos/{id}/edit', [QuartoController::class, 'edit'])->name('quartos.edit');
    Route::get('/Lista-quarto', [QuartoController::class, 'index'])->name('quarto.list');


    Route::post('/admin/logout', [AdministradorController::class, 'logout'])->name('logout.admin');
});