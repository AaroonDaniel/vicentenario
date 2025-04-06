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
        Schema::create('eventos_patrocinadores', function (Blueprint $table) {
            // Claves foráneas como clave primaria compuesta
            $table->foreignId('id_evento')
                  ->constrained('eventos', 'id_evento')
                  ->onDelete('cascade');
            $table->foreignId('id_auspiciador')
                  ->constrained('patrocinadores', 'id_patrocinador')
                  ->onDelete('cascade');

            // Columnas adicionales
            $table->date('fecha')->nullable();
            $table->decimal('monto', 10, 2)->nullable();

            // Timestamps
            $table->timestamps();

            // Clave primaria compuesta
            $table->primary(['id_evento', 'id_auspiciador']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos_patrocinadores');
    }
};
