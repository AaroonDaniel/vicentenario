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
        Schema::create('etnias', function (Blueprint $table) {
            $table->id('id_etnia'); // Clave primaria personalizada
            $table->foreignId('id_cultura')
                  ->constrained('culturas', 'id_cultura')
                  ->onDelete('cascade');
            $table->string('nombre');
            $table->string('ubicacion');
            $table->integer('poblacion');

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etnias');
    }
};