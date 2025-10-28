<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Quartos - Gold Hotel</title>
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
        .card:hover {
            transform: scale(1.02);
            transition: 0.3s ease;
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
                    <li class="nav-item"><a href="{{ route('hospede.dashboard') }}" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="{{ route('hospede.dados') }}" class="nav-link">Meus dados</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Reservas</a></li>
                    <li class="nav-item"><a href="{{ route('quartos.index') }}" class="nav-link active">Quartos</a></li>
                    <li class="nav-item"><a href="{{ route('hospede.logout') }}" class="nav-link">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="fw-bold mb-4 text-center">Lista de Quartos</h1>

        <div class="row g-4">
            @forelse ($quartos as $quarto)
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $quarto->tipoQuarto }}</h5>
                            <p class="card-text mb-1"><strong>Capacidade:</strong> {{ $quarto->capacidade }}</p>
                            <p class="card-text mb-1"><strong>Valor da Diária:</strong> 
                                R$ {{ number_format($quarto->valorDiaria, 2, ',', '.') }}
                            </p>
                            <p class="card-text mb-3"><strong>Status:</strong> 
                                @if ($quarto->status === 'disponível')
                                    <span class="text-success fw-semibold">Disponível</span>
                                @else
                                    <span class="text fw-semibold">{{ ucfirst($quarto->status) }}</span>
                                @endif
                            </p>
                            <a 
                               class="btn btn-primary w-100 {{ $quarto->status !== 'disponível' ? 'disabled' : '' }}">
                                Reservar
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">
                    Nenhum quarto cadastrado no sistema.
                </div>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
