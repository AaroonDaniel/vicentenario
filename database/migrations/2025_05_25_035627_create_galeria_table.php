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
        Schema::create('galeria', function (Blueprint $table) {
            $table->id(); // Campo id
            $table->string('titulo');
            $table->string('imagen'); // Ruta o nombre del archivo
            $table->text('descripcion')->nullable();
            $table->unsignedBigInteger('evento_id'); // FK hacia eventos
            $table->date('fecha');
            $table->timestamps();

            // Definir clave foránea
            $table->foreign('evento_id')
                ->references('id_evento') // Usa la clave primaria de eventos
                ->on('eventos')
                ->onDelete('cascade'); // Opcional: elimina en cascada
        });
    }

};
