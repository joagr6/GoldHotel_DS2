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
    // ============================================================
    // ADMIN - LISTAGEM COM FILTROS
    // ============================================================
    public function adminIndex(Request $request)
    {
        // Inicia a query com relacionamentos
        $query = Reserva::with(['hospede', 'quarto']);

        // Filtro por nome do hóspede
        if ($request->filled('hospede')) {
            $query->whereHas('hospede', function ($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->hospede . '%');
            });
        }

        // Filtro por tipo de quarto
        if ($request->filled('quarto')) {
            $query->whereHas('quarto', function ($q) use ($request) {
                $q->where('tipoQuarto', 'like', '%' . $request->quarto . '%');
            });
        }

        // Filtro por status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filtro por data de entrada
        if ($request->filled('data_entrada')) {
            $query->whereDate('data_entrada', $request->data_entrada);
        }

        // Executa busca
        $reservas = $query->orderBy('id', 'desc')->get();

        // Retorna para a view correta
        return view('administrador.reservas', compact('reservas'));
    }

    // ============================================================
    // CREATE
    // ============================================================
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

        $servicos = ServicoAdicional::where('status', 'Ativo')->get();

        return view('reserva.form', [
            'quartoSelecionado' => $quartoSelecionado,
            'quartosDisponiveis' => $quartosDisponiveis,
            'servicos' => $servicos,
        ]);
    }

    // ============================================================
    // STORE
    // ============================================================
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

        $reserva = Reserva::create([
            'data_entrada' => $request->data_entrada,
            'data_saida'   => $request->data_saida,
            'status'       => 'Ativa',
            'hospede_id'   => Auth::guard('hospede')->id(),
            'quarto_id'    => $request->quarto_id,
        ]);

        $reserva->servicos()->attach($request->servicos ?? []);

        return redirect()->route('hospede.dashboard')
            ->with('success', 'Reserva registrada com sucesso!');
    }

    // ============================================================
    // EDIT
    // ============================================================
    public function edit($id)
    {
        $reserva = Reserva::where('hospede_id', Auth::guard('hospede')->id())
            ->with(['quarto', 'servicos'])
            ->findOrFail($id);

        if (strtolower($reserva->status) !== 'ativa') {
            return redirect()->route('hospede.dashboard')
                ->with('error', 'Apenas reservas ativas podem ser editadas.');
        }

        $quartosDisponiveis = Quarto::whereRaw('LOWER(status) = ?', ['disponível'])
            ->orWhere('id', $reserva->quarto_id)
            ->get();

        $servicos = ServicoAdicional::where('status', 'Ativo')->get();

        return view('reserva.form', compact('reserva', 'quartosDisponiveis', 'servicos'));
    }

    // ============================================================
    // UPDATE
    // ============================================================
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

        $reserva->servicos()->sync($request->servicos ?? []);

        return redirect()->route('hospede.dashboard')
            ->with('success', 'Reserva atualizada com sucesso!');
    }

public function destroy($id)
{
    // Só permite cancelar reserva do próprio hóspede
    $reserva = Reserva::where('hospede_id', Auth::guard('hospede')->id())
        ->findOrFail($id);

    if (strtolower($reserva->status) !== 'ativa') {
        return back()->with('error', 'Apenas reservas ativas podem ser canceladas.');
    }

    // Atualizar status da reserva
    $reserva->update([
        'status' => 'Cancelada',
    ]);

    // Opcional: liberar o quarto automaticamente
    $reserva->quarto->update([
        'status' => 'Disponível',
    ]);

    return redirect()->route('hospede.dashboard')
        ->with('success', 'Reserva cancelada com sucesso!');
}}
