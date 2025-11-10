<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-2xl sm:rounded-xl p-6 lg:p-8">

            <h2 class="text-3xl font-extrabold text-gray-900 leading-tight mb-8 border-b border-indigo-100 pb-4">
                Gestão de Unidades
            </h2>

            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 space-y-4 sm:space-y-0">
                <div class="w-full sm:w-2/5 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input wire:model.live.debounce.300ms="search" type="text"
                            placeholder="Buscar por Nome Fantasia ou CNPJ..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm transition duration-150 ease-in-out">
                </div>

                <button wire:click="openModal()"
                        class="flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-6 rounded-lg shadow-lg transition duration-150 ease-in-out transform hover:scale-[1.01]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Nova Unidade
                </button>
            </div>

            <div class="overflow-x-auto border border-gray-200 rounded-xl shadow-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-indigo-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nome Fantasia</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Razão Social</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">CNPJ</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Bandeira</th>
                            <th scope="col" class="relative px-6 py-3"><span class="sr-only">Ações</span></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($unidades as $unidade)
                            <tr wire:key="unidade-{{ $unidade->id }}" class="hover:bg-indigo-50/30 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-gray-900">{{ $unidade->nome_fantasia }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $unidade->razao_social }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $unidade->cnpj }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-600 font-medium">
                                    {{ $unidade->bandeira->nome ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                                    <button wire:click="openModal({{ $unidade->id }})" class="text-indigo-600 hover:text-indigo-800 font-medium transition duration-150">
                                        Editar
                                    </button>
                                    <button wire:click="confirmDelete({{ $unidade->id }}, '{{ $unidade->nome_fantasia }}')" class="text-red-600 hover:text-red-800 font-medium transition duration-150">
                                        Excluir
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500 bg-gray-50/50">
                                    <h3 class="mt-2 text-sm font-semibold text-gray-900">Nenhuma unidade encontrada</h3>
                                    <p class="mt-1 text-sm text-gray-500">Comece criando uma nova unidade.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-8">
                {{ $unidades->links() }}
            </div>

        </div>
    </div>
    
    @include('livewire.unidade.partials.modal-form')
    @include('livewire.partials.delete-script')
</div>