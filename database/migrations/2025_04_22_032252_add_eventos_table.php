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
        Schema::table('eventos', function (Blueprint $table) {
            $table->string('imagen_ruta')->nullable(); // Agregar la columna imagen_ruta
        });
    }

    /*
        id_evento	nombre	fecha	descripcion	tipo direccion departamento 
    */

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('eventos', function (Blueprint $table) {
            $table->dropColumn('imagen_ruta'); // Eliminar la columna si se revierte la migración
        });
    }
};
