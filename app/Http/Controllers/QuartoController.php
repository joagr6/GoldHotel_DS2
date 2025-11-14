<?php

namespace App\Http\Controllers;

use App\Models\Quarto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuartoController extends Controller
{
   
    public function index(Request $request)
{
    $query = Quarto::query();

    // Verifica se há filtros aplicados
    if ($request->filled('tipo') && $request->filled('valor')) {
        $tipo = $request->input('tipo');
        $valor = $request->input('valor');

        switch ($tipo) {
            case 'capacidade':
                $query->where('capacidade', 'like', "%{$valor}%");
                break;

            case 'status':
                $query->where('status', 'like', "%{$valor}%");
                break;

            case 'valorDiaria':
                if (is_numeric($valor)) {
                    $query->where('valorDiaria', '=', $valor);
                } else {
                    $query->where('valorDiaria', 'like', "%{$valor}%");
                }
                break;
        }
    }

    $quartos = $query->get();

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
            // Remove a imagem antiga se existir
            if ($quarto->imagem && Storage::disk('public')->exists($quarto->imagem)) {
                Storage::disk('public')->delete($quarto->imagem);
            }
            $validated['imagem'] = $request->file('imagem')->store('quartos', 'public');
        } else {
            // Preserva a imagem antiga se não houver nova imagem
            $validated['imagem'] = $quarto->imagem;
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
