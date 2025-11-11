<div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Logs de Auditoria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-lg">
                
                <!-- Filtros -->
                <div class="p-6 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Filtrar Registros</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Filtro por Entidade -->
                        <div>
                            <label for="auditable_type" class="block text-sm font-medium text-gray-700">Entidade</label>
                            <select wire:model.live="auditable_type" id="auditable_type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">Todas</option>
                                @foreach($auditable_types as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filtro por Usuário -->
                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-700">Usuário</label>
                            <select wire:model.live="user_id" id="user_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">Todos</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filtro por Evento -->
                        <div>
                            <label for="event" class="block text-sm font-medium text-gray-700">Ação</label>
                            <select wire:model.live="event" id="event" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">Todas</option>
                                <option value="created">Criação</option>
                                <option value="updated">Atualização</option>
                                <option value="deleted">Exclusão</option>
                            </select>
                        </div>

                        <!-- Botão de Limpar Filtros -->
                        <div class="flex items-end">
                            <button wire:click="resetFilters" class="w-full justify-center inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Limpar Filtros
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tabela de Logs -->
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuário</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ação</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entidade</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valores Antigos</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valores Novos</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($audits as $audit)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $audit->user->name ?? 'Sistema' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($audit->event == 'created') bg-green-100 text-green-800 @endif
                                                @if($audit->event == 'updated') bg-yellow-100 text-yellow-800 @endif
                                                @if($audit->event == 'deleted') bg-red-100 text-red-800 @endif">
                                                {{ $audit->event }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ class_basename($audit->auditable_type) }} (ID: {{ $audit->auditable_id }})</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            <pre class="whitespace-pre-wrap text-xs">@json($audit->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)</pre>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            <pre class="whitespace-pre-wrap text-xs">@json($audit->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)</pre>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $audit->created_at->format('d/m/Y H:i:s') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Nenhum registro de auditoria encontrado.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $audits->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>