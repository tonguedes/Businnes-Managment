<script>
    // Escuta o evento 'show-delete-confirmation' disparado pelo componente Livewire
    document.addEventListener('livewire:initialized', () => {
        @this.on('show-delete-confirmation', (event) => {
            // Extrai o ID e o nome do evento
            const id = event.id;
            const nome = event.nome;
            // Extrai o nome do evento a ser disparado na confirmação
            const eventName = event.eventName || 'itemDeleted';
 
            // Usa a janela de confirmação do navegador
            if (confirm(`Tem certeza que deseja excluir "${nome}"? Esta ação é irreversível.`)) {
                // Se o usuário confirmar, dispara o evento específico que o componente PHP está ouvindo,
                // passando o ID do item a ser excluído.
                @this.dispatch(eventName, { id: id });
            }
        });
    });
</script>