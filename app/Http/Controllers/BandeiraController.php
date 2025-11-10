<?php

namespace App\Http\Controllers;

use App\Models\Bandeira;
use App\Http\Requests\BandeiraRequest;
use Illuminate\Http\Request;

class BandeiraController extends Controller
{
    /**
     * Lista todas as bandeiras com suporte a busca.
     */
    public function index(Request $request)
    {
        $query = Bandeira::with('grupoEconomico');

        if ($search = $request->get('search')) {
            $query->where('nome', 'like', "%{$search}%");
        }

        return response()->json($query->orderBy('nome')->paginate(10));
    }

    /**
     * Cria uma nova bandeira.
     */
    public function store(BandeiraRequest $request)
    {
        $bandeira = Bandeira::create($request->validated());

        return response()->json($bandeira, 201);
    }

    /**
     * Exibe uma bandeira específica.
     */
    public function show(Bandeira $bandeira)
    {
        return response()->json($bandeira->load('grupoEconomico'));
    }

    /**
     * Atualiza uma bandeira existente.
     */
    public function update(BandeiraRequest $request, Bandeira $bandeira)
    {
        $bandeira->update($request->validated());

        return response()->json($bandeira);
    }

    /**
     * Deleta uma bandeira.
     */
    public function destroy(Bandeira $bandeira)
    {
        $bandeira->delete();

        return response()->noContent();
    }
}
