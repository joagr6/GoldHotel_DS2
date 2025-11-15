<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Pagamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PagamentoController extends Controller
{
    /**
     * Exibe o formulário de pagamento para uma reserva
     */
    public function create($reservaId)
    {
        $reserva = Reserva::where('hospede_id', Auth::guard('hospede')->id())
            ->with(['quarto', 'pagamento'])
            ->findOrFail($reservaId);

        // Verifica se já existe um pagamento para esta reserva
        if ($reserva->pagamento) {
            return redirect()->route('hospede.dashboard')
                ->with('info', 'Esta reserva já possui um pagamento registrado.');
        }

        // Calcula o número de diárias
        $dataEntrada = Carbon::parse($reserva->data_entrada);
        $dataSaida = Carbon::parse($reserva->data_saida);
        $dias = $dataEntrada->diffInDays($dataSaida);
        $dias = $dias > 0 ? $dias : 1; // Mínimo 1 dia

        // Calcula o valor total
        $valorTotal = $reserva->quarto->valorDiaria * $dias;

        return view('pagamento.create', compact('reserva', 'dias', 'valorTotal'));
    }

    /**
     * Processa o pagamento de uma reserva
     */
    public function store(Request $request, $reservaId)
    {
        $reserva = Reserva::where('hospede_id', Auth::guard('hospede')->id())
            ->with('pagamento')
            ->findOrFail($reservaId);

        // Verifica se já existe um pagamento para esta reserva
        if ($reserva->pagamento) {
            return redirect()->route('hospede.dashboard')
                ->with('error', 'Esta reserva já possui um pagamento registrado.');
        }

        $request->validate([
            'metodo_pagamento' => 'required|in:cartao_credito,cartao_debito,pix,dinheiro',
            'valor' => 'required|numeric|min:0.01',
        ], [
            'metodo_pagamento.required' => 'Selecione o método de pagamento',
            'metodo_pagamento.in' => 'Método de pagamento inválido',
            'valor.required' => 'O valor é obrigatório',
            'valor.numeric' => 'O valor deve ser um número',
            'valor.min' => 'O valor deve ser maior que zero',
        ]);

        // Calcula o valor esperado
        $dataEntrada = Carbon::parse($reserva->data_entrada);
        $dataSaida = Carbon::parse($reserva->data_saida);
        $dias = $dataEntrada->diffInDays($dataSaida);
        $dias = $dias > 0 ? $dias : 1;
        $valorEsperado = $reserva->quarto->valorDiaria * $dias;

        // Valida se o valor informado corresponde ao valor esperado
        if (abs($request->valor - $valorEsperado) > 0.01) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['valor' => 'O valor informado não corresponde ao valor total da reserva.']);
        }

        // Cria o pagamento
        $pagamento = Pagamento::create([
            'reserva_id' => $reserva->id,
            'valor' => $request->valor,
            'metodo_pagamento' => $request->metodo_pagamento,
            'status' => 'pago',
            'data_pagamento' => now(),
        ]);

        return redirect()->route('hospede.dashboard')
            ->with('success', 'Pagamento realizado com sucesso!');
    }
}
