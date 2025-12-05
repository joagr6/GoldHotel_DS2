@extends('base')

@section('title', 'Dashboard do Hóspede')

@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #1e3c72, #2a5298);
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding-top: 120px;
    }

    h1 {
        color: #ffffff;
        text-shadow: 0 2px 6px rgba(0,0,0,0.35);
        margin-bottom: 10px;
    }

    p {
        color: #e5e5e5;
        margin-bottom: 25px;
    }

    .card-custom {
        background: #ffffffee;
        border-radius: 14px;
        padding: 25px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.20);
        margin-bottom: 35px;
    }

    .list-group-item {
        border: none;
        padding: 18px 10px;
        border-bottom: 1px solid #e9e9e9;
    }

    .list-group-item:last-child {
        border-bottom: none;
    }

    .fw-semibold {
        color: #1e3c72;
        font-weight: 600;
    }

    .badge {
        font-size: 0.75rem;
        padding: 6px 10px;
        border-radius: 8px;
    }

    .btn {
        font-weight: 600;
        border-radius: 8px !important;
    }

    .btn-primary {
        background: #1e3c72;
        border: none;
    }

    .btn-primary:hover {
        background: #15274d;
    }

    .btn-outline-warning {
        border-width: 2px;
    }

    .btn-outline-danger {
        border-width: 2px;
    }

    .btn-outline-primary {
        border-width: 2px;
    }
</style>
@endpush

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h1 class="fw-bold m-0">Minhas Reservas</h1>
        <p class="m-0">Veja suas reservas ativas e passadas.</p>
    </div>

    <a href="{{ route('quarto.dashboard') }}" class="btn btn-light fw-semibold shadow-sm">
        + Reservar Quarto
    </a>
</div>


    @if (session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    {{-- RESERVAS ATIVAS --}}
    <div class="card-custom">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0 fw-bold" style="color:#1e3c72;">Reservas Ativas</h5>
            
        </div>

        @if(isset($ativas) && $ativas->count())
            <div class="list-group">
                @foreach ($ativas as $res)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                       <div class="fw-semibold">{{ optional($res->quarto)->tipoQuarto }}</div>

<small>
    {{ \Carbon\Carbon::parse($res->data_entrada)->format('d/m/Y') }} –
    {{ \Carbon\Carbon::parse($res->data_saida)->format('d/m/Y') }}
</small>

{{-- SERVIÇOS ADICIONAIS --}}
@if ($res->servicos->count())
    <div class="mt-1">
        @foreach ($res->servicos as $serv)
            <span class="badge bg-primary">{{ $serv->nome }}</span>
        @endforeach
    </div>
@else
    <div class="mt-1">
        <span class="badge bg-secondary">Sem serviços adicionais</span>
    </div>
@endif

                        <div class="d-flex align-items-center gap-2">

                            <span class="badge bg-success">
                                {{ ucfirst($res->status) }}
                            </span>

                            @if(!$res->pagamento)
                                <a href="{{ route('pagamento.create', $res->id) }}" 
                                   class="btn btn-success btn-sm">
                                    💳 Pagar
                                </a>
                            @else
                                <span class="badge bg-info">Pago</span>
                            @endif

                            <a href="{{ route('reserva.edit', $res->id) }}" 
                               class="btn btn-outline-warning btn-sm">
                                ✏️ Editar
                            </a>

                            <a href="{{ route('reserva.comprovante', $res->id) }}" 
                               class="btn btn-outline-primary btn-sm" 
                               target="_blank">
                                📄 Comprovante
                            </a>

                            <form method="POST"
                                  action="{{ route('reserva.destroy', $res->id) }}"
                                  onsubmit="return confirm('Deseja realmente cancelar esta reserva?');">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    Cancelar
                                </button>
                            </form>

                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted mb-0">Você não possui reservas ativas.</p>
        @endif
    </div>

    {{-- RESERVAS PASSADAS --}}
<div class="card-custom">
    <h5 class="mb-3 fw-bold" style="color:#1e3c72;">Reservas passadas</h5>

    @if(isset($passadas) && $passadas->count())
        <div class="list-group">
            @foreach ($passadas as $res)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fw-semibold">{{ optional($res->quarto)->tipoQuarto }}</div>
                        <small>
                            {{ \Carbon\Carbon::parse($res->data_entrada)->format('d/m/Y') }} –
                            {{ \Carbon\Carbon::parse($res->data_saida)->format('d/m/Y') }}
                        </small>
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-secondary">{{ ucfirst($res->status) }}</span>

                        <a href="{{ route('reserva.comprovante', $res->id) }}" 
                           class="btn btn-outline-primary btn-sm" 
                           target="_blank">
                            📄 Comprovante
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted mb-0">Sem histórico de reservas.</p>
    @endif
</div>


@endsection
