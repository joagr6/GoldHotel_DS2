@extends('base')
@section('titulo', 'Lista de Reservas')

@section('conteudo')
<a href="{{ url('/') }}">
    <button>
        <img src="{{ asset('img/voltar.png') }}" alt="Voltar" width="15" height="15">
    </button>
</a>

<h1>Lista de Reservas</h1>

<div class="row mb-4">
    <div class="col">
        <form action="{{ route('reserva.search') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <label class="form-label">Tipo</label>
                    <select name="tipo" class="form-select">
                        <option value="hospede">Hóspede</option>
                        <option value="status">Status</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Valor</label>
                    <input type="text" class="form-control" name="valor" placeholder="Pesquisar...">
                </div>

                <div class="col-md-3 mt-4">
                    <button type="submit" class="btn btn-primary mt-2">
                        <i class="fa-solid fa-magnifying-glass"></i> Buscar
                    </button>
                </div>

                <div class="col-md-2 mt-4">
                    <a href="{{ route('reserva.create') }}" class="btn btn-success mt-2">Nova Reserva</a>
                </div>
            </div>
        </form>
    </div>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Hóspede</th>
            <th>Quarto</th>
            <th>Data de Entrada</th>
            <th>Data de Saída</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dados as $reserva)
            <tr>
                <td>{{ $reserva->id }}</td>
                <td>{{ $reserva->hospede?->nome ?? 'Não informado' }}</td>
                <td>
                    Quarto {{ $reserva->quarto?->numero ?? '-' }} 
                    ({{ $reserva->quarto?->tipo ?? 'Sem tipo' }})
                </td>
                <td>{{ \Carbon\Carbon::parse($reserva->data_entrada)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($reserva->data_saida)->format('d/m/Y') }}</td>
                <td>
                    @if ($reserva->status == 'ativa')
                        <span class="badge bg-success">Ativa</span>
                    @elseif ($reserva->status == 'finalizada')
                        <span class="badge bg-secondary">Finalizada</span>
                    @else
                        <span class="badge bg-danger">Cancelada</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('reserva.edit', $reserva->id) }}" class="btn btn-primary btn-sm">Editar</a>
                    <form action="{{ route('reserva.destroy', $reserva->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Tem certeza que deseja excluir esta reserva?')">
                            Excluir
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@stop
