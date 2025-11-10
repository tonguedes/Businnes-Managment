<div x-data="grupoFormManager()" x-show="$wire.isModalOpen" 
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
             class="bg-white rounded-xl shadow-2xl transform transition-all sm:max-w-md sm:w-full z-10 overflow-hidden text-gray-900"> {{-- Adicionado text-gray-900 aqui --}}
            
            <form @submit.prevent="saveGrupo()">
                <div class="p-6">
                    <h3 class="text-2xl font-bold leading-6 text-gray-900 mb-4" 
                        x-text="$wire.editingId ? 'Editar Grupo Econômico' : 'Criar Novo Grupo Econômico'">
                    </h3>
                    
                    <div class="mt-4">
                        <label for="nome" class="block text-sm font-medium text-gray-700">Nome do Grupo</label>
                        <input x-model="form.nome" type="text" id="nome"
                               class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm"
                               required>
                        <p x-show="errors.nome" x-text="errors.nome" class="text-red-500 text-sm mt-1"></p>
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse space-x-3">
                    <button type="submit" 
                            class="w-full sm:w-auto inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 transition duration-150">
                        <span x-text="$wire.editingId ? 'Salvar Alterações' : 'Criar Grupo'"></span>
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

<script>
    // ... Código JavaScript/Alpine/Axios permanece inalterado ...
    document.addEventListener('alpine:init', () => {
        Alpine.data('grupoFormManager', () => ({
            form: { nome: '' },
            errors: {},
            
            init() {
                this.$wire.on('loadGrupoData', ({ id }) => this.loadGrupo(id));
                this.$wire.on('clearForm', () => this.clearForm());
            },

            loadGrupo(id) {
                Axios.get(`/api/grupos/${id}`)
                .then(response => {
                    this.form.nome = response.data.nome;
                    this.errors = {};
                })
                .catch(error => {
                    console.error("Erro ao carregar dados:", error);
                });
            },

            clearForm() {
                this.form.nome = '';
                this.errors = {};
            },

            saveGrupo() {
                this.errors = {};
                const isEditing = this.$wire.editingId;
                const url = isEditing ? `/api/grupos/${isEditing}` : '/api/grupos';
                const method = isEditing ? 'put' : 'post'; 

                Axios({
                    method: 'post', 
                    url: url,
                    data: {
                        ...this.form,
                        _method: method 
                    }
                })
                .then(() => {
                    this.$wire.dispatch('grupoSaved');
                    this.clearForm();
                })
                .catch(error => {
                    if (error.response && error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        alert('Erro ao salvar o grupo. Verifique o console.');
                        console.error("Erro ao salvar:", error);
                    }
                });
            },
        }));
    });
</script>