<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('novedades', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('departamento');
            $table->text('descripcion');
            $table->string('imagen')->nullable(); // ruta de imagen
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('novedades');
    }
};
