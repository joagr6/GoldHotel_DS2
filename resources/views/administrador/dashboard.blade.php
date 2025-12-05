@extends('administrador.base')

@section('title', 'Dashboard do Administrador')

@push('styles')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
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
        .action-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: 0.2s ease-in-out;
            height: 100%;
        }
        .action-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
    </style>
@endpush

@section('content')

    <h1 class="fw-bold mb-4">Dashboard Administrativo</h1>

    <!-- RESERVAS -->
    <div class="mb-4">
        <h2 class="fw-bold mb-3">Reservas</h2>
        <div class="row g-3">
            <div class="col-md-6">
                <div class="action-card">
                    <h5><i class="fa-solid fa-calendar-check text-primary"></i> Gerenciar Reservas</h5>
                    <p class="text-muted">Visualize e gerencie todas as reservas do sistema</p>
                    <a href="{{ route('admin.reservas.index') }}" class="btn btn-primary">
                        <i class="fa-solid fa-list"></i> Listar Reservas
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- QUARTOS -->
    <div class="mb-4">
        <h2 class="fw-bold mb-3">Quartos</h2>
        <div class="row g-3">
            <div class="col-md-6">
                <div class="action-card">
                    <h5><i class="fa-solid fa-bed text-success"></i> Listar Quartos</h5>
                    <p class="text-muted">Visualize todos os quartos cadastrados</p>
                    <a href="{{ route('quartos.index') }}" class="btn btn-success">
                        <i class="fa-solid fa-list"></i> Listar Quartos
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="action-card">
                    <h5><i class="fa-solid fa-plus-circle text-info"></i> Cadastrar Quarto</h5>
                    <p class="text-muted">Adicione um novo quarto ao sistema</p>
                    <a href="{{ route('quartos.create') }}" class="btn btn-info">
                        <i class="fa-solid fa-plus"></i> Cadastrar Quarto
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- HÓSPEDES -->
    <div class="mb-5">
        <h2 class="fw-bold mb-3">Hóspedes</h2>
        <div class="row g-3">
            <div class="col-md-6">
                <div class="action-card">
                    <h5><i class="fa-solid fa-users text-warning"></i> Gerenciar Hóspedes</h5>
                    <p class="text-muted">Visualize todos os hóspedes cadastrados</p>
                    <a href="{{ route('hospede.list') }}" class="btn btn-warning">
                        <i class="fa-solid fa-list"></i> Listar Hóspedes
                    </a>
                </div>
            </div>
        </div>
    </div>
     <!-- Serviço Adicional -->
    <div class="mb-4">
        <h2 class="fw-bold mb-3">Serviço Adicional</h2>
        <div class="row g-3">
            <div class="col-md-6">
                <div class="action-card">
                    <h5><i class="fa-solid fa-bed text-success"></i> Listar Serviços</h5>
                    <p class="text-muted">Visualize todos os Servicos cadastrados</p>
                    <a href="{{ route('servicos.store') }}" class="btn btn-success">
                        <i class="fa-solid fa-list"></i> Listar Serviços
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="action-card">
                    <h5><i class="fa-solid fa-plus-circle text-info"></i> Cadastrar Serviço</h5>
                    <p class="text-muted">Adicione um novo servoço ao sistema</p>
                    <a href="{{ route('servicos.create') }}" class="btn btn-info">
                        <i class="fa-solid fa-plus"></i> Cadastrar Serviço
                    </a>
                </div>
            </div>
        </div>
    </div>
    

    <!-- GRÁFICOS -->
    <div class="mt-4">
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

@endsection

@push('scripts')
    {{ $graficoReservas->script() }}
    {{ $graficoQuartos->script() }}
    {{ $graficoHospedes->script() }}
@endpush
