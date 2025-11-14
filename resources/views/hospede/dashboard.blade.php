@extends('base')

@section('title', 'Dashboard do Hóspede')

@section('content')

    <h1 class="fw-bold">Minhas Reservas</h1>
    <p>Veja suas reservas ativas e passadas.</p>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="bg-white p-4 rounded shadow-sm mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Reservas ativas</h5>
            <a href="{{ route('quarto.dashboard') }}" class="btn btn-primary btn-sm">Reservar quarto</a>
        </div>

        @if(isset($ativas) && $ativas->count())
            <div class="list-group">
                @foreach ($ativas as $res)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-semibold">{{ optional($res->quarto)->tipoQuarto }}</div>
                            <small>{{ \Carbon\Carbon::parse($res->data_entrada)->format('d/m/Y') }} -
                                   {{ \Carbon\Carbon::parse($res->data_saida)->format('d/m/Y') }}</small>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-success">{{ ucfirst($res->status) }}</span>

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


    <div class="bg-white p-4 rounded shadow-sm">
        <h5 class="mb-3">Reservas passadas</h5>

        @if(isset($passadas) && $passadas->count())
            <div class="list-group">
                @foreach ($passadas as $res)
                    <div class="list-group-item d-flex justify-content-between">
                        <div>
                            <div class="fw-semibold">{{ optional($res->quarto)->tipoQuarto }}</div>
                            <small>{{ \Carbon\Carbon::parse($res->data_entrada)->format('d/m/Y') }} -
                                   {{ \Carbon\Carbon::parse($res->data_saida)->format('d/m/Y') }}</small>
                        </div>

                        <span class="badge bg-secondary align-self-center">{{ ucfirst($res->status) }}</span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted mb-0">Sem histórico de reservas.</p>
        @endif
    </div>

@endsection
