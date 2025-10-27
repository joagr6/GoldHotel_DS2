@extends('base')

@section('titulo', 'Login do Administrador')

@section('content')
<h2>Login do Administrador</h2>

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

<form method="POST" action="{{ route('login.admin.post') }}">
    @csrf
    <label>CPF:</label><br>
    <input type="text" name="cpf" placeholder="Digite seu CPF" required><br><br>

    <label>Senha:</label><br>
    <input type="password" name="senha" placeholder="Digite sua senha" required><br><br>

    <button type="submit">Entrar</button>
</form>
@endsection
