@extends('base')

@section('title', 'Realizar Pagamento - Gold Hotel')

@section('content')

    <h1 class="fw-bold mb-4">Realizar Pagamento</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="bg-white p-4 rounded shadow-sm mb-4">
                <h5 class="mb-3">Detalhes da Reserva</h5>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Quarto:</strong> {{ $reserva->quarto->tipoQuarto }}
                    </div>
                    <div class="col-md-6">
                        <strong>Capacidade:</strong> {{ $reserva->quarto->capacidade }} pessoa(s)
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Data de Entrada:</strong> 
                        {{ \Carbon\Carbon::parse($reserva->data_entrada)->format('d/m/Y') }}
                    </div>
                    <div class="col-md-6">
                        <strong>Data de Saída:</strong> 
                        {{ \Carbon\Carbon::parse($reserva->data_saida)->format('d/m/Y') }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Número de Diárias:</strong> {{ $dias }}
                    </div>
                    <div class="col-md-6">
                        <strong>Valor da Diária:</strong> 
                        R$ {{ number_format($reserva->quarto->valorDiaria, 2, ',', '.') }}
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Valor Total:</h5>
                    <h4 class="mb-0 text-primary fw-bold">
                        R$ {{ number_format($valorTotal, 2, ',', '.') }}
                    </h4>
                </div>
            </div>

            <div class="bg-white p-4 rounded shadow-sm">
                <h5 class="mb-3">Forma de Pagamento</h5>

                <form method="POST" action="{{ route('pagamento.store', $reserva->id) }}">
                    @csrf

                    <input type="hidden" name="valor" value="{{ $valorTotal }}">

                    <div class="mb-3">
                        <label class="form-label">Selecione o método de pagamento</label>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-check border rounded p-3 h-100">
                                    <input class="form-check-input" type="radio" name="metodo_pagamento" 
                                           id="cartao_credito" value="cartao_credito" required>
                                    <label class="form-check-label" for="cartao_credito">
                                        <strong>Cartão de Crédito</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check border rounded p-3 h-100">
                                    <input class="form-check-input" type="radio" name="metodo_pagamento" 
                                           id="cartao_debito" value="cartao_debito" required>
                                    <label class="form-check-label" for="cartao_debito">
                                        <strong>Cartão de Débito</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check border rounded p-3 h-100">
                                    <input class="form-check-input" type="radio" name="metodo_pagamento" 
                                           id="pix" value="pix" required>
                                    <label class="form-check-label" for="pix">
                                        <strong>PIX</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check border rounded p-3 h-100">
                                    <input class="form-check-input" type="radio" name="metodo_pagamento" 
                                           id="dinheiro" value="dinheiro" required>
                                    <label class="form-check-label" for="dinheiro">
                                        <strong>Dinheiro</strong>
                                    </label>
                                </div>
                            </div>
                        </div>
                        @error('metodo_pagamento')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i>
                        <strong>Importante:</strong> Após confirmar o pagamento, você receberá um comprovante da transação.
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            Confirmar Pagamento
                        </button>
                        <a href="{{ route('hospede.dashboard') }}" class="btn btn-secondary btn-lg">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-4">
            <div class="bg-light p-4 rounded shadow-sm">
                <h6 class="fw-bold mb-3">Resumo do Pagamento</h6>
                <div class="mb-2">
                    <small class="text-muted">Reserva #{{ $reserva->id }}</small>
                </div>
                <div class="mb-2">
                    <small class="text-muted">Diárias:</small>
                    <div class="fw-semibold">{{ $dias }} {{ $dias == 1 ? 'diária' : 'diárias' }}</div>
                </div>
                <div class="mb-2">
                    <small class="text-muted">Valor por diária:</small>
                    <div class="fw-semibold">R$ {{ number_format($reserva->quarto->valorDiaria, 2, ',', '.') }}</div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <strong>Total:</strong>
                    <h5 class="mb-0 text-primary">R$ {{ number_format($valorTotal, 2, ',', '.') }}</h5>
                </div>
            </div>
        </div>
    </div>

@endsection

