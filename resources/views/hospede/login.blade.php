@extends('base')

@section('titulo', 'Login do Hóspede')

@section('content')
<h2>Login do Hóspede</h2>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('hospede.login.post') }}">
    @csrf
    <label>CPF:</label><br>
    <input type="text" name="cpf" placeholder="Digite seu CPF" required><br><br>

    <label>Senha:</label><br>
    <input type="password" name="senha" placeholder="Digite sua senha" required><br><br>

    <button type="submit">Entrar</button>
</form>

<br>

<p>Ainda não tem conta?</p>
<a href="{{ route('hospede.cadastro') }}">
    <button type="button">Cadastrar-se</button>
</a>
@endsection
