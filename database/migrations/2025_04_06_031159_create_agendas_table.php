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
        Schema::create('agendas', function (Blueprint $table) {
            $table->id('id_agenda'); // Clave primaria personalizada
            $table->foreignId('id_evento')
                  ->constrained('eventos', 'id_evento')
                  ->onDelete('cascade'); // Relación con eventos
            $table->string('titulo', 255)->comment('Título de la actividad');
            $table->text('descripcion')->nullable()->comment('Descripción detallada de la actividad');
            $table->dateTime('fecha_inicio')->comment('Fecha y hora de inicio');
            $table->dateTime('fecha_fin')->comment('Fecha y hora de finalización');
            $table->string('ubicacion', 255)->nullable()->comment('Ubicación de la actividad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
