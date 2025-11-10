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
        Schema::create('colaboradors', function (Blueprint $table) {
            $table->id(); // ID [cite: 44]
            $table->foreignId('unidade_id')->constrained()->cascadeOnDelete(); // Unidade (FK) [cite: 50]
            $table->string('nome'); // Nome [cite: 46]
            $table->string('email')->unique(); // email [cite: 47]
            $table->string('cpf', 14)->unique(); // CPF [cite: 49]
            $table->timestamps(); // Data de Criação e Última Atualização [cite: 52]
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colaboradors');
    }
};
