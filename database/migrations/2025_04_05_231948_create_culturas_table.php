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
        Schema::create('culturas', function (Blueprint $table) {
            $table->id('id_cultura'); // Clave primaria personalizada
            $table->foreignId('id_historia')
                  ->constrained('historias', 'id_historia') // Cambio aquí: 'historias' en lugar de 'historia'
                  ->onDelete('cascade');
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('tipo');
            $table->string('origen');

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('culturas');
    }
};