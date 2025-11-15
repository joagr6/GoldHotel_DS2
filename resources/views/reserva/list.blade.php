@extends('base')

@section('title', 'Minhas Reservas')

@section('content')

    <h1 class="fw-bold mb-4">Minhas Reservas</h1>

    @if ($dados->isEmpty())
        <div class="alert alert-info">Você não possui reservas cadastradas.</div>
    @else
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle bg-white shadow-sm">
                <thead class="table-primary">
                    <tr>
                        <th>#ID</th>
                        <th>Quarto</th>
                        <th>Data Entrada</th>
                        <th>Data Saída</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dados as $reserva)
                        <tr>
                            <td>{{ $reserva->id }}</td>
                            <td>{{ optional($reserva->quarto)->tipoQuarto }}</td>
                            <td>{{ \Carbon\Carbon::parse($reserva->data_entrada)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($reserva->data_saida)->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge bg-{{ strtolower($reserva->status) == 'ativa' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($reserva->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('reserva.comprovante', $reserva->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fa-solid fa-file-pdf"></i> Comprovante
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

@endsection

