<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class GrupoEconomicoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // A autorização via 'auth:sanctum' já garante que o usuário está logado.
        // Se você implementou a auditoria, podemos adicionar uma checagem de permissão aqui no futuro.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // 'grupo' é o nome do parâmetro na rota 'api/grupos/{grupo}'
        $grupoId = $this->route('grupo') ? $this->route('grupo')->id : null;

        return [
            'nome' => [
                'required', 'string', 'max:255',
                Rule::unique('grupo_economicos', 'nome')->ignore($grupoId)
            ],
        ];
    }
}