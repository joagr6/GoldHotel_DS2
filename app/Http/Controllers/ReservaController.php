<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Hospede;
use App\Models\Quarto;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    /**
     * Exibe a lista de reservas
     */
    public function index()
    {
        // Busca todas as reservas com seus relacionamentos (hóspede e quarto)
        $dados = Reserva::with(['hospede', 'quarto'])->get();

        // Retorna para a view, enviando a variável $dados
        return view('reserva.list', compact('dados'));
    }

    /**
     * Exibe o formulário para criar uma nova reserva
     */
    public function create()
    {
        $hospedes = Hospede::all();
        $quartos = Quarto::all();

        return view('reserva.form', [
            'dado' => new Reserva(),
            'hospedes' => $hospedes,
            'quartos' => $quartos,
        ]);
    }

    /**
     * Armazena uma nova reserva no banco
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        Reserva::create($request->only([
            'data_entrada',
            'data_saida',
            'status',
            'hospede_id',
            'quarto_id'
        ]));

        return redirect()->route('reserva.index')
            ->with('success', 'Reserva registrada com sucesso!');
    }

    /**
     * Exibe uma reserva específica
     */
    public function show($id)
    {
        $reserva = Reserva::with(['hospede', 'quarto'])->findOrFail($id);
        return view('reservas.show', compact('reserva'));
    }

    /**
     * Exibe o formulário para editar uma reserva existente
     */
    public function edit($id)
    {
        $dado = Reserva::findOrFail($id);
        $hospedes = Hospede::all();
        $quartos = Quarto::all();

        return view('reserva.form', compact('dado', 'hospedes', 'quartos'));
    }

    /**
     * Atualiza uma reserva no banco
     */
    public function update(Request $request, $id)
    {
        $this->validateRequest($request);

        $reserva = Reserva::findOrFail($id);
        $reserva->update($request->only([
            'data_entrada',
            'data_saida',
            'status',
            'hospede_id',
            'quarto_id'
        ]));

        return redirect()->route('reserva.index')
            ->with('success', 'Reserva atualizada com sucesso!');
    }

    /**
     * Remove uma reserva
     */
    public function destroy($id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->delete();

        return redirect()->route('reserva.index')
            ->with('success', 'Reserva excluída com sucesso!');
    }

    /**
     * Busca reservas por campo e valor
     */
    public function search(Request $request)
    {
        $tipo = $request->tipo;
        $valor = $request->valor;

        $reservas = Reserva::with(['hospede', 'quarto'])
            ->where($tipo, 'like', "%{$valor}%")
            ->get();

        return view('reserva.list', compact('reservas'));
    }

    /**
     * Validação padrão
     */
    private function validateRequest(Request $request)
    {
        $request->validate([
            'data_entrada' => 'required|date',
            'data_saida'   => 'required|date|after_or_equal:data_entrada',
            'status'       => 'required|string|max:20',
            'hospede_id'   => 'required|exists:hospedes,id',
            'quarto_id'    => 'required|exists:quartos,id',
        ], [
            'data_entrada.required' => 'A data de entrada é obrigatória',
            'data_saida.required' => 'A data de saída é obrigatória',
            'data_saida.after_or_equal' => 'A data de saída deve ser posterior à de entrada',
            'status.required' => 'O status é obrigatório',
            'hospede_id.required' => 'Selecione um hóspede',
            'quarto_id.required' => 'Selecione um quarto',
        ]);
    }
}
