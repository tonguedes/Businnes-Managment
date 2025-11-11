<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Painel de Navegação Rápida') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-2xl sm:rounded-lg p-10">
            
            <h3 class="text-3xl font-extrabold text-gray-800 mb-10 text-center">
                Selecione o Módulo de Gestão
            </h3>
            
            <!-- Grade de Módulos (Ajustado o estilo para maior clareza e espaço) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                <!-- Botão 1: Grupos Econômicos -->
                <a href="{{ route('grupos.index') }}" 
                    class="flex flex-col items-center justify-center p-6 h-40 bg-indigo-600 text-white rounded-xl shadow-2xl hover:bg-indigo-700 transition duration-300 transform hover:scale-[1.05] focus:outline-none focus:ring-4 focus:ring-indigo-300/80 text-center">
                    <svg class="h-10 w-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h-5v-5h5v5zm-5-10H5v5h5v-5zm7-5H5v5h12v-5z"/></svg>
                    <span class="text-xl font-bold">Grupos Econômicos</span>
                    <span class="text-sm opacity-90 mt-1">Empresas e Holdings</span>
                </a>

                <!-- Botão 2: Bandeiras -->
                <a href="{{ route('bandeiras.index') }}" 
                    class="flex flex-col items-center justify-center p-6 h-40 bg-green-600 text-white rounded-xl shadow-2xl hover:bg-green-700 transition duration-300 transform hover:scale-[1.05] focus:outline-none focus:ring-4 focus:ring-green-300/80 text-center">
                    <svg class="h-10 w-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span class="text-xl font-bold">Bandeiras</span>
                    <span class="text-sm opacity-90 mt-1">Marcas e Franquias</span>
                </a>
                
                <!-- Botão 3: Unidades -->
                <a href="{{ route('unidades.index') }}" 
                    class="flex flex-col items-center justify-center p-6 h-40 bg-yellow-500 text-gray-800 rounded-xl shadow-2xl hover:bg-yellow-600 transition duration-300 transform hover:scale-[1.05] focus:outline-none focus:ring-4 focus:ring-yellow-300/80 text-center">
                    <svg class="h-10 w-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5M12 7h.01"/></svg>
                    <span class="text-xl font-bold">Unidades</span>
                    <span class="text-sm opacity-90 mt-1">Lojas e Filiais</span>
                </a>

                <!-- Botão 4: Colaboradores -->
                <a href="{{ route('colaboradores.index') }}" 
                    class="flex flex-col items-center justify-center p-6 h-40 bg-red-600 text-white rounded-xl shadow-2xl hover:bg-red-700 transition duration-300 transform hover:scale-[1.05] focus:outline-none focus:ring-4 focus:ring-red-300/80 text-center">
                    <svg class="h-10 w-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H9a1 1 0 01-1-1v-1a4 4 0 014-4h2a4 4 0 014 4v1a1 1 0 01-1 1z"/></svg>
                    <span class="text-xl font-bold">Colaboradores</span>
                    <span class="text-sm opacity-90 mt-1">Gestão de Pessoal</span>
                </a>

               
            </div>
            
        </div>
    </div>
</div>


</x-app-layout>