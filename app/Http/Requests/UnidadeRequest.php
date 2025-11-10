<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UnidadeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $unidadeId = $this->route('unidade');

        return [
            // Garante que a Bandeira exista
            'bandeira_id' => ['required', 'exists:bandeiras,id'],
            
            'nome_fantasia' => ['required', 'string', 'max:255'],
            'razao_social' => ['required', 'string', 'max:255'],
            
            'cnpj' => [
                'required',
                'string',
                'size:14', // Ou implemente uma validação de formato mais complexa
                Rule::unique('unidades', 'cnpj')->ignore($unidadeId),
                // Sugestão: Adicionar um Validador customizado para CNPJ (Futuro)
            ],
        ];
    }
}