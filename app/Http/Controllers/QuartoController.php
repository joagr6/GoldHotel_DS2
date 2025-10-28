<?php

namespace App\Http\Controllers;

use App\Models\Quarto;
use Illuminate\Http\Request;

class QuartoController extends Controller
{
    /**
     * Exibe lista completa (para o administrador)
     */
    public function index()
    {
        $quartos = Quarto::all();
        return view('quarto.list', compact('quartos'));
    }

    /**
     * Exibe apenas quartos disponíveis (para o hóspede)
     */
    public function listaHospede()
    {
        // Filtra apenas quartos com status "disponível"
        $quartos = Quarto::where('status', 'disponível')->get();

        // Retorna a view específica dos hóspedes
        return view('hospede.quartos', compact('quartos'));
    }

    /**
     * Formulário de criação (somente admin)
     */
    public function create()
    {
        return view('quarto.form');
    }

    /**
     * Armazena um novo quarto (somente admin)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'capacidade' => 'required|string|max:50',
            'valorDiaria' => 'required|numeric|min:0',
            'status' => 'required|string|max:20',
            'tipoQuarto' => 'required|string|max:50',
            'imagem' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagem')) {
            $validated['imagem'] = $request->file('imagem')->store('quartos', 'public');
        }

        Quarto::create($validated);

        return redirect()
            ->route('quartos.index')
            ->with('success', 'Quarto cadastrado com sucesso!');
    }

    public function show(Quarto $quarto)
    {
        //
    }

    public function edit(Quarto $quarto)
    {
        //
    }

    public function update(Request $request, Quarto $quarto)
    {
        //
    }

    public function destroy(Quarto $quarto)
    {
        //
    }
}
