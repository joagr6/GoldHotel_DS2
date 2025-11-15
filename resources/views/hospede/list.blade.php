@extends('administrador.base')

@section('title', 'Listagem de Hóspedes')

@section('content')

    <h1 class="fw-bold mb-4">Listagem de Hóspedes</h1>

    {{-- 🔍 Formulário de Pesquisa --}}
    <form action="{{ route('hospede.list') }}" method="GET" class="row g-3 mb-4 align-items-end">
        <div class="col-md-3">
            <label class="form-label">Filtrar por:</label>
            <select name="tipo" class="form-select">
                <option value="nome" {{ request('tipo') == 'nome' ? 'selected' : '' }}>Nome</option>
                <option value="cpf" {{ request('tipo') == 'cpf' ? 'selected' : '' }}>CPF</option>
                <option value="cidade" {{ request('tipo') == 'cidade' ? 'selected' : '' }}>Cidade</option>
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label">Valor</label>
            <input 
                type="text" 
                name="valor" 
                value="{{ request('valor') }}" 
                class="form-control" 
                placeholder="Pesquisar..."
            >
        </div>

        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-magnifying-glass"></i> Buscar
            </button>
        </div>
    </form>


    {{-- 🧾 Tabela de Hóspedes --}}
    @if ($hospedes->isEmpty())
        <div class="alert alert-warning">Nenhum hóspede encontrado.</div>
    @else
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle bg-white shadow-sm">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Foto</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Data Nasc.</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Cidade</th>
                        <th>Rua</th>
                        <th>Nº</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hospedes as $h)
                        <tr>
                            <td>{{ $h->id }}</td>
                            <td class="text-center">
                                @if ($h->imagem)
                                    <img src="{{ asset('storage/' . $h->imagem) }}" 
                                         alt="Foto de {{ $h->nome }}" 
                                         style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%; border: 1px solid #ddd;">
                                @else
                                    <span class="text-muted">Sem foto</span>
                                @endif
                            </td>
                            <td>{{ $h->nome }}</td>
                            <td>{{ $h->cpf }}</td>
                            <td>{{ date('d/m/Y', strtotime($h->data_nascimento)) }}</td>
                            <td>{{ $h->telefone }}</td>
                            <td>{{ $h->email }}</td>
                            <td>{{ $h->cidade }}</td>
                            <td>{{ $h->rua }}</td>
                            <td>{{ $h->numcasa }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

@endsection

