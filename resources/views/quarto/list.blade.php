@extends('base')
@section('titulo', 'Listagem de Quartos')

@section('conteudo')
    <a href="{{ route('quartos.create') }}">
        <button class="btn btn-success mb-3">
            <i class="fa-solid fa-plus"></i> Novo Quarto
        </button>
    </a>

    <h3>Listagem de Quartos (Administradores)</h3>

    <div class="table-responsive mt-3">
        <table class="table table-hover table-bordered">
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
                        <td>{{ $quarto->status }}</td>
                        <td>{{ $quarto->tipoQuarto }}</td>
                        <td>
                            @if ($quarto->imagem)
                                <img src="{{ asset('storage/' . $quarto->imagem) }}" width="80" height="80" alt="Imagem do quarto">
                            @else
                                <span class="text-muted">Sem imagem</span>
                            @endif
                        </td>
                        <td>
                            <a href="#" class="btn btn-outline-warning btn-sm">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="#" method="POST" style="display:inline-block;">
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
@endsection
