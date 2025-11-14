<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gold Hotel')</title>

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

    @stack('styles')
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold text-uppercase" href="#">
                GOLD HOTEL
                @if(Auth::guard('hospede')->check())
                        <span>Olá, {{ Auth::guard('hospede')->user()->nome }}</span>
                    @endif
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item"><a href="{{ route('hospede.dashboard') }}" class="nav-link">Reservas</a></li>
                    <li class="nav-item"><a href="{{ route('hospede.dados') }}" class="nav-link">Meus dados</a></li>
                    <li class="nav-item"><a href="{{ route('quarto.dashboard') }}" class="nav-link">Quartos</a></li>
                    <li class="nav-item"><a href="{{ route('hospede.logout') }}" class="nav-link">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- CONTEÚDO DAS PÁGINAS --}}
    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
