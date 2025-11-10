<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GrupoEconomico extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    /**
     * Um Grupo possui muitas Bandeiras.
     */
    public function bandeiras(): HasMany
    {
        return $this->hasMany(Bandeira::class);
    }
}