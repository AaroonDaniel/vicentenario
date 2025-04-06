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
        Schema::create('preferencias_usuario', function (Blueprint $table) {
            $table->id('id_preferencia'); // Clave primaria personalizada
            $table->foreignId('user_id')
                  ->constrained('users', 'user_id')
                  ->onDelete('cascade');
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('tipo');

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preferencias_usuario');
    }
};