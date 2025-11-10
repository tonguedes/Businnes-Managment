<?php

namespace App\Http\Controllers;

use App\Models\GrupoEconomico;
use App\Http\Requests\GrupoEconomicoRequest; // Importamos o FormRequest
use Illuminate\Http\Request;

class GrupoEconomicoController extends Controller
{
    /**
     * LISTAGEM (INDEX)
     * Deve suportar busca (search) para o Livewire/Alpine.
     */
    public function index(Request $request)
    {
        $query = GrupoEconomico::query();

        // Implementação do filtro de busca
        if ($search = $request->get('search')) {
            $query->where('nome', 'like', "%{$search}%");
        }
        
        // Retorna a lista paginada e ordenada
        return response()->json([
            'data' => $query->orderBy('nome')->paginate(10)
        ]);
    }

    /**
     * CRIAÇÃO (STORE)
     * O GrupoEconomicoRequest valida e autoriza antes de chegar aqui.
     */
    public function store(GrupoEconomicoRequest $request)
    {
        // Se a validação passou, criamos o registro
        $grupo = GrupoEconomico::create($request->validated());
        
        return response()->json($grupo, 201); // 201 Created
    }

    /**
     * VISUALIZAÇÃO (SHOW)
     */
    public function show(GrupoEconomico $grupo)
    {
        return response()->json($grupo);
    }

    /**
     * ATUALIZAÇÃO (UPDATE)
     * O GrupoEconomicoRequest lida com a validação 'unique' do nome.
     */
    public function update(GrupoEconomicoRequest $request, GrupoEconomico $grupo)
    {
        $grupo->update($request->validated());
        
        return response()->json($grupo);
    }

    /**
     * DELEÇÃO (DESTROY)
     */
    public function destroy(GrupoEconomico $grupo)
    {
        $grupo->delete();
        
        return response()->noContent(); // 204 No Content
    }
}