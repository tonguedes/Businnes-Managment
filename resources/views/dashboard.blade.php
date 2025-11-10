<x-app-layout>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Painel de Navegação Rápida') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-10">
                
                <h3 class="text-3xl font-bold text-gray-800 mb-8 text-center">
                    Selecione o Módulo de Gestão
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    <a href="{{ route('grupos.index') }}" 
                       class="flex flex-col items-center justify-center p-8 bg-indigo-600 text-white rounded-xl shadow-lg hover:bg-indigo-700 transition duration-300 transform hover:scale-[1.03]">
                        <svg class="h-10 w-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h-5v-5h5v5zm-5-10H5v5h5v-5zm7-5H5v5h12v-5z"/></svg>
                        <span class="text-lg font-bold">Grupos Econômicos</span>
                        <span class="text-sm opacity-75 mt-1">Empresas e Holdings</span>
                    </a>

                    <a href="{{ route('bandeiras.index') }}" 
                       class="flex flex-col items-center justify-center p-8 bg-green-600 text-white rounded-xl shadow-lg hover:bg-green-700 transition duration-300 transform hover:scale-[1.03]">
                        <svg class="h-10 w-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span class="text-lg font-bold">Bandeiras</span>
                        <span class="text-sm opacity-75 mt-1">Marcas e Franquias</span>
                    </a>
                    
                    <a href="{{ route('unidades.index') }}" 
                       class="flex flex-col items-center justify-center p-8 bg-yellow-600 text-black rounded-xl shadow-lg hover:bg-yellow-700 transition duration-300 transform hover:scale-[1.03]">
                        <svg class="h-10 w-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5M12 7h.01"/></svg>
                        <span class="text-lg font-bold">Unidades</span>
                        <span class="text-sm opacity-75 mt-1">Lojas e Filiais</span>
                    </a>

                    <a href="{{ route('colaboradores.index') }}" 
                       class="flex flex-col items-center justify-center p-8 bg-red-600 text-white rounded-xl shadow-lg hover:bg-red-700 transition duration-300 transform hover:scale-[1.03]">
                        <svg class="h-10 w-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H9a1 1 0 01-1-1v-1a4 4 0 014-4h2a4 4 0 014 4v1a1 1 0 01-1 1z"/></svg>
                        <span class="text-lg font-bold">Colaboradores</span>
                        <span class="text-sm opacity-75 mt-1">Gestão de Pessoal</span>
                    </a>
                </div>
                
                <p class="text-center text-gray-500 text-sm mt-8">
                    Para visualizar o histórico de Auditoria, edite um Colaborador.
                </p>

            </div>
        </div>
    </div>
</x-app-layout>