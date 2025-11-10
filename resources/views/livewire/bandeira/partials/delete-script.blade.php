<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('deleteBandeiraManager', () => ({
            init() {
                this.$root.addEventListener('delete-bandeira', (e) => this.confirmDelete(e.detail));
            },

            confirmDelete(data) {
                if (confirm(`Tem certeza que deseja excluir a bandeira: "${data.nome}" (ID: ${data.id})? Esta ação é irreversível.`)) {
                    this.deleteBandeira(data.id);
                }
            },

            deleteBandeira(id) {
                Axios({
                    method: 'post', 
                    url: `/api/bandeiras/${id}`,
                    data: {
                        _method: 'DELETE' 
                    }
                })
                .then(() => {
                    this.$wire.dispatch('bandeiraDeleted');
                    alert(`Bandeira (ID: ${id}) excluída com sucesso!`);
                })
                .catch(error => {
                    alert('Erro ao excluir a bandeira. Verifique as dependências (ex: unidades).');
                    console.error("Erro ao excluir:", error);
                });
            },
        }));
    });
</script>

<div x-data="deleteBandeiraManager()" style="display: none;"></div>