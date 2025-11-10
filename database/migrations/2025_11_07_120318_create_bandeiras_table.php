<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bandeiras', function (Blueprint $table) {
            $table->id();
           $table->foreignId('grupo_economico_id')->constrained()->cascadeOnDelete(); // Grupo Econômico (FK) [cite: 23]
            $table->string('nome'); // Nome [cite: 21]
            $table->timestamps(); // Data de Criação e Última Atualização [cite: 25, 27]

            $table->unique(['grupo_economico_id', 'nome']); // Para garantir que um grupo não tenha duas bandeiras com o mesmo nome
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bandeiras');
    }
};
