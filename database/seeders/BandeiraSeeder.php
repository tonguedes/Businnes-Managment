<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GrupoEconomico;
use App\Models\Bandeira;

class BandeiraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pega todos os grupos econômicos já criados
        $grupos = GrupoEconomico::all();

        foreach ($grupos as $grupo) {
            // Cria 2 bandeiras para cada grupo econômico
            Bandeira::create([
                'grupo_economico_id' => $grupo->id,
                'nome' => 'Bandeira ' . fake()->company() . ' ' . $grupo->id,
            ]);
            Bandeira::create([
                'grupo_economico_id' => $grupo->id,
                'nome' => 'Bandeira ' . fake()->company() . ' ' . $grupo->id,
            ]);
        }
    }
}