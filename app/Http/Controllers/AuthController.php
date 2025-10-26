<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credenciais = $request->only('email', 'password');

        if (Auth::attempt($credenciais)) {
            return redirect()->route('reservas.index');
        }

        return back()->withErrors(['email' => 'Credenciais inválidas.']);
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login.form');
    }
}
