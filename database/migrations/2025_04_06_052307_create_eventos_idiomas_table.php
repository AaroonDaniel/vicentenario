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
        Schema::create('eventos_idiomas', function (Blueprint $table) {
            // Claves foráneas como clave primaria compuesta
            $table->foreignId('id_evento')
                  ->constrained('eventos', 'id_evento')
                  ->onDelete('cascade');
            $table->foreignId('id_idioma')
                  ->constrained('idiomas', 'id_idioma')
                  ->onDelete('cascade');

            // Columnas adicionales
            $table->string('nivel_requerido')->nullable()->comment('Nivel de idioma requerido para el evento');

            // Timestamps
            $table->timestamps();

            // Clave primaria compuesta
            $table->primary(['id_evento', 'id_idioma']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos_idiomas');
    }
};
