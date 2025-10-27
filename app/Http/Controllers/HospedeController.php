<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Hospede;

class HospedeController extends Controller
{
    /**
     * Mostra o formulário de login
     */
    public function showLoginForm()
    {
        return view('hospede.login');
    }

    /**
     * Faz login do hóspede
     */
    public function login(Request $request)
    {
        $request->validate([
            'cpf' => 'required|string',
            'senha' => 'required|string',
        ]);

        $hospede = Hospede::where('cpf', $request->cpf)->first();

        if ($hospede && Hash::check($request->senha, $hospede->senha)) {
            Auth::guard('hospede')->login($hospede);
            $request->session()->regenerate();
            return redirect()->route('hospede.dashboard');
        }

        return back()->withErrors(['cpf' => 'CPF ou senha incorretos.']);
    }

    /**
     * Faz logout do hóspede
     */
 
    /**
     * Mostra o painel do hóspede logado
     */
 public function dashboard()
{
    return view('hospede.dashboard');
}

public function logout(Request $request)
{
    Auth::guard('hospede')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('hospede.login');
}

    /**
     * Mostra o formulário de cadastro
     */
    public function cadastro()
    {
        return view('hospede.form');
    }

    /**
     * Salva o novo hóspede
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'cpf' => 'required|string|max:16|unique:hospedes,cpf',
            'data_nascimento' => 'required|date',
            'telefone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:50',
            'cidade' => 'nullable|string|max:50',
            'numcasa' => 'nullable|string|max:50',
            'rua' => 'nullable|string|max:50',
            'senha' => 'required|string',
        ]);

        Hospede::create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'data_nascimento' => $request->data_nascimento,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'cidade' => $request->cidade,
            'numcasa' => $request->numcasa,
            'rua' => $request->rua,
            'senha' => Hash::make($request->senha),
        ]);

        return redirect()->route('hospede.login')->with('success', 'Cadastro realizado com sucesso!');
    }

    /**
     * Mostra os dados do hóspede logado
     */
    public function meusDados()
{
    // Pega o hóspede logado
    $hospede = Auth::guard('hospede')->user();

    // Garante que existe um hóspede logado
    if (!$hospede) {
        return redirect()->route('hospede.login')->withErrors('Faça login para acessar seus dados.');
    }

    // Envia para a view
    return view('hospede.dados', compact('hospede'));
}



public function edit()
{
    $hospede = Auth::guard('hospede')->user();

    if (!$hospede) {
        return redirect()->route('hospede.login')->withErrors('Faça login para acessar esta página.');
    }

    return view('hospede.dados', compact('hospede'));
}

public function update(Request $request, $id)
{
    $hospede = Hospede::findOrFail($id);

    $validated = $request->validate([
        'nome' => 'required|string|max:255',
        'data_nascimento' => 'required|date',
        'email' => 'required|email|unique:hospedes,email,' . $id,
        'senha' => 'nullable|string|min:6|confirmed',
    ]);

    $hospede->nome = $validated['nome'];
    $hospede->data_nascimento = $validated['data_nascimento'];
    $hospede->email = $validated['email'];

    // só atualiza a senha se o campo for preenchido
    if (!empty($validated['senha'])) {
        $hospede->senha = bcrypt($validated['senha']);
    }

    $hospede->save();

    return redirect()->route('hospede.dashboard')->with('success', 'Dados atualizados com sucesso!');
}

}
