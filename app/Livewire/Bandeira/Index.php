<?php

namespace App\Livewire\Bandeira;

use App\Models\Bandeira;
use App\Models\GrupoEconomico;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Livewire\Attributes\On;

class Index extends Component
{
    use WithPagination;

    // Propriedades para o formulário do modal
    #[Rule('required|string|max:255')]
    public $nome = '';

    #[Rule('required|exists:grupo_economicos,id')]
    public $grupo_economico_id = '';

    // Propriedades de controle
    public $search = '';
    public $isModalOpen = false;
    public $editingId = null;

    public function render()
    {
        $bandeiras = Bandeira::with('grupoEconomico')
            ->where('nome', 'like', '%' . $this->search . '%')
            ->orderBy('nome')
            ->paginate(10);

        // Precisamos dos grupos para popular o <select> no modal
        $grupos = GrupoEconomico::orderBy('nome')->get();

        return view('livewire.bandeira.index', [
            'bandeiras' => $bandeiras,
            'grupos' => $grupos,
        ])->layout('layouts.app');
    }

    public function openModal($id = null)
    {
        $this->resetValidation();
        $this->reset('nome', 'grupo_economico_id', 'editingId');

        if ($id) {
            $bandeira = Bandeira::findOrFail($id);
            $this->editingId = $bandeira->id;
            $this->nome = $bandeira->nome;
            $this->grupo_economico_id = $bandeira->grupo_economico_id;
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

        Bandeira::updateOrCreate(
            ['id' => $this->editingId],
            [
                'nome' => $this->nome,
                'grupo_economico_id' => $this->grupo_economico_id,
            ]
        );

        $this->closeModal();
    }

    public function confirmDelete($id, $nome)
    {
        $this->dispatch('show-delete-confirmation', id: $id, nome: $nome, eventName: 'bandeiraDeleted');
    }

    #[On('bandeiraDeleted')]
    public function delete($id)
    {
        Bandeira::findOrFail($id)->delete();
    }
}