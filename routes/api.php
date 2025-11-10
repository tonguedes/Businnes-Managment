<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GrupoEconomicoController;
use App\Http\Controllers\BandeiraController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\ColaboradorController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aqui você define as rotas que são carregadas pelo RouteServiceProvider.
| Essas rotas são stateless e automaticamente prefixadas com 'api'.
|
*/

// Rota para criar um token de autenticação
Route::post('/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);
 
    $user = User::where('email', $request->email)->first();
 
    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['As credenciais fornecidas estão incorretas.'],
        ]);
    }
 
    return response()->json([
        'token' => $user->createToken($request->device_name)->plainTextToken
    ]);
});

// Rotas protegidas pelo token de autenticação Sanctum
Route::middleware('auth:sanctum')->group(function () {

    // CRUD de Grupos Econômicos
    Route::apiResource('grupos', GrupoEconomicoController::class);

    // CRUD de Bandeiras
    // Rota aninhada (Nested) para acessar bandeiras de um grupo específico: /api/grupos/{grupo}/bandeiras
    // Embora apiResource não suporte aninhamento nativo, podemos usar o prefixo para simular:
    Route::apiResource('bandeiras', BandeiraController::class);

    // CRUD de Unidades
    Route::apiResource('unidades', UnidadeController::class);

    // CRUD de Colaboradores
    Route::apiResource('colaboradores', ColaboradorController::class);

    // Rota básica para retornar o usuário logado (teste de autenticação)
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});