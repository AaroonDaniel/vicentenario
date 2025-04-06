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
        Schema::create('expositores', function (Blueprint $table) {
            $table->id('id_expositor'); // Clave primaria personalizada
            $table->string('nombre', 255)->comment('Nombre del expositor');
            $table->string('especialidad', 255)->nullable()->comment('Especialidad o área de conocimiento del expositor');
            $table->string('institucion', 255)->nullable()->comment('Institución a la que pertenece el expositor');
            $table->string('contacto', 255)->nullable()->comment('Información de contacto del expositor');
            $table->timestamps(); // Columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expositores');
    }
};
