<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Bandeira extends Model implements Auditable

{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['nome', 'grupo_economico_id'];

    /**
     * Uma Bandeira pertence a um Grupo Econômico.
     */
    public function grupoEconomico(): BelongsTo
    {
        return $this->belongsTo(GrupoEconomico::class);
    }

    /**
     * Uma Bandeira possui muitas Unidades.
     */
    public function unidades(): HasMany
    {
        return $this->hasMany(Unidade::class);
    }
}