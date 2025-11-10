<?php

namespace App\Exports;

use App\Models\Colaborador;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ColaboradorExport implements FromQuery, WithHeadings, WithMapping
{
    protected $filters;

    /**
     * Recebe os filtros do componente Livewire.
     */
    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    /**
     * Define a consulta ao banco de dados com base nos filtros.
     */
    public function query()
    {
        $query = Colaborador::query()->with(['unidade.bandeira']);

        // Aplica filtro de busca geral (nome ou email)
        if (!empty($this->filters['search'])) {
            $query->where(function ($q) {
                $q->where('nome', 'like', '%' . $this->filters['search'] . '%')
                  ->orWhere('email', 'like', '%' . $this->filters['search'] . '%');
            });
        }

        // Aplica filtro por CPF
        if (!empty($this->filters['cpf'])) {
            $query->where('cpf', 'like', '%' . $this->filters['cpf'] . '%');
        }

        // Aplica filtro por Unidade
        if (!empty($this->filters['unidade_id'])) {
            $query->where('unidade_id', $this->filters['unidade_id']);
        }

        // Aplica filtro por Bandeira (através do relacionamento)
        if (!empty($this->filters['bandeira_id'])) {
            $query->whereHas('unidade', function ($q) {
                $q->where('bandeira_id', $this->filters['bandeira_id']);
            });
        }

        return $query->orderBy('nome');
    }

    /**
     * Define os cabeçalhos das colunas no Excel.
     */
    public function headings(): array
    {
        return [
            'Nome',
            'Email',
            'CPF',
            'Unidade',
            'Bandeira',
        ];
    }

    /**
     * Mapeia os dados de cada colaborador para as colunas do Excel.
     */
    public function map($colaborador): array
    {
        return [
            $colaborador->nome,
            $colaborador->email,
            $colaborador->cpf,
            $colaborador->unidade->nome_fantasia ?? 'N/A',
            $colaborador->unidade->bandeira->nome ?? 'N/A',
        ];
    }
}