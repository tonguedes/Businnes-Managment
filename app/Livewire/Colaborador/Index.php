<?php

namespace App\Livewire\Colaborador;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;
use App\Models\Colaborador; 
use App\Models\Unidade;   
use App\Models\Bandeira;
use App\Exports\ColaboradorExport;
use Maatwebsite\Excel\Facades\Excel;

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

    
    // 👇 AS PROPRIEDADES PÚBLICAS DEVEM ESTAR AQUI 👇
    public $filter_unidade_id = '';
    public $filter_bandeira_id = '';
    public $filter_cpf = '';

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
        // 1. Inicia a consulta base para Colaboradores
        $query = Colaborador::query()->with(['unidade.bandeira']);

        // 2. Aplica os filtros dinamicamente
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('nome', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }
        if (!empty($this->filter_cpf)) {
            $query->where('cpf', 'like', '%' . $this->filter_cpf . '%');
        }
        if (!empty($this->filter_unidade_id)) {
            $query->where('unidade_id', $this->filter_unidade_id);
        }
        if (!empty($this->filter_bandeira_id)) {
            $query->whereHas('unidade', function ($q) {
                $q->where('bandeira_id', $this->filter_bandeira_id);
            });
        }

        $colaboradores = $query->orderBy('nome')->paginate(10);

        // 3. Consulta dados para os filtros e modal
        $unidades = Unidade::orderBy('nome_fantasia')->get(['id', 'nome_fantasia']);
        $bandeiras = Bandeira::orderBy('nome')->get(['id', 'nome']);
            
        // 4. Retorna a view com todos os dados necessários
        return view('livewire.colaborador.index', [
            'colaboradores' => $colaboradores,
            'unidades' => $unidades,
            'bandeiras' => $bandeiras,
        ])->layout('layouts.app'); 
    }

    /**
     * Gera e baixa o arquivo Excel com os colaboradores filtrados.
     */
    public function exportExcel()
    {
        $filters = [
            'search' => $this->search,
            'unidade_id' => $this->filter_unidade_id,
            'bandeira_id' => $this->filter_bandeira_id,
            'cpf' => $this->filter_cpf,
        ];


        $fileName = 'colaboradores_' . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(new ColaboradorExport($filters), $fileName);
    }
}
