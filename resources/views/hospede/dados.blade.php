@extends('base')

@section('title', 'Meus Dados')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-black text-white">
            <h4 class="mb-0">Meus Dados</h4>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('hospede.update', $hospede->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nome" class="form-label">Nome completo</label>
                        <input type="text" name="nome" id="nome" class="form-control"
                               value="{{ old('nome', $hospede->nome) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" name="cpf" id="cpf" class="form-control"
                               value="{{ old('cpf', $hospede->cpf) }}" maxlength="16" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                        <input type="date" name="data_nascimento" id="data_nascimento" class="form-control"
                               value="{{ old('data_nascimento', $hospede->data_nascimento) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" name="telefone" id="telefone" class="form-control"
                               value="{{ old('telefone', $hospede->telefone) }}">
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control"
                               value="{{ old('email', $hospede->email) }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" name="cidade" id="cidade" class="form-control"
                               value="{{ old('cidade', $hospede->cidade) }}">
                    </div>
                    <div class="col-md-4">
                        <label for="rua" class="form-label">Rua</label>
                        <input type="text" name="rua" id="rua" class="form-control"
                               value="{{ old('rua', $hospede->rua) }}">
                    </div>
                    <div class="col-md-4">
                        <label for="numcasa" class="form-label">Número da Casa</label>
                        <input type="text" name="numcasa" id="numcasa" class="form-control"
                               value="{{ old('numcasa', $hospede->numcasa) }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="senha" class="form-label">Nova Senha (opcional)</label>
                        <input type="password" name="senha" id="senha" class="form-control">
                        <small class="text-muted">Deixe em branco para manter a senha atual</small>
                    </div>
                    <div class="col-md-6">
                        <label for="imagem" class="form-label">Foto de Perfil</label>
                        <input type="file" name="imagem" id="imagem" class="form-control" accept="image/*">
                        <small class="text-muted">Formatos aceitos: JPG, PNG, GIF. Tamanho máximo: 2MB</small>
                        @if($hospede->imagem)
                            <div class="mt-2">
                                <p class="mb-1">Imagem atual:</p>
                                <img src="{{ asset('storage/' . $hospede->imagem) }}" 
                                     alt="Foto de perfil" 
                                     style="max-width: 150px; border-radius: 8px; border: 1px solid #ddd;">
                            </div>
                        @endif
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Salvar Alterações</button>
                    <a href="{{ route('hospede.dashboard') }}" class="btn btn-secondary">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
