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
        <h1 class="fw-bold m-0">Serviço Adicional</h1>
        <p class="m-0">Adicione um serviço a sua hospedagem</p>
    </div>
</div>
@endsection
