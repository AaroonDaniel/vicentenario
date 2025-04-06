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
        Schema::create('idiomas', function (Blueprint $table) {
            $table->id('id_idioma'); // Clave primaria personalizada
            $table->string('nombre', 100)->comment('Nombre del idioma');
            $table->text('descripcion')->nullable()->comment('Descripción detallada del idioma');
            $table->string('region')->nullable()->comment('Región geográfica donde se habla el idioma');

            // Relación con Etnias
            $table->foreignId('id_etnia')
                  ->constrained('etnias', 'id_etnia')
                  ->onDelete('cascade');

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('idiomas');
    }
};