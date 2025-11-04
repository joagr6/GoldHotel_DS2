<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Quarto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
  
    public function index()
    {
        $dados = Reserva::with('quarto')
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
                ->where('status', 'disponível')
                ->firstOrFail();
        }

        $quartosDisponiveis = Quarto::where('status', 'disponível')->get();

        return view('reserva.create', [
            'quartoSelecionado' => $quartoSelecionado,
            'quartos' => $quartosDisponiveis,
        ]);
    }

  
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

        $reserva = Reserva::create([
            'data_entrada' => $request->data_entrada,
            'data_saida'   => $request->data_saida,
            'status'       => 'Ativa',
            'hospede_id'   => Auth::guard('hospede')->id(),
            'quarto_id'    => $request->quarto_id,
        ]);

        $quarto = Quarto::find($request->quarto_id);
        if ($quarto) {
            $quarto->update(['status' => 'indisponível']);
        }

        return redirect()->route('hospede.dashboard')
            ->with('success', 'Reserva registrada com sucesso!');
    }

    public function show($id)
    {
        $reserva = Reserva::where('hospede_id', Auth::guard('hospede')->id())
            ->with('quarto')
            ->findOrFail($id);

        return view('reserva.show', compact('reserva'));
    }

    // Listagem de reservas para administrador
    public function adminIndex()
    {
        $reservas = Reserva::with(['quarto', 'hospede'])->orderByDesc('created_at')->get();

        return view('administrador.reservas', compact('reservas'));
    }

    public function destroy($id)
    {
        $reserva = Reserva::where('hospede_id', Auth::guard('hospede')->id())
            ->findOrFail($id);

        if (strtolower($reserva->status) !== 'ativa') {
            return redirect()->back()->with('error', 'Apenas reservas ativas podem ser canceladas.');
        }

        $reserva->status = 'Cancelada';
        $reserva->save();

        $quarto = Quarto::find($reserva->quarto_id);
        if ($quarto) {
            $quarto->update(['status' => 'disponível']);
        }

        return redirect()->back()->with('success', 'Reserva cancelada com sucesso!');
    }
}
