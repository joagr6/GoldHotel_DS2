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
            ->where('hospede_id', Auth::id())
            ->get();

        return view('reserva.list', compact('dados'));
    }

 
    public function create()
    {
        $quartos = Quarto::where('disponivel', true)->get();

        return view('reserva.form', [
            'dado' => new Reserva(),
            'quartos' => $quartos,
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

        Reserva::create([
            'data_entrada' => $request->data_entrada,
            'data_saida'   => $request->data_saida,
            'status'       => 'Ativa',
            'hospede_id'   => Auth::id(),
            'quarto_id'    => $request->quarto_id,
        ]);

        $quarto = Quarto::find($request->quarto_id);
        $quarto->update(['disponivel' => false]);

        return redirect()->route('reserva.index')
            ->with('success', 'Reserva registrada com sucesso!');
    }

    public function show($id)
    {
        $reserva = Reserva::where('hospede_id', Auth::id())
            ->with('quarto')
            ->findOrFail($id);

        return view('reserva.show', compact('reserva'));
    }

    public function destroy($id)
    {
        $reserva = Reserva::where('hospede_id', Auth::id())->findOrFail($id);
        
        $quarto = Quarto::find($reserva->quarto_id);
        if ($quarto) {
            $quarto->update(['disponivel' => true]);
        }

        $reserva->delete();

        return redirect()->route('reserva.index')
            ->with('success', 'Reserva cancelada com sucesso!');
    }
}
