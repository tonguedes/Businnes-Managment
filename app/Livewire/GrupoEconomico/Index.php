<?php

namespace App\Livewire\GrupoEconomico;

use App\Models\GrupoEconomico;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;

class Index extends Component
{
    use WithPagination;

    #[Rule('required|string|max:255')]
    public $nome = '';

    public $search = '';
    public $isModalOpen = false;
    public $editingId = null;


    public function render()
    {
        // 1. Consulta o banco de dados e aplica o filtro
        $grupos = GrupoEconomico::where('nome', 'like', '%' . $this->search . '%')
            ->orderBy('nome')
            ->paginate(10);
            
        // 2. RETORNA a view e PASSA a variável '$grupos'
        return view('livewire.grupo-economico.index', [
            'grupos' => $grupos
        ])->layout('layouts.app');
    }

    public function openModal($id = null)
    {
        $this->resetValidation();
        $this->reset('nome', 'editingId');

        if ($id) {
            $grupo = GrupoEconomico::findOrFail($id);
            $this->editingId = $grupo->id;
            $this->nome = $grupo->nome;
        }

        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function save()
    {
        $this->validate();

        GrupoEconomico::updateOrCreate(
            ['id' => $this->editingId],
            ['nome' => $this->nome]
        );

        $this->closeModal();
    }

    public function confirmDelete($id, $nome)
    {
        $this->dispatch('show-delete-confirmation', id: $id, nome: $nome, eventName: 'grupoDeleted');
    }

    #[On('grupoDeleted')]
    public function delete($id)
    {
        GrupoEconomico::findOrFail($id)->delete();
        // Opcional: Adicionar uma mensagem de sucesso que pode ser exibida na tela.
        // session()->flash('message', 'Grupo excluído com sucesso.');
        // A renderização será chamada automaticamente pelo Livewire após este método.
    }
}