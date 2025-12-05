<?php

namespace App\Http\Controllers;

use App\Models\ServicoAdicional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicoAdicionalController extends Controller
{
    public function index(Request $request)
    {
        $query = ServicoAdicional::query();

        // FILTRO (opcional igual ao de quarto)
        if ($request->filled('tipo') && $request->filled('valor')) {
            $tipo = $request->input('tipo');
            $valor = $request->input('valor');

            switch ($tipo) {
                case 'nome':
                    $query->where('nome', 'like', "%{$valor}%");
                    break;

                case 'status':
                    $query->where('status', 'like', "%{$valor}%");
                    break;

                case 'valor':
                    if (is_numeric($valor)) {
                        $query->where('valor', '=', $valor);
                    } else {
                        $query->where('valor', 'like', "%{$valor}%");
                    }
                    break;
            }
        }

        $servicos = $query->get();

        return view('servicoAdicional.list', compact('servicos'));
    }

    public function create()
    {
        return view('servicoAdicional.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome'       => 'required|string|max:100',
            'descricao'  => 'required|string',
            'valor'      => 'required|numeric|min:0',
            'status'     => 'required|string|max:20',
            'imagem'     => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagem')) {
            $validated['imagem'] = $request->file('imagem')->store('servicos', 'public');
        }

        ServicoAdicional::create($validated);

        return redirect()->route('servicos.index')->with('success', 'Serviço adicional cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $servico = ServicoAdicional::findOrFail($id);
        return view('servico.form', compact('servico'));
    }

    public function update(Request $request, $id)
    {
        $servico = ServicoAdicional::findOrFail($id);

        $validated = $request->validate([
            'nome'       => 'required|string|max:100',
            'descricao'  => 'required|string',
            'valor'      => 'required|numeric|min:0',
            'status'     => 'required|string|max:20',
            'imagem'     => 'nullable|image|max:2048',
        ]);

        // Atualizar imagem
        if ($request->hasFile('imagem')) {
            if ($servico->imagem && Storage::disk('public')->exists($servico->imagem)) {
                Storage::disk('public')->delete($servico->imagem);
            }

            $validated['imagem'] = $request->file('imagem')->store('servicos', 'public');
        } else {
            $validated['imagem'] = $servico->imagem;
        }

        $servico->update($validated);

        return redirect()->route('servicos.index')->with('success', 'Serviço atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $servico = ServicoAdicional::findOrFail($id);

        if ($servico->imagem && Storage::disk('public')->exists($servico->imagem)) {
            Storage::disk('public')->delete($servico->imagem);
        }

        $servico->delete();

        return redirect()->route('servicos.index')->with('success', 'Serviço excluído com sucesso!');
    }
}
