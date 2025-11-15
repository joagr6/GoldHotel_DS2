<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gold Hotel - Administração')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
        .navbar {
            background: linear-gradient(135deg, #1e3c72, #2a5298) !important;
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold text-uppercase" href="{{ route('dashboard.admin') }}">
                GOLD HOTEL
                @if(Auth::guard('administrador')->check())
                    <span>Administrador</span>
                @endif
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="{{ route('dashboard.admin') }}" class="nav-link {{ request()->routeIs('dashboard.admin') ? 'active' : '' }}">
                            <i class="fa-solid fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.reservas.index') }}" class="nav-link {{ request()->routeIs('admin.reservas.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-calendar-check"></i> Reservas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('quartos.index') }}" class="nav-link {{ request()->routeIs('quartos.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-bed"></i> Quartos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hospede.list') }}" class="nav-link {{ request()->routeIs('hospede.list') ? 'active' : '' }}">
                            <i class="fa-solid fa-users"></i> Hóspedes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout.admin') }}" class="nav-link">
                            <i class="fa-solid fa-sign-out-alt"></i> Sair
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- CONTEÚDO DAS PÁGINAS --}}
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>

