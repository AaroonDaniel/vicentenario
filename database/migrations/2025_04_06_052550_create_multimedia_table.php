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
        Schema::create('multimedia', function (Blueprint $table) {
            $table->id('id_multimedia'); // Clave primaria personalizada
            $table->foreignId('id_evento')
                  ->constrained('eventos', 'id_evento')
                  ->onDelete('cascade');
            $table->string('tipo_archivo');
            $table->string('ruta_archivo');
            $table->text('descripcion_archivo');

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multimedia');
    }
};
