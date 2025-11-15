@extends('administrador.base')

@section('title', 'Reservas - Administração')

@section('content')
<style>
    .btn-back {
        position: fixed;
        top: 90px;
        left: 20px;
        z-index: 3000;
        background: rgba(0, 0, 0, 0.15);
        backdrop-filter: blur(3px);
        color: black;
        border: 1px solid white;
        border-radius: 8px;
        padding: 6px 14px;
        text-decoration: none;
        transition: 0.3s;
        font-weight: 600;
    }
     .btn-back:hover {
        background: white;
        color: #000000ff;
    }
    </style>
<a href="{{ url('/admin/dashboard') }}" class="btn-back">← </a>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold mb-0">Listagem de Reservas</h1>
    </div>

        {{-- Formulário de Busca --}}
        <div class="bg-white p-4 rounded shadow-sm mb-4">
            <h5 class="mb-3">Buscar Reservas</h5>
            <form method="GET" action="{{ route('admin.reservas.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Hóspede</label>
                    <input 
                        type="text" 
                        name="hospede" 
                        class="form-control" 
                        placeholder="Nome do hóspede"
                        value="{{ request('hospede') }}"
                    >
                </div>
                <div class="col-md-3">
                    <label class="form-label">Quarto</label>
                    <input 
                        type="text" 
                        name="quarto" 
                        class="form-control" 
                        placeholder="Tipo de quarto"
                        value="{{ request('quarto') }}"
                    >
                </div>
                <div class="col-md-2">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Todos</option>
                        <option value="Ativa" {{ request('status') == 'Ativa' ? 'selected' : '' }}>Ativa</option>
                        <option value="Cancelada" {{ request('status') == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
                        <option value="Finalizada" {{ request('status') == 'Finalizada' ? 'selected' : '' }}>Finalizada</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Data Entrada</label>
                    <input 
                        type="date" 
                        name="data_entrada" 
                        class="form-control"
                        value="{{ request('data_entrada') }}"
                    >
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fa-solid fa-magnifying-glass"></i> Buscar
                    </button>
                </div>
            </form>
            @if (request()->anyFilled(['hospede', 'quarto', 'status', 'data_entrada']))
                <div class="mt-2">
                    <a href="{{ route('admin.reservas.index') }}" class="btn btn-sm btn-outline-secondary">
                        Limpar Filtros
                    </a>
                </div>
            @endif
        </div>

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

@endsection


