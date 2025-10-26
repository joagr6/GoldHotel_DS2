@extends('base')

@section('title', 'Dashboard do Hóspede')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col">
    <!-- Barra superior -->
    <nav class="bg-blue-700 p-4 shadow-md flex justify-between items-center">
        <div class="text-lg font-semibold">
            Olá, {{ Auth::guard('hospede')->user()->nome }} 👋
        </div>
        <div>
            <a href="{{ route('hospede.logout') }}" 
               class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-md text-sm">
               Sair
            </a>
        </div>
    </nav>

    <!-- Conteúdo principal -->
    <main class="flex-1 p-8">
        <h1 class="text-2xl font-bold mb-4">Bem-vindo à sua área, {{ Auth::guard('hospede')->user()->nome }}!</h1>
        <p class="text-gray-700 mb-6">
            Aqui você pode gerenciar suas reservas, atualizar seus dados e acessar informações exclusivas do hotel.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                <h2 class="text-xl font-semibold mb-2">Minhas Reservas</h2>
                <p class="text-gray-600">Veja suas reservas ativas e passadas.</p>
                <!-- <a href="{{ route('reserva.index') }}" class="text-blue-600 hover:underline">Acessar</a> -->
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                <h2 class="text-xl font-semibold mb-2">Atualizar Perfil</h2>
                <p class="text-gray-600">Altere seus dados pessoais e senha.</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                <h2 class="text-xl font-semibold mb-2">Ajuda e Suporte</h2>
                <p class="text-gray-600">Entre em contato com nossa equipe de atendimento.</p>
                <a href="#" class="text-blue-600 hover:underline">Contato</a>
            </div>
        </div>
    </main>
</div>
@endsection
