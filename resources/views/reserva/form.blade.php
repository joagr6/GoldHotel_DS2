<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($reserva) ? 'Editar Reserva' : 'Nova Reserva' }} - Gold Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold text-uppercase" href="#">GOLD HOTEL</a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item"><a href="{{ route('hospede.dashboard') }}" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="{{ route('quarto.dashboard') }}" class="nav-link">Quartos</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <h1 class="fw-bold mb-4">{{ isset($reserva) ? 'Editar Reserva' : 'Fazer Reserva' }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ isset($reserva) ? route('reserva.update', $reserva->id) : route('reserva.store') }}" class="bg-white p-4 rounded shadow-sm">
            @csrf
            @if(isset($reserva))
                @method('PUT')
            @endif

            @if (isset($quartoSelecionado))
                <div class="mb-3">
                    <label class="form-label">Quarto selecionado</label>
                    <input type="text" class="form-control" value="{{ $quartoSelecionado->tipoQuarto }} - R$ {{ number_format($quartoSelecionado->valorDiaria, 2, ',', '.') }}" disabled>
                    <input type="hidden" name="quarto_id" value="{{ $quartoSelecionado->id }}">
                </div>
            @else
                <div class="mb-3">
                    <label class="form-label">Selecione o quarto</label>
                    <select class="form-select" name="quarto_id" required>
                        <option value="">Escolha...</option>
                        @foreach ($quartosDisponiveis ?? $quartos as $q)
                            <option value="{{ $q->id }}" {{ (isset($reserva) && $reserva->quarto_id == $q->id) ? 'selected' : '' }}>
                                {{ $q->tipoQuarto }} - R$ {{ number_format($q->valorDiaria, 2, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Data de entrada</label>
                    <input type="date" name="data_entrada" class="form-control" value="{{ isset($reserva) ? $reserva->data_entrada : old('data_entrada') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Data de saída</label>
                    <input type="date" name="data_saida" class="form-control" value="{{ isset($reserva) ? $reserva->data_saida : old('data_saida') }}" required>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">{{ isset($reserva) ? 'Atualizar Reserva' : 'Confirmar Reserva' }}</button>
                <a href="{{ isset($reserva) ? route('hospede.dashboard') : route('quarto.dashboard') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

