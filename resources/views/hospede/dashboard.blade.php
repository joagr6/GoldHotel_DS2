<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard do Hóspede - Gold Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 70px; 
            background-color: #f8f9fa;
        }
        .navbar-brand span {
            display: block;
            font-size: 0.8rem;
            font-weight: normal;
            color: #dcdcdc;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold text-uppercase" href="#">
                GOLD HOTEL
                <span>Olá, {{ Auth::guard('hospede')->user()->nome }}</span>
            </a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item"><a href="{{ route('hospede.dashboard') }}" class="nav-link active">Home</a></li>
                    <li class="nav-item"><a href="{{ route('hospede.dados') }}" class="nav-link">Meus dados</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Reservas</a></li>
                    <li class="nav-item"><a href="{{ route('quarto.dashboard') }}" class="nav-link">Quartos</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="fw-bold">Minhas Reservas</h1>
        <p>Veja suas reservas ativas e passadas.</p>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="bg-white p-4 rounded shadow-sm mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Reservas ativas</h5>
                <a href="{{ route('quarto.dashboard') }}" class="btn btn-primary btn-sm">Reservar quarto</a>
            </div>
            @if(isset($ativas) && $ativas->count())
                <div class="list-group">
                    @foreach ($ativas as $res)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-semibold">{{ optional($res->quarto)->tipoQuarto }}</div>
                                <small>{{ \Carbon\Carbon::parse($res->data_entrada)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($res->data_saida)->format('d/m/Y') }}</small>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-success">{{ ucfirst($res->status) }}</span>
                                <form method="POST" action="{{ route('reserva.destroy', $res->id) }}" onsubmit="return confirm('Deseja realmente cancelar esta reserva?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Cancelar</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted mb-0">Você não possui reservas ativas.</p>
            @endif
        </div>

        <div class="bg-white p-4 rounded shadow-sm">
            <h5 class="mb-3">Reservas passadas</h5>
            @if(isset($passadas) && $passadas->count())
                <div class="list-group">
                    @foreach ($passadas as $res)
                        <div class="list-group-item d-flex justify-content-between">
                            <div>
                                <div class="fw-semibold">{{ optional($res->quarto)->tipoQuarto }}</div>
                                <small>{{ \Carbon\Carbon::parse($res->data_entrada)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($res->data_saida)->format('d/m/Y') }}</small>
                            </div>
                            <span class="badge bg-secondary align-self-center">{{ ucfirst($res->status) }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted mb-0">Sem histórico de reservas.</p>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
