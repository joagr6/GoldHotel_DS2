<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\HospedeController;
use App\Http\Controllers\QuartoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\ServicoAdicionalController;
Route::get('/', function () {
    return view('welcome');
})->name('home');

//serviço adicional 
Route::get('/servico-adicional', [ReservaController::class, 'servicoAdicional'])->name('servico.dashboard');


//  Login e cadastro de hóspede
 
Route::get('/login-hospede', [HospedeController::class, 'showLoginForm'])->name('hospede.login');
Route::post('/login-hospede', [HospedeController::class, 'login'])->name('hospede.login.post');
Route::get('/logout-hospede', [HospedeController::class, 'logout'])->name('hospede.logout');

Route::get('/cadastro-hospede', [HospedeController::class, 'cadastro'])->name('hospede.cadastro');
Route::post('/cadastro-hospede', [HospedeController::class, 'store'])->name('hospede.store');

Route::get('/hospede/dados', [HospedeController::class, 'edit'])->name('hospede.dados');
Route::put('/hospede/{id}', [HospedeController::class, 'update'])->name('hospede.update');

Route::middleware('auth:hospede')->group(function () {
    Route::get('/hospede/dashboard', [HospedeController::class, 'dashboard'])->name('hospede.dashboard');
    Route::get('/quarto/quartos', [QuartoController::class, 'listaHospede'])->name('quarto.dashboard');
    Route::get('/reserva/comprovante/{id}', [ReservaController::class, 'comprovante'])->name('reserva.comprovante');
    
    // Rotas de pagamento
    Route::get('/pagamento/{reservaId}', [PagamentoController::class, 'create'])->name('pagamento.create');
    Route::post('/pagamento/{reservaId}', [PagamentoController::class, 'store'])->name('pagamento.store');
});

//  Rotas de reservas 
Route::get('/reserva', [ReservaController::class, 'index'])->name('reserva.index');
Route::get('/reserva/create', [ReservaController::class, 'create'])->name('reserva.create');
Route::post('/reserva', [ReservaController::class, 'store'])->name('reserva.store');
Route::get('/reserva/edit/{id}', [ReservaController::class, 'edit'])->name('reserva.edit');
Route::put('/reserva/update/{id}', [ReservaController::class, 'update'])->name('reserva.update');
Route::post('/reserva/search', [ReservaController::class, 'search'])->name('reserva.search');
Route::delete('/reserva/{id}', [ReservaController::class, 'destroy'])->name('reserva.destroy');

//  Login admin 
Route::get('/admin/login', [AdministradorController::class, 'showLoginForm'])->name('login.admin');
Route::post('/admin/login', [AdministradorController::class, 'login'])->name('login.admin.post');

//  Rotas protegidas de administrador 
Route::middleware('auth:administrador')->group(function () {
    Route::get('/admin/logout', [AdministradorController::class, 'logout'])->name('logout.admin');
    Route::get('/admin/dashboard', [AdministradorController::class, 'dashboard'])->name('dashboard.admin');

    Route::get('/cadastro-quarto', [QuartoController::class, 'create'])->name('quartos.create');
    Route::post('/cadastro-quarto', [QuartoController::class, 'store'])->name('quartos.store');
    Route::get('/lista-quartos', [QuartoController::class, 'index'])->name('quartos.index');
    
    Route::get('/quartos/{id}/edit', [QuartoController::class, 'edit'])->name('quartos.edit');
    Route::put('/quartos/{id}', [QuartoController::class, 'update'])->name('quartos.update');
    Route::delete('/quartos/{id}', [QuartoController::class, 'destroy'])->name('quartos.destroy');

    Route::get('/admin/hospedes', [HospedeController::class, 'index'])->name('hospede.list');

    // Reservas - administração
    Route::get('/admin/reservas', [ReservaController::class, 'adminIndex'])->name('admin.reservas.index');
});


Route::get('/login/{tipo}', function($tipo) {
    if (!in_array($tipo, ['admin', 'hospede'])) {
        abort(404);
    }
    return view('usuario.login', compact('tipo'));
})->name('login.usuario');