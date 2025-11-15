@extends('base')

@section('title', 'Meus Dados')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #1e3c72, #2a5298);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Poppins', sans-serif;
        margin: 0;
    }

    .container-center {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .profile-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: white;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        width: 950px;
        max-height: 90vh;
        height: auto;
        overflow: hidden;
        padding: 0;
    }

    .profile-left {
        flex: 1;
        background: #f4f6fc;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 30px;
    }

    .profile-left img {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        border: 4px solid #1e3c72;
        object-fit: cover;
        margin-bottom: 15px;
    }

    .profile-left h2 {
        color: #1e3c72;
        font-weight: 600;
    }

    .profile-form {
        flex: 1.2;
        padding: 40px;
        max-height: 80vh;
        overflow-y: auto;
    }

    .form-label {
        font-weight: 500;
        color: #333;
    }

    .btn-success {
        background-color: #fbc531;
        border: none;
        color: #000;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-success:hover {
        background-color: #e1ac0e;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
        font-weight: 600;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .btn-back {
        position: fixed;
        top: 90px;
        left: 20px;
        z-index: 3000;
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(3px);
        color: white;
        border: 1px solid white;
        border-radius: 8px;
        padding: 6px 14px;
        text-decoration: none;
        transition: 0.3s;
        font-weight: 600;
    }

    .btn-back:hover {
        background: white;
        color: #1e3c72;
    }
</style>

<a href="{{ route('hospede.dashboard') }}" class="btn-back">←</a>

<div class="container-center">
    <div class="profile-wrapper">

        {{-- LADO ESQUERDO --}}
        <div class="profile-left">
            @if ($hospede->imagem)
                <img src="{{ asset('storage/'.$hospede->imagem) }}" alt="Foto do hóspede">
            @else
                <img src="https://via.placeholder.com/200" alt="Sem imagem">
            @endif

            <h2>{{ $hospede->nome }}</h2>
            <p style="color:#444;">Atualize seus dados pessoais ao lado.</p>
        </div>

        {{-- FORMULÁRIO --}}
        <div class="profile-form">
            <h4 class="text-center mb-4" style="color:#1e3c72;">Meus Dados</h4>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('hospede.update', $hospede->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Nome completo</label>
                        <input type="text" name="nome" class="form-control"
                               value="{{ old('nome', $hospede->nome) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">CPF</label>
                        <input type="text" class="form-control"
                               value="{{ $hospede->cpf }}" readonly>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Data de Nascimento</label>
                        <input type="date" name="data_nascimento" class="form-control"
                               value="{{ old('data_nascimento', $hospede->data_nascimento) }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Telefone</label>
                        <input type="text" name="telefone" class="form-control"
                               value="{{ old('telefone', $hospede->telefone) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control"
                               value="{{ old('email', $hospede->email) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Cidade</label>
                        <input type="text" name="cidade" class="form-control"
                               value="{{ old('cidade', $hospede->cidade) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Rua</label>
                        <input type="text" name="rua" class="form-control"
                               value="{{ old('rua', $hospede->rua) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Número da Casa</label>
                        <input type="text" name="numcasa" class="form-control"
                               value="{{ old('numcasa', $hospede->numcasa) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nova Senha (opcional)</label>
                        <input type="password" name="senha" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Foto de Perfil</label>
                        <input type="file" name="imagem" class="form-control" accept="image/*">
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('hospede.dashboard') }}" class="btn btn-secondary">Voltar</a>

                    <button type="submit" class="btn btn-success">
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection
