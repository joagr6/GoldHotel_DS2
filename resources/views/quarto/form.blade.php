@extends('base')

@section('title', 'Cadastro de Quarto')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Cadastro de Quarto</h4>
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

            {{-- Formulário de cadastro --}}
            <form action="{{ route('quartos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="capacidade" class="form-label">Capacidade</label>
                        <input 
                            type="text" 
                            name="capacidade" 
                            id="capacidade" 
                            class="form-control" 
                            value="{{ old('capacidade') }}" 
                            required>
                    </div>

                    <div class="col-md-6">
                        <label for="valorDiaria" class="form-label">Valor da Diária (R$)</label>
                        <input 
                            type="number" 
                            step="0.01" 
                            name="valorDiaria" 
                            id="valorDiaria" 
                            class="form-control" 
                            value="{{ old('valorDiaria') }}" 
                            required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="">Selecione...</option>
                            <option value="Disponível" {{ old('status') == 'Disponível' ? 'selected' : '' }}>Disponível</option>
                            <option value="Ocupado" {{ old('status') == 'Ocupado' ? 'selected' : '' }}>Ocupado</option>
                            <option value="Em manutenção" {{ old('status') == 'Em manutenção' ? 'selected' : '' }}>Em manutenção</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="tipoQuarto" class="form-label">Tipo de Quarto</label>
                        <input 
                            type="text" 
                            name="tipoQuarto" 
                            id="tipoQuarto" 
                            class="form-control" 
                            value="{{ old('tipoQuarto') }}" 
                            required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="imagem" class="form-label">Imagem do Quarto</label>
                    <input 
                        type="file" 
                        name="imagem" 
                        id="imagem" 
                        class="form-control" 
                        accept="image/*">
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Cadastrar Quarto</button>
                    <a href="{{ route('login.admin') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
