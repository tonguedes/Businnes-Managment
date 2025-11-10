<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrupoEconomicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('grupo_economicos')->insert([
            [
                'nome' => 'Grupo Econômico A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Grupo Econômico B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Grupo Econômico C',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
