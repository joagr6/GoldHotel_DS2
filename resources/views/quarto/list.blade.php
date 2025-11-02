<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Quartos</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-light p-4">

<div class="container">
    {{-- 🔙 Botões superiores --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ url('/admin/dashboard') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </div>
        <div>
            <a href="{{ route('quartos.create') }}" class="btn btn-success">
                <i class="fa-solid fa-plus"></i> Novo Quarto
            </a>
        </div>
    </div>

    <h3 class="mb-4">Listagem de Quartos (Administradores)</h3>

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

    {{-- ✅ Mensagens de feedback --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
