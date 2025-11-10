<?php

namespace App\Livewire\Unidade;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;
use App\Models\Unidade; // Assumindo que você tem este Model
use App\Models\Bandeira; // Precisamos disso para o dropdown

class Index extends Component
{
    use WithPagination;

    // Propriedades para o formulário do modal
    #[Rule('required|string|max:255')]
    public $nome_fantasia = '';

    #[Rule('required|string|max:255')]
    public $razao_social = '';

    #[Rule('required|string|max:18')] // Formato: 00.000.000/0000-00
    public $cnpj = '';

    #[Rule('required|exists:bandeiras,id')]
    public $bandeira_id = '';

    // Propriedades de controle
    public $search = '';
    public $isModalOpen = false;
    public $editingId = null;

    public function openModal($id = null)
    {
        $this->isModalOpen = true;
        $this->resetValidation();
        $this->reset('nome_fantasia', 'razao_social', 'cnpj', 'bandeira_id', 'editingId');

        if ($id) {
            $unidade = Unidade::findOrFail($id);
            $this->editingId = $unidade->id;
            $this->nome_fantasia = $unidade->nome_fantasia;
            $this->razao_social = $unidade->razao_social;
            $this->cnpj = $unidade->cnpj;
            $this->bandeira_id = $unidade->bandeira_id;
        }
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->editingId = null;
    }

    public function save()
    {
        $this->validate();

        Unidade::updateOrCreate(
            ['id' => $this->editingId],
            [
                'nome_fantasia' => $this->nome_fantasia,
                'razao_social' => $this->razao_social,
                'cnpj' => $this->cnpj,
                'bandeira_id' => $this->bandeira_id,
            ]
        );

        $this->closeModal();
    }

    public function confirmDelete($id, $nome)
    {
        $this->dispatch('show-delete-confirmation', id: $id, nome: $nome, eventName: 'unidadeDeleted');
    }

    #[On('unidadeDeleted')]
    public function delete($id)
    {
        Unidade::findOrFail($id)->delete();
    }
    
    public function render()
    {
        // 1. Consulta as Unidades e aplica o filtro (Nome Fantasia ou Razão Social)
        $unidades = Unidade::with('bandeira') // Carrega o relacionamento Bandeira
            ->where('nome_fantasia', 'like', '%' . $this->search . '%')
            ->orWhere('razao_social', 'like', '%' . $this->search . '%')
            ->orderBy('nome_fantasia')
            ->paginate(10);

        // 2. Consulta todas as Bandeiras (para o Dropdown no Modal)
        $bandeiras = Bandeira::orderBy('nome')->get(['id', 'nome']);
            
        // 3. RETORNA a view, passando as Unidades e as Bandeiras
        return view('livewire.unidade.index', [
            'unidades' => $unidades,
            'bandeiras' => $bandeiras // ESSENCIAL para o formulário
        ])->layout('layouts.app'); // Usando 'layouts.app' para evitar o erro anterior
    }
}