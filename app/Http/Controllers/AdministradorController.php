<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Administrador;
use App\Models\Reserva;
use App\Models\Quarto;
use App\Models\Hospede;

class AdministradorController extends Controller
{
    public function showLoginForm()
    {
        return view('usuario.login', ['tipo' => 'admin']);
    }

    public function login(Request $request)
    {
        $request->validate([
            'cpf' => 'required',
            'senha' => 'required',
        ]);

        if (Auth::guard('administrador')->attempt([
            'cpf' => $request->cpf,
            'password' => $request->senha
        ])) {
            return redirect()->route('dashboard.admin')->with('success', 'Login realizado com sucesso!');
        }

        return back()->withErrors(['cpf' => 'CPF ou senha inválidos.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('administrador')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.admin');
    }

    // DASHBOARD DO ADMINISTRADOR
   public function dashboard()
{
    // Quantidade total de reservas
    $totalReservas = Reserva::count();

    // Quartos disponíveis (ajuste se o nome do campo for diferente)
    $quartosDisponiveis = Quarto::where('status', 'disponivel')->count();

    $totalHospedes = Hospede::count();

    // Carrega a view correta
    return view('administrador.dashboard', compact('totalReservas', 'quartosDisponiveis','totalHospedes'));
}

}
