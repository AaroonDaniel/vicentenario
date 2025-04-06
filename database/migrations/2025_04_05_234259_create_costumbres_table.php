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
        Schema::create('costumbres', function (Blueprint $table) {
            $table->id('id_costumbre'); // Clave primaria personalizada
            $table->foreignId('id_etnia') // Clave foránea hacia etnias
                  ->constrained('etnias', 'id_etnia')
                  ->onDelete('cascade');
            $table->string('nombre', 100)->comment('Nombre de la costumbre');
            $table->text('descripcion')->nullable()->comment('Descripción de la costumbre');
            $table->string('vestimenta', 255)->nullable()->comment('Vestimenta asociada a la costumbre');
            $table->timestamps(); // Columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costumbres');
    }
};