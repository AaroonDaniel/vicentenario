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
        Schema::create('participantes_eventos', function (Blueprint $table) {
            // Claves foráneas como clave primaria compuesta
            $table->unsignedBigInteger('id_evento'); // Tipo: BIGINT UNSIGNED
            $table->unsignedBigInteger('user_id');   // Tipo: BIGINT UNSIGNED

            // Definir las claves foráneas
            $table->foreign('id_evento')
                  ->references('id_evento')
                  ->on('eventos')
                  ->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade');

            // Columnas adicionales
            $table->string('rol', 100)->nullable()->comment('Rol del participante en el evento (e.g., Asistente, Organizador)');
            $table->boolean('confirmado')->default(false)->comment('Indica si el participante confirmó su asistencia');

            // Timestamps
            $table->timestamps();

            // Clave primaria compuesta
            $table->primary(['id_evento', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participantes_eventos');
    }
};
