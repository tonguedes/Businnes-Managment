<?php

use App\Livewire\GrupoEconomico\Index as GrupoEconomicoIndex;
use App\Livewire\Bandeira\Index as BandeiraIndex;
use App\Livewire\Unidade\Index as UnidadeIndex;
use App\Livewire\Colaborador\Index as ColaboradorIndex;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Adicione esta rota para carregar a sua página de grupos
Route::get('grupos', GrupoEconomicoIndex::class)
    ->middleware(['auth'])->name('grupos');


Route::get('/bandeiras', BandeiraIndex::class)->name('bandeiras');
Route::get('/unidades', UnidadeIndex::class)->name('unidades');
Route::get('/colaboradores', ColaboradorIndex::class)->name('colaboradores');




require __DIR__.'/auth.php';
