@extends('administrador.base')

@section('title', 'Listagem de Quartos')

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
        <h1 class="fw-bold mb-0">Listagem de Quartos</h1>
        <a href="{{ route('quartos.create') }}" class="btn btn-success">
            <i class="fa-solid fa-plus"></i> Novo Quarto
        </a>
    </div>

    {{-- 🔍 Formulário de pesquisa --}}
    <form method="GET" action="{{ route('quartos.index') }}" class="row g-3 mb-4 align-items-end">
        <div class="col-md-3">
            <label class="form-label">Tipo</label>
            <select name="tipo" class="form-select">
                <option value="">Selecione...</option>
                <option value="capacidade" {{ request('tipo') == 'capacidade' ? 'selected' : '' }}>Capacidade</option>
                <option value="status" {{ request('tipo') == 'status' ? 'selected' : '' }}>Status</option>
                <option value="valorDiaria" {{ request('tipo') == 'valorDiaria' ? 'selected' : '' }}>Valor</option>
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label">Valor</label>
            <input 
                type="text" 
                class="form-control" 
                name="valor" 
                placeholder="Pesquisar..." 
                value="{{ request('valor') }}"
            >
        </div>

        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-magnifying-glass"></i> Buscar
            </button>
        </div>
    </form>


    {{-- 🛏️ Tabela de quartos --}}
    @if ($quartos->isEmpty())
        <div class="alert alert-warning">Nenhum quarto cadastrado.</div>
    @else
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle bg-white shadow-sm">
                <thead class="table-primary">
                    <tr>
                        <th>#ID</th>
                        <th>Capacidade</th>
                        <th>Valor Diária (R$)</th>
                        <th>Status</th>
                        <th>Tipo de Quarto</th>
                        <th>Imagem</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quartos as $quarto)
                        <tr>
                            <td>{{ $quarto->id }}</td>
                            <td>{{ $quarto->capacidade }}</td>
                            <td>{{ number_format($quarto->valorDiaria, 2, ',', '.') }}</td>
                            <td>{{ ucfirst($quarto->status) }}</td>
                            <td>{{ $quarto->tipoQuarto }}</td>
                            <td class="text-center align-middle">
                                @if ($quarto->imagem)
                                    <div style="width: 100px; height: 100px; overflow: hidden; border-radius: 8px; border: 1px solid #ddd; margin: auto;">
                                        <img src="{{ asset('storage/' . $quarto->imagem) }}" 
                                            alt="Imagem do quarto" 
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                @else
                                    <span class="text-muted">Sem imagem</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('quartos.edit', $quarto->id) }}" class="btn btn-outline-warning btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('quartos.destroy', $quarto->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm"
                                        onclick="return confirm('Deseja remover este quarto?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

@endsection

