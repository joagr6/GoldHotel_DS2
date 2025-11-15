@extends('base_public')

@section('title', 'Cadastro de Hóspede')

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

    /* 🔥 Centralização total do quadro */
    .container-center {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .register-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: white;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        width: 950px;
        max-height:90vh;
        height: auto;
        overflow: hidden;
        position: relative;
        padding: 0;
    }

    .register-left {
        flex: 1;
        background: #f4f6fc;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 30px;
    }

    .register-left h2 {
        color: #1e3c72;
        font-weight: 600;
        margin-top: 10px;
    }

    .register-left p {
        color: #444;
    }

    .register-form {
        flex: 1.2;
        padding: 40px;
        max-height: 80vh;
        overflow-y: auto;
    }

    .form-label {
        font-weight: 500;
        color: #333;
    }

    .btn-primary {
        background-color: #fbc531;
        border: none;
        color: #000;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-primary:hover {
        background-color: #e1ac0e;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    /* 🔥 Botão voltar agora não atrapalha o centro */
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

    .logo {
        width: 300px;
        height: auto;
        margin-bottom: 15px;
        object-fit: contain;
    }
</style>

<a href="{{ url('/') }}" class="btn-back">← </a>

<div class="container-center">
    <div class="register-wrapper">

        {{-- Lado esquerdo --}}
        <div class="register-left">
            @if(file_exists(public_path('images/hotel_logo.jpg')))
                <img src="{{ asset('images/hotel_logo.jpg') }}" alt="Logo do Hotel" class="logo">
            @else
                <div class="logo" style="font-weight:bold; color:#888;">Hotel</div>
            @endif

            <h2>Bem-vindo!</h2>
            <p>Cadastre-se para desfrutar de todos os serviços do nosso hotel.</p>
        </div>

        {{-- Formulário --}}
        <div class="register-form">
            <h4 class="text-center mb-4" style="color:#1e3c72;">Cadastro de Hóspede</h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Ops!</strong> Há alguns erros no formulário:
                    <ul class="mb-0">
                        @foreach ($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('hospede.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nome completo</label>
                        <input type="text" name="nome" class="form-control" value="{{ old('nome') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">CPF</label>
                        <input type="text" name="cpf" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Data de Nascimento</label>
                        <input type="date" name="data_nascimento" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Telefone</label>
                        <input type="text" name="telefone" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Cidade</label>
                        <input type="text" name="cidade" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Rua</label>
                        <input type="text" name="rua" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Número da Casa</label>
                        <input type="text" name="numcasa" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Senha</label>
                        <input type="password" name="senha" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Foto de Perfil (opcional)</label>
                        <input type="file" name="imagem" class="form-control">
                    </div>
                </div>

                {{-- 🔥 BOTÕES CENTRALIZADOS E BONITOS --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('login.usuario', ['tipo' => 'hospede']) }}" class="btn btn-secondary">
                        Já tenho conta
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Cadastrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
