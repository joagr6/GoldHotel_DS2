@extends('base')

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
        overflow: hidden;
    }

    .register-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: white;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        width: 950px;
        height: 550px;
        overflow: hidden;
        position: relative;
        z-index: 1;
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

    .btn-back {
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 2;
        background: rgba(255,255,255,0.2);
        color: white;
        border: 1px solid white;
        border-radius: 8px;
        padding: 6px 14px;
        text-decoration: none;
        transition: 0.3s;
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

    .wave-background {
        position: absolute;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 0% 0%, rgba(255,255,255,0.05) 0%, transparent 70%),
                    radial-gradient(circle at 100% 100%, rgba(255,255,255,0.05) 0%, transparent 70%);
        z-index: 0;
    }
</style>

<a href="{{ url('/') }}" class="btn-back">←</a>
<div class="wave-background"></div>

<div class="register-wrapper">
    {{-- Lado esquerdo com logo e texto --}}
    <div class="register-left">
        @if(file_exists(public_path('images/hotel_logo.jpg')))
            <img src="{{ asset('images/hotel_logo.jpg') }}" alt="Logo do Hotel" class="logo">
        @else
            <div class="logo" style="font-weight:bold; color:#888;">Hotel</div>
        @endif
        <h2>Bem-vindo!</h2>
        <p>Cadastre-se para desfrutar de todos os serviços do nosso hotel.</p>
    </div>

    {{-- Lado direito com o formulário --}}
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

        <form action="{{ route('hospede.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nome" class="form-label">Nome completo</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" name="cpf" id="cpf" class="form-control" maxlength="16" value="{{ old('cpf') }}" required>
                </div>

                <div class="col-md-6">
                    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" value="{{ old('data_nascimento') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" name="telefone" id="telefone" class="form-control" value="{{ old('telefone') }}">
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="col-md-6">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" name="cidade" id="cidade" class="form-control" value="{{ old('cidade') }}">
                </div>

                <div class="col-md-6">
                    <label for="rua" class="form-label">Rua</label>
                    <input type="text" name="rua" id="rua" class="form-control" value="{{ old('rua') }}">
                </div>
                <div class="col-md-6">
                    <label for="numcasa" class="form-label">Número da Casa</label>
                    <input type="text" name="numcasa" id="numcasa" class="form-control" value="{{ old('numcasa') }}">
                </div>

                <div class="col-md-6">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" name="senha" id="senha" class="form-control" required>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('login.usuario', ['tipo' => 'hospede']) }}"  class="btn btn-secondary">Já tenho conta</a>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
    </div>
</div>
@endsection
