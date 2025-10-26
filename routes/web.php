<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\HospedeController;
use App\Http\Controllers\QuartoController;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Rotas de Login / Logout (públicas)
|--------------------------------------------------------------------------
*/
Route::get('/login-hospede', [HospedeController::class, 'showLoginForm'])
    ->name('hospede.login');

Route::post('/login-hospede', [HospedeController::class, 'login'])
    ->name('hospede.login.post');

Route::get('/logout-hospede', [HospedeController::class, 'logout'])
    ->name('hospede.logout');


    // Cadastro de hóspede
Route::get('/cadastro-hospede', [HospedeController::class, 'cadastro'])->name('hospede.cadastro');
Route::post('/cadastro-hospede', [HospedeController::class, 'store'])->name('hospede.store');

/*
|--------------------------------------------------------------------------
| Área do Hóspede (somente autenticado)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:hospede')->group(function () {

    Route::get('/hospede/dashboard', [HospedeController::class, 'dashboard'])->name('hospede.dashboard');
    Route::post('/hospede/logout', [HospedeController::class, 'logout'])->name('hospede.logout');

    // Dashboard (tela principal após login)
    Route::get('/hospede/dashboard', [HospedeController::class, 'dashboard'])
        ->name('hospede.dashboard');

    // Página "Meus Dados"
    Route::get('/hospede/dados', [HospedeController::class, 'meusDados'])
        ->name('hospede.dados');

    /*
    |--------------------------------------------------------------------------
    | Rotas de Reserva (CRUD)
    |--------------------------------------------------------------------------
    */
    Route::get('/reserva', [ReservaController::class, 'index'])->name('reserva.index');
    Route::get('/reserva/create', [ReservaController::class, 'create'])->name('reserva.create');
    Route::post('/reserva', [ReservaController::class, 'store'])->name('reserva.store');
    Route::get('/reserva/edit/{id}', [ReservaController::class, 'edit'])->name('reserva.edit');
    Route::put('/reserva/update/{id}', [ReservaController::class, 'update'])->name('reserva.update');
    Route::post('/reserva/search', [ReservaController::class, 'search'])->name('reserva.search');
    Route::delete('/reserva/{id}', [ReservaController::class, 'destroy'])->name('reserva.destroy');


    Route::get('/quartos', [QuartoController::class, 'index'])->name('quartos.index');
});