<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Quarto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

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
                ->whereRaw('LOWER(status) = ?', ['disponível'])
                ->firstOrFail();
        }

        // Busca quartos disponíveis (status disponível, sem verificar reservas ainda)
        $quartosDisponiveis = Quarto::whereRaw('LOWER(status) = ?', ['disponível'])->get();

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

        $quarto = Quarto::findOrFail($request->quarto_id);

        // Verifica se o quarto está disponível
        if (strtolower($quarto->status) !== 'disponível') {
            return redirect()->back()
                ->withInput()
                ->withErrors(['quarto_id' => 'Este quarto não está disponível para reserva.']);
        }

        // Verifica conflitos de datas com reservas ativas do mesmo quarto
        $dataEntrada = $request->data_entrada;
        $dataSaida = $request->data_saida;

        $conflito = Reserva::where('quarto_id', $request->quarto_id)
            ->whereIn('status', ['Ativa', 'ativa'])
            ->where(function($query) use ($dataEntrada, $dataSaida) {
                $query->whereBetween('data_entrada', [$dataEntrada, $dataSaida])
                      ->orWhereBetween('data_saida', [$dataEntrada, $dataSaida])
                      ->orWhere(function($q) use ($dataEntrada, $dataSaida) {
                          $q->where('data_entrada', '<=', $dataEntrada)
                            ->where('data_saida', '>=', $dataSaida);
                      });
            })
            ->exists();

        if ($conflito) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['data_entrada' => 'Este quarto já possui uma reserva ativa no período selecionado.']);
        }

        $reserva = Reserva::create([
            'data_entrada' => $request->data_entrada,
            'data_saida'   => $request->data_saida,
            'status'       => 'Ativa',
            'hospede_id'   => Auth::guard('hospede')->id(),
            'quarto_id'    => $request->quarto_id,
        ]);

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

        // Não precisa mudar o status do quarto automaticamente
        // O quarto pode ter outras reservas ativas
        // O status do quarto deve ser gerenciado separadamente pelo admin

        return redirect()->back()->with('success', 'Reserva cancelada com sucesso!');
    }

    /**
     * Gera o comprovante de reserva em PDF
     */
    public function comprovante($id)
    {
        $reserva = Reserva::where('hospede_id', Auth::guard('hospede')->id())
            ->with(['quarto', 'hospede'])
            ->findOrFail($id);

        // Calcula o número de diárias
        $dataEntrada = \Carbon\Carbon::parse($reserva->data_entrada);
        $dataSaida = \Carbon\Carbon::parse($reserva->data_saida);
        $dias = $dataEntrada->diffInDays($dataSaida);
        $dias = $dias > 0 ? $dias : 1; // Mínimo 1 dia
        
        // Calcula o valor total
        $valorTotal = $reserva->quarto->valorDiaria * $dias;

        $pdf = Pdf::loadView('reserva.comprovante', [
            'reserva' => $reserva,
            'dias' => $dias,
            'valorTotal' => $valorTotal,
        ]);

        return $pdf->download('comprovante-reserva-' . $reserva->id . '.pdf');
    }
}
