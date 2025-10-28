<?php

namespace App\Http\Controllers;

use App\Models\Quarto;
use Illuminate\Http\Request;

class QuartoController extends Controller
{
    /**
     * Lista de quartos (para administrador)
     */
    public function index()
    {
        $quartos = Quarto::all();
        return view('quarto.list', compact('quartos'));
    }

    /**
     * Lista de quartos (para hóspede visualizar)
     */
    public function listaHospede()
    {
        $quartos = Quarto::all();
        return view('quarto.dashboard', compact('quartos')); // <-- ajustado
    }

    /**
     * Formulário de criação de quarto (admin)
     */
    public function create()
    {
        return view('quarto.form');
    }

    /**
     * Armazena novo quarto
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

        return redirect()->route('quartos.index')->with('success', 'Quarto cadastrado com sucesso!');
    }

    /**
     * Editar quarto existente
     */
    public function edit($id)
    {
        $quarto = Quarto::findOrFail($id);
        return view('quarto.form', compact('quarto'));
    }

    /**
     * Atualizar quarto existente
     */
    public function update(Request $request, $id)
    {
        $quarto = Quarto::findOrFail($id);

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

        $quarto->update($validated);

        return redirect()->route('quartos.index')->with('success', 'Quarto atualizado com sucesso!');
    }

    /**
     * Excluir quarto
     */
    public function destroy($id)
    {
        $quarto = Quarto::findOrFail($id);
        $quarto->delete();

        return redirect()->route('quartos.index')->with('success', 'Quarto excluído com sucesso!');
    }
}
