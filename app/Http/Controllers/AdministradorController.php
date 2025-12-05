<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Administrador;
use App\Models\Reserva;
use App\Models\Quarto;
use App\Models\Hospede;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class AdministradorController extends Controller
{
    public function showLoginForm()
    {
        return view('usuario.login', ['tipo' => 'admin']);
    }

    public function login(Request $request)
    {
        $request->validate([
            'cpf' => 'required',
            'senha' => 'required',
        ]);

        if (Auth::guard('administrador')->attempt([
            'cpf' => $request->cpf,
            'password' => $request->senha
        ])) {
            return redirect()->route('dashboard.admin')->with('success', 'Login realizado com sucesso!');
        }

        return back()->withErrors(['cpf' => 'CPF ou senha inválidos.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('administrador')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.admin');
    }

    // =============================================
    // 🔵 DASHBOARD DO ADMINISTRADOR
    // =============================================
    public function dashboard()
    {
        // ===============================
        // 🔹 Dados principais
        // ===============================
        $totalReservas = Reserva::count();
        $quartosDisponiveis = Quarto::where('status', 'disponivel')->count();
        $totalHospedes = Hospede::count();

        // ===============================
        // 🔹 Gráfico 1 - Reservas Totais
        // ===============================
        $graficoReservas = (new LarapexChart)->barChart()
            ->setTitle('Reservas Totais')
            ->addData('Reservas', [$totalReservas])
            ->setXAxis(['Total']);

        // ===============================
        // 🔹 Gráfico 2 - Quartos Disponíveis
        // ===============================
        $graficoQuartos = (new LarapexChart)->barChart()
            ->setTitle('Quartos Disponíveis')
            ->addData('Disponíveis', [$quartosDisponiveis])
            ->setXAxis(['Quartos']);

        // ===============================
        // 🔹 Gráfico 3 - Total de Hóspedes
        // ===============================
        $graficoHospedes = (new LarapexChart)->barChart()
            ->setTitle('Total de Hóspedes')
            ->addData('Hóspedes', [$totalHospedes])
            ->setXAxis(['Total']);

        // =================================================
        // 🔵 NOVO GRÁFICO — QUARTOS MAIS RESERVADOS DO MÊS
        // =================================================
        $mesAtual = now()->month;

        $dados = Reserva::selectRaw('quarto_id, COUNT(*) as total')
            ->whereMonth('created_at', $mesAtual)
            ->groupBy('quarto_id')
            ->orderByDesc('total')
            ->get();

        $labels = [];
        $valores = [];

        foreach ($dados as $item) {
            $labels[] = 'Quarto ' . $item->quarto_id; // Pode alterar para nome do quarto
            $valores[] = $item->total;
        }

        $graficoQuartoMaisReservado = (new LarapexChart)->barChart()
            ->setTitle('Quartos Mais Reservados do Mês')
            ->addData('Reservas', $valores)
            ->setXAxis($labels);

        // ===============================
        // 🔹 Retorno da View
        // ===============================
        return view('administrador.dashboard', compact(
            'graficoReservas',
            'graficoQuartos',
            'graficoHospedes',
            'graficoQuartoMaisReservado'
        ));
    }
}
