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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id('id_evento'); // Tipo: BIGINT UNSIGNED AUTO_INCREMENT
            $table->string('nombre', 255)->comment('Nombre del evento');
            $table->date('fecha')->comment('Fecha del evento');
            $table->text('descripcion')->nullable()->comment('Descripción detallada del evento');
            $table->string('tipo', 100)->comment('Tipo de evento (e.g., Cultural, Histórico)');
            $table->string('direccion', 255)->nullable()->comment('Dirección del evento');
            $table->string('departamento', 100)->nullable()->comment('Departamento o región donde se realiza el evento');
            $table->timestamps(); // Columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};