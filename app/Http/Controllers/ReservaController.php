<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Quarto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    /**
     * Exibe a lista de reservas do hóspede logado
     */
    public function index()
    {
        // Busca apenas as reservas do hóspede autenticado
        $dados = Reserva::with('quarto')
            ->where('hospede_id', Auth::id())
            ->get();

        return view('reserva.list', compact('dados'));
    }

    /**
     * Exibe o formulário para criar uma nova reserva
     */
    public function create()
    {
        // Busca apenas os quartos disponíveis
        $quartos = Quarto::where('disponivel', true)->get();

        return view('reserva.form', [
            'dado' => new Reserva(),
            'quartos' => $quartos,
        ]);
    }

    /**
     * Armazena uma nova reserva no banco
     */
    public function store(Request $request)
    {
        $request->validate([
            'data_entrada' => 'required|date',
            'data_saida'   => 'required|date|after_or_equal:data_entrada',
            'quarto_id'    => 'required|exists:quartos,id',
        ], [
            'data_entrada.required' => 'A data de entrada é obrigatória',
            'data_saida.required' => 'A data de saída é obrigatória',
            'data_saida.after_or_equal' => 'A data de saída deve ser posterior à de entrada',
            'quarto_id.required' => 'Selecione um quarto',
        ]);

        // Cria a reserva com base no hóspede autenticado
        Reserva::create([
            'data_entrada' => $request->data_entrada,
            'data_saida'   => $request->data_saida,
            'status'       => 'Ativa',
            'hospede_id'   => Auth::id(),
            'quarto_id'    => $request->quarto_id,
        ]);

        // Atualiza o status do quarto para indisponível
        $quarto = Quarto::find($request->quarto_id);
        $quarto->update(['disponivel' => false]);

        return redirect()->route('reserva.index')
            ->with('success', 'Reserva registrada com sucesso!');
    }

    /**
     * Exibe os detalhes de uma reserva (apenas do hóspede logado)
     */
    public function show($id)
    {
        $reserva = Reserva::where('hospede_id', Auth::id())
            ->with('quarto')
            ->findOrFail($id);

        return view('reserva.show', compact('reserva'));
    }

    /**
     * Remove uma reserva (apenas do hóspede logado)
     */
    public function destroy($id)
    {
        $reserva = Reserva::where('hospede_id', Auth::id())->findOrFail($id);
        
        // Libera o quarto
        $quarto = Quarto::find($reserva->quarto_id);
        if ($quarto) {
            $quarto->update(['disponivel' => true]);
        }

        $reserva->delete();

        return redirect()->route('reserva.index')
            ->with('success', 'Reserva cancelada com sucesso!');
    }
}
