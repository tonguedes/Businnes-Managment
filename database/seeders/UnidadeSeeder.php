<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bandeira;
use App\Models\Unidade;

class UnidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pega todas as bandeiras já criadas
        $bandeiras = Bandeira::all();

        foreach ($bandeiras as $bandeira) {
            // Cria 2 unidades para cada bandeira
            for ($i = 0; $i < 2; $i++) {
                Unidade::create([
                    'bandeira_id' => $bandeira->id,
                    'nome_fantasia' => fake()->company(),
                    'razao_social' => fake()->company() . ' LTDA',
                    'cnpj' => fake()->unique()->numerify('##############'), // 14 dígitos
                ]);
            }
        }
    }
}