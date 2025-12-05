@extends('administrador.base')

@section('title', isset($servico) ? 'Editar Serviço Adicional' : 'Cadastro de Serviço Adicional')

@section('content')

<style>
.btn-back {
    position: fixed;
    top: 90px;
    left: 20px;
    z-index: 3000;
    background: rgba(0, 0, 0, 0.15);
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

<div class="mb-4">
    <h1 class="fw-bold">{{ isset($servico) ? 'Editar Serviço Adicional' : 'Cadastro de Serviço Adicional' }}</h1>
</div>

<div class="card shadow-lg border-0">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">{{ isset($servico) ? 'Editar Serviço Adicional' : 'Cadastro de Serviço Adicional' }}</h4>
    </div>

    <div class="card-body">

        {{-- Exibe erros --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Ops!</strong> Existem erros no formulário:<br><br>
                <ul>
                    @foreach ($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulário --}}
        <form 
            action="{{ isset($servico) ? route('servicos.update', $servico->id) : route('servicos.store') }}" 
            method="POST" 
            enctype="multipart/form-data"
        >
            @csrf

            @if (isset($servico))
                @method('PUT')
            @endif

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nome" class="form-label">Nome do Serviço</label>
                    <input 
                        type="text" 
                        name="nome" 
                        id="nome" 
                        class="form-control"
                        value="{{ old('nome', $servico->nome ?? '') }}"
                        required
                    >
                </div>

                <div class="col-md-6">
                    <label for="valor" class="form-label">Valor (R$)</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="valor" 
                        id="valor" 
                        class="form-control"
                        value="{{ old('valor', $servico->valor ?? '') }}"
                        required
                    >
                </div>
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea 
                    name="descricao" 
                    id="descricao" 
                    class="form-control" 
                    rows="4"
                    required
                >{{ old('descricao', $servico->descricao ?? '') }}</textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="">Selecione...</option>
                        <option value="Ativo" {{ old('status', $servico->status ?? '') == 'Ativo' ? 'selected' : '' }}>Ativo</option>
                        <option value="Inativo" {{ old('status', $servico->status ?? '') == 'Inativo' ? 'selected' : '' }}>Inativo</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="imagem" class="form-label">Imagem / Ícone (opcional)</label>
                    <input 
                        type="file"
                        class="form-control"
                        name="imagem"
                        accept="image/*"
                    >
                </div>
            </div>

            @if(isset($servico) && $servico->imagem)
                <div class="mt-3">
                    <p>Imagem atual:</p>
                    <img 
                        src="{{ asset('storage/' . $servico->imagem) }}"
                        style="max-width: 200px; border-radius: 8px;"
                    >
                </div>
            @endif

            <div class="text-end mt-4">
                <button type="submit" class="btn btn-success">
                    {{ isset($servico) ? 'Atualizar' : 'Cadastrar' }}
                </button>
                <a href="{{ route('servicos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>

        </form>

    </div>
</div>

@endsection
