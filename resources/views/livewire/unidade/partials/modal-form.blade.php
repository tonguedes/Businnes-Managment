<div x-data x-show="$wire.isModalOpen" 
    class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
    
    <div x-show="$wire.isModalOpen" x-transition.opacity.duration.300ms 
         @click.self="$wire.closeModal()" 
         class="fixed inset-0 bg-gray-900/75 transition-opacity">
    </div>

    <div class="flex items-center justify-center min-h-screen p-4">
        <div x-show="$wire.isModalOpen" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="bg-white rounded-xl shadow-2xl transform transition-all sm:max-w-xl sm:w-full z-10 overflow-hidden text-gray-900">
            
            <form wire:submit.prevent="save">
                <div class="p-6">
                    <h3 class="text-2xl font-bold leading-6 text-gray-900 mb-6" 
                        x-text="$wire.editingId ? 'Editar Unidade' : 'Criar Nova Unidade'">
                    </h3>
                    
                    <div class="mb-4">
                        <label for="bandeira_id" class="block text-sm font-medium text-gray-700">Bandeira</label>
                        <select wire:model="bandeira_id" id="bandeira_id"
                               class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-gray-900"
                               required>
                                <option value="" disabled selected>Selecione uma bandeira</option>
                                @foreach($bandeiras as $bandeira)
                                    <option value="{{ $bandeira->id }}">{{ $bandeira->nome }}</option>
                                @endforeach
                        </select>
                        @error('bandeira_id') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="nome_fantasia" class="block text-sm font-medium text-gray-700">Nome Fantasia</label>
                        <input wire:model="nome_fantasia" type="text" id="nome_fantasia"
                               class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-gray-900"
                               required>
                        @error('nome_fantasia') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="razao_social" class="block text-sm font-medium text-gray-700">Razão Social</label>
                        <input wire:model="razao_social" type="text" id="razao_social"
                               class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-gray-900"
                               required>
                        @error('razao_social') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="cnpj" class="block text-sm font-medium text-gray-700">CNPJ</label>
                        <input wire:model="cnpj" type="text" id="cnpj"
                               class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-gray-900"
                               required>
                        @error('cnpj') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                </div>

                <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse space-x-3">
                    <button type="submit" 
                            class="w-full sm:w-auto inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 transition duration-150">
                        <span x-text="$wire.editingId ? 'Salvar Alterações' : 'Criar Unidade'"></span>
                    </button>
                    <button @click.prevent="$wire.closeModal()" type="button" 
                            class="mt-3 sm:mt-0 w-full sm:w-auto inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-100 transition duration-150">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- O script Alpine/Axios foi removido pois a lógica agora é controlada pelo componente Livewire --}}