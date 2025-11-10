<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('deleteColaboradorManager', () => ({
            init() {
                this.$root.addEventListener('delete-colaborador', (e) => this.confirmDelete(e.detail));
            },

            confirmDelete(data) {
                if (confirm(`Tem certeza que deseja excluir o colaborador: "${data.nome}" (ID: ${data.id})? Esta ação é irreversível.`)) {
                    this.deleteColaborador(data.id);
                }
            },

            deleteColaborador(id) {
                // Assumindo rota API /api/colaboradores/{id}
                Axios({
                    method: 'post', 
                    url: `/api/colaboradores/${id}`,
                    data: {
                        _method: 'DELETE' 
                    }
                })
                .then(() => {
                    this.$wire.dispatch('colaboradorDeleted');
                    alert(`Colaborador (ID: ${id}) excluído com sucesso!`);
                })
                .catch(error => {
                    alert('Erro ao excluir o colaborador. Verifique as dependências.');
                    console.error("Erro ao excluir:", error);
                });
            },
        }));
    });
</script>

<div x-data="deleteColaboradorManager()" style="display: none;"></div>