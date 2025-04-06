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
        Schema::create('eventos_expositores', function (Blueprint $table) {
            // Claves foráneas como clave primaria compuesta
            $table->foreignId('id_evento')
                  ->constrained('eventos', 'id_evento')
                  ->onDelete('cascade');
            $table->foreignId('id_expositor')
                  ->constrained('expositores', 'id_expositor')
                  ->onDelete('cascade');

            // Columnas adicionales
            $table->string('fecha')->nullable()->comment('Fecha del evento');
            $table->string('tema')->nullable()->comment('Tema del evento');

            // Timestamps
            $table->timestamps();

            // Clave primaria compuesta
            $table->primary(['id_evento', 'id_expositor']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos_expositores');
    }
};