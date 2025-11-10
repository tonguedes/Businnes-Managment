<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('deleteUnidadeManager', () => ({
            init() {
                this.$root.addEventListener('delete-unidade', (e) => this.confirmDelete(e.detail));
            },

            confirmDelete(data) {
                if (confirm(`Tem certeza que deseja excluir a unidade: "${data.nome}" (ID: ${data.id})? Esta ação é irreversível.`)) {
                    this.deleteUnidade(data.id);
                }
            },

            deleteUnidade(id) {
                // Assumindo rota API /api/unidades/{id}
                Axios({
                    method: 'post', 
                    url: `/api/unidades/${id}`,
                    data: {
                        _method: 'DELETE' 
                    }
                })
                .then(() => {
                    this.$wire.dispatch('unidadeDeleted');
                    alert(`Unidade (ID: ${id}) excluída com sucesso!`);
                })
                .catch(error => {
                    alert('Erro ao excluir a unidade. Verifique as dependências (ex: colaboradores).');
                    console.error("Erro ao excluir:", error);
                });
            },
        }));
    });
</script>

<div x-data="deleteUnidadeManager()" style="display: none;"></div>