@extends('base')

@section('title', 'Lista de Quartos')

@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #1e3c72, #2a5298);
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding-top: 120px; /* evita que o título fique por baixo da navbar */
    }

    .navbar-brand span {
        display: block;
        font-size: 0.8rem;
        font-weight: normal;
        color: #dcdcdc;
    }

    h1 {
        color: #ffffff;
        margin-bottom: 30px;
        text-shadow: 0 2px 6px rgba(0,0,0,0.35);
    }

    .card {
        overflow: hidden;
        border-radius: 14px;
        background: #ffffffee;
        transition: transform 0.25s, box-shadow 0.25s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.25);
    }

    .card-title {
        font-weight: 700;
        color: #1e3c72;
    }

    .btn-primary {
        background: #1e3c72;
        border: none;
    }

    .btn-primary:hover {
        background: #162c54;
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
        background: rgba(255,255,255,0.3);
    }
</style>
<a href="{{ url('/hospede/dashboard') }}" class="btn-back">←</a>
@endpush




@section('content')

    <h1 class="text-center">Lista de Quartos</h1>

    <div class="row g-4">
        @forelse ($quartos as $quarto)
            <div class="col-12 col-sm-6 col-md-4">
                <div class="card h-100">

                    {{-- Imagem --}}
                    @if ($quarto->imagem)
                        <img src="{{ asset('storage/' . $quarto->imagem) }}" 
                             class="card-img-top" 
                             alt="{{ $quarto->tipoQuarto }}"
                             style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top d-flex align-items-center justify-content-center bg-dark text-white"
                             style="height: 200px;">
                            Sem imagem
                        </div>
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $quarto->tipoQuarto }}</h5>

                        <p class="card-text mb-1">
                            <strong>Capacidade:</strong> {{ $quarto->capacidade }}
                        </p>

                        <p class="card-text mb-1">
                            <strong>Valor da Diária:</strong>
                            R$ {{ number_format($quarto->valorDiaria, 2, ',', '.') }}
                        </p>

                        <p class="card-text mb-3">
                            <strong>Status:</strong>
                            @if (strtolower($quarto->status) === 'disponível')
                                <span class="status-disponivel">Disponível</span>
                            @else
                                <span class="status-indisponivel">{{ ucfirst($quarto->status) }}</span>
                            @endif
                        </p>

                        {{-- Botão reservar --}}
                        <a href="{{ strtolower($quarto->status) === 'disponível' ? route('reserva.create', ['quarto_id' => $quarto->id]) : '#' }}"
                           class="btn btn-primary w-100 {{ strtolower($quarto->status) !== 'disponível' ? 'disabled' : '' }}">
                            Reservar
                        </a>

                    </div>
                </div>
            </div>

        @empty
            <div class="col-12 text-center text-light">
                Nenhum quarto cadastrado no sistema.
            </div>
        @endforelse
    </div>

@endsection
