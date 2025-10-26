@extends('base')

@section('titulo', 'Cadastro de Hóspede')

@section('conteudo')
<h2>Cadastro de Hóspede</h2>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('hospede.store') }}">
    @csrf

    <label>Nome completo:</label><br>
    <input type="text" name="nome" value="{{ old('nome') }}" required><br><br>

    <label>CPF:</label><br>
    <input type="text" name="cpf" value="{{ old('cpf') }}" required><br><br>

    <label>Data de nascimento:</label><br>
    <input type="date" name="data_nascimento" value="{{ old('data_nascimento') }}" required><br><br>

    <label>Telefone:</label><br>
    <input type="text" name="telefone" value="{{ old('telefone') }}"><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="{{ old('email') }}"><br><br>

    <label>Cidade:</label><br>
    <input type="text" name="cidade" value="{{ old('cidade') }}"><br><br>

    <label>Rua:</label><br>
    <input type="text" name="rua" value="{{ old('rua') }}"><br><br>

    <label>Número da casa:</label><br>
    <input type="text" name="numcasa" value="{{ old('numcasa') }}"><br><br>

    <label>Senha:</label><br>
    <input type="password" name="senha" required><br><br>

    <label>Confirmar senha:</label><br>
    <input type="password" name="senha_confirmation" required><br><br>

    <button type="submit">Cadastrar</button>
</form>

<br>
<a href="{{ route('hospede.login') }}">
    <button type="button">Voltar para o Login</button>
</a>
@endsection
