<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Administrador;


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
   
public function dashboard()
{
    return view('administrador.dashboard'); 
}
}
