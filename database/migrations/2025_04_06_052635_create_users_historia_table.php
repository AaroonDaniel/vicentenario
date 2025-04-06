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
        Schema::create('users_historia', function (Blueprint $table) {
            // Claves foráneas como clave primaria compuesta
            $table->foreignId('user_id')
                  ->constrained('users', 'user_id')
                  ->onDelete('cascade');
            $table->foreignId('id_historia')
                  ->constrained('historias', 'id_historia')
                  ->onDelete('cascade');

            // Columnas adicionales
            $table->string('puntuacion')->nullable()->comment('Puntuación del usuario en la historia');

            // Timestamps
            $table->timestamps();

            // Clave primaria compuesta
            $table->primary(['user_id', 'id_historia']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_historia');
    }
};