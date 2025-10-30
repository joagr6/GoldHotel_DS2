@extends('base')

@section('titulo', 'Login do Hóspede')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #1e3c72, #2a5298);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        font-family: 'Poppins', sans-serif;
    }

    .wave-background {
        position: absolute;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 0% 0%, rgba(255,255,255,0.05) 0%, transparent 70%),
                    radial-gradient(circle at 100% 100%, rgba(255,255,255,0.05) 0%, transparent 70%);
        z-index: 0;
    }

    .login-card {
        position: relative;
        z-index: 1;
        background: white;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        width: 400px;
        padding: 40px 35px;
        text-align: center;
        animation: fadeIn 0.8s ease;
    }

    .login-card h4 {
        color: #1e3c72;
        font-weight: 600;
        margin-top: 10px;
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

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(20px);}
        to {opacity: 1; transform: translateY(0);}
    }

    .logo {
        width: 120px;
        height: auto;
        margin-bottom: 10px;
    }
</style>

<a href="{{ url('/') }}" class="btn-back">←</a>

<div class="wave-background"></div>

<div class="login-card">
    {{-- Logo do Hotel --}}
    <img src="{{ asset('images/hotel_logo.jpg') }}" alt="Logo do Hotel" class="logo">

    <h4>
        @if ($tipo === 'admin')
            Login do Administrador
        @else
            Login do Hóspede
        @endif
    </h4>

    <p class="text-muted mb-4">
        {{ $tipo === 'admin' ? 'Acesse o painel de administração' : 'Entre na sua conta' }}
    </p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST"
          action="{{ $tipo === 'admin' ? route('login.admin.post') : route('hospede.login.post') }}">
        @csrf

        <div class="mb-3 text-start">
            <label class="form-label">CPF</label>
            <input type="text" name="cpf" class="form-control" placeholder="Digite seu CPF" required>
        </div>

        <div class="mb-3 text-start">
            <label class="form-label">Senha</label>
            <input type="password" name="senha" class="form-control" placeholder="Digite sua senha" required>
        </div>

        <button type="submit" class="btn btn-primary w-100 mt-2">Entrar</button>
    </form>

    @if ($tipo !== 'admin')
        <div class="mt-4">
            <p class="text-muted">Ainda não tem conta?</p>
            <a href="{{ route('hospede.cadastro') }}" class="btn btn-outline-primary w-100">Cadastrar-se</a>
        </div>
    @endif
</div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    