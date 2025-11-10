<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-2xl sm:rounded-xl p-6 lg:p-8">

            <h2 class="text-3xl font-extrabold text-gray-900 leading-tight mb-8 border-b border-indigo-100 pb-4">
                Gestão de Colaboradores
            </h2>

            <div class="bg-gray-50 p-5 rounded-xl shadow-inner mb-6 space-y-4">
                
                <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center space-y-3 sm:space-y-0 sm:space-x-4">
                    
                    <div class="relative w-full sm:w-2/5">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Buscar por Nome ou Email..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm transition duration-150 ease-in-out">
                    </div>
                    
                    <div class="flex flex-row space-x-3 w-full sm:w-auto">
                        <button wire:click="openModal()"
                                class="flex-1 sm:flex-none flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-6 rounded-lg shadow-lg transition duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Novo
                        </button>
                        <button wire:click="exportExcel" wire:loading.attr="disabled" wire:target="exportExcel"
                                class="flex-1 sm:flex-none flex items-center justify-center bg-green-600 hover:bg-green-700 text-black font-semibold py-2.5 px-6 rounded-lg shadow-lg transition duration-150 disabled:opacity-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 16V9M11 16V9M15 16V9M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2z" />
                            </svg>
                            Exportar
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 pt-4 border-t border-gray-200">
                    
                    <div>
                        <label for="filter_cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                        <input wire:model.live.debounce.300ms="filter_cpf" type="text" id="filter_cpf" placeholder="Filtrar por CPF..."
                                class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm">
                    </div>

                    <div>
                        <label for="filter_bandeira" class="block text-sm font-medium text-gray-700">Bandeira</label>
                        <select wire:model.live="filter_bandeira_id" id="filter_bandeira" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm">
                            <option value="">Todas</option>
                            @foreach($bandeiras as $bandeira)
                                <option value="{{ $bandeira->id }}">{{ $bandeira->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="filter_unidade" class="block text-sm font-medium text-gray-700">Unidade</label>
                        <select wire:model.live="filter_unidade_id" id="filter_unidade" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm">
                            <option value="">Todas</option>
                            @foreach($unidades as $unidade)
                                <option value="{{ $unidade->id }}">{{ $unidade->nome_fantasia }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Lista Responsiva: Tabela em Desktop, Cards em Mobile -->
            <div class="space-y-4 md:hidden">
                @forelse ($colaboradores as $colaborador)
                    <div wire:key="colaborador-mobile-{{ $colaborador->id }}" class="bg-white p-4 rounded-lg shadow border border-gray-200">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-bold text-gray-900">{{ $colaborador->nome }}</p>
                                <p class="text-sm text-gray-600">{{ $colaborador->email }}</p>
                                <p class="text-sm text-gray-500">CPF: {{ $colaborador->cpf }}</p>
                            </div>
                            <div class="flex items-center space-x-1 flex-shrink-0">
                                <button wire:click="openModal({{ $colaborador->id }})" title="Editar" class="text-indigo-600 hover:text-indigo-800 p-1 rounded transition duration-150">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </button>
                                <button wire:click="confirmDelete({{ $colaborador->id }}, '{{ $colaborador->nome }}')" title="Excluir" class="text-red-600 hover:text-red-800 p-1 rounded transition duration-150">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                </button>
                            </div>
                        </div>
                        <div class="mt-3 pt-3 border-t border-gray-100 text-sm">
                            <p><span class="font-semibold">Unidade:</span> <span class="text-indigo-600">{{ $colaborador->unidade->nome_fantasia ?? 'N/A' }}</span></p>
                            <p><span class="font-semibold">Bandeira:</span> {{ $colaborador->unidade->bandeira->nome ?? 'N/A' }}</p>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-12 text-center text-gray-500 bg-gray-50/50 rounded-lg">
                        <h3 class="mt-2 text-sm font-semibold text-gray-900">Nenhum colaborador encontrado</h3>
                        <p class="mt-1 text-sm text-gray-500">Tente remover alguns filtros.</p>
                    </div>
                @endforelse
            </div>

            <div class="hidden md:block overflow-x-auto border border-gray-200 rounded-xl shadow-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-indigo-50">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Nome</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">CPF</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Unidade</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Bandeira</th>
                            <th scope="col" class="px-2 py-3 w-20"><span class="sr-only">Ações</span></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($colaboradores as $colaborador)
                            <tr wire:key="colaborador-desktop-{{ $colaborador->id }}" class="hover:bg-indigo-50/30 transition duration-150">
                                <td class="px-4 py-4 font-medium text-gray-900">{{ $colaborador->nome }}</td>
                                <td class="px-4 py-4 text-sm text-gray-800">{{ $colaborador->email }}</td>
                                <td class="px-4 py-4 text-sm text-gray-600">{{ $colaborador->cpf }}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-indigo-600 font-medium">{{ $colaborador->unidade->nome_fantasia ?? 'N/A' }}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 font-medium">{{ $colaborador->unidade->bandeira->nome ?? 'N/A' }}</td>
                                <td class="px-2 py-4 text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-1">
                                        <button wire:click="openModal({{ $colaborador->id }})" title="Editar" class="text-indigo-600 hover:text-indigo-800 p-1 rounded transition duration-150">
                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                        </button>
                                        <button wire:click="confirmDelete({{ $colaborador->id }}, '{{ $colaborador->nome }}')" title="Excluir" class="text-red-600 hover:text-red-800 p-1 rounded transition duration-150">
                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500 bg-gray-50/50">
                                    <h3 class="mt-2 text-sm font-semibold text-gray-900">Nenhum colaborador encontrado</h3>
                                    <p class="mt-1 text-sm text-gray-500">Tente remover alguns filtros.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-8">
                {{ $colaboradores->links() }}
            </div>

        </div>
    </div>
    
    @include('livewire.colaborador.partials.modal-form')
    @include('livewire.partials.delete-script')
</div>