<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
 
class Colaborador extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['nome', 'email', 'cpf', 'unidade_id'];

    /**
     * Um Colaborador pertence a uma Unidade.
     */
    public function unidade(): BelongsTo
    {
        return $this->belongsTo(Unidade::class);
    }}