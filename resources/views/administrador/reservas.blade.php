<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas - Administração</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">Listagem de Reservas</h3>
            <a href="{{ route('dashboard.admin') }}" class="btn btn-secondary">Voltar</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(!$reservas->count())
            <div class="alert alert-warning">Nenhuma reserva encontrada.</div>
        @else
            <div class="table-responsive bg-white shadow-sm rounded">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-secondary">
                        <tr>
                            <th>#</th>
                            <th>Hóspede</th>
                            <th>Quarto</th>
                            <th>Entrada</th>
                            <th>Saída</th>
                            <th>Status</th>
                            <th>Criada em</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservas as $r)
                            <tr>
                                <td>{{ $r->id }}</td>
                                <td>{{ optional($r->hospede)->nome }}</td>
                                <td>{{ optional($r->quarto)->tipoQuarto }}</td>
                                <td>{{ \Carbon\Carbon::parse($r->data_entrada)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($r->data_saida)->format('d/m/Y') }}</td>
                                <td>
                                    @php $s = strtolower($r->status); @endphp
                                    <span class="badge {{ $s === 'ativa' ? 'bg-success' : ($s === 'cancelada' ? 'bg-danger' : 'bg-secondary') }}">
                                        {{ ucfirst($r->status) }}
                                    </span>
                                </td>
                                <td>{{ $r->created_at?->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


