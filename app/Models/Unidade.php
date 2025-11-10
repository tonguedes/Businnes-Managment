<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unidade extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['nome_fantasia', 'razao_social', 'cnpj', 'bandeira_id'];

    /**
     * Uma Unidade pertence a uma Bandeira.
     */
    public function bandeira(): BelongsTo
    {
        return $this->belongsTo(Bandeira::class);
    }

    /**
     * Uma Unidade possui muitos Colaboradores.
     */
    public function colaboradores(): HasMany
    {
        return $this->hasMany(Colaborador::class);
    }
}