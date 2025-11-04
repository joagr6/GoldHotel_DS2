<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Hospede;

class HospedeController extends Controller
{
   
   public function showLoginForm()
{
    return view('usuario.login', ['tipo' => 'hospede']);
}

public function index(Request $request)
{
    $tipo = $request->input('tipo');
    $valor = $request->input('valor');

    $query = Hospede::query();

    if ($tipo && $valor) {
        $query->where($tipo, 'like', '%' . $valor . '%');
    }

    $hospedes = $query->get();

    return view('hospede.list', compact('hospedes'));
}



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

 public function dashboard()
{
    $hospede = Auth::guard('hospede')->user();

    $ativas = \App\Models\Reserva::with('quarto')
        ->where('hospede_id', optional($hospede)->id)
        ->whereIn('status', ['Ativa', 'ativa'])
        ->orderByDesc('data_entrada')
        ->get();

    $passadas = \App\Models\Reserva::with('quarto')
        ->where('hospede_id', optional($hospede)->id)
        ->whereIn('status', ['Finalizada', 'finalizada', 'Cancelada', 'cancelada'])
        ->orderByDesc('data_entrada')
        ->get();

    return view('hospede.dashboard', compact('ativas', 'passadas'));
}

public function logout(Request $request)
{
    Auth::guard('hospede')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('hospede.login');
}

    public function cadastro()
    {
        return view('hospede.form');
    }

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

        return redirect()->route('login.usuario', ['tipo' => 'hospede'])
        ->with('success', 'Cadastro realizado com sucesso!');
    }

    public function meusDados()
{
    $hospede = Auth::guard('hospede')->user();

    if (!$hospede) {
        return redirect()->route('hospede.login')->withErrors('Faça login para acessar seus dados.');
    }

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

    if (!empty($validated['senha'])) {
        $hospede->senha = bcrypt($validated['senha']);
    }

    $hospede->save();

    return redirect()->route('hospede.dashboard')->with('success', 'Dados atualizados com sucesso!');
}

}
