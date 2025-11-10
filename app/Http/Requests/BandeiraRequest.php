<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BandeiraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // O ID da bandeira que está sendo editada (se for PUT/PATCH)
        $bandeiraId = $this->route('bandeira'); 
        
        return [
            // Garante que o Grupo Econômico exista na tabela
            'grupo_economico_id' => ['required', 'exists:grupo_economicos,id'],
            
            'nome' => [
                'required',
                'string',
                'max:255',
                // Garante que o nome seja único DENTRO do grupo_economico_id
                Rule::unique('bandeiras', 'nome')
                    ->where('grupo_economico_id', $this->input('grupo_economico_id'))
                    ->ignore($bandeiraId), // Ignora o registro atual na edição
            ],
        ];
    }
}