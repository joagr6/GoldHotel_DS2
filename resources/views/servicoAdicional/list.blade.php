@extends('administrador.base')

@section('title', 'Listagem de Serviços Adicionais')

@section('content')

<style>
.btn-back {
    position: fixed;
    top: 90px;
    left: 20px;
    z-index: 3000;
    background: rgba(0,0,0,0.15);
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

<a href="{{ url('/admin/dashboard') }}" class="btn-back">←</a>

<h1 class="fw-bold mb-4">Listagem de Serviços Adicionais</h1>

{{-- 🔍 FILTRO --}}
<form action="{{ route('servicos.index') }}" method="GET" class="row g-3 mb-4 align-items-end">
    <div class="col-md-3">
        <label class="form-label">Filtrar por:</label>
        <select name="tipo" class="form-select">
            <option value="nome" {{ request('tipo') == 'nome' ? 'selected' : '' }}>Nome</option>
            <option value="valor" {{ request('tipo') == 'valor' ? 'selected' : '' }}>Valor</option>
            <option value="status" {{ request('tipo') == 'status' ? 'selected' : '' }}>Status</option>
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Valor</label>
        <input type="text" name="valor" value="{{ request('valor') }}" class="form-control" placeholder="Pesquisar...">
    </div>

    <div class="col-md-3">
        <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-magnifying-glass"></i> Buscar
        </button>
    </div>
</form>

{{-- 🧾 TABELA --}}
@if ($servicos->isEmpty())
    <div class="alert alert-warning">Nenhum serviço encontrado.</div>
@else

<div class="table-responsive">
    <table class="table table-hover table-bordered align-middle bg-white shadow-sm">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Imagem</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Valor (R$)</th>
                <th>Status</th>
                <th>Reservas associadas</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($servicos as $s)
                <tr>
                    <td>{{ $s->id }}</td>

                    <td class="text-center">
                        @if ($s->imagem)
                            <img src="{{ asset('storage/' . $s->imagem) }}"
                                 alt="Imagem"
                                 style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd;">
                        @else
                            <span class="text-muted">Sem imagem</span>
                        @endif
                    </td>

                    <td>{{ $s->nome }}</td>

                    <td style="max-width: 300px;">
                        {{ Str::limit($s->descricao, 80) }}
                    </td>

                    <td>R$ {{ number_format($s->valor, 2, ',', '.') }}</td>

                    <td>
                        <span class="badge {{ $s->status == 'Ativo' ? 'bg-success' : 'bg-secondary' }}">
                            {{ $s->status }}
                        </span>
                    </td>

<td>
    @if($s->reservas && $s->reservas->count() > 0)
        @foreach ($s->reservas as $r)
            <span class="badge bg-info text-dark mb-1">
                {{ $r->hospede->nome ?? 'Hóspede não informado' }}
            </span>
        @endforeach
    @else
        <span class="text-muted">Nenhuma</span>
    @endif
</td>

                    {{-- ✏️🗑️ AÇÕES --}}
                    <td class="text-center">
                        <a href="{{ route('servicos.edit', $s->id) }}" class="btn btn-outline-warning btn-sm">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <form action="{{ route('servicos.destroy', $s->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                onclick="return confirm('Deseja remover este serviço?')">
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
