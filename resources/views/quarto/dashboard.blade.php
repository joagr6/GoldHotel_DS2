@extends('base')

@section('title', 'Lista de Quartos')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col">

    <nav class="bg-blue-700 text-white p-4 shadow-md flex justify-between items-center">
        <div class="text-lg font-semibold">
            Painel de Quartos
        </div>
        <div>
            <a href="/" class="bg-white text-blue-700 px-3 py-1 rounded-md font-medium hover:bg-gray-200">
                Voltar
            </a>
        </div>
    </nav>

    <main class="flex-1 p-8">
        <h1 class="text-2xl font-bold mb-6">Quartos Cadastrados</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($quartos as $quarto)
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all">
                    <h2 class="text-xl font-semibold text-blue-700 mb-2">{{ $quarto->tipoQuarto }}</h2>

                    <p class="text-gray-700"><strong>Capacidade:</strong> {{ $quarto->capacidade }}</p>
                    <p class="text-gray-700"><strong>Valor da Diária:</strong> 
                        R$ {{ number_format($quarto->valorDiaria, 2, ',', '.') }}
                    </p>
                    <p class="text-gray-700"><strong>Status:</strong>
                        @if ($quarto->status === 'disponível')
                            <span class="text-green-600 font-semibold">Disponível</span>
                        @else
                            <span class="text-red-600 font-semibold">{{ ucfirst($quarto->status) }}</span>
                        @endif
                    </p>

                    <button class="mt-4 w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">
                        Ver Detalhes
                    </button>
                </div>
            @empty
                <p class="text-gray-600 col-span-full">Nenhum quarto cadastrado no sistema.</p>
            @endforelse
        </div>
    </main>
</div>
@endsection
