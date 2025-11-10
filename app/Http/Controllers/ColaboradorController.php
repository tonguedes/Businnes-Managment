<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Http\Requests\ColaboradorRequest;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
{
    /**
     * Lista todos os colaboradores com suporte a busca.
     */
    public function index(Request $request)
    {
        $query = Colaborador::with('unidade');

        if ($search = $request->get('search')) {
            $query->where('nome', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('cpf', 'like', "%{$search}%");
        }

        return response()->json($query->orderBy('nome')->paginate(10));
    }

    /**
     * Cria um novo colaborador.
     */
    public function store(ColaboradorRequest $request)
    {
        $colaborador = Colaborador::create($request->validated());

        return response()->json($colaborador, 201);
    }

    /**
     * Exibe um colaborador específico.
     */
    public function show(Colaborador $colaborador)
    {
        return response()->json($colaborador->load('unidade'));
    }

    /**
     * Atualiza um colaborador existente.
     */
    public function update(ColaboradorRequest $request, Colaborador $colaborador)
    {
        $colaborador->update($request->validated());

        return response()->json($colaborador);
    }

    /**
     * Deleta um colaborador.
     */
    public function destroy(Colaborador $colaborador)
    {
        $colaborador->delete();

        return response()->noContent();
    }
}
