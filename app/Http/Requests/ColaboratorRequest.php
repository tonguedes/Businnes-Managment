<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ColaboradorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $colaboradorId = $this->route('colaborador');

        return [
            // Garante que a Unidade exista
            'unidade_id' => ['required', 'exists:unidades,id'],
            
            'nome' => ['required', 'string', 'max:255'],
            
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('colaboradores', 'email')->ignore($colaboradorId),
            ],
            
            'cpf' => [
                'required',
                'string',
                'size:11', // Ou implemente uma validação de formato mais complexa
                Rule::unique('colaboradores', 'cpf')->ignore($colaboradorId),
                // Sugestão: Adicionar um Validador customizado para CPF (Futuro)
            ],
        ];
    }
}