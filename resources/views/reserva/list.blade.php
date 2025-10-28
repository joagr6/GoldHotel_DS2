<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Quartos</title>

    {{-- Bootstrap CSS (opcional, se quiser estilização) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome (para ícones) --}}
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-light p-4">

    <a href="{{ url('/') }}">
        <button class="btn btn-secondary mb-3">
            <img src="{{ asset('img/voltar.png') }}" alt="Voltar" width="15" height="15"> Voltar
        </button>
    </a>

    <h2 class="mb-4">Listagem de Quartos</h2>

    <div class="mb-4">
        <form action="{{ route('quartos.search') }}" method="post" class="row g-2">
            @csrf
            <div class="col-md-3">
                <label class="form-label">Tipo</label>
                <select name="tipo" class="form-select">
                    <option value="tipoQuarto">Tipo de Quarto</option>
                    <option value="status">Status</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Valor</label>
                <input type="text" class="form-control" name="valor" placeholder="Pesquisar...">
            </div>

            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-magnifying-glass"></i> Buscar
                </button>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <a href="{{ route('quartos.create') }}" class="btn btn-success w-100">
                    <i class="fa-solid fa-plus"></i> Novo
                </a>
            </div>
        </form>
    </div>

    @if ($quartos->isEmpty())
        <div class="alert alert-warning">Nenhum quarto encontrado.</div>
    @else
        <table class="table table-bordered table-hover bg-white">
            <thead class="table-secondary">
                <tr>
                    <th>ID</th>
                    <th>Capacidade</th>
                    <th>Valor Diária</th>
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
                        <td>R$ {{ number_format($quarto->valorDiaria, 2, ',', '.') }}</td>
                        <td>{{ ucfirst($quarto->status) }}</td>
                        <td>{{ $quarto->tipoQuarto }}</td>
                        <td>
                            @if ($quarto->imagem)
                                <img src="{{ asset('storage/' . $quarto->imagem) }}" alt="Imagem do quarto" width="80">
                            @else
                                <small>Sem imagem</small>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('quartos.edit', $quarto->id) }}" class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('quartos.destroy', $quarto->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Tem certeza que deseja excluir este quarto?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</body>
</html>
