<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Hóspedes</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-light p-4">

<div class="container">
    <a href="{{ url('/admin/dashboard') }}" class="btn btn-secondary mb-3">
        <i class="fa-solid fa-arrow-left"></i> Voltar
    </a>

    <h3 class="mb-4">Listagem de Hóspedes</h3>

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

    {{-- ✅ Mensagens de feedback --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- 🧾 Tabela de Hóspedes --}}
    @if ($hospedes->isEmpty())
        <div class="alert alert-warning">Nenhum hóspede encontrado.</div>
    @else
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle bg-white shadow-sm">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
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
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
