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
        Schema::create('idiomas_culturas', function (Blueprint $table) {
            // Claves foráneas como clave primaria compuesta
            $table->foreignId('id_idioma')
                  ->constrained('idiomas', 'id_idioma')
                  ->onDelete('cascade');
            $table->foreignId('id_cultura')
                  ->constrained('culturas', 'id_cultura')
                  ->onDelete('cascade');

            // Columnas adicionales
            $table->string('descripcion', 255)->nullable()->comment('Descripción de la relación entre idioma y cultura');

            // Timestamps
            $table->timestamps();

            // Clave primaria compuesta
            $table->primary(['id_idioma', 'id_cultura']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('idiomas_culturas');
    }
};