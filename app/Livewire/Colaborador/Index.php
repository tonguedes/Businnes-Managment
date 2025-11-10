<?php

namespace App\Livewire\Colaborador;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;
use App\Models\Colaborador; // Assumindo que você tem este Model
use App\Models\Unidade;     // Precisamos disso para o dropdown

class Index extends Component
{
    use WithPagination;

    // Propriedades para o formulário do modal
    #[Rule('required|string|max:255')]
    public $nome = '';

    #[Rule('required|email|max:255')]
    public $email = '';

    #[Rule('required|string|max:14')] // Formato com pontos e traço
    public $cpf = '';

    #[Rule('required|exists:unidades,id')]
    public $unidade_id = '';

    // Propriedades de controle
    public $search = '';
    public $isModalOpen = false;
    public $editingId = null;

    public function openModal($id = null)
    {
        $this->isModalOpen = true;
        $this->resetValidation();
        $this->reset('nome', 'email', 'cpf', 'unidade_id', 'editingId');

        if ($id) {
            $colaborador = Colaborador::findOrFail($id);
            $this->editingId = $colaborador->id;
            $this->nome = $colaborador->nome;
            $this->email = $colaborador->email;
            $this->cpf = $colaborador->cpf;
            $this->unidade_id = $colaborador->unidade_id;
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

        Colaborador::updateOrCreate(
            ['id' => $this->editingId],
            [
                'nome' => $this->nome,
                'email' => $this->email,
                'cpf' => $this->cpf,
                'unidade_id' => $this->unidade_id,
            ]
        );

        $this->closeModal();
    }

    public function confirmDelete($id, $nome)
    {
        $this->dispatch('show-delete-confirmation', id: $id, nome: $nome, eventName: 'colaboradorDeleted');
    }

    #[On('colaboradorDeleted')]
    public function delete($id)
    {
        Colaborador::findOrFail($id)->delete();
    }
    
    public function render()
    {
        // 1. Consulta os Colaboradores, carregando o relacionamento Unidade
        $colaboradores = Colaborador::with('unidade')
            ->where('nome', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy('nome')
            ->paginate(10);

        // 2. Consulta todas as Unidades (para o Dropdown no Modal)
        $unidades = Unidade::orderBy('nome_fantasia')->get(['id', 'nome_fantasia']);
            
        // 3. RETORNA a view, passando os Colaboradores e as Unidades
        return view('livewire.colaborador.index', [
            'colaboradores' => $colaboradores,
            'unidades' => $unidades 
        ])->layout('layouts.app'); 
    }
}