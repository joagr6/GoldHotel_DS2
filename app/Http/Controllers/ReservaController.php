<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\ServicoAdicional;
use App\Models\Quarto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ReservaController extends Controller
{
    public function index()
    {
        $dados = Reserva::with(['quarto', 'servicos'])
            ->where('hospede_id', Auth::guard('hospede')->id())
            ->orderByDesc('data_entrada')
            ->get();

        return view('reserva.list', compact('dados'));
    }

    public function create(Request $request)
    {
        $quartoId = $request->input('quarto_id');
        $quartoSelecionado = null;

        if ($quartoId) {
            $quartoSelecionado = Quarto::where('id', $quartoId)
                ->whereRaw('LOWER(status) = ?', ['disponível'])
                ->firstOrFail();
        }

        $quartosDisponiveis = Quarto::whereRaw('LOWER(status) = ?', ['disponível'])->get();

        // Serviços ativos
        $servicos = ServicoAdicional::where('status', 'Ativo')->get();

        return view('reserva.form', [
            'quartoSelecionado' => $quartoSelecionado,
            'quartosDisponiveis' => $quartosDisponiveis,
            'servicos' => $servicos,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'data_entrada' => 'required|date',
            'data_saida'   => 'required|date|after_or_equal:data_entrada',
            'quarto_id'    => 'required|exists:quartos,id',
        ]);

        $quarto = Quarto::findOrFail($request->quarto_id);

        if (strtolower($quarto->status) !== 'disponível') {
            return back()->withErrors(['quarto_id' => 'Este quarto não está disponível.'])
                         ->withInput();
        }

        // Criar reserva
        $reserva = Reserva::create([
            'data_entrada' => $request->data_entrada,
            'data_saida'   => $request->data_saida,
            'status'       => 'Ativa',
            'hospede_id'   => Auth::guard('hospede')->id(),
            'quarto_id'    => $request->quarto_id,
        ]);

        // 🔥 SALVAR SERVIÇOS ADICIONAIS (N:N)
        $reserva->servicos()->attach($request->servicos ?? []);

        return redirect()->route('hospede.dashboard')
            ->with('success', 'Reserva registrada com sucesso!');
    }

    public function edit($id)
    {
        $reserva = Reserva::where('hospede_id', Auth::guard('hospede')->id())
            ->with(['quarto', 'servicos'])
            ->findOrFail($id);

        if (strtolower($reserva->status) !== 'ativa') {
            return redirect()->route('hospede.dashboard')
                ->with('error', 'Apenas reservas ativas podem ser editadas.');
        }

        // Quarto ainda deve estar disponível OU pode manter o mesmo quarto
        $quartosDisponiveis = Quarto::whereRaw('LOWER(status) = ?', ['disponível'])
            ->orWhere('id', $reserva->quarto_id)
            ->get();

        $servicos = ServicoAdicional::where('status', 'Ativo')->get();

        return view('reserva.form', compact('reserva', 'quartosDisponiveis', 'servicos'));
    }

    public function update(Request $request, $id)
    {
        $reserva = Reserva::where('hospede_id', Auth::guard('hospede')->id())
            ->findOrFail($id);

        $request->validate([
            'data_entrada' => 'required|date',
            'data_saida'   => 'required|date|after_or_equal:data_entrada',
            'quarto_id'    => 'required|exists:quartos,id',
        ]);

        $reserva->update([
            'data_entrada' => $request->data_entrada,
            'data_saida'   => $request->data_saida,
            'quarto_id'    => $request->quarto_id,
        ]);

        // 🔥 ATUALIZAR SERVIÇOS (N:N)
        $reserva->servicos()->sync($request->servicos ?? []);

        return redirect()->route('hospede.dashboard')
            ->with('success', 'Reserva atualizada com sucesso!');
    }
}
