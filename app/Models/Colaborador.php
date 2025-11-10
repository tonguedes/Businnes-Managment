<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Colaborador extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email', 'cpf', 'unidade_id'];

    /**
     * Um Colaborador pertence a uma Unidade.
     */
    public function unidade(): BelongsTo
    {
        return $this->belongsTo(Unidade::class);
    }
}