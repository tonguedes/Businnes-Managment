<?php

namespace App\Livewire\AuditLog;

use Livewire\Component;
use OwenIt\Auditing\Models\Audit;
use App\Models\User;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $auditable_type = '';
    public string $user_id = '';
    public string $event = '';

    public array $auditable_types = [];
    public $users;

    /**
     * Prepara os dados para os filtros.
     */
    public function mount(): void
    {
        $this->auditable_types = Audit::select('auditable_type')
            ->distinct()
            ->pluck('auditable_type')
            ->map(fn ($type) => class_basename($type))
            ->sort()
            ->all();

        $this->users = User::orderBy('name')->get();
    }

    /**
     * Reseta os filtros de busca.
     */
    public function resetFilters(): void
    {
        $this->reset(['auditable_type', 'user_id', 'event']);
        $this->resetPage();
    }

    public function render()
    {
        $query = Audit::with('user')->latest();

        if ($this->auditable_type) {
            $query->where('auditable_type', 'like', '%' . $this->auditable_type . '%');
        }
        if ($this->user_id) {
            $query->where('user_id', $this->user_id);
        }
        if ($this->event) {
            $query->where('event', $this->event);
        }

        return view('livewire.audit-log.index', [
            'audits' => $query->paginate(15),
        ])->layout('layouts.app');
    }
}