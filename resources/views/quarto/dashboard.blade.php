@extends('base')

@section('title', 'Lista de Quartos')

@push('styles')
<style>
    body {
        background-color: #f8f9fa;
    }
    .navbar-brand span {
        display: block;
        font-size: 0.8rem;
        font-weight: normal;
        color: #dcdcdc;
    }
    .card:hover {
        transform: scale(1.02);
        transition: 0.3s ease;
    }
</style>
@endpush

@section('content')

    <h1 class="fw-bold mb-4 text-center">Lista de Quartos</h1>

    <div class="row g-4">
        @forelse ($quartos as $quarto)
            <div class="col-12 col-sm-6 col-md-4">
                <div class="card shadow-sm h-100">
                    @if ($quarto->imagem)
                        <img src="{{ asset('storage/' . $quarto->imagem) }}" 
                             class="card-img-top" 
                             alt="{{ $quarto->tipoQuarto }}"
                             style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" 
                             style="height: 200px;">
                            <span class="text-white">Sem imagem</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $quarto->tipoQuarto }}</h5>
                        

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
                                <span class="text-success fw-semibold">Disponível</span>
                            @else
                                <span class="text-danger fw-semibold">{{ ucfirst($quarto->status) }}</span>
                            @endif
                        </p>

                        <a href="{{ strtolower($quarto->status) === 'disponível' ? route('reserva.create', ['quarto_id' => $quarto->id]) : '#' }}"
                           class="btn btn-primary w-100 {{ strtolower($quarto->status) !== 'disponível' ? 'disabled' : '' }}">
                            Reservar
                        </a>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                Nenhum quarto cadastrado no sistema.
            </div>
        @endforelse
    </div>

@endsection
