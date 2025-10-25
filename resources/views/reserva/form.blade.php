@extends('base')
@section('titulo', 'Formulário de Reserva')

@section('conteudo')
<a href="{{ url('/') }}">
    <button>
        <img src="{{ asset('img/voltar.png') }}" alt="Voltar" width="15" height="15">
    </button>
</a>

<h1>Registrar Reserva</h1>

@php
    if (!empty($dado->id)) {
        $action = route('reserva.update', $dado->id);
    } else {
        $action = route('reserva.store');
    }
@endphp

<form action="{{ $action }}" method="post">
    @csrf

    @if (!empty($dado->id))
        @method('put')
    @endif

    <input type="hidden" name="id" value="{{ old('id', $dado->id ?? '') }}">

    <div class="row mt-3">
        <div class="col">
            <label for="hospede_id">Hóspede</label>
            <select name="hospede_id" id="hospede_id" class="form-select" required>
                <option value="">Selecione o hóspede</option>
                @foreach($hospedes as $hospede)
                    <option value="{{ $hospede->id }}" 
                        {{ old('hospede_id', $dado->hospede_id ?? '') == $hospede->id ? 'selected' : '' }}>
                        {{ $hospede->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col">
            <label for="quarto_id">Quarto</label>
            <select name="quarto_id" id="quarto_id" class="form-select" required>
                <option value="">Selecione o quarto</option>
                @foreach($quartos as $quarto)
                    <option value="{{ $quarto->id }}" 
                        {{ old('quarto_id', $dado->quarto_id ?? '') == $quarto->id ? 'selected' : '' }}>
                        Quarto {{ $quarto->numero }} - {{ $quarto->tipo }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <label for="data_entrada">Data de Entrada</label>
            <input type="date" class="form-control" name="data_entrada" id="data_entrada"
                   value="{{ old('data_entrada', $dado->data_entrada ?? '') }}" required>
        </div>
        <div class="col">
            <label for="data_saida">Data de Saída</label>
            <input type="date" class="form-control" name="data_saida" id="data_saida"
                   value="{{ old('data_saida', $dado->data_saida ?? '') }}" required>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="">Selecione</option>
                <option value="ativa" {{ old('status', $dado->status ?? '') == 'ativa' ? 'selected' : '' }}>Ativa</option>
                <option value="finalizada" {{ old('status', $dado->status ?? '') == 'finalizada' ? 'selected' : '' }}>Finalizada</option>
                <option value="cancelada" {{ old('status', $dado->status ?? '') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
            </select>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <button type="submit" class="btn btn-success">
                {{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}
            </button>
            <a href="{{ route('reserva.index') }}" class="btn btn-primary">Voltar</a>
        </div>
    </div>
</form>
@stop
