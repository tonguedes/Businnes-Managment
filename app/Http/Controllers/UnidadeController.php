<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use App\Http\Requests\UnidadeRequest;
use Illuminate\Http\Request;

class UnidadeController extends Controller
{
    /**
     * Lista todas as unidades com suporte a busca.
     */
    public function index(Request $request)
    {
        $query = Unidade::with('bandeira');

        if ($search = $request->get('search')) {
            $query->where('nome_fantasia', 'like', "%{$search}%")
                  ->orWhere('razao_social', 'like', "%{$search}%");
        }

        return response()->json($query->orderBy('nome_fantasia')->paginate(10));
    }

    /**
     * Cria uma nova unidade.
     */
    public function store(UnidadeRequest $request)
    {
        $unidade = Unidade::create($request->validated());

        return response()->json($unidade, 201);
    }

    /**
     * Exibe uma unidade específica.
     */
    public function show(Unidade $unidade)
    {
        return response()->json($unidade->load('bandeira'));
    }

    /**
     * Atualiza uma unidade existente.
     */
    public function update(UnidadeRequest $request, Unidade $unidade)
    {
        $unidade->update($request->validated());

        return response()->json($unidade);
    }

    /**
     * Deleta uma unidade.
     */
    public function destroy(Unidade $unidade)
    {
        $unidade->delete();

        return response()->noContent();
    }
}
