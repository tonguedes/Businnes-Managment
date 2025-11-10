<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unidade;
use App\Models\Colaborador;

class ColaboradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pega todas as unidades já criadas
        $unidades = Unidade::all();

        foreach ($unidades as $unidade) {
            // Cria 2 colaboradores para cada unidade
            for ($i = 0; $i < 2; $i++) {
                Colaborador::create([
                    'unidade_id' => $unidade->id,
                    'nome' => fake()->name(),
                    'email' => fake()->unique()->safeEmail(),
                    'cpf' => fake()->unique()->numerify('###########'), // 11 dígitos
                ]);
            }
        }
    }
}