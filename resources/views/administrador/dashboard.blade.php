<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard do Administrador - Gold Hotel</title>
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
                <span>Administrador</span>
            </a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item"><a href="{{ route('dashboard.admin') }}" class="nav-link active">Home</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="fw-bold">Reservas</h1>
        <div class="bg-white p-4 rounded shadow-sm">
            <a href="{{ route('quartos.index') }}"><button>Listar Reservas</button></a>

        </div>
    </div>

    <div class="container mt-4">
        <h1 class="fw-bold">Quartos</h1>

        <div class="bg-white p-4 rounded shadow-sm">
            <a href="{{ route('quartos.index') }}"><button>Listar Quartos</button></a>
            <a href="{{ route('quartos.create') }}"><button>Cadastrar Quartos</button></a>
        </div>
    </div>
        <div class="container mt-4">
        <h1 class="fw-bold">Hóspedes</h1>

        <div class="bg-white p-4 rounded shadow-sm">
            <a href="{{ route('hospede.list') }}"><button>Listar Hóspedes</button></a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
