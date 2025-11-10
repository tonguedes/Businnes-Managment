<?php

use App\Livewire\GrupoEconomico\Index as GrupoEconomicoIndex;
use App\Livewire\Bandeira\Index as BandeiraIndex;
use App\Livewire\Unidade\Index as UnidadeIndex;
use App\Livewire\Colaborador\Index as ColaboradorIndex;
use Illuminate\Support\Facades\Route;

// 1. Rota Raiz: Redireciona o acesso principal para a área de grupos.
Route::get('/', function () {
    // Se o usuário estiver logado, redireciona para grupos.
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    // Caso contrário, redireciona para a tela de login (o middleware 'auth' fará isso).
    return redirect()->route('login');
});

// Rotas Protegidas (Exige Login)
// Usamos o middleware 'auth' para proteger todo o bloco.
Route::middleware(['auth'])->group(function () {
    
    // Rotas de Gestão (Agora todas protegidas)
    Route::get('/grupos', GrupoEconomicoIndex::class)->name('grupos.index');
    Route::get('/bandeiras', BandeiraIndex::class)->name('bandeiras.index');
    Route::get('/unidades', UnidadeIndex::class)->name('unidades.index');
    Route::get('/colaboradores', ColaboradorIndex::class)->name('colaboradores.index');

    // Rotas de Usuário (Mantidas do Breeze)
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('profile', 'profile')->name('profile');
});


// As rotas de login/logout/register (definidas pelo Breeze) são carregadas aqui.
require __DIR__.'/auth.php'; 