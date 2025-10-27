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

    <!-- Barra superior -->
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
                    <li class="nav-item"><a href="{{ route('quartos.index') }}" class="nav-link">Quartos</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="fw-bold">Minhas Reservas</h1>
        <p>Veja suas reservas ativas e passadas.</p>

        <div class="bg-white p-4 rounded shadow-sm">
            <p>Aqui vão as informações das reservas do hóspede...</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
