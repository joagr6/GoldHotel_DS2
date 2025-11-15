@extends('administrador.base')

@section('title', isset($quarto) ? 'Editar Quarto' : 'Cadastro de Quarto')

@section('content')

<div class="mb-4">
    <h1 class="fw-bold">{{ isset($quarto) ? 'Editar Quarto' : 'Cadastro de Quarto' }}</h1>
</div>

<div class="card shadow-lg border-0">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">{{ isset($quarto) ? 'Editar Quarto' : 'Cadastro de Quarto' }}</h4>
    </div>

    <div class="card-body">
        {{-- Exibe erros de validação --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Ops!</strong> Há alguns erros no formulário:<br><br>
                <ul>
                    @foreach ($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulário dinâmico --}}
        <form 
            action="{{ isset($quarto) ? route('quartos.update', $quarto->id) : route('quartos.store') }}" 
            method="POST" 
            enctype="multipart/form-data"
        >
            @csrf
            @if(isset($quarto))
                @method('PUT')
            @endif

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="capacidade" class="form-label">Capacidade</label>
                    <input 
                        type="text" 
                        name="capacidade" 
                        id="capacidade" 
                        class="form-control" 
                        value="{{ old('capacidade', $quarto->capacidade ?? '') }}" 
                        required
                    >
                </div>

                <div class="col-md-6">
                    <label for="valorDiaria" class="form-label">Valor da Diária (R$)</label>
                    <input 
                        type="number" 
                        name="valorDiaria" 
                        id="valorDiaria" 
                        class="form-control" 
                        step="0.01"
                        value="{{ old('valorDiaria', $quarto->valorDiaria ?? '') }}" 
                        required
                    >
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="">Selecione...</option>
                        <option value="Disponível" {{ old('status', $quarto->status ?? '') == 'Disponível' ? 'selected' : '' }}>Disponível</option>
                        <option value="Ocupado" {{ old('status', $quarto->status ?? '') == 'Ocupado' ? 'selected' : '' }}>Ocupado</option>
                        <option value="Em manutenção" {{ old('status', $quarto->status ?? '') == 'Em manutenção' ? 'selected' : '' }}>Em manutenção</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="tipoQuarto" class="form-label">Tipo de Quarto</label>
                    <input 
                        type="text" 
                        name="tipoQuarto" 
                        id="tipoQuarto" 
                        class="form-control" 
                        value="{{ old('tipoQuarto', $quarto->tipoQuarto ?? '') }}" 
                        required
                    >
                </div>
            </div>

            <div class="mb-3">
                <label for="imagem" class="form-label">Imagem do Quarto</label>
                <input 
                    type="file" 
                    name="imagem" 
                    id="imagem" 
                    class="form-control" 
                    accept="image/*"
                >

                {{-- Se estiver editando e já houver imagem --}}
                @if(isset($quarto) && $quarto->imagem)
                    <div class="mt-3">
                        <p>Imagem atual:</p>
                        <img 
                            src="{{ asset('storage/' . $quarto->imagem) }}" 
                            alt="Imagem do quarto" 
                            style="max-width: 200px; border-radius: 8px;"
                        >
                    </div>
                @endif
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-success">
                    {{ isset($quarto) ? 'Atualizar' : 'Cadastrar' }}
                </button>
                <a href="{{ route('quartos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@endsection

