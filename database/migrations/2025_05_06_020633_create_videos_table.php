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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evento_id'); // Clave foránea
            $table->string('titulo');
            $table->string('url');
            $table->text('descripcion'); 

            $table->timestamps();

            // Definición de la clave foránea
            $table->foreign('evento_id')->references('id_evento')->on('eventos')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
