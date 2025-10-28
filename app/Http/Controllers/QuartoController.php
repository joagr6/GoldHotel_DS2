<?php

namespace App\Http\Controllers;

use App\Models\Quarto;
use Illuminate\Http\Request;

class QuartoController extends Controller
{
   
    public function index()
    {
        $quartos = Quarto::all();
        return view('quarto.list', compact('quartos'));
    }

   
    public function listaHospede()
    {
        $quartos = Quarto::all();
        return view('quarto.dashboard', compact('quartos')); // <-- ajustado
    }

    public function create()
    {
        return view('quarto.form');
    }

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

   
    public function edit($id)
    {
        $quarto = Quarto::findOrFail($id);
        return view('quarto.form', compact('quarto'));
    }


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

    public function destroy($id)
    {
        $quarto = Quarto::findOrFail($id);
        $quarto->delete();

        return redirect()->route('quartos.index')->with('success', 'Quarto excluído com sucesso!');
    }
}
