<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard do Administrador - Gold Hotel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

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
        .grafico-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.12);
            transition: 0.2s ease-in-out;
        }
        .grafico-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 14px rgba(0,0,0,0.18);
        }
        h5 {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold text-uppercase" href="#">
                GOLD HOTEL
                <span>Administrador</span>
            </a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="{{ route('dashboard.admin') }}" class="nav-link active">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout.admin') }}" class="nav-link">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- RESERVAS -->
    <div class="container mt-4">
        <h1 class="fw-bold">Reservas</h1>
        <div class="bg-white p-4 rounded shadow-sm">
            <a href="{{ route('admin.reservas.index') }}"><button>Listar Reservas</button></a>
        </div>
    </div>

    <!-- QUARTOS -->
    <div class="container mt-4">
        <h1 class="fw-bold">Quartos</h1>
        <div class="bg-white p-4 rounded shadow-sm">
            <a href="{{ route('quartos.index') }}"><button>Listar Quartos</button></a>
            <a href="{{ route('quartos.create') }}"><button>Cadastrar Quartos</button></a>
        </div>
    </div>

    <!-- HÓSPEDES -->
    <div class="container mt-4 mb-5">
        <h1 class="fw-bold">Hóspedes</h1>
        <div class="bg-white p-4 rounded shadow-sm">
            <a href="{{ route('hospede.list') }}"><button>Listar Hóspedes</button></a>
        </div>
    </div>

    <!-- GRÁFICOS -->
    <div class="container mt-4">
        <div class="row g-4">

            <div class="col-md-4">
                <div class="grafico-card">
                    <h5 class="text-center">Reservas Totais</h5>
                    {!! $graficoReservas->container() !!}
                </div>
            </div>

            <div class="col-md-4">
                <div class="grafico-card">
                    <h5 class="text-center">Quartos Disponíveis</h5>
                    {!! $graficoQuartos->container() !!}
                </div>
            </div>

            <div class="col-md-4">
                <div class="grafico-card">
                    <h5 class="text-center">Total de Hóspedes</h5>
                    {!! $graficoHospedes->container() !!}
                </div>
            </div>

        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{ $graficoReservas->script() }}
    {{ $graficoQuartos->script() }}
    {{ $graficoHospedes->script() }}

</body>
</html>
