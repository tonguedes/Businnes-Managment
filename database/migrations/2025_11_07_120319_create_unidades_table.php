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
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bandeira_id')->constrained()->cascadeOnDelete(); // Bandeira (FK) [cite: 37]
            $table->string('nome_fantasia'); // Nome Fantasia [cite: 32]
            $table->string('razao_social'); // Razão Social [cite: 33]
            $table->string('cnpj', 18)->unique(); // CNPJ [cite: 35]
            $table->timestamps(); // Data de Criação e Última Atualização [cite: 39, 41]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidades');
    }
};
