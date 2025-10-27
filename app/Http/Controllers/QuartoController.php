<?php

namespace App\Http\Controllers;

use App\Models\Quarto;
use Illuminate\Http\Request;

class QuartoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Busca todos os quartos no banco
        $quartos = Quarto::all();

        // Retorna a view de quartos
        return view('quarto.dashboard', compact('quartos'));
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
{
    return view('quarto.form');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'nome' => 'required|string|max:100',
        'descricao' => 'required|string',
        'preco' => 'required|numeric',
        'imagem' => 'nullable|image|max:2048',
    ]);

    // salva no banco
    \App\Models\Quarto::create($validated);

    return redirect()->route('dashboard.admin')->with('success', 'Quarto cadastrado com sucesso!');
}

    /**
     * Display the specified resource.
     */
    public function show(Quarto $quarto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quarto $quarto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quarto $quarto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quarto $quarto)
    {
        //
    }
}
