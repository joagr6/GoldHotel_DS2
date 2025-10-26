@extends('base')

@section('titulo', 'Área do Hóspede')

@section('conteudo')
    <h2>Olá, {{ $hospede->nome }}!</h2>
    <p>Seja bem-vindo ao sistema do <strong>GoldHotel</strong>.</p>

    <div style="margin-top: 20px;">
        <a href="{{ route('reserva.create') }}">
            <button>Fazer Reserva</button>
        </a>

        <a href="{{ route('reserva.index') }}">
            <button>Minhas Reservas</button>
        </a>

        <a href="{{ route('hospede.dados') }}">
            <button>Meus Dados</button>
        </a>

        <a href="{{ route('hospede.logout') }}">
            <button style="background-color:red;color:white;">Sair</button>
        </a>
    </div>
@endsection
